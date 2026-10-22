<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MY_Controller
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
    redirect('admin/messages/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data Messages";
    // $this->data['username'] = $this->session->username;
    
    $this->data['messages_data'] = $this->db->order_by('dateTime','desc')->get('email')->result();
    $this->load->view('backend/view', $this->data);
  }


  public function read() 
  {
    if(isset($_POST['submit'])){
        $data= array(
              'status'      =>  $this->input->post('status'));
              // eksekusi query INSERT
        $this->model->update('email', $data, array('id' => $this->input->post('id')));
        redirect('admin/messages/view');
    } else {
        $this->data['title']  = "Lihat Messages";
        $id                   = $this->uri->segment(4);
        $this->data['messages'] = $this->model->get_by_id('email','id',$id)->row();
        $this->_render_page('backend/read', $this->data); 
    }

  }

public function delete($id = null)
  {
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/messages/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('email','id',$id)->result();
    $this->model->delete_by_id('email','id',$id);
    $this->session->set_flashdata('message', 'Data berhasil dihapus! <i class="fa fa-fw fa-check"></i>');
    redirect('admin/messages/view');
  }


}