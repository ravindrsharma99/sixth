<?php
class Login extends CI_Controller {
 
function __construct(){
   parent::__construct();
   $this->load->model('Admin_model','',TRUE);
   $this->load->library('session');
   $this->load->helper('url');
   $session_data = $this->session->userdata('logged_in');
    if($session_data['id']!=""){
    redirect('Dashboard');
    }
  
}
 
function index()
{

   //This method will have the credentials validation
   $this->load->library('form_validation');
   $this->form_validation->set_rules('email', 'Email', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
 
    if($this->form_validation->run() == FALSE){
    //Field validation failed.  User redirected to login page
    $this->load->view('login');
    }
    else{
    redirect('Dashboard');
    } 
}
 
function check_database($password){
   //Field validation succeeded.  Validate against database
    $email = $this->input->post('email');
 	  $password = $this->input->post('password');
   //query the database
   $result = $this->Admin_model->login($email, $password);
 
   if($result){
     $sess_array = array();
     foreach($result as $row => $value)

     {
       $sess_array = array(
         'id' => $value->id,
         'email' => $value->email,
         'fullname' => $value->fullname
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid Email or Password');
     return false;
     }
  }
}
