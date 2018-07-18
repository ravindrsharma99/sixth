<?php
include_once('../wp-config.php');
include_once('../wp-load.php');
include_once('../wp-includes/wp-db.php');
global $wpdb;
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $decode_id = base64_decode($id);
    $explode_data = explode("_", $decode_id);
    $userid = $explode_data[0];

    if (isset($_POST['newpassword'])) {
        if ($_POST['password'] == $_POST['newpassword']) {
            if ($userid != "") {
                $password = ($_POST['newpassword']);
                wp_set_password( $password, $userid );
                echo "<div style=color:green;>Password Updated Sucessfully</div>";
            } else {
                echo "<div style=color:red;>OOPs,Something went Wrong</div>";
            }
        } else {
            echo "<div style=color:red;>Password didn't match.</div>";
        }
    }
    ?> 
    <form action="" method="post"  >
        <div><label>New Password</label>
            <input type="password" name="password" id="pwd1" style=" margin-left: 3%;"/></div>
        <div style=" margin-top: 7px;"><label>Confirm Password</label><input type="password" name="newpassword" id="pwd2" style=" margin-left: 2%;"/></div>
        <button  type="submit" name="button" title="Save" class="button" onClick="checkpass();">save</button>
    </form>
<?php } else { ?>
    <div  style="color:red;">OOPs,Something went Wrong.</div>
<?php } ?>