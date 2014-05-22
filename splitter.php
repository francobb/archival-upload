<?php 
/**
 * @package Terminati
 * 
 * Simple class used to split large xml files into smaller files.
 * Ref: http://truelogic.org/wordpress/2012/07/03/split-large-xml-into-parts-before-processing-in-php/
 */

if( ! class_exists( 'Splitter' ) ){
	class Splitter {
		/**
		 * Function to break an xml file into several smaller files 
		 * If the orig xml file is smaller than max size then it will be converted into a single file
		 * @param string $boundaryTag for product boundary tag name
		 * @param int $filename_index file number to start at 
		 * @param int articles_per_file how many occurences of the item to break the file at
		 * @param string $xml_string the raw data from the original xml file
		 * @param string $fixedFooter if not null then footer will be this string and not computed
		 * @return $filename_array array of filenames created
		 **/
		function breakIntoFiles( $args ) {
			 	$boundaryTag = 'newsListItem';
			 	$filename_index = $args['filename_index'];
			 	$articles_per_file = intval( $args['articles_per_file'] );
			 	$xml_string = $args['xml_string'];
				$xml_array = explode("\n",$xml_string);
				$items = 0; // no.of lines added to xml file in loop. resets to zero everytime a file is created
				$files = $filename_index; // count of files created
				$length= count($xml_array); 
				$header = ""; // header block for xml file
				$footer = "</news>"; // footer block for xml file "its fixed"
				$article_node = "";  // article_node of xml data to be written into file
				$filename_array = array(); // array of files created
				$article_start_tag = false; // true when first boundary tag is found
				$file_created = false;	 // false if some data has not been written to file

				//process main data		
				for ( $i = 0; $i < $length; $i++){

						$line  = $xml_array[$i];

					if ( strpos(  $line , '&lt;newsListItem' ) !== false ) {
						$items ++;
						$article_start_tag = true;
					}
					//Everything before the first boundary is the header of each file	
					if (!$article_start_tag)
						$header .= $line . "\r\n";
					
					if ( $items >= $articles_per_file) {
					$items = 0;
					$files++;
					$filename =  $files . ".xml";

					$f = fopen($filename, "w");
					fwrite($f, htmlspecialchars_decode( $header ) );
					fwrite($f, htmlspecialchars_decode( $article_node ) );
					fwrite($f, $footer);
					fclose($f);
					$filename_array[] = $filename;

					$article_node = $line . "\r\n";
					$file_created = true;
					}
					else {
						$file_created = false;
						if ( $article_start_tag ){
							$article_node .= $line . "\r\n";
						}
					}

					
				}
				if ( $file_created == false ) {
						$files++;
						$filename =  $files . ".xml";
						$f = fopen($filename, "w");
						fwrite($f,htmlspecialchars_decode( $header ) );
						fwrite($f, htmlspecialchars_decode($article_node ) );
						fclose($f);
						$filename_array[] = $filename;
						$file_created = true;
					}
				echo "files: " . $files . ' items: ' . $items . ' articles_per_file: ' . $articles_per_file;

				 return $filename_array;

		}				
		function get_file_name( $publish_date ){
			$filename = strtotime( 'F-o', $publish_date );
			return $filename;
		}

		function get_publish_date( $element ){
			var_dump( $element );
			if( strpos( $element, ':' !== false ) ){
				$date = str_replace( '<publishDate>', '', $element ); 
				$date = str_replace( '</publishDate>', '', $element ); 
				return $date;
			}
	
			return false;			
		}
	}
}
?>