<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Id extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        if(isset($_POST['referrer'])){
            $data= array(
                'nama' =>  $this->input->post('nama'),
                'subject' =>  'contact form',
                'email' =>  $this->input->post('email'),
                'content' =>  $this->input->post('content'),
                'dateTime' =>  date("Y-m-d H:i:s"));
                
                // eksekusi query INSERT
                $this->model->save('email',$data);
                redirect('id/thank-you','refresh');
            }
            $this->load->helper(array('my_helper'));
            //Do your magic here
            $this->load->library('pagination');
            $this->data['lang'] = 'id';
            $this->data['locale'] = 'id_ID';
            $this->data['web_config'] = $this->model->get_by_id('web_app','id',1)->row();
            $this->data['posts'] = $this->db->get_where('posts',array('status'=>1))->result();
            $this->data['ecatalogue_lkpp'] = $this->db->order_by('idBrand','DESC')->get_where('products',array('status'=>1,'category'=>'ecatalogue'))->result();
            $this->data['services'] = $this->db->get('services')->result();
            $this->data['blogs'] = $this->db->order_by('publishDate','DESC')->limit(5)->get_where('posts',array('status'=>1))->result();
            $this->data['categories'] = $this->db->order_by('namaCategory','ASC')->get_where('categories',array('status'=>1))->result();
            $this->data['brands'] = $this->db->order_by('namaBrand','ASC')->get_where('brands',array('status'=>1))->result();
            
            
        }
        
        public function index()
        {
            //seo
            $this->data['typeContent'] = 'website';
            $this->data['title'] = 'PT. Permana Putra Mandiri';
            $this->data['description'] = 'website resmi PT. Permana Putra Mandiri yang bergerak dibidang penjualan alat kedokteran ke seluruh Indonesia';
            $this->data['keywords'] = 'Perusahaan Distributor Alat Kesehatan / Alat Kedokteran di Indonesia';
            $this->data['url'] = base_url();
            $this->data['img'] = base_url().'assets/img/ptppm.jpg';
            //end
            $this->data['services_3'] = $this->db->limit(6)->get_where('services',array('position'=>'on'))->result();
            $this->data['services'] = $this->db->limit(6)->get('services')->result();
            // $this->data['brands'] = $this->db->get_where('brands',array('status'=>1))->result();
            $this->data['slides'] = $this->db->get_where('slides',array('status'=>1))->result();
            $this->load->view('id/index', $this->data);
            
        }
        
        // public function categories($name = null)
        // {
            //     $config                    = array();
            //     $config['full_tag_open']   = '<ul class="pagination">';
            //     $config['full_tag_close']  = '</ul>';
            //     $config['first_link']      = false;
            //     $config['last_link']       = false;
            //     $config['first_tag_open']  = '<li>';
            //     $config['first_tag_close'] = '</li>';
            //     $config['prev_link']       = '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>';
            //     $config['prev_tag_open']   = '<li class="prev">';
            //     $config['prev_tag_close']  = '</li>';
            //     $config['next_link']       = '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>';
            //     $config['next_tag_open']   = '<li>';
            //     $config['next_tag_close']  = '</li>';
            //     $config['last_tag_open']   = '<li>';
            //     $config['last_tag_close']  = '</li>';
            //     $config['cur_tag_open']    = '<li class="active"><a href="#">';
            //     $config['cur_tag_close']   = '</a></li>';
            //     $config['num_tag_open']    = '<li>';
            //     $config['num_tag_close']   = '</li>';
            
            //     $config["base_url"]        = base_url() . "id/categories/".$name;
            //     $config["total_rows"]      = $this->model->record_count_cat();
            //     $config["per_page"]        = 1;
            //     $config["uri_segment"]     = 3;
            
            //     $this->pagination->initialize($config);
            //      if ($this->uri->segment(3)) {
                //         $offset = $this->uri->segment(3);
                //     } else {
                    //         $offset = 0;
                    //     }
                    
                    //     $page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                    //     $this->data["links"]       = $this->pagination->create_links();
                    //     $this->data["categories"]    = $this->model->fetch_data_cat($config["per_page"], $page);
                    
                    //     // $this->data['products'] = $this->db->get_where('products',array('status'=>1))->result();
                    //     $this->load->view('id/categories', $this->data);
                    
                    // }
                    
    public function category(){
        $seo                             = $this->uri->segment(4);
        // get ID category
        $category                        =  $this->db->get_where('categories',array('slug'=>$seo,'status'=>1))->row();
        if(!$category) {
            redirect(base_url(),'refresh');
            return;
        }
        $categoryID                      =$category->idCategory;
        // get product List
        $productCategories               = $this->db->get_where('products',array('idCategory'=>$categoryID,'status'=>1))->result();
        if(!$productCategories) {
            redirect(base_url(),'refresh');
            return;
        }
        $this->data['productCategories'] = $productCategories;
        
        //seo
        $this->data['typeContent']       = 'object';
        $this->data['title']             = strtoupper(get_databySlug($seo,'categories','namaCategory')).' - PT. Permana Putra Mandiri';
        $this->data['description']       = get_databySlug($seo,'categories','deskripsiID');
        $this->data['keywords']          = 'spesifikasi '.get_databySlug($seo,'categories','namaCategory');
        $this->data['url']               = base_url().'id/product/category/'.get_databySlug($seo,'categories','slug');
        $this->data['img']               = base_url().'assets/img/'.get_databySlug($seo,'categories','img');
        //end
        $this->load->view('id/categories', $this->data);
    }
    
    public function ecatalogue_lkpp()
    {
        //seo
        $this->data['typeContent'] = 'object';
        $this->data['title']       = 'Produk Ecatalogue LKPP - PT. Permana Putra Mandiri';
        $this->data['description'] = 'Daftar Produk Ecatalogue PT. Permana Putra Mandiri yang sudah terdaftar di LKPP';
        $this->data['keywords']    = 'daftar harga produk ecatalogue lkpp pt permana putra mandiri';
        $this->data['url']         = base_url().'id/ecatalogue-lkpp/';
        $this->data['img']         = base_url().'assets/img/products.jpg';
        //end
        $this->load->view('id/ecatalogue_lkpp', $this->data);
        
    }
    
    public function products()
    {
        $config                    = array();
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        
        $config["base_url"]        = base_url() . "id/products/";
        $config["total_rows"]      = $this->model->record_count('products');
        $config["per_page"]        = 10;
        $config["uri_segment"]     = 3;
        
        $this->pagination->initialize($config);
        
        $page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data["links"]       = $this->pagination->create_links();
        $this->data["products"]    = $this->model->fetch_data('products',$config["per_page"], $page);
        
        //seo
        $this->data['typeContent'] = 'object';
        $this->data['title']       = 'Semua Produk - PT. Permana Putra Mandiri';
        $this->data['description'] = 'PT Permana Putra Mandiri adalah Perusahaan Distributor Alat Kesehatan Terlengkap dan Terjangkau di Indonesia';
        $this->data['keywords']    = 'harga alat kesehatan';
        $this->data['url']         = base_url().'id/products';
        $this->data['img']         = base_url().'assets/img/products.jpg';
        //end
        $this->load->view('id/products', $this->data);
        
    }
    
    public function product_detail()
    {
        $seo                       = $this->uri->segment(3);
        $product                   = $this->db->get_where('products',array('slug'=>$seo,'status'=>1))->row();
        if(!$product) {
            redirect(base_url().'id/products','refresh');
        }
        $this->data['product']     = $product;
        //seo
        $this->data['typeContent'] = 'object';
        $this->data['title']       = strtoupper(get_datacatbyID($product->idCategory)).' '.strtoupper(get_databySlug($seo,'products','namaProduct')).' - PT. Permana Putra Mandiri';
        $this->data['description'] = get_databySlug($seo,'products','deskripsiID');
        $this->data['keywords']    = 'spesifikasi '.get_datacatbyID(get_databySlug($seo,'products','idCategory')).' '.get_databySlug($seo,'products','namaProduct');
        $this->data['url']         = base_url().'id/product/'.get_databySlug($seo,'products','slug');
        $this->data['img']         = base_url().'assets/img/'.get_databySlug($seo,'products','img');
        //end
        $this->load->view('id/product_detail', $this->data);
    }
    
    public function blog()
    {
        $config                    = array();
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        
        $config["base_url"]        = base_url() . "id/blog/";
        $config["total_rows"]      = $this->model->record_count('posts');
        $config["per_page"]        = 5;
        $config["uri_segment"]     = 3;
        
        $this->pagination->initialize($config);
        
        $page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data["links"]       = $this->pagination->create_links();
        $this->data["posts"]       = $this->model->fetch_data('posts',$config["per_page"], $page);
        
        //seo
        $this->data['typeContent'] = 'article';
        $this->data['title']       = 'Semua Blog - PT. Permana Putra Mandiri';
        $this->data['description'] = 'artikel tentang website, biasanya tentang event atau adanya produk baru';
        $this->data['keywords']    = 'artikel alat kesehatan';
        $this->data['url']         = base_url().'id/blog';
        $this->data['img']         = base_url().'assets/img/blog.jpg';
        //end
        $this->load->view('id/blog', $this->data);
        
    }
    
    public function blog_archive(){
        $seo         = $this->uri->segment(4);
        $blogArchive = $this->db->get_where('posts',array('archive'=>$seo,'status'=>1))->result();
        if(!$blogArchive) {
            redirect(base_url().'id/blog/','refresh');
        }
        $this->data['blogArchive'] = $blogArchive;
        
        //seo
        $this->data['typeContent']       = 'object';
        $this->data['title']             = 'ARCHIVE BLOG '.$seo.' - PT. Permana Putra Mandiri';
        $this->data['description']       = 'archive blog '.$seo;
        $this->data['keywords']          = 'archive blog '.$seo;
        $this->data['url']               = base_url().'id/blog/archive/'.$seo;
        $this->data['img']               = base_url().'assets/img/blog_archive.jpg';
        //end
        $this->load->view('id/blog_archive', $this->data);
    }
    
    public function blog_detail()
    {
        $seo                = $this->uri->segment(3);
        $post               = $this->db->get_where('posts',array('slug'=>$seo,'status'=>1))->row();
        if(!$post) {
            redirect(base_url().'id/blog','refresh');
        }
        $this->data['post'] = $post;
        
        //seo
        $this->data['typeContent'] = 'object';
        $this->data['title']       = strtoupper(get_databySlug($seo,'posts','namaPost')).' - PT. Permana Putra Mandiri';
        $this->data['description'] = get_databySlug($seo,'posts','deskripsiID');
        $this->data['keywords']    = 'artikel tentang '.get_databySlug($seo,'posts','namaPost');
        $this->data['url']         = base_url().'id/blog/'.get_databySlug($seo,'posts','slug');
        $this->data['img']         = base_url().'assets/img/'.get_databySlug($seo,'posts','img');
        //end
        
        $this->load->view('id/blog_detail', $this->data);
    }
    
    public function page_detail()
    {
        $seo                = $this->uri->segment(3);
        $page               = $this->db->get_where('pages',array('slug'=>$seo,'status'=>1))->row();
        if(!$page) {
            redirect(base_url().'id/','refresh');
        }
        $this->data['page'] = $page;
        //seo
        $this->data['typeContent'] = 'article';
        $this->data['title']       = strtoupper(get_databySlug($seo,'pages','namaPage')).' - PT. Permana Putra Mandiri';
        $this->data['description'] = get_databySlug($seo,'pages','deskripsiID');
        $this->data['keywords']    = 'Halaman '.get_databySlug($seo,'pages','namaPage');
        $this->data['url']         = base_url().'id/blog/'.get_databySlug($seo,'pages','slug');
        $this->data['img']         = base_url().'assets/img/'.get_databySlug($seo,'pages','img');
        //end
        $this->load->view('id/page_detail', $this->data);
    }
    
    public function services()
    {
        $seo                    = $this->uri->segment(2);
        $this->data['services'] = $this->db->get_where('services')->result();
        $this->data['clients']  = $this->db->get('clients')->result();
        //seo
        $this->data['typeContent'] = 'article';
        $this->data['title']       = 'SERVICES - PT. Permana Putra Mandiri';
        $this->data['description'] = get_data('web_app',array('id'=>1),'sloganWebID');
        $this->data['keywords']    = 'services pt permana putra mandiri';
        $this->data['url']         = base_url().'id/services';
        $this->data['img']         = base_url().'assets/img/services.jpg';
        //end
        $this->load->view('id/services', $this->data);
    }
    
    public function about_us()
    {
        $seo                    = $this->uri->segment(2);
        $about_us               = $this->db->get_where('about_us',array('id'=>1))->row();
        if(!$about_us) {
            redirect(base_url().'id/','refresh');
        }
        $this->data['about_us'] = $about_us;
        $this->data['services'] = $this->db->limit(6)->get('services')->result();
        $this->data['clients']  = $this->db->get('clients')->result();
        //seo
        $this->data['typeContent'] = 'article';
        $this->data['title']       = 'TENTANG KAMI - PT. Permana Putra Mandiri';
        $this->data['description'] = get_data('about_us',array('id'=>1),'deskripsiID');
        $this->data['keywords']    = 'about us pt permana putra mandiri';
        $this->data['url']         = base_url().'id/about-us';
        $this->data['img']         = base_url().'assets/img/about-us.jpg';
        //end
        $this->load->view('id/about_us', $this->data);
    }
    
    public function contact_us()
    {
        error_reporting(0);
        if(isset($_POST['submit'])){
            $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
            $userIp=$this->input->ip_address();
            $secret = env('RECAPTCHA_SECRET', '');                 
            $credential = array(
                    'secret' => $secret,
                    'response' => $this->input->post('g-recaptcha-response')
                );
           
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
        
            $status= json_decode($response, true);
                
            if(is_array($status) && !empty($status['success'])){ 
                // $this->model->save('email',$data);
                $config = [
                    'protocol'  => 'smtp',
                    'smtp_host' => env('SMTP_HOST', 'ssl://smtp.googlemail.com'),
                    'smtp_user' => env('SMTP_USER', ''),
                    'smtp_pass' => env('SMTP_PASS', ''),
                    'smtp_port' => (int)env('SMTP_PORT', 465),
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'newline'   => "\r\n"
                ];
        
                $this->email->initialize($config);
                $this->email->from($this->input->post('email'), $this->input->post('nama').'('.$this->input->post('noWA').')');
                $this->email->reply_to($this->input->post('email'), $this->input->post('nama').'('.$this->input->post('noWA').')');
                $this->email->to('info@ptppm.id');
                $this->email->subject($this->input->post('subject'));
                $this->email->message($this->input->post('content'));
                if ($this->email->send()) {
                    redirect('id/thank-you','refresh');    
                } else {
                    log_message('error', 'Email sending failed: ' . $this->email->print_debugger(array('headers', 'subject')));
                    redirect('id/thank-you', 'refresh');
                }
            }
        }else{
            $this->load->library('googlemaps');
            
            $config = array();
            $config['center'] = '-6.292953, 106.890954';
            $config['zoom'] = '15';
            $this->googlemaps->initialize($config);
            
            $marker = array();
            $marker['position'] = get_data('web_app',array('id'=>1),'maps');
            $marker['infowindow_content'] = '<b>PT. Permana Putra Mandiri</b><br/>Jl. Taman Mini Pintu 2 Atas No. 43<br/>Cipayung, Jakarta Timur<br/>Jakarta, Indonesia. 13810';
            $marker['title'] = get_data('web_app',array('id'=>1),'namaWeb');
            $this->googlemaps->add_marker($marker);
            
            $this->data['map'] = $this->googlemaps->create_map();
            //seo
            $this->data['typeContent'] = 'article';
            $this->data['title']       = 'KONTAK - PT. Permana Putra Mandiri';
            $this->data['description'] = 'alamat nomor telfon email website pt permana putra mandiri';
            $this->data['keywords']    = 'kontak pt permana putra mandiri';
            $this->data['url']         = base_url().'id/contact-us';
            $this->data['img']         = base_url().'assets/img/contact-us.jpg';
            //end
            $this->load->view('id/contact_us', $this->data);
            }
        }
        
        public function brand_detail()
        {
            $seo                = $this->uri->segment(3);
            $brand               = $this->db->get_where('brands',array('slug'=>$seo,'status'=>1))->row();
            if(!$brand) {
                show_404();
            }
            $this->data['brand'] = $brand;
            //seo
            $this->data['typeContent'] = 'article';
            $this->data['title']       = strtoupper(get_databySlug($seo,'brands','namaBrand')).' - PT. Permana Putra Mandiri';
            $this->data['description'] = get_databySlug($seo,'brands','deskripsiID');
            $this->data['keywords']    = 'brand '.get_databySlug($seo,'brands','namaBrand');
            $this->data['url']         = base_url().'id/blog/'.get_databySlug($seo,'brands','slug');
            $this->data['img']         = base_url().'assets/img/'.get_databySlug($seo,'brands','img');
            //end
            $this->load->view('id/brand_detail', $this->data);
        }
        
        public function events()
        {
            $config                    = array();
            $config['full_tag_open']   = '<ul class="pagination">';
            $config['full_tag_close']  = '</ul>';
            $config['first_link']      = false;
            $config['last_link']       = false;
            $config['first_tag_open']  = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link']       = '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>';
            $config['prev_tag_open']   = '<li class="prev">';
            $config['prev_tag_close']  = '</li>';
            $config['next_link']       = '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>';
            $config['next_tag_open']   = '<li>';
            $config['next_tag_close']  = '</li>';
            $config['last_tag_open']   = '<li>';
            $config['last_tag_close']  = '</li>';
            $config['cur_tag_open']    = '<li class="active"><a href="#">';
            $config['cur_tag_close']   = '</a></li>';
            $config['num_tag_open']    = '<li>';
            $config['num_tag_close']   = '</li>';
            
            $config["base_url"]        = base_url() . "id/events/";
            $config["total_rows"]      = $this->model->record_count('events');
            $config["per_page"]        = 5;
            $config["uri_segment"]     = 3;
            
            $this->pagination->initialize($config);
            
            $page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->data["links"]       = $this->pagination->create_links();
            $this->data["events"]      = $this->model->fetch_data('events',$config["per_page"], $page);
            
            //seo
            $this->data['typeContent'] = 'article';
            $this->data['title']       = 'EVENTS - PT. Permana Putra Mandiri';
            $this->data['description'] = 'informasi event pt permana putra mandiri';
            $this->data['keywords']    = 'event pt permana putra mandiri';
            $this->data['url']         = base_url().'id/events';
            $this->data['img']         = base_url().'assets/img/events.jpg';
            //end
            $this->load->view('id/events', $this->data);
            
        }
        
        
        public function sitemap()
        {
            //seo
            $this->data['typeContent'] = 'article';
            $this->data['title'] = 'Sitemap - PT. Permana Putra Mandiri';
            $this->data['description'] = 'sitemap ptppm.id';
            $this->data['keywords'] = 'sitemap ptppm.id';
            $this->data['url'] = base_url();
            $this->data['img'] = base_url().'assets/img/ptppm.jpg';
            //end
            $this->data['brands'] = $this->db->order_by('namaBrand','ASC')->get_where('brands',array('status'=>1))->result();
            $this->data['categories'] = $this->db->order_by('namaCategory','ASC')->get_where('categories',array('status'=>1))->result();
            $this->data['pages'] = $this->db->get_where('pages',array('status'=>1))->result();
            $this->data['posts'] = $this->db->get_where('posts',array('status'=>1))->result();
            $this->load->view('id/sitemap', $this->data);
            
        }
        
        public function thankyou()
        {
            $this->data['title'] = 'Terima Kasih!';
            $this->data['text'] = 'Sudah menghubungi Kami, Segala Kritik dan Saran Kami Terima untuk Membangun.';
            $this->data['button'] = 'Kembali ke Beranda';
            $this->load->view('id/thankyou', $this->data);
        }
        
        
        
    }
    
    /* End of file Web.php */
    /* Location: ./application/controllers/Web.php */
    