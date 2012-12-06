<?php  

defined('C5_EXECUTE') or die(_("Access Denied."));


/* 
	you can override system layouts here  - but we're not going to by default 
	
	For example: if you would like to theme your login page with the Green Salad theme,
	you would uncomment the lines below and change the second argument of setThemeByPath 
	to be the handle of the the Green Salad theme "greensalad" 

*/



$v = View::getInstance();

$v->setThemeByPath('/page_not_found', "general_layout");

$v->setThemeByPath('/login', "general_layout");
$v->setThemeByPath('/403', "general_layout");
$v->setThemeByPath('/register', "general_layout");
