<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class MY_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function save($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

	public function delete_by_id($table, $idTable, $id)
    {
        $this->db->where($idTable, $id);
        $this->db->delete($table);
    }

    public function get_by_id($table, $idTable, $id)
    {
        $this->db->where($idTable, $id);
        $query = $this->db->get($table);

        return $query;
    }

    public function getDataASC($table, $order_by, $whereParameter) 
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order_by, 'ASC');
        $this->db->where($whereParameter);
        return $this->db->get()->result();
    }

    public function select_products(){
        $this->db->select('products.*,brands.namaBrand,categories.namaCategory');
        $this->db->join('brands', 'products.idBrand=brands.idBrand');
        $this->db->join('categories', 'products.idCategory=categories.idCategory');
        $products = $this->db->get('products');
        return $products ? $products->result() : array();    
    } 

    public function record_count($table) {
        $query = $this->db->where('status', 1)->get($table);
        return $query ? $query->num_rows() : 0;
    }

    public function fetch_data($table, $limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->order_by('createdTime', 'DESC')->get_where($table, array('status' => 1));

        $data = array();
        if ($query && $query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function record_count_cat() {
        $seo = $this->uri->segment(3);
        // get ID categories
        $category = $this->db->get_where('categories', array('slug' => $seo, 'status' => 1))->row_array();
        if ( ! $category || empty($category['idCategory'])) {
            return 0;
        }
        $categoryID = $category['idCategory'];
        $query = $this->db->where(array('idCategory' => $categoryID, 'status' => 1))->get('products');
        return $query ? $query->num_rows() : 0;
    }

   public function fetch_data_cat($limit, $start) {
        $seo = $this->uri->segment(3);
        // get ID categories
        $category = $this->db->get_where('categories', array('slug' => $seo, 'status' => 1))->row_array();
        if ( ! $category || empty($category['idCategory'])) {
            return array();
        }
        $categoryID = $category['idCategory'];
        $this->db->limit($limit, $start);
        $query = $this->db->order_by('createdTime', 'DESC')->get_where('products', array('idCategory' => $categoryID, 'status' => 1));

        $data = array();
        if ($query && $query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
   }

   public function count_data($table, $where_parameter){
        $data = $this->db->get_where($table, $where_parameter);
        return $data ? $data->num_rows() : 0;
    }

}

/* End of file MY_model.php */
/* Location: ./application/models/MY_model.php */
