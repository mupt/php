<?php # del_crankset.php

// This page deletes a brand
// This page is accessed through view_brand.php.
echo '<fieldset><legend>Delete a crankset brand</legend>';
$page_title = 'Delete a crankset brand';

// Check for a valid dir. ID, through GET or POST.
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // Accessed through del_crankset.php
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

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query.
	   $query = "select * from crankset where crankset_id=$id";		
	   $result = @mysqli_query ($dbc, $query); // Run the query.
	
	   if (mysqli_num_rows($result) == 1) { // Valid dir. ID, show the result.

		// Get the brand information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
	
		$crankset_name_del=$row[2];
		
		$query = "DELETE FROM crankset WHERE crankset_id=$id";		
		$result_del = @mysqli_query ($dbc, $query); // Run the query.
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.


		// Get the brand information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
		
		// Create the result page.
		echo '<h1 id="mainhead">Delete a Directors</h1>
		<p>The crankset brand name <strong>'.$crankset_name_del. '</strong> has been deleted.</p><p><br /><br /></p>';	
	} else { // Not a valid brand ID.
		echo '<h1 id="mainhead">Page Error</h1>
		<p class="error">This page has been accessed in error.</p><p><br /><br /></p>';
	}


	}
		

		
	 else { // If the query did not run OK.
			echo '<h1 id="mainhead">System Error</h1>
			<p class="error">This crankset brand could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
		}
	
	} else { // Wasn't sure about deleting the movie.
		echo '<h1 id="mainhead">Delete a crankset brand</h1>';

	$query = "select * from crankset where crankset_id=$id";		
	$result = @mysqli_query ($dbc, $query); // Run the query.
	
	if (mysqli_num_rows($result) == 1) { // Valid movie ID, show the result.

		// Get the movie information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
			
		$crankset_name_del=$row[2];

		
		// Create the result page.
  echo'
		<p>The crankset brand name <strong>'.$crankset_name_del. '</strong> has NOT been deleted.</p><p><br /><br /></p>';	
	} else { // Not a valid dir. ID.
		echo '<h1 id="mainhead">Page Error</h1>
		<p class="error">This page has been accessed in error.</p><p><br /><br /></p>';
	}


}
} else { // Show the form.

	// Retrieve the director information.
	$query = "SELECT crankset_name FROM crankset WHERE crankset_id=$id";		
	$result = @mysqli_query ($dbc, $query); // Run the query.
	
	if (mysqli_num_rows($result) == 1) { // Valid dir. ID, show the form.

		// Get the brand information.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
		
		// Create the form.
		echo '
	<form action="del_crankset_name.php" method="post">
	<h3>Crankset brand name: ' . $row[0] . '</h3>
	<p>Are you sure you want to delete this brand?</p>
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No</p>
	<p><input type="submit" name="submit" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
		echo' <p>Would you rather edit this entry?</p>';
		echo '<a href="edit_crankset.php?id=' . $id . '">Edit</a>';
	
	} else { // Not a valid dir. ID.
		echo '<h1 id="mainhead">Page Error</h1>
		<p class="error">This page has been accessed in error.</p><p><br /><br /></p>';
	}

} // End of the main Submit conditional.

mysqli_close($dbc); // Close the database connection.

?>

<?php
echo "</fieldset>";
echo'<div style="text-align:center">';
echo'<p>&nbsp;</p>';
echo'<br />';
echo '&nbsp;&nbsp;&nbsp;&nbsp;__o';
echo'<br />';
echo'&nbsp;_ \<,_';
echo '<br />';
echo'(_)/ (_)';
echo'<a href="index.php">';
echo'<p>Velobase 2012</p>';
echo'</a>';
echo'</div>';
?>
