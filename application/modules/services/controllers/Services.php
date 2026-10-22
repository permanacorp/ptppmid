<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Services extends MY_Controller
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
    redirect('admin/services/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data Services";
    // $this->data['username'] = $this->session->username;
    
    $this->data['services_data'] = $this->db->get('services')->result();
    $this->load->view('backend/view', $this->data);
  }

  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaService', 'Nama Service', 'trim|required|is_unique[services.namaService]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaService' =>  $this->input->post('namaService'),
                    'icon'        =>  $this->input->post('icon'),
                    'position'        =>  $this->input->post('position'),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"));

                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaService'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'namaService' =>  $this->input->post('namaService'),
                    'icon'        =>  $this->input->post('icon'),
                    'position'        =>  $this->input->post('position'),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'img'         =>  $data['file_name'],
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"));
                  }
                

              // eksekusi query INSERT
                $this->model->save('services',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/services/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data services";

            $this->data['idService'] = array(
              'name' => 'idService',
              'id'   => 'idService',
              'type' => 'hidden',
              );

            $this->data['namaService'] = array(
              'name'        => 'namaService',
              'id'          => 'namaService',
              'placeholder' => 'Nama Service',
              'type'        => 'text',
              'class'       => 'form-control',
              'value'       => $this->form_validation->set_value('namaService'),
              );

            $this->data['deskripsiID'] = array(
              'name'        => 'deskripsiID',
              'id'          => 'deskripsiID',
              'placeholder' => 'Deskripsi dalam Bahasa Indonesia',
              'type'        => 'text',
              'class'       => 'form-control',
              'value'       => $this->form_validation->set_value('deskripsiID'),
              );

            $this->data['deskripsiEN'] = array(
              'name'        => 'deskripsiEN',
              'id'          => 'deskripsiEN',
              'placeholder' => 'Deskripsi dalam Bahasa Inggris',
              'type'        => 'text',
              'class'       => 'form-control',
              'value'       => $this->form_validation->set_value('deskripsiEN'),
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
                    'namaService' =>  $this->input->post('namaService'),
                    'icon'        =>  $this->input->post('icon'),
                    'position'        =>  $this->input->post('position'),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
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
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaService'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'namaService' =>  $this->input->post('namaService'),
                    'icon'        =>  $this->input->post('icon'),
                    'position'        =>  $this->input->post('position'),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'img'         =>  $data['file_name'],
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"));
                  }


              // eksekusi query INSERT
                $this->model->update('services', $data, array('idService' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
              redirect('admin/services/view','refresh');
         } 
        }else {
            $this->data['title']  = "Edit Data services";
            $this->data['services'] = $this->model->get_by_id('services','idService',$id)->row();

            $this->data['idService'] = array(
              'name' => 'idService',
              'id'   => 'idService',
              'type' => 'hidden',
              );

            $this->data['namaService'] = array(
              'name'        => 'namaService',
              'id'          => 'namaService',
              'placeholder' => 'Nama Service',
              'type'        => 'text',
              'class'       => 'form-control',
              );

            $this->data['deskripsiID'] = array(
              'name'        => 'deskripsiID',
              'id'          => 'deskripsiID',
              'placeholder' => 'Deskripsi dalam Bahasa Indonesia',
              'type'        => 'text',
              'class'       => 'form-control',
              );

            $this->data['deskripsiEN'] = array(
              'name'        => 'deskripsiEN',
              'id'          => 'deskripsiEN',
              'placeholder' => 'Deskripsi dalam Bahasa Inggris',
              'type'        => 'text',
              'class'       => 'form-control',
              );  

            $this->_render_page('backend/edit', $this->data); 
            }

    
  }

public function delete($id = null)
  {
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/services/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('services','idService',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
      endforeach;
    }
    $this->model->delete_by_id('services','idService',$id);
    $this->session->set_flashdata('message', 'Data Berhasil dihapus');
    redirect('admin/services/view');
  }

public function _rules() 
  {
    $this->form_validation->set_rules('deskripsiID', 'Deskripsi dalam Bahasa Indonesia', 'trim|required|max_length[300]');
    $this->form_validation->set_rules('deskripsiEN', 'Deskripsi dalam Bahasa Inggris', 'trim|required|max_length[300]');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('max_length', '{field} tidak boleh lebih dari 300 karakter!');
    $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');

    $this->form_validation->set_rules('idService', 'idService', 'trim');
  }

}