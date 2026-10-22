<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class MY_Controller extends CI_Controller {

	public $data = array();
	public $viewdata = array();

	public function __construct()
	{
		parent::__construct();
		$this->data['bran_menu'] = $this->db->order_by('namaBrand','ASC')->get_where('brands',array('status'=>1))->result();
		$this->data['cat_menu'] = $this->db->order_by('namaCategory','ASC')->get_where('categories',array('status'=>1))->result();
		$this->data['products_count']= $this->model->count_data('products',array('status'=>1));
		$this->data['ecatalogue_count']= $this->model->count_data('products',array('status'=>1,'category'=>'ecatalogue'));
		$this->data['retail_count']= $this->model->count_data('products',array('status'=>1,'category'=>'retail'));
		$this->data['brands_count']= $this->model->count_data('brands',array('status'=>1));
		$this->data['categories_count']= $this->model->count_data('categories',array('status'=>1));
		$this->data['base_url']= base_url();
		$this->data['name']=$this->session->userdata('nama');
		$this->data['base_url_admin']= base_url().'admin/';
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->lang->load('auth');
	}

	public function _render_page($view, $data=null, $returnhtml=false){

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
