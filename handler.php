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

			if( $attr['filter'] == 'exclude' )
				$this->exclude = $attr['filter'];

			#$this->id_list = explode( ' ', $attr['articlelist'] ); 

			$this->id_list = array( "599015" ); 

			//read temp file into xml object
			$this->xml = simplexml_load_file( $xml_file );

			//array containing article all nodes 
			$this->archive_history = $this->load_archive();

			$this->delete_articles();

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


		function delete_helper( $xml, $article ){
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
		 * Deletes an all  node from xml dom
		 * @param int $brafton_id
		 */
		function delete_articles(){
			
			$xml_copy = $this->xml; 
			//for every given id
			foreach( $this->id_list as $article_id ){
				//check for it's existence in the archive history array
				foreach( $this->archive_history as $article )
				{
					//if found, delete it
					if( $article->id == $article_id ){
						$new_xml = @$this->delete_helper( $xml_copy, $article_id );
						echo "test";
						#var_dump( $xml_copy->$node);
						#var_dump( $article );

					}
				}
			} 
			var_dump( $new_xml );
		}

	}
endif;
?>