<style type="text/css">
div { margin:0 auto; width: 400px }
</style>
<fieldset><legend>Add a model</legend>
<?php # add_role.php


$page_title = 'Add Model';

include ('mysqli_connect.php');

// Check if the form has been submitted.


if (isset($_POST['submitted'])) {

	$errors = array(); // Initialize error array.

	
	// Check for a crankset name ID
	if (empty($_POST['crankset_name'])) {
		$errors[] = 'You forgot to enter the crankset name.';
	} else {
		$crankset_name = $_POST['crankset_name'];
	}

	// Check for a size
	if (empty($_POST['cr_brand_id'])) {
		$errors[] = 'You forgot to enter the size .';
	} else {
		$cr_brand_id = $_POST['cr_brand_id'];
	
		// Build the query
		$query = "SELECT * FROM cr_brand WHERE cr_brand_id=$cr_brand_id";
		$result = @mysqli_query ($dbc, $query);
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
			{
			$cr_brand_name=$row['cr_brand_name'];
			}
		}

		

	
	if (empty($errors)) { // If everything's okay.
	
		// Add the movie to the database.
		
		// Make the query.

		
		$query= "insert into crankset (cr_brand_id, crankset_name) values ('$cr_brand_id', '$crankset_name')";
		$result = @mysqli_query ($dbc, $query); // Run the query.
		if ($result) { // If it ran OK.
		
			// Print a message.
			echo '<h1 id="mainhead">Success!</h1>
		<p>You have added the following role:</p>';

		   echo "<table>
		<tr><td>Crankset:</td><td>{$crankset_name}</td></tr>
		<tr><td>Crankset Brand</td><td>{$cr_brand_name}</td></tr>";	
		
			exit();
			
		} else { // If it did not run OK.
			echo '<h1 id="mainhead">System Error</h1>
			<p class="error">The role could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
			exit();
		}
		
	} else { // Report the errors.
	
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p><a href="'.$_SERVER['PHP_SELF'].'">Try Again</a></p><p><br /></p>';
		exit();
		
	} // End of if (empty($errors)) IF.


	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<?php 
	 if (isset($_POST['crankset_id'])) $this_crankset_id=$POST['crankset_id'];
	  if (isset($_POST['cr_brand_id'])) $this_cr_brand_id=$POST['cr_brand_id'];
?>
<div>
<h2></h2>
<form action="add_crankset_name.php" method="post">
<p>Crankset Name: <input type="text" name="crankset_name" size="35" maxlength="35" value="<?php if (isset($_POST['crankset_name'])) echo $_POST['crankset_name']; ?>" /></p>
	


</select>
<p>Crankset Brand <select name="cr_brand_id">
<?php 
// Build the query
$query = "SELECT * FROM cr_brand ORDER BY cr_brand_name ASC";
$result = @mysqli_query ($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{

		if ($row['cr_brand_name'] == $this_cr_brand_id) {
		echo '<option value="'.$row['cr_brand_id'].'" selected="selected">'.$row['cr_brand_name'].'</option>';
		} else {
			echo'<option value="'.$row['cr_brand_id'].'">'.$row['cr_brand_name'].'</option>';}

}

?>
</select>
</p>

	<p><input type="submit" name="submit" value="Add Model" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
</div>
</fieldset>

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