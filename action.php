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

	#echo htmlspecialchars( $new_xml->asXML() );
	$test = $new_xml->asXML( 'archives.xml' ); 

	#echo $handler->create_new_archive($new_xml)->asXML();
	#var_dump( $new_xml );
	if( $test != false )
		require_once( 'page-success.php' );
	else
		require_once( 'page-error.php' );

}
?>