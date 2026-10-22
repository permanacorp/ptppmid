<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function page_title($p) {
    $c = array ('-');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
    $p = str_replace($d, ' ', $p); // Hilangkan karakter yang telah disebutkan di array $d
    $p = ucwords(str_replace($c, '', $p)); // Ganti tanda dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $p;
}

function count_data($table, $array_parameter)
{
    $ci = & get_instance();
    $cek = $ci->db->get_where($table, $array_parameter);
    return $cek ? $cek->num_rows() : 0; 
}

function get_data_ductspec($data)
{
    $ci = & get_instance();
    $cek = $ci->db->order_by('order', 'ASC')->get_where('products_spec', array('idProduct' => $data));
    return $cek ? $cek->result() : array();   
}

function get_data_catpro($data, $id)
{
    $ci = & get_instance();
    $cek = $ci->db->where(array(
        'idCategory'   => $data,
        'status'       => 1,
        'idProduct !=' => $id
    ))->get('products');
    return $cek ? $cek->result() : array();   
}

function get_data_ransli($data)
{
    $ci = & get_instance();
    $cek = $ci->db->get_where('brands_slide', array('idBrand' => $data));
    return $cek ? $cek->result() : array();   
}

function get_data_probran($data)
{
    $ci = & get_instance();
    $cek = $ci->db->order_by('namaProduct', 'asc')->get_where('products', array('idBrand' => $data, 'status' => 1));
    return $cek ? $cek->result() : array();   
}

function get_data($table, $array_parameter, $data)
{
    $ci = & get_instance();
    $query = $ci->db->get_where($table, $array_parameter);
    if ($query && $row = $query->row_array()) {
        return isset($row[$data]) ? $row[$data] : null;
    }
    return null;
}

function get_databySlug($slug, $table, $data)
{
    $ci = & get_instance();
    $query = $ci->db->get_where($table, array('slug' => $slug, 'status' => 1));
    if ($query && $row = $query->row_array()) {
        return isset($row[$data]) ? $row[$data] : null;
    }
    return null;
}

function get_datacatbyID($id)
{
    $ci = & get_instance();
    $query = $ci->db->get_where('categories', array('idCategory' => $id, 'status' => 1));
    if ($query && $row = $query->row_array()) {
        return isset($row['namaCategory']) ? $row['namaCategory'] : '';
    }
    return '';
}

function get_dataslugcatbyID($id)
{
    $ci = & get_instance();
    $query = $ci->db->get_where('categories', array('idCategory' => $id, 'status' => 1));
    if ($query && $row = $query->row_array()) {
        return isset($row['slug']) ? $row['slug'] : '';
    }
    return '';
}

function get_databranbyID($id)
{
    $ci = & get_instance();
    $query = $ci->db->get_where('brands', array('idBrand' => $id, 'status' => 1));
    if ($query && $row = $query->row_array()) {
        return isset($row['namaBrand']) ? $row['namaBrand'] : '';
    }
    return '';
}

function get_data_cat_lkpp()
{
    $ci = & get_instance();
    $cek = $ci->db->order_by('idCategory', 'asc')->get_where('products', array('category' => "ecatalogue", 'status' => 1));
    return $cek ? $cek->result() : array();   
}

function rupiah($angka)
{
    $num = is_numeric($angka) ? (float) $angka : 0.0;
    return "Rp. " . number_format($num, 2, ',', '.');
}

function clean_wysiwyg($html)
{
    if (!class_exists('Wysiwyg_security')) {
        require_once APPPATH . 'libraries/Wysiwyg_security.php';
    }
    return Wysiwyg_security::clean($html);
}

function safe_html($html)
{
    return clean_wysiwyg($html);
}

