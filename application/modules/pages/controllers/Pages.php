<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('seo_helper'));
    $this->lang->load('auth');
    if (!$this->ion_auth->logged_in()){
      echo'<script>alert("You must login for access it.");</script>';
      // apabila belum login maka diarahkan ke halaman login
      redirect('login', 'refresh');
      // return;
    }
  }

  public function index()
  {
    redirect('admin/pages/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data pages";
    // $this->data['username'] = $this->session->username;
    
    $this->data['pages_data'] = $this->db->get('pages')->result();
    $this->load->view('backend/view', $this->data);
  }

  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaPage', 'Nama Page', 'trim|required|is_unique[pages.namaPage]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaPage'   =>  $this->input->post('namaPage'),
                    'slug'        =>  seo($this->input->post('namaPage')),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));

                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaPage'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                     $data= array(
                    'namaPage'   =>  $this->input->post('namaPage'),
                    'slug'        =>  seo($this->input->post('namaPage')),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'img'         =>  $data['file_name'],
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));
                  }
                

              // eksekusi query INSERT
                $this->model->save('pages',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/pages/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data pages";

            $this->data['idPage'] = array(
              'name' => 'idPage',
              'id'   => 'idPage',
              'type' => 'hidden',
              );

            $this->data['namaPage'] = array(
              'name'  => 'namaPage',
              'id'    => 'namaPage',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('namaPage'),
              );

            $this->data['deskripsiID'] = array(
              'name'  => 'deskripsiID',
              'id'    => 'deskripsiID',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('deskripsiID'),
              );

            $this->data['deskripsiEN'] = array(
              'name'  => 'deskripsiEN',
              'id'    => 'deskripsiEN',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('deskripsiEN'),
              );

            $this->data['contentID'] = array(
              'name'  => 'contentID',
              'id'    => 'contentID',
              'class' => 'ckeditor',
              'value' => $this->form_validation->set_value('contentID'),
              );

            $this->data['contentEN'] = array(
              'name'  => 'contentEN',
              'id'    => 'contentEN',
              'class' => 'ckeditor',
              'value' => $this->form_validation->set_value('contentEN'),
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
                    'namaPage'   =>  $this->input->post('namaPage'),
                    'slug'        =>  seo($this->input->post('namaPage')),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));
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
                    $config['file_name']     = seo($this->input->post('namaPage'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    
                    //delete file
                    $img = $this->model->get_by_id('pages','idPage',$id)->row();
                    if(file_exists('assets/img/'.$img->img) && $img->img)
                        unlink('assets/img/'.$img->img);

                    $data= array(
                    'namaPage'   =>  $this->input->post('namaPage'),
                    'slug'        =>  seo($this->input->post('namaPage')),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'img'         =>  $data['file_name'] ,
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));
                }

              // eksekusi query INSERT
                $this->model->update('pages', $data, array('idPage' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate! <i class="fa fa-fw fa-check"></i>');
              redirect('admin/pages/view','refresh');
         } 
        }else {
            $this->data['title']  = "Edit Data pages";
            $id                   = $this->uri->segment(4);
            $this->data['pages'] = $this->model->get_by_id('pages','idPage',$id)->row();

            $this->data['idPage'] = array(
              'name' => 'idPage',
              'id'   => 'idPage',
              'type' => 'hidden',
              );

            $this->data['namaPage'] = array(
              'name'  => 'namaPage',
              'id'    => 'namaPage',
              'type'  => 'text',
              'class' => 'form-control',
              'readonly'=>'readonly',
              );

            $this->data['deskripsiID'] = array(
              'name'  => 'deskripsiID',
              'id'    => 'deskripsiID',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['deskripsiEN'] = array(
              'name'  => 'deskripsiEN',
              'id'    => 'deskripsiEN',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['contentID'] = array(
              'name'  => 'contentID',
              'id'    => 'contentID',
              'class' => 'ckeditor',
              );

            $this->data['contentEN'] = array(
              'name'  => 'contentEN',
              'id'    => 'contentEN',
              'class' => 'ckeditor',
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
    $id=$this->uri->segment(4);
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/pages/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('pages','idPage',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
      endforeach;
    }
    $this->model->delete_by_id('pages','idPage',$id);
    $this->session->set_flashdata('message', 'Data berhasil dihapus! <i class="fa fa-fw fa-check"></i>');
    redirect('admin/pages/view');
  }

  public function _rules() 
  {
    $this->form_validation->set_rules('deskripsiID', 'Deskripsi dalam Bahasa Indonesia', 'trim|required|max_length[160]');
    $this->form_validation->set_rules('deskripsiEN', 'Deskripsi dalam Bahasa Inggris', 'trim|required|max_length[160]');
    $this->form_validation->set_rules('contentID', 'Content Indonesia', 'trim|required');
    $this->form_validation->set_rules('contentEN', 'Content English', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('max_length', '{field} tidak boleh lebih dari 160 karakter!');
    $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');

    $this->form_validation->set_rules('idPage', 'idPage', 'trim');
  }

}