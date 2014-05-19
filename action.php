<?php
/**
 * @author Ali <techsupport@brafton.com>
 * @subpackage Archives Filter
 */

require_once('handler.php');

if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

	
	$handler = new XMLHandler( $file, $_POST );  
			
	$new_xml = @$handler->delete_articles();

	var_dump( $new_xml );
}
?>