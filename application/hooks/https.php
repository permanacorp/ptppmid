<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Legacy trigger_https replaced with safe no-op.
 * Full HTTPS is enforced directly at the web server / .htaccess level.
 */
function trigger_https()
{
	// No-op. Never downgrade HTTPS connections.
	return;
}
