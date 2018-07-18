<?php
class Post extends CI_Controller {
 
function __Construct(){
  parent::__Construct ();
   $this->load->database(); // load database
   $this->load->model('Postmodel'); // load model
   $this->load->helper('url');
    $this->load->view('header');
$this->load->view('left-sidebar');

}
 
public function index() {
   $this->data['posts'] = $this->Postmodel->getPosts(); // calling Post model method getPosts()
   $this->load->view('posts_view', $this->data); // load the view file , we are passing $data array to view file
}
 
 
}
?>
