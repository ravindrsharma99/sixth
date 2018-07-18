
      <!--header end-->
      <!--sidebar start-->
     
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!--state overview start-->
             <div class="row state-overview">
                  <div class="col-lg-6 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="fa fa-user"></i>
                          </div>
                          <div class="value">
                              <h1 class="count1">
                                  <?php echo $totalusers;?>
                              </h1>
                              <p>Total Users</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-6 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count45">
                                <?php echo $loginusers;?>
                              </h1>
                              <p>Login Users</p>
                          </div>
                      </section>
                  </div>
     <!--              <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="fa fa-sort-amount-asc"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count45">
                               <?php echo $totalvechicle;?>
                              </h1>
                              <p>Total Vechicle</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="fa fa-arrows"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count45">
                              <?php echo $totalmoves;?>
                              </h1>
                              <p>Total Moves</p>
                          </div>
                      </section>
                  </div> -->
              </div> 
              <!--state overview end-->
      <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                 
                <center><div id="piexhart" style="width: 100%; height: 500px; float: left"></div></center>
            </div>
      </div> 

          </section>
      </section>
          
      <!--main content end-->
      <!--footer start-->
     <?php 
     $this->load->view('templete/footer');
     ?>
      <!--footer end-->
      <?php
      $ch_data = $ch_data . "['Total Users '," . $totalusers . "],";
      $ch_data = $ch_data . "['Login Users '," . $loginusers . "],";
      // $ch_data = $ch_data . "['Total Vechicle'," . $totalvechicle . "],";
      // $ch_data = $ch_data . "['Total Moves'," . $totalmoves . "],";
      ?>
    <!--script for this page-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="<?php echo base_url("public/js/sparkline-chart.js")?>"></script>
    <script src="<?php echo base_url("public/js/easy-pie-chart.js")?>"></script>
    <script src="<?php echo base_url("public/js/count.js")?>"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });


      $(function(){
          $('select.styled').customSelect();
      });

  </script>
     <script type="text/javascript">


    Highcharts.chart('piexhart', {
        title: {
    text: ' All Record '
},
        chart: {

            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        tooltip: {
            enabled: true,
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total % ',
            data: [

                <?php  echo $ch_data; ?>
            ]
        }]
    });
    </script>
  </body>
</html>
