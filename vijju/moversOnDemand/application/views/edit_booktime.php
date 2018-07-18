<?php

    $user = json_decode(file_get_contents('http://movers.com.au/Admin/api/User/getVehicleMove'));
    // $timeData = $user->Response->timemanagementdata;
    $setting = $user->Response->settingdata[0];

    // echo "<pre>";print_r($timeData);
    $current = date('Y-m-d');
    for($i = 0; $i < $setting->type ; $i++){
        $date = date('Y-m-d', strtotime("+".$i."days", strtotime($current)));
        $dayName[] = date('Y-m-d', strtotime($date));      
    }
    // echo "<pre>";print_r($_SESSION); die; 
?>

<div class="container" id="main">
    <div class="row  background_BluRr">
        <div class="col-md-12 col-sm-12">
            <div class="LogOut pull-right"><a href="<?php echo base_url('/App/logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></div>
        </div>
        <div class="row show-grid">
            <div class="col-sm-1 col-md-1-offset"></div>
        </div>
    </div>
    <div class="row">
    <?php
        // if(isset($this->session->flashdata('mmsg'))){
        //     echo $this->session->flashdata;
        // }

    ?>
        <form id="contactus-form1" action="<?php echo base_url(); ?>App/book_select_time" method="POST" >
            <div class="col-lg-10 col-lg-offset-1">
                <div class="Content_WraPper">
                    <div class="heaDiNg_main">
                        <h2 class="text-capitalize">Set Pickup Time</h2></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="TIMing">
                                <!-- <div class='input-group date' >
                                    <input type='text' class="form-control" value="" name="datepick" id='min-date'/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div> -->


                                <div class='input-group date' >
                                    <input type="hidden" id="timeslotsel" name="timeslotsel">
                                    <select id="select" onchange="choice1(this)">
                                        <option value="" class="slectTimes"> --SELECT-- </option>
                                        <?php // $tomorrow = date("Y-m-d", strtotime("+1 day"));
                                            $i = 1;$j = 2;
                                            foreach ($dayName as $key => $value) {  if($value == $current){ $value = "Today"; }  if($i == 8){$i = 1;}
                                        ?>
                                            <option value="<?php echo $i ; ?>" id="opt<?php echo $j; ?>"><?php echo $value; ?></option>
                                        <?php $i++; $j++; } ?>
                                    </select>
                                    <select id="timeslot">
                                        <option>--None--</option>
                                    </select>                                        
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="previous">
                    <?php if(isset($_SESSION['editbookdata'])){ ?>
                        <input type="submit"  id="contact_usa"  name="timesubedit" value="submit"> 
                    <?php }else{ ?>
                        <input type="submit"  id="contact_usa"  name="timesub" value="submit">                       
                    <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/bootstrap-material-datetimepicker.js"></script>
<script>
    $(document).ready(function(){
        $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() ,maxDate: moment().add(30, 'd') ,useCurrent: true,shortTime: false});
        // jq.material.init();
        $('#min-date').bootstrapMaterialDatePicker().on('change', function(e, date){});
    });
</script>
 <script>
        function choice1(select) {
            var date = select.options[select.selectedIndex].text;
            // alert(date);
            $('#date').val(date);
            $("#timeslot").attr("required", "true");
            var num = $('select').val();
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>App/timeslot',
                data:'value='+num+'&date='+date,
                success:function(html){
                    $('#timeslot').html(html);
                     // console.log(html);return false;
                }
            });
        }
        $('#timeslot').click(function(){
            var time = $('#timeslot').val();
            $('#timeslotsel').val(time);
        });
    </script>