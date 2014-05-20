<?php 
/**
 * @author Ali <techsupport@brafton.com>
 * @package Archives Filter
 * 
 * Helper class to manipulate xml file 
 * Accepts an xml file via form submission. 
 * 
 * todo: break out longer xml archives files into several shorter ones. 
 * 
 * make sure filenames are not all the same. Perhaps name the files by the dates
 * of the articles in them.
 */

if( ! class_exists( 'XMLHandler' ) ) :
	Class XMLHandler {

		/**
		 * Array
		 */
		public $archive_history;

		/**
		 * Bool 
		 */
		public $exclude; 

		/**
		 * array
		 */
		public $id_list;

		/**
		 * SimpleXMLElement Object
		 */
		public $xml;
		/**
		 * Receives xml file from upload form.
		 * @param $file 
		 * @param $attr 
		 */
		function __construct( $xml_file, $attr ){
			if( $attr['filter'] == 'exclude' ) {
				$this->exclude = $attr['filter'];
				//Grab all article id's from form field
				$this->id_list = explode( ' ', $attr['articlelist'] ); 
			}
			//read temp file into xml object
			$this->xml = simplexml_load_file( $xml_file );

			//array containing article all nodes 
			$this->archive_history = $this->load_archive();
		}

		/**
		 * Find all articles on the xml file
		 */
		function load_archive(){
			$articles = array();
			foreach( $this->xml->newsListItem as $article )
			{
				$articles[] = $article; 
			}
			return $articles;
		}

		/**
		 * Removes individual article from xml file
		 * @param SimpleXMLElement $xml
		 * @param String $article 
		 * 
		 * @return SimpleXMLElement $xml
		 */
		function delete_single_article( $xml, $article ){
			$i = 0;
			if( isset($xml->newsListItem)  )
			{
				foreach( $xml->newsListItem as $item )
				{
					if( $item->id == $article ){
						unset( $xml->newsListItem[$i] );
					}
					$i++;
				}
			}
			return $xml;
		}

		/**
		 * Deletes an all given articles from xml file
		 * @return SimpleXMlElement $new_xml
		 */
		function delete_articles(){
			$deleted = 0; 
			//for every given id in article list
			foreach( $this->id_list as $article_id ){
				//check for it's existence in the archive history array
				foreach( $this->archive_history as $article ){
					//if found, remove the article
					if( $article->id == $article_id ){
						$new_xml = @$this->delete_single_article( $this->xml, $article_id );
						$deleted++; 
					}
				}
			} 
			//if there was nothing to delete
			if( $delted === 0 )
				return $deleted;

			return $new_xml;
		}
	}
endif;