<?php # del_model.php

// This page deletes a model..
// This page is accessed through view_models.php.

$page_title = 'Delete a Movie';

// Check for a valid movie ID, through GET or POST.
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // Accessed through view_movies.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form has been submitted.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<h1 id="mainhead">Page Error</h1>
	<p class="error">This page has been accessed in error.</p><p><br /><br /></p>';
	include ('./includes/footer.html'); 
	exit();
}

include ('mysqli_connect.php'); // Connect to the db.

// Check if the form has been submitted.
if (isset($_POST['submitted'])) {

	if ($_POST['sure'] == 'Yes') { // Delete them.

		// Make the query.
	   $query = "SELECT model_id, model_name, color FROM model WHERE model_id=$id";
	   $result = @mysqli_query ($dbc, $query); // Run the query.
	
	   if (mysqli_num_rows($result) == 1) { // Valid movie ID, show the result.

		// Get the movie information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);

		$model_name_del=$row[1];
		$color_del=$row[2];
		
		$query = "DELETE FROM model WHERE model_id=$id";		
		$result_del = @mysqli_query ($dbc, $query); // Run the query.
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.


		// Get the movie information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
		
		// Create the result page.
		echo '<h1 id="mainhead">Delete a Movie</h1>
		<p>The movie <b>'.$model_name_del.'</b> from year <b>'.$color_del.'</b> has been deleted.</p><p><br /><br /></p>';	
	} else { // Did not run OK.
			echo '<h1 id="mainhead">System Error</h1>
			<p class="error">The movie could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
	}


	}
		

		
	 else { // Not a valid movie ID.
					echo '<h1 id="mainhead">Page Error</h1>
		<p class="error">This page has been accessed in error.</p><p><br /><br /></p>';
		} //End of else.
	
	} // End of $_POST['sure'] == 'Yes' if().
	else { // Wasn't sure about deleting the movie.
		echo '<h1 id="mainhead">Delete a Movie</h1>';
	$query = "SELECT model_id, model_name, color FROM model WHERE model_id=$id";
	$result = @mysqli_query ($dbc, $query); // Run the query.
	
	if (mysqli_num_rows($result) == 1) { // Valid movie ID, show the result.

		// Get the movie information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
		
		// Create the result page.
  echo'
		<p>The movie <b>'.$row[1].'</b> from year <b>'.$row[2].'</b> has NOT been deleted.</p><p><br /><br /></p>';	
	} else { // Not a valid movie ID.
		echo '<h1 id="mainhead">Page Error</h1>
		<p class="error">This page has been accessed in er4ror.</p><p><br /><br /></p>';
	}


} // End of wasn’t sure else().

} // End of main submit conditional.

else { // Show the form.

	// Retrieve.	
	$query = "select model_name, color, brand.brand_id, brand_name, kind.kind_id, kind_name, cr_brand.cr_brand_id, cr_brand_name, crankset.crankset_id, crankset_name from model, brand, kind, crankset, cr_brand where model.brand_id=brand.brand_id and model.kind_id=kind.kind_id and crankset.cr_brand_id=cr_brand.cr_brand_id and model.crankset_id=crankset.crankset_id and model_id = $id";
	$result = @mysqli_query ($dbc, $query); // Run the query.
	
	if (mysqli_num_rows($result) == 1) { // Valid movie ID, show the form.

		// Get the movie information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
		
		// Draw the form.
		echo '<h2>Delete a Movie</h2>
	<form action="del_model.php" method="post">
	<h3>Title: ' . $row[0] . '</h3>
	<h3>Director: ' . $row[1] .'</h3>
	<h3>Genre: ' . $row[3] . '</h3>
	<h3>Year: ' . $row[5] . '</h3>
	<h3> Year: ' .$row[7]. '</h3>
	<h3> whatever:'.$row[9].'</h3>
	<p>Are you sure you want to delete this movie?<br />
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No</p>
	<p><input type="submit" name="submit" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} //End of valid movie ID if().
	else { // Not a valid movie ID.
		echo '<h1 id="mainhead">Page Error</h1>
		<p class="error">This page has been accessed in error.</p><p><br /><br /></p>';
	}

} // End of the main Submit conditional.

mysqli_close($dbc); // Close the database connection.

?>