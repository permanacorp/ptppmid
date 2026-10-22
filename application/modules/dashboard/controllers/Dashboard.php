<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('auth');
	}
	
	public function index(){
		$this->data['title'] = 'Dashboard';

		if (!$this->ion_auth->logged_in()){
			// apabila belum login maka diarahkan ke halaman login
			redirect('login', 'refresh');
		}
		else{
			$this->_render_page('dashboard',$this->data);
		}
	}

}
