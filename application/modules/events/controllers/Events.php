<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller
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
    redirect('admin/events/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data events";
    
    $this->data['events_data'] = $this->db->get('events')->result();
    // $this->data['events_data'] = $this->db->get('events')->result();
    $this->_render_page('backend/view', $this->data);
  }



  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaEvent', 'Nama Event', 'trim|required|is_unique[events.namaEvent]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaEvent'      =>  $this->input->post('namaEvent'),
                    'contentID'      =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'      =>  clean_wysiwyg($this->input->post('contentEN')),
                    'startDate'      =>  $this->input->post('startDate'),
                    'endDate'        =>  $this->input->post('endDate'),
                    'eventTargetURL' =>  $this->input->post('eventTargetURL'),
                    'createdBy'      =>  $this->session->userdata('identity'),
                    'createdTime'    =>  date("Y-m-d H:i:s"),
                    'status'         =>  $this->input->post('status'));

                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaEvent'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'namaEvent'      =>  $this->input->post('namaEvent'),
                    'img'            =>  $data['file_name'],
                    'contentID'      =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'      =>  clean_wysiwyg($this->input->post('contentEN')),
                    'startDate'      =>  $this->input->post('startDate'),
                    'endDate'        =>  $this->input->post('endDate'),
                    'eventTargetURL' =>  $this->input->post('eventTargetURL'),
                    'createdBy'      =>  $this->session->userdata('identity'),
                    'createdTime'    =>  date("Y-m-d H:i:s"),
                    'status'         =>  $this->input->post('status'));  
                  }
              // eksekusi query INSERT
                $this->model->save('events',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/events/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data events";
            $this->data['idEvent'] = array(
              'name' => 'idEvent',
              'id'   => 'idEvent',
              'type' => 'hidden',
              );

            $this->data['namaEvent'] = array(
              'name'  => 'namaEvent',
              'id'    => 'namaEvent',
              'placeholder' => 'Nama Event',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('namaEvent'),
              );

            $this->data['contentID'] = array(
              'name'  => 'contentID',
              'id'    => 'contentID',
              'placeholder' => 'Konten dalam Bahasa Indonesia',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('contentID'),
              );

            $this->data['contentEN'] = array(
              'name'  => 'contentEN',
              'id'    => 'contentEN',
              'placeholder' => 'Konten dalam Bahasa Inggris',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('contentEN'),
              );

            $this->data['startDate'] = array(
              'name'  => 'startDate',
              'id'    => 'startDate',
              'type'  => 'date',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('startDate'),
              );

            $this->data['endDate'] = array(
              'name'  => 'endDate',
              'id'    => 'endDate',
              'type'  => 'date',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('endDate'),
              );

            $this->data['eventTargetURL'] = array(
              'name'  => 'eventTargetURL',
              'id'    => 'eventTargetURL',
              'placeholder' => 'Postingan URL',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('eventTargetURL'),
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
    $this->form_validation->set_rules('namaEvent', 'Nama Post', 'trim|required');
        if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaEvent'      =>  $this->input->post('namaEvent'),
                    'contentID'      =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'      =>  clean_wysiwyg($this->input->post('contentEN')),
                    'startDate'      =>  $this->input->post('startDate'),
                    'endDate'        =>  $this->input->post('endDate'),
                    'eventTargetURL' =>  $this->input->post('eventTargetURL'),
                    'updatedBy'      =>  $this->session->userdata('identity'),
                    'updatedTime'    =>  date("Y-m-d H:i:s"),
                    'status'         =>  $this->input->post('status'));
                    
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
                    $config['file_name']     = seo($this->input->post('namaEvent'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    $data= array(
                    'namaEvent'      =>  $this->input->post('namaEvent'),
                    'img'            =>  $data['file_name'],
                    'contentID'      =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'      =>  clean_wysiwyg($this->input->post('contentEN')),
                    'startDate'      =>  $this->input->post('startDate'),
                    'endDate'        =>  $this->input->post('endDate'),
                    'eventTargetURL' =>  $this->input->post('eventTargetURL'),
                    'updatedBy'      =>  $this->session->userdata('identity'),
                    'updatedTime'    =>  date("Y-m-d H:i:s"),
                    'status'         =>  $this->input->post('status'));  
                  }

              // eksekusi query INSERT
                $this->model->update('events', $data, array('idEvent' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
              redirect('admin/events/view','refresh');
         } 
        }else {
            $this->data['title']      = "Edit Data events";
            $id                       = $this->uri->segment(4);
            $this->data['events']    = $this->model->get_by_id('events','idEvent',$id)->row();

            $this->data['idEvent'] = array(
              'name' => 'idEvent',
              'id'   => 'idEvent',
              'type' => 'hidden',
              );

            $this->data['namaEvent'] = array(
              'name'  => 'namaEvent',
              'id'    => 'namaEvent',
              'placeholder' => 'Nama Produk',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['contentID'] = array(
              'name'  => 'contentID',
              'id'    => 'contentID',
              'placeholder' => 'Konten dalam Bahasa Indonesia',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['contentEN'] = array(
              'name'  => 'contentEN',
              'id'    => 'contentEN',
              'placeholder' => 'Konten dalam Bahasa Inggris',
              'type'  => 'text',
              'class' => 'form-control',
              );

            $this->data['startDate'] = array(
              'name'  => 'startDate',
              'id'    => 'startDate',
              'type'  => 'date',
              'class' => 'form-control',
              );

            $this->data['endDate'] = array(
              'name'  => 'endDate',
              'id'    => 'endDate',
              'type'  => 'date',
              'class' => 'form-control',
              );

            $this->data['eventTargetURL'] = array(
              'name'  => 'eventTargetURL',
              'id'    => 'eventTargetURL',
              'placeholder' => 'Postingan URL',
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
              'class' => 'form-control',
            );    


            $this->_render_page('backend/edit', $this->data); 
            }

    
  }

public function delete($id = null)
  {
    $id=$this->uri->segment(4);
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/events/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('events','idEvent',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
        if (!empty($det->imgResizex340) && is_file("assets/img/".$det->imgResizex340)) { unlink("assets/img/".$det->imgResizex340); }
        if (!empty($det->imgResizex80) && is_file("assets/img/".$det->imgResizex80)) { unlink("assets/img/".$det->imgResizex80); }
      endforeach;
    }
    $this->model->delete_by_id('events','idEvent',$id);
    $this->session->set_flashdata('message', 'Data Berhasil dihapus');
    redirect('admin/events/view');
  }

public function _rules() 
  {
    $this->form_validation->set_rules('eventTargetURL', 'Postingan URL', 'trim|required');
    $this->form_validation->set_rules('startDate', 'Tanggal Mulai Event', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('is_unique', '{field} sudah digunakan!');

    $this->form_validation->set_rules('idEvent', 'idEvent', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}