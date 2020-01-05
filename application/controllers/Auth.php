<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function index()
	{
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Login';
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('auth/login');
            $this->load->view('template/footer');
        } else {
            //Validasi sukses
            $this->_login();
        }
        
    }

    private function _login()
    {
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email'=> $email])->row_array();
        // var_dump($user); [untuk cek user manual]
        // die;

        // Jika user ada
        if($user) {
            //jika user aktif
            if ($user ['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user ['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >WRONG..! PASSWORD...! </div>');
                    redirect('auth');
                }

            } else {
                
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >This mail unactivated, pleace ceck your mail..! or get activated code. </div>');
                redirect('auth/resendverify');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" >Email is unregistered</div>');
            redirect('auth');
        }
    }

    public function register()
	{
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'User_name', 'required|trim|min_length[4]|alpha_numeric|is_unique[user.username]', [
            'min_length' => 'user name too shoort, min 4 chart',
            'alpha_numeric' => 'chart not avalible \'_,-,space\'.',
            'is_unique' => 'user name is used!, coise another.'
            ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email has be registered..!, use another email'
            ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'min_length' => 'Password too shoort',
            'matches' => 'Password unmatch...!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',);
        $this->form_validation->set_rules('birthday', 'Brithday', 'required|trim',);
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim',);
        $this->form_validation->set_rules('phonenumber', 'Phone number', 'required|trim',);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('auth/register');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time(),
                'birthday' => htmlspecialchars($this->input->post('birthday', true)),
                'gender' => htmlspecialchars($this->input->post('gender', true)),
                'phonenumber' => htmlspecialchars($this->input->post('phonenumber', true)),
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" >success registered, need activated account, ceck your mail..!</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'awiy.gombloh@gmail.com',
            'smtp_pass' => 'telkom3305',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('awiy.gombloh@gmail.com', 'The Coffee');
        $this->email->to($this->input->post('email'));

        if($type == 'verify') {
        $this->email->subject('Account Verification');
        $this->email->message('Click this link to verify your account : <a href="'. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="'. base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }
        
        
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email'])->row_array();

        if($user){
            $user_token = $this->db->get('user_token', ['token' => $token])->row_array();

            if($user_token) {
                //validation time exper
                if(time() - $user_token['date_created'] < (60*60*24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-succes" role="alert">'.$email.' has be active, please login..</div>');
                    redirect('auth');

                } else {
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Account activation failed..! Token Expired</div>');
                    redirect('auth/resendverify');
                }

            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Account activation failed..! Wrong TOken</div>');
                redirect('auth/resendverify');
            }

        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Account activation failed..! Wrong Email.. Please register again.</div>');
            redirect('auth');
        }

    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Don\'t forget to comeback again...!<br>see you next time...!</div>');
        redirect('auth');
    }
 
    public function forgotPassword() 
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('auth/forgotpassword');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Check your mail to get reset code to reset password!</div>');
                redirect('auth');

            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email unregistered...! or unactived...!</div>');
                redirect('auth/forgotpassword');
            }
        }
        
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Failed Resetcode...!<br>Insert your mail to send again reset code..!</div>');
                redirect('auth/forgotpassword');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cannot reset password, Email unregistered...!</div>');
            redirect('auth/register');
        }

    }

    public function changePassword () 
    {
        if(!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'min_length' => 'Password too shoort',
            'matches' => 'Password unmatch...!'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]',);
    
        if($this->form_validation->run() == false) {
        $data['title'] = 'Change Password';
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('auth/changepassword');
        $this->load->view('template/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-succsess" role="alert">Your password has been change..!</div>');
            redirect('auth');
        }
    }

    public function resendverify()
	{
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if($this->form_validation->run() == false) {
            $data['title'] = 'Resend Activated Code';
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('auth/resendverify');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email],)->row_array();
           

            if( $user ['is_active'] == 1) {
                
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email is active, please log in...!</div>');
                redirect('auth');

            } elseif ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'verify');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Check your mail to get reset code to reset password!</div>');
                redirect('auth');
            }
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email unregistered...</div>');
                redirect('auth/resendverify');
            }
        }
       
    }

}
