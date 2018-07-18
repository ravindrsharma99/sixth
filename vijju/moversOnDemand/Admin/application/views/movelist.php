 <!DOCTYPE html>
 <html lang="en">
  <head>
   <title>Codeigniter Pagination Example</title>
   <link href="<?= base_url();?>css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
   <div class="container">
    <div class="row">
     <div class="col-md-12">
      <div class="row">
      
       <h4>Movies List</h4>
       <table class="table table-striped table-bordered table-condensed">
        <tr><td><strong>Movie Id</strong></td><td><strong>Film Name</strong></td><td><strong>Director</strong></td><td><strong>Release Year</strong></td></tr> 
        <?php 
        if(is_array($MOVIES) && count($MOVIES) ) {
         foreach($MOVIES as $movie){     
        ?>
        <tr><td><?=$movie->MOVIE_ID;?></td><td><?=$movie->FILM_NAME;?></td><td><?=$movie->DIRECTOR;?></td><td><?=$movie->RELEASE_YEAR;?></td></tr>     
           <?php 
         }        
        }?>  
       </table>            
      </div>
     </div>
    </div>
    <div class="row">
              <div class="col-md-12">
      <div class="row"><?php echo $this->pagination->create_links(); ?></div> 
     </div>
    </div>
   </div>    
  </body>
 </html> 