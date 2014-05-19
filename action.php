<?php
#ini_set('display_startup_errors',1);
#ini_set('display_errors',1);
#error_reporting(-1);
/**
 * @author Ali <techsupport@brafton.com>
 * @subpackage Archives Filter
 */

require_once('handler.php');


if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

	
	$handler = new XMLHandler( $file, $_POST );  

	# echo $handler->format_string();
}
?>