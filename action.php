<?php
/**
 * @author Ali <techsupport@brafton.com>
 * @package Archives Filter
 */

require_once('handler.php');

if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

	$handler = new XMLHandler( $file, $_POST );  
	$new_xml = @$handler->delete_articles();

	if( $new_xml === 0 ){ 
		require_once( 'page-error.php' );
	} else {
		$new_xml->asXML( 'archives.xml' ); 
		require_once( 'page-success.php' );
	}	
}
?>