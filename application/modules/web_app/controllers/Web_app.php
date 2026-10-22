<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Web_app extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('seo_helper'));
    $this->lang->load('auth');
    $this->data['icons'] = $this->config->item('icons');
    if (!$this->ion_auth->logged_in()){
      echo'<script>alert("You must login for access it.");</script>';
      // apabila belum login maka diarahkan ke halaman login
      redirect('login', 'refresh');
      // return;
    }
  }

  public function index()
  {
    redirect('admin/web_app/configuration','refresh');
  }

  public function configuration()
  {
    $this->_rules();
        if($this->form_validation->run()==true) {
           if(isset($_POST['submit'])){
                $data= array(
                    'namaWeb'     =>  $this->input->post('namaWeb'),
                    'sloganWebID' =>  $this->input->post('sloganWebID'),
                    'sloganWebEN' =>  $this->input->post('sloganWebEN'),
                    'maps'        =>  $this->input->post('maps'),
                    'alamat'      =>  $this->input->post('alamat'),
                    'address'     =>  $this->input->post('address'),
                    'telp'        =>  $this->input->post('telp'),
                    'fax'         =>  $this->input->post('fax'),
                    'email'       =>  $this->input->post('email'),
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"));

                  if($this->input->post('removeImg')) // if remove img checked
                  {
                      if(file_exists('assets/img/'.$this->input->post('removeImg')) && $this->input->post('removeImg'))
                          unlink('assets/img/'.$this->input->post('removeImg'));
                      $data['img'] = '';
                  }  
                
                 
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'png';
                    $config['file_name']     = seo($this->input->post('namaWeb'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'namaWeb'     =>  $this->input->post('namaWeb'),
                    'sloganWebID' =>  $this->input->post('sloganWebID'),
                    'sloganWebEN' =>  $this->input->post('sloganWebEN'),
                    'maps'        =>  $this->input->post('maps'),
                    'alamat'      =>  $this->input->post('alamat'),
                    'address'     =>  $this->input->post('address'),
                    'telp'        =>  $this->input->post('telp'),
                    'fax'         =>  $this->input->post('fax'),
                    'email'       =>  $this->input->post('email'),
                    'img'         =>  $data['file_name']);
                  }


              // eksekusi query INSERT
                $this->model->update('web_app', $data, array('id' => 1));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
              redirect('admin/web_app/configuration','refresh');
         } 
        }else {
            $this->data['title']  = "configuration Data web_app";
            $this->data['web_app'] = $this->model->get_by_id('web_app','id',1)->row();

            $this->data['id'] = array(
              'name' => 'id',
              'id'   => 'id',
              'type' => 'hidden',
              );

            $this->data['namaWeb'] = array(
              'name'        => 'namaWeb',
              'id'          => 'namaWeb',
              'placeholder' => 'namaWeb',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['sloganWebID'] = array(
              'name'        => 'sloganWebID',
              'id'          => 'sloganWebID',
              'placeholder' => 'Slogan Web dalam Bahasa Indonesia',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['sloganWebEN'] = array(
              'name'        => 'sloganWebEN',
              'id'          => 'sloganWebEN',
              'placeholder' => 'Slogan dalam Bahasa Inggris',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );  

            $this->data['maps'] = array(
              'name'        => 'maps',
              'id'          => 'maps',
              'placeholder' => 'Koordinat Google maps',
              'type'        => 'text',
              'class'       => 'form-control',
              );  

            $this->data['alamat'] = array(
              'name'        => 'alamat',
              'id'          => 'alamat',
              'placeholder' => 'Alamat',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );  

            $this->data['address'] = array(
              'name'        => 'address',
              'id'          => 'address',
              'placeholder' => 'Address',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );  

            $this->data['telp'] = array(
              'name'        => 'telp',
              'id'          => 'telp',
              'placeholder' => 'Telephone',
              'type'        => 'text',
              'class'       => 'form-control',
              );  

            $this->data['fax'] = array(
              'name'        => 'fax',
              'id'          => 'fax',
              'placeholder' => 'Fax',
              'type'        => 'text',
              'class'       => 'form-control',
              );  

            $this->data['email'] = array(
              'name'        => 'email',
              'id'          => 'email',
              'placeholder' => 'Email',
              'type'        => 'text',
              'class'       => 'form-control',
              );  

            $this->_render_page('backend/configuration', $this->data); 
            }

    
  }


public function _rules() 
  {
    // $this->form_validation->set_rules('deskripsiID', 'Deskripsi dalam Bahasa Indonesia', 'trim|required|max_length[300]');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('max_length', '{field} tidak boleh lebih dari 300 karakter!');

    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}