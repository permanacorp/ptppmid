<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends MY_Controller
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
    redirect('admin/brands/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data brands";
    // $this->data['username'] = $this->session->username;
    
    $this->data['brands_data'] = $this->db->get('brands')->result();
    $this->load->view('backend/view', $this->data);
  }

  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaBrand', 'Nama Brand', 'trim|required|is_unique[brands.namaBrand]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaBrand'   =>  $this->input->post('namaBrand'),
                    'slug'        =>  seo($this->input->post('namaBrand')),
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
                    $config['file_name']     = seo($this->input->post('namaBrand'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                     $data= array(
                    'namaBrand'   =>  $this->input->post('namaBrand'),
                    'slug'        =>  seo($this->input->post('namaBrand')),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'img'         =>  $data['file_name'] ,
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'status'      =>  $this->input->post('status'));
                  }
                

              // eksekusi query INSERT
                $this->model->save('brands',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/brands/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data brands";

            $this->data['idBrand'] = array(
              'name' => 'idBrand',
              'id'   => 'idBrand',
              'type' => 'hidden',
              );

            $this->data['namaBrand'] = array(
              'name'  => 'namaBrand',
              'id'    => 'namaBrand',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('namaBrand'),
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
                    'namaBrand'   =>  $this->input->post('namaBrand'),
                    'slug'        =>  seo($this->input->post('namaBrand')),
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
                    $config['file_name']     = seo($this->input->post('namaBrand'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    
                    //delete file
                    $img = $this->model->get_by_id('brands','idBrand',$id)->row();
                    if(file_exists('assets/img/'.$img->img) && $img->img)
                        unlink('assets/img/'.$img->img);

                    $data= array(
                    'namaBrand'   =>  $this->input->post('namaBrand'),
                    'slug'        =>  seo($this->input->post('namaBrand')),
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
                $this->model->update('brands', $data, array('idBrand' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate! <i class="fa fa-fw fa-check"></i>');
              redirect('admin/brands/view','refresh');
         } 
        }else {
            $this->data['title']  = "Edit Data brands";
            $id                   = $this->uri->segment(4);
            $this->data['brands'] = $this->model->get_by_id('brands','idBrand',$id)->row();

            $this->data['idBrand'] = array(
              'name' => 'idBrand',
              'id'   => 'idBrand',
              'type' => 'hidden',
              );

            $this->data['namaBrand'] = array(
              'name'  => 'namaBrand',
              'id'    => 'namaBrand',
              'type'  => 'text',
              'class' => 'form-control',
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
    if (empty($ifId)) { redirect('admin/brands/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('brands','idBrand',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
      endforeach;
    }
    $this->model->delete_by_id('brands','idBrand',$id);
    $this->session->set_flashdata('message', 'Data berhasil dihapus! <i class="fa fa-fw fa-check"></i>');
    redirect('admin/brands/view');
  }

public function slider()
  {
      $this->data['title']  = "Tambah Data Slider";
      $id                     = $this->uri->segment(4);
      $this->data['brands'] = $this->model->get_by_id('brands','idBrand',$id)->row();
      $this->data['slider']   = $this->db->get_where('brands_slide',array('idBrand'=>$id));
      $this->data['username'] = $this->session->userdata('username'); 
      $this->_render_page('backend/slider',$this->data);
    }

Public function slider_id($id)
    {
        $this->db->from('brands_slide');
        $this->db->where('id',$id);
        $data = $this->db->get()->row();
        echo json_encode($data);
    }


public function slider_add()
    {
        
        $data = array(
                'id' => $this->input->post('id'),
                'idBrand' => $this->input->post('idBrand')
            );

        if(!empty($_FILES['img']['name'])) {
            $upload = $this->_do_upload();
            $data['img'] = $upload;
        }

        $insert = $this->model->save('brands_slide',$data);

        echo json_encode(array("status" => TRUE));
    }

public function slider_update()
    {
        $data = array(
                'id' => $this->input->post('id'),
                'idBrand' => $this->input->post('idBrand')
            );

        if($this->input->post('remove_img')) // if remove img checked
        {
            if(file_exists('assets/img/'.$this->input->post('remove_img')) && $this->input->post('remove_img'))
                unlink('assets/img/'.$this->input->post('remove_img'));
            $data['img'] = '';
        }

        if(!empty($_FILES['img']['name']))
        {
            $upload = $this->_do_upload();
            
            //delete file
            $img = $this->model->get_by_id('brands_slide','id',$this->input->post('id'))->row();
            if(file_exists('assets/img/'.$img->img) && $img->img)
                unlink('assets/img/'.$img->img);

            $data['img'] = $upload;
        }

        $this->model->update('brands_slide', $data, array('id' => $this->input->post('id')));
        echo json_encode(array("status" => TRUE));
    }

public function slider_delete($id = null)
    {
        //delete file
        if (empty($id)) { $id = $this->uri->segment(4); }
        if (!empty($id)) {
            $data = $this->model->get_by_id('brands_slide','id',$id)->row();
            if($data && !empty($data->img) && is_file('assets/img/'.$data->img)) {
                unlink('assets/img/'.$data->img);
            }
        }
        
        $this->model->delete_by_id('brands_slide','id',$id);
        echo json_encode(array("status" => TRUE));
    }

private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 150; //set max size allowed in Kilobyte
        $config['max_width']            = 840; // set max width image allowed
        $config['max_height']           = 300; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('img')) //upload and form-control
        {
            $data['inputerror'][] = 'img';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show slider error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
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

    $this->form_validation->set_rules('idBrand', 'idBrand', 'trim');
  }

}