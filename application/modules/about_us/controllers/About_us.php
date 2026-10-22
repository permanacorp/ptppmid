<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class About_us extends MY_Controller
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
    $this->_rules();
        if($this->form_validation->run()==true) {
           if(isset($_POST['submit'])){
                $data= array(
                    'namaID'      =>  $this->input->post('namaID'),
                    'namaEN'      =>  $this->input->post('namaEN'),
                    'deskripsiID' =>  clean_wysiwyg($this->input->post('deskripsiID')),
                    'deskripsiEN' =>  clean_wysiwyg($this->input->post('deskripsiEN')),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'visionID'    =>  $this->input->post('visionID'),
                    'visionEN'    =>  $this->input->post('visionEN'),
                    'missionID'   =>  $this->input->post('missionID'),
                    'missionEN'   =>  $this->input->post('missionEN'),
                    'percent'     =>  $this->input->post('percent'),
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"));

              // eksekusi query INSERT
                $this->model->update('about_us', $data, array('id' => 1));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
              redirect('admin/about-us','refresh');
         }
        }else {
            $this->data['title']  = "Page About Us";
            $this->data['about_us'] = $this->model->get_by_id('about_us','id',1)->row();

            $this->data['id'] = array(
              'name' => 'id',
              'id'   => 'id',
              'type' => 'hidden',
              );

            $this->data['namaID'] = array(
              'name'        => 'namaID',
              'id'          => 'namaID',
              'placeholder' => 'namaID',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['namaEN'] = array(
              'name'        => 'namaEN',
              'id'          => 'namaEN',
              'placeholder' => 'namaEN',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['deskripsiID'] = array(
              'name'        => 'deskripsiID',
              'id'          => 'deskripsiID',
              'placeholder' => 'Deskripsi dalam Bahasa Indonesia',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['deskripsiEN'] = array(
              'name'        => 'deskripsiEN',
              'id'          => 'deskripsiEN',
              'placeholder' => 'Deskripsi dalam Bahasa Inggris',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

             $this->data['contentID'] = array(
              'name'        => 'contentID',
              'id'          => 'contentID',
              'placeholder' => 'content dalam Bahasa Indonesia',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['contentEN'] = array(
              'name'        => 'contentEN',
              'id'          => 'contentEN',
              'placeholder' => 'content dalam Bahasa Inggris',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

             $this->data['visionID'] = array(
              'name'        => 'visionID',
              'id'          => 'visionID',
              'placeholder' => 'vision dalam Bahasa Indonesia',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['visionEN'] = array(
              'name'        => 'visionEN',
              'id'          => 'visionEN',
              'placeholder' => 'vision dalam Bahasa Inggris',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

             $this->data['missionID'] = array(
              'name'        => 'missionID',
              'id'          => 'missionID',
              'placeholder' => 'mission dalam Bahasa Indonesia',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['missionEN'] = array(
              'name'        => 'missionEN',
              'id'          => 'missionEN',
              'placeholder' => 'mission dalam Bahasa Inggris',
              'type'        => 'textarea',
              'class'       => 'form-control',
              );

            $this->data['percent'] = array(
              'name'        => 'percent',
              'id'          => 'percent',
              'placeholder' => 'percent',
              'type'        => 'text',
              'class'       => 'form-control',
              );

            $this->_render_page('backend/about_us', $this->data);
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
