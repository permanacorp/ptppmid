<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Wysiwyg_security Library
 *
 * Server-side HTML sanitizer / purifier specifically designed for WYSIWYG
 * rich-text content (CKEditor, TinyMCE, Summernote) on modern PHP (7.4 - 8.5+).
 * 
 * Provides defense-in-depth against Stored XSS, Reverse Tabnabbing, and CSS injection
 * while strictly preserving legitimate formatting, tables, lists, media, and styles.
 */
#[\AllowDynamicProperties]
class Wysiwyg_security {

    private static $allowed_tags = [
        'p', 'br', 'hr', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'b', 'strong', 'i', 'em', 'u', 's', 'strike', 'sub', 'sup', 'small', 'mark',
        'span', 'div', 'blockquote', 'pre', 'code',
        'ul', 'ol', 'li', 'dl', 'dt', 'dd',
        'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td', 'caption', 'col', 'colgroup',
        'a', 'img', 'figure', 'figcaption',
        'iframe'
    ];

    private static $allowed_attributes = [
        'id', 'class', 'title', 'dir', 'lang', 'style',
        'href', 'target', 'rel', 'download',
        'src', 'alt', 'width', 'height', 'loading',
        'border', 'cellpadding', 'cellspacing', 'align', 'valign', 'colspan', 'rowspan', 'scope',
        'frameborder', 'allow', 'allowfullscreen'
    ];

    private static $trusted_iframe_domains = [
        'youtube.com',
        'www.youtube.com',
        'youtube-nocookie.com',
        'www.youtube-nocookie.com',
        'youtu.be',
        'vimeo.com',
        'player.vimeo.com',
        'google.com',
        'www.google.com',
        'maps.google.com'
    ];

    public function __construct() {
        // Ready
    }

    /**
     * Sanitize rich-text WYSIWYG HTML
     *
     * @param string|null $html
     * @return string
     */
    public static function clean($html) {
        if ($html === null || $html === '' || !is_string($html)) {
            return '';
        }

        // Fast path: if no tags present, escape plain text
        if (strpos($html, '<') === false) {
            return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }

        if (!class_exists('DOMDocument')) {
            // Fallback: strip dangerous tags via regex if DOMDocument is missing
            return self::regexFallbackClean($html);
        }

        $dom = new DOMDocument();
        $options = LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NONET;
        if (defined('LIBXML_NOERROR')) $options |= LIBXML_NOERROR;
        if (defined('LIBXML_NOWARNING')) $options |= LIBXML_NOWARNING;

        // Wrap with standard HTML5 envelope to ensure UTF-8 encoding
        $wrapped = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body><div id="__purify_wrapper">' . $html . '</div></body></html>';
        
        @$dom->loadHTML($wrapped, $options);

        $wrapper = $dom->getElementById('__purify_wrapper');
        if (!$wrapper) {
            return '';
        }

        self::sanitizeNode($wrapper);

        // Extract innerHTML
        $result = '';
        foreach ($wrapper->childNodes as $child) {
            $result .= $dom->saveHTML($child);
        }

        return $result;
    }

    private static function sanitizeNode(DOMNode $node) {
        if ($node->hasChildNodes()) {
            $children = iterator_to_array($node->childNodes);
            foreach ($children as $child) {
                self::sanitizeNode($child);
            }
        }

        if ($node->nodeType === XML_ELEMENT_NODE) {
            $tag = strtolower($node->nodeName);

            // If tag is not in whitelist
            if (!in_array($tag, self::$allowed_tags, true)) {
                // If actively dangerous, remove tag and its contents completely
                if (in_array($tag, ['script', 'style', 'object', 'embed', 'applet', 'form', 'input', 'button', 'select', 'textarea', 'svg', 'math', 'meta', 'link', 'base', 'frame', 'frameset'], true)) {
                    $node->parentNode->removeChild($node);
                } else {
                    // Otherwise keep child text/nodes, unwrap it
                    while ($node->firstChild) {
                        $node->parentNode->insertBefore($node->firstChild, $node);
                    }
                    $node->parentNode->removeChild($node);
                }
                return;
            }

            // Tag is allowed, check and sanitize attributes
            if ($node->hasAttributes()) {
                $attrs = iterator_to_array($node->attributes);
                foreach ($attrs as $attr) {
                    $attrName = strtolower($attr->nodeName);
                    $attrVal  = $attr->nodeValue;

                    // 1. Remove ANY inline event handler (onclick, onload, onerror, etc.)
                    if (str_starts_with($attrName, 'on') || str_starts_with($attrName, 'data-on')) {
                        $node->removeAttribute($attr->nodeName);
                        continue;
                    }

                    // 2. Remove attributes not in whitelist
                    if (!in_array($attrName, self::$allowed_attributes, true)) {
                        $node->removeAttribute($attr->nodeName);
                        continue;
                    }

                    // 3. Validate href
                    if ($attrName === 'href') {
                        if (!self::isSafeUrl($attrVal, false)) {
                            $node->removeAttribute($attr->nodeName);
                            continue;
                        }
                    }

                    // 4. Validate src
                    if ($attrName === 'src') {
                        if ($tag === 'iframe') {
                            if (!self::isTrustedIframeSrc($attrVal)) {
                                $node->parentNode->removeChild($node);
                                return;
                            }
                        } else {
                            if (!self::isSafeUrl($attrVal, true)) {
                                $node->removeAttribute($attr->nodeName);
                                continue;
                            }
                        }
                    }

                    // 5. Sanitize style
                    if ($attrName === 'style') {
                        $cleanStyle = self::sanitizeStyle($attrVal);
                        if (empty($cleanStyle)) {
                            $node->removeAttribute($attr->nodeName);
                        } else {
                            $node->setAttribute('style', $cleanStyle);
                        }
                    }
                }
            }

            // Enforce rel="noopener noreferrer" for target="_blank"
            if ($tag === 'a' && $node->hasAttribute('target')) {
                if (strtolower($node->getAttribute('target')) === '_blank') {
                    $node->setAttribute('rel', 'noopener noreferrer');
                }
            }
        }
    }

    private static function isSafeUrl($url, $allowImageData = false) {
        $url = trim($url);
        if ($url === '') return false;

        // Relative paths or anchors
        if ($url[0] === '/' || $url[0] === '#' || $url[0] === '.') {
            return true;
        }

        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (!$scheme) {
            return true; // Relative
        }

        $scheme = strtolower($scheme);
        if (in_array($scheme, ['http', 'https', 'mailto', 'tel'], true)) {
            return true;
        }

        if ($allowImageData && $scheme === 'data') {
            // Allow safe embedded images only
            if (preg_match('/^data:image\/(png|jpeg|jpg|gif|webp);base64,[A-Za-z0-9+\/]+=*$/i', $url)) {
                return true;
            }
        }

        return false;
    }

    private static function isTrustedIframeSrc($url) {
        $url = trim($url);
        $parsed = parse_url($url);
        if (!$parsed || empty($parsed['host'])) {
            return false;
        }

        $host = strtolower($parsed['host']);
        foreach (self::$trusted_iframe_domains as $trusted) {
            if ($host === $trusted || str_ends_with($host, '.' . $trusted)) {
                return true;
            }
        }
        return false;
    }

    private static function sanitizeStyle($style) {
        if (preg_match('/(expression|behavior|javascript|vbscript|-moz-binding|@import)/i', $style)) {
            return '';
        }
        if (preg_match('/url\s*\(/i', $style)) {
            return '';
        }
        return trim($style);
    }

    private static function regexFallbackClean($html) {
        // Strip script, style, embed, object tags
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        $html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
        $html = preg_replace('#<(object|embed|applet|form|svg|math)(.*?)>(.*?)</\1>#is', '', $html);
        // Strip on* events
        $html = preg_replace('#\s+on[a-z]+\s*=\s*(["\']).*?\1#is', '', $html);
        // Strip javascript: urls
        $html = preg_replace('#(href|src)\s*=\s*(["\'])\s*javascript:.*?\2#is', '', $html);
        return $html;
    }
}
