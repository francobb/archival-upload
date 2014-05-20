<?php
/**
 * @author Ali <techsupport@brafton.com>
 * @package Archives Filter
 */
?>
<!DOCTYPE html>
<html>
<?php require_once 'header.php' ?>
<body>
	<div class="row" style="margin: 0 0 3em 0;">
    	<div class="col-md-10 col-md-offset-1">
			<h1>Brafton XML Archives Filter</h1>
			<div class="description">
				<p>Curator doesn't include an option to easily look up content for clients given a specific article id (brafton id) list. This is a simple stopgap to solve this issue. Simply upload an xml file from curator. Add your article list, and choose whether you want to include or exclude articles in your list. Click, submit to generate a new xml file containing only the content you're looking for! Pretty neat.</p>
				<p>If you bug me enough I'll add support to break up huge xml files into several smaller xml files so imports don't fail due to php timeout exceptions.<p>
			</div>
		</div>
	</div>
	<div class="row">
	    <div class="col-md-7 col-md-offset-4">
	    	<form class="form-horizontal center" method="post" action="action.php" enctype= "multipart/form-data">
			<div class="form-group">
				<p>Fill out the form below to filter unwanted content from a Brafton xml feed. </p>
				<p>Article List: <input type="textarea"  name="articlelist" required="required" placeholder="Enter article id's" /></p>	
				<p>Do you wish to include or exclude the Articles in your new xml files? <br />
					<input type="radio" name="filter" 
					value="include"  /> Include
					<input type="radio" checked="checked" name="filter" 
					value="exclude"> Exclude
				</p>
			</div>
			<div class="form-group">
				<p>Upload your XML file: 
					<input type="file" name="archive" id="archive" /><br />
				</p>
			</div>	
			<div class="row">
			    <div class="col-md-7">
					<input type="submit" class="btn btn-primary btn-lg btn-block" value="submit"/>
				</div>
			</div>		
		</form>
	    </div>
	</div>
</body>
</html>