<?php
class Postmodel extends CI_Model {
 
function getPosts(){
  $this->db->select("ID,post_content,post_title");
  $this->db->from('wp_post');
  $query = $this->db->get();
  return $query->result();
}
 
}
?>
