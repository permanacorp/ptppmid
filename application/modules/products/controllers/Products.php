<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('seo_helper'));
    $this->load->library('image_lib');
    $this->lang->load('auth');
    if (!$this->ion_auth->logged_in()) {
      echo '<script>alert("You must login for access it.");</script>';
      // apabila belum login maka diarahkan ke halaman login
      redirect('login', 'refresh');
      //   return;
    }
  }

  public function index()
  {
    redirect('admin/products/view', 'refresh');
  }

  public function view()
  {
    $this->data['title'] = "Data products";
    $this->data['products_data'] = $this->model->select_products();
    // $this->data['products_data'] = $this->db->get('products')->result();
    $this->_render_page('backend/view', $this->data);
  }



  public function add()
  {
    $this->_rules();
    $this->form_validation->set_rules('namaProduct', 'Nama Product', 'trim|required|is_unique[products.namaProduct]');
    if ($this->form_validation->run() == true) {
      if (isset($_POST['submit'])) {
        $data = array(
          'idBrand'      =>  $this->input->post('idBrand'),
          'idCategory'   =>  $this->input->post('idCategory'),
          'namaProduct'  =>  $this->input->post('namaProduct'),
          'slug'         =>  seo($this->input->post('namaProduct')),
          'deskripsiID'  =>  $this->input->post('deskripsiID'),
          'deskripsiEN'  =>  $this->input->post('deskripsiEN'),
          'contentID'    =>  clean_wysiwyg($this->input->post('contentID')),
          'contentEN'    =>  clean_wysiwyg($this->input->post('contentEN')),
          'category'     =>  $this->input->post('category'),
          'download'     =>  seo($this->input->post('namaProduct')) . '.pdf',
          'urlPembelian' =>  $this->input->post('urlPembelian'),
          'price'        =>  $this->input->post('price'),
          'embedYT'        =>  $this->input->post('embedYT'),
          'createdBy'    =>  $this->session->userdata('identity'),
          'createdTime'  =>  date("Y-m-d H:i:s"),
          'status'       =>  $this->input->post('status')
        );


        if (!empty($_FILES['userfile']['name'])) {
          $config['upload_path']   = './assets/img/';
          $config['allowed_types'] = 'jpg|png';
          $config['file_name']     = seo($this->input->post('namaProduct'));
          // $config['max_size']      = 200; //set max size allowed in Kilobyte
          // $config['max_width']     = 150; // set max width image allowed
          // $config['max_height']    = 60; // set max height allowed
          $this->load->library('upload', $config);
          $this->upload->do_upload();
          $data = $this->upload->data();
          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_260x124.jpg', $img);
            $config['width']         = 260;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex260'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }
          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_160x77.jpg', $img);
            $config['width']         = 160;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex160'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }
          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_111x53.jpg', $img);
            $config['width']         = 111;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex111'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }
          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_56x26.jpg', $img);
            $config['width']         = 56;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex56'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }

          $data = array(
            'idBrand'       =>  $this->input->post('idBrand'),
            'idCategory'    =>  $this->input->post('idCategory'),
            'namaProduct'   =>  $this->input->post('namaProduct'),
            'slug'          =>  seo($this->input->post('namaProduct')),
            'deskripsiID'   =>  $this->input->post('deskripsiID'),
            'deskripsiEN'   =>  $this->input->post('deskripsiEN'),
            'contentID'     =>  clean_wysiwyg($this->input->post('contentID')),
            'contentEN'     =>  clean_wysiwyg($this->input->post('contentEN')),
            'category'      =>  $this->input->post('category'),
            'download'      =>  $this->input->post('download'),
            'urlPembelian'  =>  $this->input->post('urlPembelian'),
            'price'         =>  $this->input->post('price'),
            'embedYT'         =>  $this->input->post('embedYT'),
            'img'           =>  $data['file_name'],
            'imgResizex260' =>  $data['resizex260'],
            'imgResizex160' =>  $data['resizex160'],
            'imgResizex111' =>  $data['resizex111'],
            'imgResizex56'  =>  $data['resizex56'],
            'createdBy'     =>  $this->session->userdata('identity'),
            'createdTime'   =>  date("Y-m-d H:i:s"),
            'status'        =>  $this->input->post('status')
          );
        }
        // eksekusi query INSERT
        $this->model->save('products', $data);

        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', 'Data berhasil dibuat <i class="fa fa-fw fa-check"></i>');
        redirect('admin/products/view', 'refresh');
      }
    } else {
      $this->data['title'] = "Tambah Data products";
      $this->data['brands'] = $this->model->getDataASC('brands', 'namaBrand', array('status' => 1));
      $this->data['categories'] = $this->model->getDataASC('categories', 'namaCategory', array('status' => 1));

      $this->data['idProduct'] = array(
        'name' => 'idProduct',
        'id'   => 'idProduct',
        'type' => 'hidden',
      );

      $this->data['namaProduct'] = array(
        'name'  => 'namaProduct',
        'id'    => 'namaProduct',
        'placeholder' => 'Nama Produk',
        'type'  => 'text',
        'class' => 'form-control',
        'value' => $this->form_validation->set_value('namaProduct'),
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

      $this->data['category'] = array(
        'ecatalogue' => 'E-Catalogue',
        'retail' => 'Retail',
      );

      $this->data['category_css'] = array(
        'name'  => 'category',
        'id'    => 'category',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['download'] = array(
        'name'  => 'download',
        'id'    => 'download',
        'type'  => 'text',
        'class' => 'form-control',
        'value' => $this->form_validation->set_value('download'),
      );
      $this->data['urlPembelian'] = array(
        'name'  => 'urlPembelian',
        'id'    => 'urlPembelian',
        'type'  => 'text',
        'class' => 'form-control',
      );
      $this->data['price'] = array(
        'name'  => 'price',
        'id'    => 'price',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['embedYT'] = array(
        'name'  => 'embedYT',
        'id'    => 'embedYT',
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
      $this->_render_page('backend/add', $this->data);
    }
  }


  public function edit($id = null)
  {
    $this->_rules();
    $this->form_validation->set_rules('namaProduct', 'Nama Product', 'trim|required');
    if ($this->form_validation->run() == true) {
      if (isset($_POST['submit'])) {
        $data = array(
          'idBrand'      =>  $this->input->post('idBrand'),
          'idCategory'   =>  $this->input->post('idCategory'),
          'namaProduct'  =>  $this->input->post('namaProduct'),
          'slug'         =>  seo($this->input->post('namaProduct')),
          'deskripsiID'  =>  $this->input->post('deskripsiID'),
          'deskripsiEN'  =>  $this->input->post('deskripsiEN'),
          'contentID'    =>  clean_wysiwyg($this->input->post('contentID')),
          'contentEN'    =>  clean_wysiwyg($this->input->post('contentEN')),
          'category'     =>  $this->input->post('category'),
          'download'     =>  seo($this->input->post('namaProduct')) . '.pdf',
          'urlPembelian' =>  $this->input->post('urlPembelian'),
          'price'        =>  $this->input->post('price'),
          'embedYT'        =>  $this->input->post('embedYT'),
          'updatedBy'    =>  $this->session->userdata('identity'),
          'updatedTime'  =>  date("Y-m-d H:i:s"),
          'status'       =>  $this->input->post('status')
        );

        if ($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
        {
          if (file_exists('assets/img/' . $this->input->post('removeImg')) && $this->input->post('removeImg'))
            unlink('assets/img/' . $this->input->post('removeImg'));
          $data['img'] = '';
        }
        if ($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
        {
          if (file_exists('assets/img/' . $this->input->post('delete_imgResizex260')) && $this->input->post('delete_imgResizex260'))
            unlink('assets/img/' . $this->input->post('delete_imgResizex260'));
          $data['imgResizex260'] = '';
        }
        if ($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
        {
          if (file_exists('assets/img/' . $this->input->post('delete_imgResizex160')) && $this->input->post('delete_imgResizex160'))
            unlink('assets/img/' . $this->input->post('delete_imgResizex160'));
          $data['imgResizex160'] = '';
        }
        if ($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
        {
          if (file_exists('assets/img/' . $this->input->post('delete_imgResizex111')) && $this->input->post('delete_imgResizex111'))
            unlink('assets/img/' . $this->input->post('delete_imgResizex111'));
          $data['imgResizex111'] = '';
        }
        if ($this->input->post('removeImg')) // fungsi hapus gambar menggunakan checkbox
        {
          if (file_exists('assets/img/' . $this->input->post('delete_imgResizex56')) && $this->input->post('delete_imgResizex56'))
            unlink('assets/img/' . $this->input->post('delete_imgResizex56'));
          $data['imgResizex56'] = '';
        }

        if (!empty($_FILES['userfile']['name'])) {
          $config['upload_path']   = './assets/img/';
          $config['allowed_types'] = 'jpg|png';
          $config['file_name']     = seo($this->input->post('namaProduct'));
          // $config['max_size']      = 200; //set max size allowed in Kilobyte
          // $config['max_width']     = 150; // set max width image allowed
          // $config['max_height']    = 60; // set max height allowed
          $this->load->library('upload', $config);
          $this->upload->do_upload();
          $data = $this->upload->data();

          //delete file
          $img = $this->model->get_by_id('products', 'idProduct', $id)->row();
          if (file_exists('assets/img/' . $img->img) && $img->img) {
            unlink("assets/img/" . $img->img);
            unlink("assets/img/" . $img->imgResizex260);
            unlink("assets/img/" . $img->imgResizex160);
            unlink("assets/img/" . $img->imgResizex111);
            unlink("assets/img/" . $img->imgResizex56);
          }

          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_260x124.jpg', $img);
            $config['width']         = 260;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex260'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }
          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_160x77.jpg', $img);
            $config['width']         = 160;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex160'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }
          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_111x53.jpg', $img);
            $config['width']         = 111;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex111'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }
          if ($this->input->post("resize") == 'yes') {
            $img                     = $data['file_name'];
            $config['image_library'] = 'gd2';
            $config['source_image']  = $data['full_path'];
            $config['new_image']     = str_replace('.jpg', '_56x26.jpg', $img);
            $config['width']         = 56;

            //send config array to image_lib's  initialize function
            $this->image_lib->initialize($config);
            $data['resizex56'] = $config['new_image'];
            // Call resize function in image library.
            $this->image_lib->resize();
          }

          $data = array(
            'idBrand'       =>  $this->input->post('idBrand'),
            'idCategory'    =>  $this->input->post('idCategory'),
            'namaProduct'   =>  $this->input->post('namaProduct'),
            'slug'          =>  seo($this->input->post('namaProduct')),
            'deskripsiID'   =>  $this->input->post('deskripsiID'),
            'deskripsiEN'   =>  $this->input->post('deskripsiEN'),
            'contentID'     =>  clean_wysiwyg($this->input->post('contentID')),
            'contentEN'     =>  clean_wysiwyg($this->input->post('contentEN')),
            'category'      =>  $this->input->post('category'),
            'download'      =>  $this->input->post('download'),
            'urlPembelian'  =>  $this->input->post('urlPembelian'),
            'price'         =>  $this->input->post('price'),
            'embedYT'         =>  $this->input->post('embedYT'),
            'img'           =>  $data['file_name'],
            'imgResizex260' =>  $data['resizex260'],
            'imgResizex160' =>  $data['resizex160'],
            'imgResizex111' =>  $data['resizex111'],
            'imgResizex56'  =>  $data['resizex56'],
            'updatedBy'     =>  $this->session->userdata('identity'),
            'updatedTime'   =>  date("Y-m-d H:i:s"),
            'status'        =>  $this->input->post('status')
          );
        }


        // eksekusi query INSERT
        $this->model->update('products', $data, array('idProduct' => $id));

        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', 'Data berhasil diupdate <i class="fa fa-fw fa-check"></i>');
        redirect($_SERVER['REQUEST_URI'], 'refresh');
      }
    } else {
      $this->data['title']      = "Edit Data products";
      $id                       = $this->uri->segment(4);
      $this->data['products']    = $this->model->get_by_id('products', 'idProduct', $id)->row();
      $this->data['brands']      = $this->model->getDataASC('brands', 'namaBrand', array('status' => 1));
      $this->data['categories']  = $this->model->getDataASC('categories', 'namaCategory', array('status' => 1));

      $this->data['idProduct']   = array('name' => 'idProduct', 'id' => 'idProduct', 'type' => 'hidden');

      $this->data['namaProduct'] = array('name' => 'namaProduct', 'id' => 'namaProduct', 'placeholder' => 'Nama Category', 'type' => 'text', 'class' => 'form-control');

      $this->data['deskripsiID'] = array('name' => 'deskripsiID', 'id' => 'deskripsiID', 'placeholder' => 'Deskripsi dalam Bahasa Indonesia', 'type'  => 'text', 'class' => 'form-control');

      $this->data['deskripsiEN'] = array('name'  => 'deskripsiEN', 'id' => 'deskripsiEN', 'placeholder' => 'Deskripsi dalam Bahasa Inggris', 'type' => 'text', 'class' => 'form-control');

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

      $this->data['category'] = array(
        'retail' => 'Retail',
        'ecatalogue' => 'E-Catalogue',
      );

      $this->data['category_css'] = array(
        'name'  => 'category',
        'id'    => 'category',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['download'] = array(
        'name'  => 'download',
        'id'    => 'download',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['urlPembelian'] = array(
        'name'  => 'urlPembelian',
        'id'    => 'urlPembelian',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['price'] = array(
        'name'  => 'price',
        'id'    => 'price',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['embedYT'] = array(
        'name'  => 'embedYT',
        'id'    => 'embedYT',
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
    $ifId = empty($id) ? $this->uri->segment(4) : $id;
    if (empty($ifId)) { redirect('admin/products/view'); return; }
    $id = $ifId;
    $data = $this->model->get_by_id('products', 'idProduct', $id)->result();
    if ($data) {
      foreach ($data as $det) :
        if (!empty($det->img) && is_file("assets/img/" . $det->img)) { unlink("assets/img/" . $det->img); }
        if (!empty($det->imgResizex260) && is_file("assets/img/" . $det->imgResizex260)) { unlink("assets/img/" . $det->imgResizex260); }
        if (!empty($det->imgResizex160) && is_file("assets/img/" . $det->imgResizex160)) { unlink("assets/img/" . $det->imgResizex160); }
        if (!empty($det->imgResizex111) && is_file("assets/img/" . $det->imgResizex111)) { unlink("assets/img/" . $det->imgResizex111); }
        if (!empty($det->imgResizex56) && is_file("assets/img/" . $det->imgResizex56)) { unlink("assets/img/" . $det->imgResizex56); }
      endforeach;
    }
    $this->db->delete('products_spec', array('idProduct' => $id));
    $this->model->delete_by_id('products', 'idProduct', $id);
    $this->session->set_flashdata('message', 'Data Berhasil dihapus');
    redirect('admin/products/view');
  }

  public function add_information()
  {
    $this->data['title']           = "Add Information";
    $id                            = $this->uri->segment(4);
    $this->data['products']        = $this->model->get_by_id('products', 'idProduct', $id)->row();
    $this->data['add_information'] = $this->db->order_by('order', 'ASC')->get_where('products_spec', array('idProduct' => $id));
    $this->_render_page('backend/add_information', $this->data);
  }

  public function add_information_id($id = null)
  {
    $this->db->from('products_spec');
    $this->db->where('id', $id);
    $data = $this->db->get()->row();
    echo json_encode($data);
  }

  public function add_information_add()
  {
    $data = array(
      'id' => $this->input->post('id'),
      'idProduct' => $this->input->post('idProduct'),
      'order' => $this->input->post('order'),
      'name' => $this->input->post('name'),
      'value' => $this->input->post('value')
    );
    $insert = $this->model->save('products_spec', $data);
    echo json_encode(array("status" => TRUE));
  }
  public function add_information_edit()
  {
    $data = array(
      'id' => $this->input->post('id'),
      'idProduct' => $this->input->post('idProduct'),
      'order' => $this->input->post('order'),
      'name' => $this->input->post('name'),
      'value' => $this->input->post('value')
    );
    $this->model->update('products_spec', $data, array('id' => $this->input->post('id')));
    echo json_encode(array("status" => TRUE));
  }

  public function add_information_delete($id = null)
  {
    if (empty($id)) { $id = $this->uri->segment(4); }
    if (!empty($id)) {
      $this->model->delete_by_id('products_spec', 'id', $id);
    }
    echo json_encode(array("status" => TRUE));
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

    $this->form_validation->set_rules('idProduct', 'idProduct', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }
}
