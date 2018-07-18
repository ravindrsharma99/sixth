<?php
    class Add_post_model extends CI_Model{   
        function AddPost(){
                    $post = $this->input->post('post');
                    $posttitle = $this->input->post('posttitle');
                    $data = array(
                        'post_content'=>$post,
                        'post_title'=>$posttitle                    
                    );
                    $this->db->insert('wp_post',$data);    
            }//end of simpan        
        }
?>
