<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        

    }
    
    public function index ()
    {
        $data['title'] = 'Home';
        $data['icon']= $this->db->get_where('user_sub_menu', ['title' => $data['title']])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('template/footer');
        
        
        
    }

    public function notallowed()
    {
        $data['title'] = 'Not Allowed';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('home/notallowed', $data);
        $this->load->view('template/footer');
       
    
    }

    public function samplepage()
    {
        $this->load->view('home/home');
    }

    public function lock()
    {
        $this->load->view('home/lockscreen');
    }





}