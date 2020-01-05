<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class User extends CI_Controller 
{
    // controler helper untuk mencegah akses annymous
    public function __construct()
    {
        parent::__construct();
        redSessions();
    }

    public function index ()
    {
        $data['title'] = 'My Profile';
        $data['icon']= $this->db->get_where('user_sub_menu', ['title' => $data['title']])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function Editprofile ()
    {
        $data['title'] = 'Edit Profile';
        $data['icon']= $this->db->get_where('user_sub_menu', ['title' => $data['title']])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full name', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('user/editprofile', $data);
            $this->load->view('template/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            
            //untuk cek gambar yg di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '5000';
                $config['upload_path']  = './assets/img/profile/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $old_image = $data['user']['image'];
                    if($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            
            }
            
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message','<div class="alert-success" role="alert">Your profile has been up_date </div>');
            redirect('user');

        }
        
        
    }

     public function Changepassword()
    {
        $data['title'] = 'Change Password';
        $data['icon']= $this->db->get_where('user_sub_menu', ['title' => $data['title']])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('template/footer');
        } else {
            $cur_pas = $this->input->post('current_password');
            $new_pas = $this->input->post('new_password1');
            if (!password_verify($cur_pas, $data['user'] ['password'])) {
                $this->session->set_flashdata('message','<div class="alert-danger" role="alert">wrong current password..!</div>');
            redirect('user/changepassword');
            } else {
                if ($cur_pas == $new_pas) {
                    $this->session->set_flashdata('message','<div class="alert-danger" role="alert">New password cannot same current password..!</div>');
                    redirect('user/changepassword');
                } else {
                    // password berhasil di ganti
                    $password_hash = password_hash($new_pas, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message','<div class="alert-success" role="alert">Password change!</div>');
                    redirect('user/changepassword');

                }
            }
        }
        
        
       
    
    }

    




}