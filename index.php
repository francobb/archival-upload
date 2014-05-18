<?php
/**
 * @author Ali <techsupport@brafton.com>
 * @subpackage Archives Filter
 */
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<title>Archives</title>
<h1>Brafton XML Archives Filter</h1>
<div class="description">
	<p>Curator doesn't include an option to easily look up content for clients given a specific article id (brafton id) list. This is a simple stopgap to solve this issue. Simply upload an xml file from curator. Add your article list, and choose whether you want to include or exclude articles in your list. Click, submit to generate a new xml file containing only the content you're looking for! Pretty neat.</p>
	<p>If you bug me enough I'll add support to break up huge xml files into several smaller xml files so imports don't fail due to php timeout exceptions.<p>
</div>
	<form method="post" action="action.php" enctype= "multipart/form-data">

		<p>Fill out the form below to filter unwanted content from a Brafton xml feed. </p>
		<p>Article List: <input type="textarea"  name="articlelist" required="required" /></p>	
		<p>Do you wish to include or exclude the Articles in your list? <br />
			<input type="radio" name="filter" 
			value="include"  /> Include
			<input type="radio" checked="checked" name="filter" 
			value="exclude"> Exclude
		</p>

		<p>Upload your XML file: 
			<input type="file" name="archive" id="archive" /><br />
		</p>	
		<input type="submit" value="submit"/>
	</form>
</body>
</html>