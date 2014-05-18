<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
/**
 * @author Ali <techsupport@brafton.com>
 * @subpackage Archives Filter
 */

require_once('handler.php');


if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

	
	$xml = simplexml_load_file( $file );
 
    print_r($xml);

	# echo $handler->format_string();
}
?>