<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller
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
    redirect('admin/categories/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data Categories";
    // $this->data['username'] = $this->session->username;
    
    $this->data['categories_data'] = $this->db->get('categories')->result();
    $this->load->view('backend/view', $this->data);
  }

  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaCategory', 'Nama Category', 'trim|required|is_unique[categories.namaCategory]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaCategory' =>  $this->input->post('namaCategory'),
                    'slug'         =>  seo($this->input->post('namaCategory')),
                    'deskripsiID'  =>  $this->input->post('deskripsiID'),
                    'deskripsiEN'  =>  $this->input->post('deskripsiEN'),
                    'contentID'    =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'    =>  clean_wysiwyg($this->input->post('contentEN')),
                    'createdBy'    =>  $this->session->userdata('identity'),
                    'createdTime'  =>  date("Y-m-d H:i:s"),
                    'status'       =>  $this->input->post('status'));

                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaCategory'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                     $data= array(
                    'namaCategory' =>  $this->input->post('namaCategory'),
                    'slug'         =>  seo($this->input->post('namaCategory')),
                    'deskripsiID'  =>  $this->input->post('deskripsiID'),
                    'deskripsiEN'  =>  $this->input->post('deskripsiEN'),
                    'contentID'    =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'    =>  clean_wysiwyg($this->input->post('contentEN')),
                    'img'          =>  $data['file_name'] ,
                    'createdBy'    =>  $this->session->userdata('identity'),
                    'createdTime'  =>  date("Y-m-d H:i:s"),
                    'status'       =>  $this->input->post('status'));
                  }
                

              // eksekusi query INSERT
                $this->model->save('categories',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/categories/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data categories";

            $this->data['idCategory'] = array(
              'name' => 'idCategory',
              'id'   => 'idCategory',
              'type' => 'hidden',
              );

            $this->data['namaCategory'] = array(
              'name'        => 'namaCategory',
              'id'          => 'namaCategory',
              'placeholder' => 'Nama Category',
              'type'        => 'text',
              'class'       => 'form-control',
              'value'       => $this->form_validation->set_value('namaCategory'),
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
                    'namaCategory'   =>  $this->input->post('namaCategory'),
                    'slug'        =>  seo($this->input->post('namaCategory')),
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
                    $config['file_name']     = seo($this->input->post('namaCategory'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    
                    //delete file
                    $img = $this->model->get_by_id('categories','idCategory',$id)->row();
                    if(file_exists('assets/img/'.$img->img) && $img->img)
                        unlink('assets/img/'.$img->img);

                    $data= array(
                    'namaCategory'   =>  $this->input->post('namaCategory'),
                    'slug'        =>  seo($this->input->post('namaCategory')),
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
                $this->model->update('categories', $data, array('idCategory' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
              redirect('admin/categories/view','refresh');
         } 
        }else {
            $this->data['title']  = "Edit Data categories";
            $this->data['categories'] = $this->model->get_by_id('categories','idCategory',$id)->row();

            $this->data['idCategory'] = array(
              'name' => 'idCategory',
              'id'   => 'idCategory',
              'type' => 'hidden',
              );

            $this->data['namaCategory'] = array(
              'name'  => 'namaCategory',
              'id'    => 'namaCategory',
              'placeholder' => 'Nama Category',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['deskripsiID'] = array(
              'name'  => 'deskripsiID',
              'id'    => 'deskripsiID',
              'placeholder' => 'Deskripsi dalam Bahasa Indonesia',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['deskripsiEN'] = array(
              'name'  => 'deskripsiEN',
              'id'    => 'deskripsiEN',
              'placeholder' => 'Deskripsi dalam Bahasa Inggris',
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
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/categories/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('categories','idCategory',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
      endforeach;
    }
    $this->model->delete_by_id('categories','idCategory',$id);
    $this->session->set_flashdata('message', 'Data Berhasil dihapus');
    redirect('admin/categories/view');
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

    $this->form_validation->set_rules('idCategory', 'idCategory', 'trim');
  }

}