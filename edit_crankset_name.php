<?php # edit_crankset.php

// This page edits a brand and is accessed through view_brand.php

echo "<fieldset><legend>Edit selected crankset</legend>";

$page_title = 'Edit Cranksets';

// Check for a valid dir. ID, through GET or POST.
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // Accessed through view_dirs.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form has been submitted.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<h1 id="mainhead">Page Error</h1>
	<p class="error">This page has been accessed in error.</p><p><br /><br /></p>';
	exit();
}

include ('mysqli_connect.php');

// Connect to the db.

// Check if the form has been submitted.
if (isset($_POST['submitted'])) {

	$errors = array(); // Initialize error array.
	
		// Check for a brand name.
	if (empty($_POST['crankset_name'])) {
		$errors[] = 'You forgot to enter the CR name.';
	} else {
		$crankset_name = $_POST['crankset_name'];
	}
	
	
	if (empty($errors)) { // If everything's OK.
	
	
			// Make the query.
			$query= "update crankset set crankset_name='$crankset_name' where crankset_id=$id";
			$result = @mysqli_query ($dbc, $query); // Run the query.
			if ((mysqli_affected_rows($dbc) == 1) || (mysqli_affected_rows($dbc) == 0)) { // If it ran OK.
			
				// Print a message.
				echo '<h1 id="mainhead"></h1>
				<p>The crankset has been edited.</p><p><br /><br /></p>';	
							
			} else { // If it did not run OK.
				echo '<h1 id="mainhead">System Error</h1>
				<p class="error">The crankset could not be edited due to a system error. We apologize for any inconvenience. Please don\'t blame yourself. </p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
				exit();
			}
				
	} else { // Report the errors.
	
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form.

// Retrieve the movies's information.	
$query = "select crankset_name from crankset where crankset_id=$id";
$result = @mysqli_query ($dbc, $query); // Run the query.

if (mysqli_num_rows($result) == 1) { // Valid movie ID, show the form.

	// Get the movie's information.
	$row = mysqli_fetch_array ($result, MYSQL_NUM);
	$this_crankset_id=$row[0];
	// Create the form.
	echo '<h2>Edit a Kind</h2>
<form action="edit_crankset_name.php" method="post">
<p>Crankset Name:<input type="text" name="crankset_name" size="25" maxlength="25" value="' . $row[0] . '" /></p>
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="id" value="' . $id . '" />
<p><input type="submit" name="submit" value="Submit" /></p>
</form>

';


} else { // Not a valid dir. ID.
	echo '<h1 id="mainhead">Page Error</h1>
	<p class="error">This page has been accessed in error. Not a valid kind ID.</p><p><br /><br /></p>';
}

mysqli_close($dbc); // Close the database connection.
		
?>
<?php
echo "</fieldset>";
?>

<?php
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
