<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends MY_Controller
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
    redirect('admin/clients/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data Clients";
    // $this->data['username'] = $this->session->username;
    
    $this->data['clients_data'] = $this->db->get('clients')->result();
    $this->load->view('backend/view', $this->data);
  }

  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaClient', 'Nama Client', 'trim|required|is_unique[clients.namaClient]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaClient' =>  $this->input->post('namaClient'),
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'       =>  $this->input->post('status'));
                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaClient'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'namaClient' =>  $this->input->post('namaClient'),
                    'img'         =>  $data['file_name'],
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'       =>  $this->input->post('status'));
                  }
                

              // eksekusi query INSERT
                $this->model->save('clients',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/clients/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data clients";

            $this->data['idClient'] = array(
              'name' => 'idClient',
              'id'   => 'idClient',
              'type' => 'hidden',
              );

            $this->data['namaClient'] = array(
              'name'        => 'namaClient',
              'id'          => 'namaClient',
              'placeholder' => 'Nama Client',
              'type'        => 'text',
              'class'       => 'form-control',
              'value'       => $this->form_validation->set_value('namaClient'),
              );

            $this->data['status'] = array(
              '0' => 'Draft',
              '1' => 'Publish',
            );  

            $this->data['status_css'] = array(
              'name'  => 'status',
              'id'    => 'status',
              'type'  => 'text',
              'class' => 'form-control',
            );    

            $this->_render_page('backend/add', $this->data); 
            }
  }


  public function edit($id = null)
  {
    $this->_rules();
        if($this->form_validation->run()==true) {
           if(isset($_POST['submit'])){
                $data= array(
                    'namaClient'  =>  $this->input->post('namaClient'),
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"),
                    'status'       =>  $this->input->post('status'));

                  if($this->input->post('removeImg')) // if remove img checked
                  {
                      if(file_exists('assets/img/'.$this->input->post('removeImg')) && $this->input->post('removeImg'))
                          unlink('assets/img/'.$this->input->post('removeImg'));
                      $data['img'] = '';
                  }  
                
                 
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaClient'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'namaClient' =>  $this->input->post('namaClient'),
                    'img'         =>  $data['file_name'],
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"),
                    'status'       =>  $this->input->post('status'));
                  }


              // eksekusi query INSERT
                $this->model->update('clients', $data, array('idClient' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
              redirect('admin/clients/view','refresh');
         } 
        }else {
            $this->data['title']  = "Edit Data clients";
            $this->data['clients'] = $this->model->get_by_id('clients','idClient',$id)->row();

            $this->data['idClient'] = array(
              'name' => 'idClient',
              'id'   => 'idClient',
              'type' => 'hidden',
              );

            $this->data['namaClient'] = array(
              'name'        => 'namaClient',
              'id'          => 'namaClient',
              'placeholder' => 'Nama Client',
              'type'        => 'text',
              'class'       => 'form-control',
              );

            $this->data['status'] = array(
              '0' => 'Draft',
              '1' => 'Publish',
            );  

            $this->data['status_css'] = array(
              'name'  => 'status',
              'id'    => 'status',
              'type'  => 'text',
              'class' => 'form-control',
            );    

            $this->_render_page('backend/edit', $this->data); 
            }

    
  }

public function delete($id = null)
  {
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/clients/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('clients','idClient',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
      endforeach;
    }
    $this->model->delete_by_id('clients','idClient',$id);
    $this->session->set_flashdata('message', 'Data Berhasil dihapus');
    redirect('admin/clients/view');
  }

public function _rules() 
  {
    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('max_length', '{field} tidak boleh lebih dari 300 karakter!');
    $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');

    $this->form_validation->set_rules('idClient', 'idClient', 'trim');
  }

}