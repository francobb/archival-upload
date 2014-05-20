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
	<div class="row wrapper main" style="margin: 0 0 3em 0;">
    	<div class="col-md-10 col-md-offset-1">
			<h1>Terminati</h1>
			<div class="description">
				<p>Terminati intends to help Brafton keep clients from terminating. Use this elegantly designed tool to frequently check for missing content so our clients don't have to. </p>
				<h3>Directions</h3>
				<p>1. Query the client's database for an ids list containing all successfully imported articles<p>
				<p>2. Download an xml archives history for the client from curator.</p>
				<p>3. Fill out the form Below.</p>
				<p>4. Download the archives xml file containing the missing content.</p>
				<p>5. Import the missing content to the client's website.</p>
			</div>
		</div>
	</div>
	<div class="row wrapper form">
	    <div class="col-md-7 col-md-offset-4">
	    	<form class="form-horizontal center" method="post" action="action.php" enctype= "multipart/form-data">
			<div class="form-group">
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