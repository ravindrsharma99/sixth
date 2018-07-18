
<!DOCTYPE html>
<html lang="en">
  <head>
 <link href="<?php echo  base_url(); ?>assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo  base_url(); ?>assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />  
  </head>

 <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Post List
                  </header>
                  <div class="panel-body">
                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Post Title</th>
                                    <th>Post</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                <?php   
                  
                  
                    foreach($posts as $posts)
                    { 
                      
                    ?>
                    <tr class="gradeX">
                      <td><?php echo $posts->ID; ?></td>
                      <td><?php echo $posts->post_title; ?></td>
                      <td><?php echo $posts->post_content; ?></td>
                      <td><a href="editAdmins.php?id=" style="color:white"><span class="btn btn-shadow btn-primary">Edit</span></a>
                      <a onclick="return confirmdelete()" href="deleteAdmin.php?id" style="color:white"><span class="btn btn-shadow btn-danger">Delete</span></a></td>
                    </tr>
                  <?php } 
                 
                ?>
                                
                                </tbody>
                            </table>

                        </div>
                  </div>
              </section>
              <!-- page end-->
          </section>
      </section>



<script type="text/javascript" language="javascript" src="<?php echo  base_url(); ?>assets/advanced-datatable/media/js/jquery.js"></script>
    <script src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo  base_url(); ?>js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo  base_url(); ?>js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo  base_url(); ?>js/slidebars.min.js"></script>
    <script src="<?php echo  base_url(); ?>js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>js/respond.min.js" ></script>
<script type="text/javascript" language="javascript" src="<?php echo  base_url(); ?>assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <!--common script for all pages-->
    <script src="<?php echo  base_url(); ?>js/common-scripts.js"></script>
<script type="text/javascript">
      /* Formating function for row details */
      function fnFormatDetails ( oTable, nTr )
      {
          var aData = oTable.fnGetData( nTr );
          var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
          sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
          sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
          sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
          sOut += '</table>';

          return sOut;
      }

      $(document).ready(function() {
          /*
           * Insert a 'details' column to the table
           */
         /*  var nCloneTh = document.createElement( 'th' );
          var nCloneTd = document.createElement( 'td' );
          nCloneTd.innerHTML = '<img src="assets/advanced-datatable/examples/examples_support/details_open.png">';
          nCloneTd.className = "center";

          $('#hidden-table-info thead tr').each( function () {
              this.insertBefore( nCloneTh, this.childNodes[0] );
          } );

          $('#hidden-table-info tbody tr').each( function () {
              this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
          } ); */

          /*
           * Initialse DataTables, with no sorting on the 'details' column
           */
          var oTable = $('#hidden-table-info').dataTable( {
            /*   "aoColumnDefs": [
                  { "bSortable": false, "aTargets": [ 0 ] }
              ],
              "aaSorting": [[1, 'asc']] */
          });

          /* Add event listener for opening and closing details
           * Note that the indicator for showing which row is open is not controlled by DataTables,
           * rather it is done here
           */
          $('#hidden-table-info tbody td img').live('click', function () {
              var nTr = $(this).parents('tr')[0];
              if ( oTable.fnIsOpen(nTr) )
              {
                  /* This row is already open - close it */
                  this.src = "assets/advanced-datatable/examples/examples_support/details_open.png";
                  oTable.fnClose( nTr );
              }
              else
              {
                  /* Open this row */
                  this.src = "assets/advanced-datatable/examples/examples_support/details_close.png";
                  oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
              }
          } );
      } );
  </script>

</body>
