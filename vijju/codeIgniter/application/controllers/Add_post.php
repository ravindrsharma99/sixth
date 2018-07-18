<?php
class Add_post extends CI_Controller {
 
function __Construct(){
  parent::__Construct ();
   $this->load->database(); // load database
    $this->load->helper('url');
    $this->load->view('header');
    $this->load->view('left-sidebar');
$this->load->model('Add_post_model');
$this->load->library('form_validation');
 $this->load->library('session');
}
 
 public function index()
	{
		$this->load->view('Add_post');
	}

   function process(){
                    
                            if($this->input->post('submit'))
                               {
                                
                                          $this->Add_post_model->AddPost();
                                          
                                              $this->session->set_flashdata('msg', 'Post Added Successfully');  
                                               redirect("Add_post");
                                          
                                          
                               
                                }
                    }


 
}
?>
