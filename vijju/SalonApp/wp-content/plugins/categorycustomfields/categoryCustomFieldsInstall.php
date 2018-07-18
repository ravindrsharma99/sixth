<?php

function categoryCustomFields_Install()
{
	 global $wpdb;
    $table_setting=$wpdb->prefix . "ccf_Fields";
	$table_term = $wpdb->prefix."terms";
    $table_values=$wpdb->prefix . "ccf_Value";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	if($wpdb->get_var("SHOW TABLES LIKE '$table_setting'") != $table_setting) {
       $sql = "CREATE TABLE " . $table_setting . " (	  
	  field_name varchar(200),
	  field_type varchar(100),
	  category_type varchar(50),
	  UNIQUE KEY field_name(field_name)
	);";
     dbDelta($sql);
	} 
	 if($wpdb->get_var("SHOW TABLES LIKE '$table_values'") != $table_setting) {
       $sql = "CREATE TABLE " . $table_values . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  field_name varchar(200) references $table_setting(field_name),
	  field_value text,	  
	  term_id bigint,
	  UNIQUE KEY id (id)
	);";
	
     dbDelta($sql);
	}
}
?>