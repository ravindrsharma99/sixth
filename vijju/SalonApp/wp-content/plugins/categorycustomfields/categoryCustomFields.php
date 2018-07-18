<?php 
/*
Plugin Name: Category Custom Fields
Plugin URI: http://av-studio.org/CategoryCustomFields.zip
Description: The plug in will let add unlimited custom fields to any cateogry/taxonomy
Version: 1.0
Author: Cornea Alexandru
Author URI: http://av-studio.org

*/

/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
 

require_once("categoryCustomFieldsDB.php");
require_once("categoryCustomFieldsInstall.php");
require_once("categoryCustomFieldsAdminHandle.php");
register_activation_hook( __FILE__, 'categoryCustomFields_Install' );

add_action("admin_menu","categoryCustomFields_AddSettingsMenu");

$taxnow = sanitize_key($_REQUEST['taxonomy']);
add_action($taxnow.'_edit_form_fields','categoryCustomFields_EditFields');
add_action($taxnow.'_add_form_fields','categoryCustomFields_AddFieldsAction');
add_action('edited_term','categoryCustomFields_AlterFields');

add_action('created_'.$taxnow,'categoryCustomFields_AlterFields');



function categoryCustomFields_GetAllCustomFieldsByTaxonomyId($taxonomy)
{
	$arr = categoryCustomFields_DB_GetCategoryValueByTaxonomy($taxonomy);
	for($i=0;$i<count($arr);$i++)
		if($arr[$i]->field_type=="image" || $arr[$i]->field_type=="file"){
				$arr[$i]->field_value=explode('@',$arr[$i]->field_value);
			
			}
	return $arr;		
}

function categoryCustomFields_GetCustomFieldByTaxonomyIdAndFieldName($taxonomy,$name)
{
	$arr = categoryCustomFields_DB_GetCategoryValueById($taxonomy,$name);
	
		if($arr->field_type=="image" || $arr->field_type=="file")
			$arr->field_value=explode('@',$arr->field_value);
	return $arr->field_value;
}

function categoryCustomFields_GetImage($taxonomy,$name,$width=10000,$height=10000)
{
	$arr = categoryCustomFields_DB_GetCategoryValueById($taxonomy,$name);
	
	if($arr->field_type=="image" || $arr->field_type=="file")
		$arr->field_value=explode('@',$arr->field_value);
		$arr->field_value = $arr->field_value[1];
	$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	
	$a= $x.'categoryCustomFields_ShowImage.php?path='.urlencode($arr->field_value).'&widht='.$widht.'&height='.$height;
	
	return $a;
	
}

function categoryCustomFields_GetPostsByCustomField($fieldName,$fieldValue)
{
	return categoryCustomFields_DB_GetPostsByCustomField($fieldName, $fieldValue);
}

function categoryCustomFields_GetCategoriesByCustomField($fieldName,$fieldValue)
{
	return categoryCustomFields__DB_GetCategoriesByCustomField($fieldName,$fieldValue);
}


function categoryCustomFields_GetCategoryCustomField($catID,$fieldName)
{
	return categoryCustomFields__DB_GetCategoryCustomField($catID,$fieldName);
}




?>