=== Category Custom Fields ===

Tags: category, categories, icons, icon, image, images, post, posts, list, lists, manage, plugin, plugins, admin, photo, photos, files, custom fields, query by custom fields
Contributors:  Alexandru Cornea
Requires at least: 3.1
Tested up to: 3.1.1
Stable tag: 1.5


== Description ==

The plug in will let add unlimited custom fields to any cateogry/taxonomy


== Frequently Asked Questions ==
Q: How do I add custom fields for categories?
A: In admin you will have the "Category Settings" entry under Settings menu

Q: How can I add an image to a category?
A: In Category Settings you can add new fields. By selecting image as field type the system will now to handle images for that field. 
When editing a category your new field will be able to get images files.

Q: Why I can't I add files/images on the add screen of a category?
A: The current version can handle files upload only from the edit screen.

Q: What is a taxonomy?
A: A category is a taxonomy. The plug in allows you to add fields only for the most know taxonomy ( category) or for custom taxonomies.

Q: How to get post by a custom field?
A: You have to call categoryCustomFields_GetPostsByCustomField with the following two parameters : field name Color (e.g. Image) and field value (e.g. Red).

Q: How to get categories by custom field
A: You have to call categoryCustomFields_GetCategoriesByCustomField with the following two parameters : field name Color (e.g. Image) and field value (e.g. Red).


== Screenshots ==

1. Admin Panel
2. Category Add screen
3. Category Edit screen


== Installation ==

1. Copy the files in the plug in direcotry.
2. Activate the plug in
3. In admin at Settings menu you will have Category Settings entry.

== Changelog ==
= 1.5 =
Fixed the bug when values were not saved if the custom field would have contain spaces
= 1.4 =
Fixed some bugs. Added the function categoryCustomFields_GetCategoriesByCustomField
= 1.3 =
Fixed some bugs. Added the function categoryCustomFields_GetCategoriesByCustomField
= 1.2 =
Fixed some bugs. 
= 1.0.1 =
Fixed a bug when editing categories with images.
= 1.0 =
* First version is out