<?php # Script 8.4 - edit_model.php

// This page edits a movie.
// This page is accessed through view_movies.php.

$page_title = 'Edit a Model';

// Check for a valid movie ID, through GET or POST.
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // Accessed through view_moives.php
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
	
	// Check for a model name.
	if (empty($_POST['model_name'])) {
		$errors[] = 'You forgot to enter the name of the model.';
	} else {
		$model_name = $_POST['model_name'];
	}
	// Check for a color
	if (empty($_POST['color'])) {
		$errors[] = ' You forgot to enter a color.';
	} else {
		$color=$_POST['color'];
	}
	
	// Check for a brand id.
	if (empty($_POST['brand_id'])) {
		$errors[] = 'You forgot to enter the brand.';
	} else {
		$brand_id = $_POST['brand_id'];
	}
	
	// Check for a kind ID.
	if (empty($_POST['kind_id'])) {
		$errors[] = 'You forgot to enter the kind.';
	} else {
		$kind_id = $_POST['kind_id'];
	}
	
	// check for cr_brand id
	if (empty($_POST['cr_brand_id'])) {
		$errors[] = 'You forgot to enter the brand of crankset.';
	} else {
		$cr_brand_id = $_POST['cr_brand_id'];
	}
	
	// Check for a crankset id
	if (empty($_POST['crankset_id'])) {
		$errors[] = 'You forgot to enter the crankset name.';
	} else {
		$crankset_id = $_POST['crankset_id'];
	}
	
	if (empty($errors)) { // If everything's OK.
	
	
			// Make the query.
			$query = "update model, crankset set model_name='$model_name', color='$color', brand_id=$brand_id, kind_id=$kind_id, crankset.cr_brand_id=$cr_brand_id, model.crankset_id=$crankset_id where model_id=$id and crankset.crankset_id=$crankset_id";
			$result = @mysqli_query ($dbc, $query); // Run the query.
			if ((mysqli_affected_rows($dbc) == 1) || (mysqli_affected_rows($dbc) == 0)) { // If it ran OK.
			
				// Print a message.
				echo '<h1 id="mainhead">Edit a Movie</h1>
				<p>The model record has been edited.</p><p><br /><br /></p>';	
							
			} else { // If it did not run OK.
				echo '<h1 id="mainhead">System Error</h1>
				<p class="error">The model could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
				exit();
			}
				
	} // End of if (empty($errors)) IF.
	
	else { // Report the errors.
	
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		} // End of foreach
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	}  // End of report errors else()

} // End of submit conditional.

// Always show the form.

// Retrieve the movies's information.
$query = "select model_name, color, brand.brand_id, brand_name, kind.kind_id, kind_name, cr_brand.cr_brand_id, cr_brand_name, crankset.crankset_id, crankset_name from model, brand, kind, crankset, cr_brand where model.brand_id=brand.brand_id and model.kind_id=kind.kind_id and crankset.cr_brand_id=cr_brand.cr_brand_id and model.crankset_id=crankset.crankset_id and model_id = $id ";		
$result = @mysqli_query ($dbc, $query); // Run the query.

if (mysqli_num_rows($result) == 1) { // Valid movie ID, show the form.

	// Get the movie's information.
	$row = mysqli_fetch_array ($result, MYSQL_NUM);
	$this_brand_id=$row[2];
	$this_kind_id=$row[4];
	$this_cr_brand_id=$row[6];
	$this_crankset_id=$row[8];
	// Create the form.


echo '<h2>Edit a Model</h2>

<form action="edit_model.php" method="post">

<p>Model Name: <input type="text" name="model_name" size="15" maxlength="25" value="' . $row[0] . '" /></p>';
echo '<p>Brand: <select name="brand_id">';
// Build the query for director drop-down
$query = "SELECT brand_id, brand_name FROM brand";
$result = @mysqli_query ($dbc, $query);

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
	if ($row['brand_id'] == $this_brand_id) 
	{
		echo '<option value="'.$row['brand_id'].'" selected="selected">' . $row['brand_name'] . '</option>';
	}
	else 
	{
		echo '<option value="'.$row['brand_id'].'">'. $row['brand_name'] . '</option>';
	}   
}
echo '</select> </p>';

echo '<p>Kind: <select name="kind_id">';
// Build the query for genre drop-down
$query = "select kind_id, kind_name from kind";
$result = @mysqli_query ($dbc, $query);

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
	if ($row['kind_id'] == $this_kind_id) 
	{
		echo '<option value="'.$row['kind_id'].'" 	selected="selected">'.$row['kind_name'].'</option>';
	}
	else 
	{
		echo '<option 	value="'.$row['kind_id'].'">'.$row['kind_name'].'</option>';
	}
}
echo '</select> </p>';

echo '<p>Crankset Brand: <select name="cr_brand_id">';
// Build the query for crankset brand
$query = "select cr_brand_id, cr_brand_name from cr_brand";
$result = @mysqli_query ($dbc, $query);

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
	if ($row['cr_brand_id'] == $this_cr_brand_id) 
	{
		echo '<option value="'.$row['cr_brand_id'].'" 	selected="selected">'.$row['cr_brand_name'].'</option>';
	}
	else 
	{
		echo '<option 	value="'.$row['cr_brand_id'].'">'.$row['cr_brand_name'].'</option>';
	}
}
echo '</select> </p>';

echo '<p>Crankset Name: <select name="crankset_id">';
// Build the query for crankset name
$query = "select crankset_id, crankset_name from crankset";
$result = @mysqli_query ($dbc, $query);

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
	if ($row['crankset_id'] == $this_crankset_id) 
	{
		echo '<option value="'.$row['crankset_id'].'" 	selected="selected">'.$row['crankset_name'].'</option>';
	}
	else 
	{
		echo '<option 	value="'.$row['crankset_id'].'">'.$row['crankset_name'].'</option>';
	}
}
echo '</select> </p>';


$query = "select model_name, color from model where model_id=$id ";		
$result = @mysqli_query ($dbc, $query); // Run the query.
$row = mysqli_fetch_array ($result, MYSQL_NUM);
echo '
<p>Color: <input type="text" name="color" size="20" maxlength="40" value="' . $row[1] . '"  /> </p>
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="id" value="' . $id . '" />
<p><input type="submit" name="submit" value="Submit" /></p>
</form>

<p><a href="add_role.php?id='.$id.'">Add a new role to this movie</a></p>

';

} else { // Not a valid movie ID.
	echo '<h1 id="mainhead">Page Error</h1>
	<p class="error">This page has been accessed in error. Not a valid movie ID.</p><p><br /><br /></p>';
}

mysqli_close($dbc); // Close the database connection.
		
?>
