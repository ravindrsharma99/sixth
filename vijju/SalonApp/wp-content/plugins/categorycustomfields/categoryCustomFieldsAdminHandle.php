<?php

function categoryCustomFields_AddFieldsAction($tag)
{
	categoryCustomField_add_tag_enctype();
	categoryCustomFields_AddFields($tag,'add');
}

function categoryCustomFields_EditFields($tag)
{
	categoryCustomFields_edit_tag_enctype();
	categoryCustomFields_AddFields($tag,'edit');

}

function categoryCustomFields_AlterFields($termId)
{	

	$taxonomy = categoryCustomFields_DB_GetTaxonomyNameTermById($termId);
	$fields = categoryCustomFields_DB_GetFields($taxonomy);
	
	
	
	foreach($fields as $f)
	{

		$value = categoryCustomFields_GetFieldsValue($f);

		if(($f->field_type =='image' || $f->field_type =='file') && strlen($value)>0)		
			categoryCustomFields_DB_UpdateFields($f->field_name,$value,$termId);
		if($f->field_type =="checkbox" || $f->field_type =="text")
			categoryCustomFields_DB_UpdateFields($f->field_name,$value,$termId);
	}
}
function categoryCustomFields_GetFieldsValue($f)
{
	$name = str_replace(" ","_",$f->field_name);
	
	switch($f->field_type)
	{
		case "text":
			return $_REQUEST[$name];
			break;
		case "date":
			return $_REQUEST[$name];
			break;
		case "checkbox":
			return $_REQUEST[$name];
			break;
		case "file":
				
			if(strlen($_FILES[$name]["name"])>0){
				$upload = wp_upload_bits($_FILES[$name]["name"], null, file_get_contents($_FILES[$name]["tmp_name"]));	
				$upload['file']=str_replace("\\","/",$upload['file']);
					return $upload['url'].'@'.$upload['file'];
			}
			break;
		case "image":
		if(strlen($_FILES[$name]["name"])>0){
			$upload = wp_upload_bits($_FILES[$name]["name"], null, file_get_contents($_FILES[$name]["tmp_name"]));	
			$upload['file']=str_replace("\\","/",$upload['file']);
			return $upload['url'].'@'.$upload['file'];
			}
			break;
	}
}


function categoryCustomFields_AddFields($tag,$screen)
{
	$tax = $tag->taxonomy;
	if(strlen($tag->taxonomy)==0)
		$tax=$tag;

	$fields = categoryCustomFields_DB_GetFields($tax);
	
	foreach($fields as $f)
	{ 
		switch($f->field_type)
		{
			case "file" :
				if($screen != "add")
					DisplayFileBox($f,$tag);
				break;
			case "text" :
				DisplayTextBox($f,$tag);
				break;
			case "image" :
				if($screen !="add")
					DisplayImageBox($f,$tag);
				break;
			case "date" :
				DisplayFileBox($f,$tag);
				break;
			case "checkbox" :
				DisplayCheckBox($f,$tag);
				break;
		}
		if($screen == "add")
			DisplayHelpBoxAdd();
	}
}

function DisplayTextBox($f,$tag)
{

		$row = categoryCustomFields_DB_GetCategoryValueById($tag->term_id,$f->field_name);


		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="<?php echo $f->field_name; ?>"><?php _ex($f->field_name, $f->field_name); ?></label></th>
			<td><input type="text"  name="<?php echo $f->field_name; ?>" id="<?php echo $f->field_name; ?>" rows="5" cols="50" style="width: 97%;"><?php echo $row->field_value; ?><br /><br />
			</td>
		</tr>
		<?php
}
function DisplayFileBox($f,$tag)
{
		$row = categoryCustomFields_DB_GetCategoryValueById($tag->term_id,$f->field_name);
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="<?php echo $f->field_name; ?>"><?php _ex($f->field_name, $f->field_name); ?></label></th>
			<td><input type="file"  name="<?php echo $f->field_name; ?>" id="<?php echo $f->field_name; ?>" ><?php $str =explode('@',$row->field_value);
			
			if(count($str)>0) echo $str[0];

			?><br />
			</td>
		</tr>
		<?php
}

function DisplayCheckBox($f,$tag)
{
		$row = categoryCustomFields_DB_GetCategoryValueById($tag->term_id,$f->field_name);
		
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="<?php echo $f->field_name; ?>"><?php _ex($f->field_name, $f->field_name); ?></label></th>
			<td><input type="checkbox" value="true"  name="<?php echo $f->field_name; ?>" id="<?php echo $f->field_name; ?>" <?php $str =explode('@',$row->field_value);
			
			if(count($str)>0 && $str[0]=="true") echo 'checked="checked"';

			?>><br/>
			</td>
		</tr>
		<?php
}


function DisplayImageBox($f,$tag)
{
		$row = categoryCustomFields_DB_GetCategoryValueById($tag->term_id,$f->field_name);
		
?>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="<?php echo $f->field_name; ?>"><?php _ex($f->field_name, $f->field_name); ?></label></th>
			<td><input type="file"  name="<?php echo $f->field_name; ?>" id="<?php echo $f->field_name; ?>" ><?php $str =explode('@',$row->field_value);
			
			if(count($str)>1) 
				echo '<a href="'.$str[0].'" target="_blank"><img src="'.$str[0].'" height="75"></a>';

			?><br />
			</td>
		</tr>
		<?php
}

		
function DisplayHelpBoxAdd()
{
	//echo ' nu merge sa pui fisiere';
}

function categoryCustomFields_AddSettingsMenu()
{
	add_options_page ('Category Custom Fields Settings',  'Category Settings', 'manage_options', 'categoryCustomFields_SettingsPage','categoryCustomFields_SettingsPage');	
}

function categoryCustomFields_SettingsPage(){
   include_once("pages/ccf_settings.php");
}

function categoryCustomFields_edit_tag_enctype() {
        echo "<script type='text/javascript'>
                  jQuery(document).ready(function(){
				  
                      jQuery('#edittag').attr('enctype','multipart/form-data');
					  
                  });
              </script>";
    }
	
function categoryCustomField_add_tag_enctype()
	{
	echo "<script type='text/javascript'>
                  jQuery(document).ready(function(){
				  
                      jQuery('#addtag').attr('enctype','multipart/form-data');
				  
                  });
              </script>";
	}
    
	?>