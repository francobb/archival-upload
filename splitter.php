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
		 * @param int $startAt file number to start at 
		 * @param int maxItems how many occurences of the item to break the file at
		 * @param string $rawdata the raw data from the original xml file
		 * @param string $fixedFooter if not null then footer will be this string and not computed
		 * @return $arrFiles array of filenames created
		 **/
		function breakIntoFiles( $args ) {
			 	$boundaryTag = 'newsListItem';
			 	$startAt = $args['startAt'];
			 	$maxItems = intval( $args['maxItems'] );
			 	$rawdata = $args['rawdata'];
				$arr = explode("\n",$rawdata);
				$items = 0; // no.of lines added to xml file in loop. resets to zero everytime a file is created
				$files = $startAt; // count of files created
				$length= count($arr); 
				$header = ""; // header block for xml file
				$footer = "</news>"; // footer block for xml file
				$chunk = "";  // chunk of xml data to be written into file
				$arrFiles = array(); // array of files created
				$boundaryIsFound = false; // true when first boundary tag is found
				$fileIsWritten = false;	 // false if some data has not been written to file

				// $footerBreak= "</" . $boundaryTag . ">";		
				// for ($i = $length-1; $i>= 0; $i--){
				// 	$line = $arr[$i];
				// 	//when we reach the end of each article
				// 	if ( strpos( $line, $footerBreak ) == false) {
				// 		$footer =  $line . "\r\n" . $footer;
				// 	}
				// 	else
				// 		break;
				// }
				#var_dump( $footer );

				//process main data		
				for ($i = 0;$i < $length; $i++){

						$line  = $arr[$i];
						var_dump( $line );

					if ( strpos(  $line , htmlspecialchars_decode( '<newsListItem' ) ) !== false ) {
						$items ++;
						$boundaryIsFound = true;
					}

					if (!$boundaryIsFound)
						$header .= $line . "\r\n";
					
					var_dump( $maxItems ) ;
					if ( $items >= $maxItems ) {
					$items = 0;
					$files++;

					$filename =  $files . ".xml";
					$f = fopen($filename, "w");
					fwrite($f, htmlspecialchars_decode( $header ) );
					fwrite($f, htmlspecialchars_decode( $chunk ) );
					fwrite($f, $footer);
					fclose($f);
					$arrFiles[] = $filename;
						echo 'no way hose';

					$chunk = $line . "\r\n";
					$fileWritten = true;
					}
					else {
						$fileIsWritten = false;
						if ( $boundaryIsFound ){
							$chunk .= $line . "\r\n";
						}
					}

					if (!$fileIsWritten ) {
						#$files++;

						$filename =  $files . ".xml";
						$f = fopen($filename, "w");
						fwrite($f,htmlspecialchars_decode( $header ) );
						fwrite($f, htmlspecialchars_decode($chunk ) );
						fclose($f);
						$arrFiles[] = $filename;
					
					}
				}


				 return $arrFiles;

		}				
		function get_file_name( $publish_date ){
			$filename = strtotime( 'F-o', $publish_date );
			return $filename;
		}

		function get_publish_date( $element ){
			if( strpos( $element, '<publishDate>' !== false ) ){
				$date = str_replace( '<publishDate>', '', $element ); 
				$date = str_replace( '</publishDate>', '', $element ); 
				return $date;
			}
		}
	}
}
?>