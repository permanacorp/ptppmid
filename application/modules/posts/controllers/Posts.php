<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('seo_helper'));
    $this->load->library('image_lib');
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
    redirect('admin/posts/view','refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data posts";
    
    $this->data['posts_data'] = $this->db->get('posts')->result();
    // $this->data['posts_data'] = $this->db->get('posts')->result();
    $this->_render_page('backend/view', $this->data);
  }



  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaPost', 'Nama Post', 'trim|required|is_unique[posts.namaPost]');
    if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
              $data= array(
                    'namaPost'    =>  $this->input->post('namaPost'),
                    'slug'        =>  seo($this->input->post('namaPost')),
                    'publishDate' =>  $this->input->post('publishDate'),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'createdBy'   =>  $this->session->userdata('identity'),
                    'createdTime' =>  date("Y-m-d H:i:s"),
                    'archive'     =>  substr($this->input->post('publishDate'),0,4),
                    'status'      =>  $this->input->post('status'));

                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaPost'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    if ($this->input->post("resize")=='yes') {
                    $img                     = $data['file_name'];
                    $config['image_library'] = 'gd2';
                    $config['source_image']  = $data['full_path'];
                    $config['new_image']     = str_replace('.jpg', '_340x227.jpg', $img);
                    $config['width']         = 340;

                    //send config array to image_lib's  initialize function
                    $this->image_lib->initialize($config);
                    $data['resizex340'] = $config['new_image'];
                    // Call resize function in image library.
                    $this->image_lib->resize();
                }
                if ($this->input->post("resize")=='yes') {
                    $img                     = $data['file_name'];
                    $config['image_library'] = 'gd2';
                    $config['source_image']  = $data['full_path'];
                    $config['new_image']     = str_replace('.jpg', '_80x60.jpg', $img);
                    $config['width']         = 80;

                    //send config array to image_lib's  initialize function
                    $this->image_lib->initialize($config);
                    $data['resizex80'] = $config['new_image'];
                    // Call resize function in image library.
                    $this->image_lib->resize();
                }

                    $data= array(
                    'namaPost'      =>  $this->input->post('namaPost'),
                    'slug'          =>  seo($this->input->post('namaPost')),
                    'publishDate'   =>  $this->input->post('publishDate'),
                    'deskripsiID'   =>  $this->input->post('deskripsiID'),
                    'deskripsiEN'   =>  $this->input->post('deskripsiEN'),
                    'contentID'     =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'     =>  clean_wysiwyg($this->input->post('contentEN')),
                    'img'           =>  $data['file_name'],
                    'imgResizex340' =>  $data['resizex340'],
                    'imgResizex80'  =>  $data['resizex80'],
                    'createdBy'     =>  $this->session->userdata('identity'),
                    'createdTime'   =>  date("Y-m-d H:i:s"),
                    'archive'       =>  substr($this->input->post('publishDate'),0,4),
                    'status'        =>  $this->input->post('status'));
                  }
              // eksekusi query INSERT
                $this->model->save('posts',$data);

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
              redirect('admin/posts/view','refresh');
         } 
        }else {
            $this->data['title'] = "Tambah Data posts";
            $this->data['idPost'] = array(
              'name' => 'idPost',
              'id'   => 'idPost',
              'type' => 'hidden',
              );

            $this->data['namaPost'] = array(
              'name'  => 'namaPost',
              'id'    => 'namaPost',
              'placeholder' => 'Nama Produk',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('namaPost'),
              );

            $this->data['deskripsiID'] = array(
              'name'  => 'deskripsiID',
              'id'    => 'deskripsiID',
              'placeholder' => 'Deskripsi dalam Bahasa Indonesia',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('deskripsiID'),
              );

            $this->data['deskripsiEN'] = array(
              'name'  => 'deskripsiEN',
              'id'    => 'deskripsiEN',
              'placeholder' => 'Deskripsi dalam Bahasa Inggris',
              'type'  => 'text',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('deskripsiEN'),
              );

            $this->data['publishDate'] = array(
              'name'  => 'publishDate',
              'id'    => 'publishDate',
              'placeholder' => 'Tanggal/Bulan/Tahun',
              'type'  => 'date',
              'class' => 'form-control',
              'value' => $this->form_validation->set_value('publishDate'),
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
    $this->form_validation->set_rules('namaPost', 'Nama Post', 'trim|required');
        if($this->form_validation->run()==true) {
            if(isset($_POST['submit'])){
                $data= array(
                    'namaPost'    =>  $this->input->post('namaPost'),
                    'slug'        =>  seo($this->input->post('namaPost')),
                    'publishDate' =>  $this->input->post('publishDate'),
                    'deskripsiID' =>  $this->input->post('deskripsiID'),
                    'deskripsiEN' =>  $this->input->post('deskripsiEN'),
                    'contentID'   =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'   =>  clean_wysiwyg($this->input->post('contentEN')),
                    'updatedBy'   =>  $this->session->userdata('identity'),
                    'updatedTime' =>  date("Y-m-d H:i:s"),
                    'archive'     =>  substr($this->input->post('publishDate'),0,4),
                    'status'      =>  $this->input->post('status'));


                    if($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
                    {
                        if(file_exists('assets/img/'.$this->input->post('removeImg')) && $this->input->post('removeImg'))
                            unlink('assets/img/'.$this->input->post('removeImg'));
                        $data['img'] = '';

                    }
                    if($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
                    {
                        if(file_exists('assets/img/'.$this->input->post('delete_imgResizex340')) && $this->input->post('delete_imgResizex340'))
                            unlink('assets/img/'.$this->input->post('delete_imgResizex340'));
                        $data['imgResizex340'] = '';
                        
                    }
                    if($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
                    {
                        if(file_exists('assets/img/'.$this->input->post('delete_imgResizex80')) && $this->input->post('delete_imgResizex80'))
                            unlink('assets/img/'.$this->input->post('delete_imgResizex80'));
                        $data['imgResizex80'] = '';
                        
                    }
                    
                
                  if(!empty($_FILES['userfile']['name'])) 
                  {
                    $config['upload_path']   = './assets/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['file_name']     = seo($this->input->post('namaPost'));
                    // $config['max_size']      = 200; //set max size allowed in Kilobyte
                    // $config['max_width']     = 150; // set max width image allowed
                    // $config['max_height']    = 60; // set max height allowed
                    $this->load->library('upload',$config);
                    $this->upload->do_upload();
                    $data= $this->upload->data();
                    if ($this->input->post("resize")=='yes') {
                    $img                     = $data['file_name'];
                    $config['image_library'] = 'gd2';
                    $config['source_image']  = $data['full_path'];
                    $config['new_image']     = str_replace('.jpg', '_340x227.jpg', $img);
                    $config['width']         = 340;

                    //send config array to image_lib's  initialize function
                    $this->image_lib->initialize($config);
                    $data['resizex340'] = $config['new_image'];
                    // Call resize function in image library.
                    $this->image_lib->resize();
                }
                if ($this->input->post("resize")=='yes') {
                    $img                     = $data['file_name'];
                    $config['image_library'] = 'gd2';
                    $config['source_image']  = $data['full_path'];
                    $config['new_image']     = str_replace('.jpg', '_80x60.jpg', $img);
                    $config['width']         = 80;

                    //send config array to image_lib's  initialize function
                    $this->image_lib->initialize($config);
                    $data['resizex80'] = $config['new_image'];
                    // Call resize function in image library.
                    $this->image_lib->resize();
                }

                    $data= array(
                    'namaPost'      =>  $this->input->post('namaPost'),
                    'slug'          =>  seo($this->input->post('namaPost')),
                    'publishDate'   =>  $this->input->post('publishDate'),
                    'deskripsiID'   =>  $this->input->post('deskripsiID'),
                    'deskripsiEN'   =>  $this->input->post('deskripsiEN'),
                    'contentID'     =>  clean_wysiwyg($this->input->post('contentID')),
                    'contentEN'     =>  clean_wysiwyg($this->input->post('contentEN')),
                    'img'           =>  $data['file_name'],
                    'imgResizex340' =>  $data['resizex340'],
                    'imgResizex80'  =>  $data['resizex80'],
                    'updatedBy'     =>  $this->session->userdata('identity'),
                    'updatedTime'   =>  date("Y-m-d H:i:s"),
                    'archive'       =>  substr($this->input->post('publishDate'),0,4),
                    'status'        =>  $this->input->post('status'));
                  }                
                    

              // eksekusi query INSERT
                $this->model->update('posts', $data, array('idPost' => $id));

              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
              redirect('admin/posts/view','refresh');
         } 
        }else {
            $this->data['title']      = "Edit Data posts";
            $id                       = $this->uri->segment(4);
            $this->data['posts']    = $this->model->get_by_id('posts','idPost',$id)->row();

            
            $this->data['idPost']   = array('name' => 'idPost','id' => 'idPost','type' => 'hidden');
            
            $this->data['namaPost'] = array('name' => 'namaPost','id' => 'namaPost','placeholder' => 'Nama Category','type' => 'text','class' => 'form-control');

            $this->data['deskripsiID'] = array('name' => 'deskripsiID','id' => 'deskripsiID','placeholder' => 'Deskripsi dalam Bahasa Indonesia','type'  => 'text','class' => 'form-control');

            $this->data['deskripsiEN'] = array('name'  => 'deskripsiEN','id' => 'deskripsiEN','placeholder' => 'Deskripsi dalam Bahasa Inggris','type' => 'text','class' => 'form-control');

            $this->data['contentID'] = array('name'  => 'contentID',
              'id'    => 'contentID',
              'class' => 'ckeditor',
              );

            $this->data['contentEN'] = array('name'  => 'contentEN',
              'id'    => 'contentEN',
              'class' => 'ckeditor',
              );

             $this->data['publishDate'] = array(
              'name'  => 'publishDate',
              'id'    => 'publishDate',
              'placeholder' => 'Tanggal/Bulan/Tahun',
              'type'  => 'date',
              'class' => 'form-control',
              );
            
            $this->data['status'] = array('0' => 'Draft',
              '1' => 'Publish',
            );  

            $this->data['status_css'] = array('name'  => 'status',
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
    if (empty($ifId)) { redirect('admin/posts/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('posts','idPost',$id)->result();
    if ($data) {
      foreach($data as $det):
        if (!empty($det->img) && is_file("assets/img/".$det->img)) { unlink("assets/img/".$det->img); }
        if (!empty($det->imgResizex340) && is_file("assets/img/".$det->imgResizex340)) { unlink("assets/img/".$det->imgResizex340); }
        if (!empty($det->imgResizex80) && is_file("assets/img/".$det->imgResizex80)) { unlink("assets/img/".$det->imgResizex80); }
      endforeach;
    }
    $this->model->delete_by_id('posts','idPost',$id);
    $this->session->set_flashdata('message', 'Data Berhasil dihapus');
    redirect('admin/posts/view');
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

    $this->form_validation->set_rules('idPost', 'idPost', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}