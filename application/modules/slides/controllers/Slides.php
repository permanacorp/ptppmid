<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slides extends MY_Controller
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
    redirect('admin/slides/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data slides";
    // $this->data['username'] = $this->session->username;
    
    $this->data['slides_data'] = $this->db->get('slides')->result();
    $this->load->view('backend/view', $this->data);
  }

  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('title', 'Title Image', 'trim|required|is_unique[slides.title]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'title'       =>  $this->input->post('title'),
                    'description' =>  $this->input->post('description'),
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));

                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('title'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'title'       =>  $this->input->post('title'),
                    'description' =>  $this->input->post('description'),
                    'img'         =>  $data['file_name'],
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));
                  }
                

              // eksekusi query INSERT
                $this->model->save('slides',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/slides/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data slides";

            $this->data['idSlide'] = array(
              'name' => 'idSlide',
              'id'   => 'idSlide',
              'type' => 'hidden',
              );

            $this->data['title'] = array(
              'name'  => 'title',
              'id'    => 'title',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('title'),
              'placeholder' => 'Title',
              );

            $this->data['description'] = array(
              'name'  => 'description',
              'id'    => 'description',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('description'),
              'placeholder' => 'Description',
              );

            $this->data['status'] = array(
              '0' => 'Draft',
              '1' => 'Publish',
            );  

            $this->data['status_css'] = array(
              'name'  => 'status',
              'id'    => 'status',
              'type'  => 'text',
              'class' => 'custom-select',
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
                    'title'       =>  $this->input->post('title'),
                    'description' =>  $this->input->post('description'),
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
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
                    $config['file_name']     = seo($this->input->post('title'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    
                    //delete file
                    $img = $this->model->get_by_id('slides','idSlide',$id)->row();
                    if(file_exists('assets/img/'.$img->img) && $img->img)
                        unlink('assets/img/'.$img->img);

                    $data= array(
                    'title'       =>  $this->input->post('title'),
                    'description' =>  $this->input->post('description'),
                    'img'         =>  $data['file_name'],
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));
                }

              // eksekusi query INSERT
                $this->model->update('slides', $data, array('idSlide' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate! <i class="fa fa-fw fa-check"></i>');
              redirect('admin/slides/view','refresh');
         } 
        }else {
            $this->data['title']  = "Edit Data slides";
            $this->data['slides'] = $this->model->get_by_id('slides','idSlide',$id)->row();

            $this->data['idSlide'] = array(
              'name' => 'idSlide',
              'id'   => 'idSlide',
              'type' => 'hidden',
              );

            $this->data['title'] = array(
              'name'  => 'title',
              'id'    => 'title',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['description'] = array(
              'name'  => 'description',
              'id'    => 'description',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['status'] = array(
              '0' => 'Draft',
              '1' => 'Publish',
            );  

            $this->data['status_css'] = array(
              'name'  => 'status',
              'id'    => 'status',
              'type'  => 'text',
              'class' => 'custom-select',
            );    

            $this->_render_page('backend/edit', $this->data); 
            }

    
  }

public function delete($id = null)
  {
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/slides/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('slides','idSlide',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
      endforeach;
    }
    $this->model->delete_by_id('slides','idSlide',$id);
    $this->session->set_flashdata('message', 'Data berhasil dihapus! <i class="fa fa-fw fa-check"></i>');
    redirect('admin/slides/view');
  }

  public function _rules() 
  {
    $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[160]');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('max_length', '{field} tidak boleh lebih dari 160 karakter!');
    $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');

    $this->form_validation->set_rules('idSlide', 'idSlide', 'trim');
  }

}