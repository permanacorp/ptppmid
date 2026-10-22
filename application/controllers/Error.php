<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MY_Controller {

	public function index()
	{
		$this->load->view('error_404');
	}

}

/* End of file Tes.php */
/* Location: ./application/controllers/Tes.php */