<?php 
/**
 * @author Ali <techsupport@brafton.com>
 * @subpackage Archives Filter
 * 
 * Helper class to manipulate xml file 
 * Accepts an xml file from form submission. 
 */

if( ! class_exists( 'XMLHandler' ) ) :
	Class XMLHandler {

		function __construct($file){
			$this->file = $file; 
		}

		/**
		 * Converts File to a string
		 * @return String $file_string
		 */
		function format_string(){
			$file_string = file_get_contents($this->file);
			return $file_string;
		}

		/**
		 * Deletes an article node from xml dom
		 * @param int $brafton_id
		 */
		function delete_article($brafton_id){

		}

	}
endif;
?>