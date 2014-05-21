<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
/**
 * @author Ali <techsupport@brafton.com>
 * @package Archives Filter
 */

require_once('handler.php');


if( isset($_FILES['archive'] ) ) {
	$file = $_FILES['archive']['tmp_name']; 

<<<<<<< HEAD
	
	$xml = simplexml_load_file( $file );
 
    print_r($xml);

	# echo $handler->format_string();
=======
	$handler = new XMLHandler( $file, $_POST );  
	$new_xml = @$handler->delete_articles();

	if( $new_xml === 0 ){ 
		require_once( 'page-error.php' );
	} else {
		$new_xml->asXML( 'archives.xml' ); 
		require_once( 'page-success.php' );
	}	
>>>>>>> 6574b81ec46b76595db76634a27be55ac4ef5757
}
?>