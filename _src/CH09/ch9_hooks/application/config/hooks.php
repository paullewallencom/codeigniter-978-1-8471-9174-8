<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller'] = array(
    'class'    => 'Class_name',
    'function' => 'function_name',
    'filename' => 'file_name_of_hook.php',
    'filepath' => 'path_to_hook'
    ); 

/*
 EXAMPLE FROM BOOK:

$hook['post_controller'] = array(
    'class'    => 'Class_name',
    'function' => 'function_name',
    'filename' => 'file_name_of_hook.php',
    'filepath' => 'path_to_hook',
	'params’   => array(param1, param2, param3 ... etc)
    ); 


*/

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */