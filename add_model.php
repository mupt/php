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

	// Check for a Model NAME
	if (empty($_POST['model_name'])) {
		$errors[] = 'You forgot to enter the model name.';
	} else {
		$model_name = $_POST['model_name'];
	}
	// Check for a COLOR name.
	if (empty($_POST['color'])) {
		$errors[] = 'You forgot to enter the movie.';
	} else {
		$color = $_POST['color'];
	}

	// Check for a brand ID
	if (empty($_POST['brand_id'])) {
		$errors[] = 'You forgot to enter the brand.';
	} else {
		$brand_id = $_POST['brand_id'];
	
		// Build the query
		$query = "SELECT * FROM brand WHERE brand_id=$brand_id";
		$result = @mysqli_query ($dbc, $query);
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
			{
			$brand_name=$row['brand_name'];
			}
		}
	
	// Check for a kind id
	if (empty($_POST['kind_id'])) {
		$errors[] = 'You forgot to enter the kind.';
	} else {
		$kind_id = $_POST['kind_id'];
	
		// Build the query
		$query = "SELECT * FROM kind WHERE kind_id=$kind_id";
		$result = @mysqli_query ($dbc, $query);
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
			{
			$kind_name=$row['kind_name'];
			}
		}
		
	// Check for a crankset name ID
	if (empty($_POST['crankset_id'])) {
		$errors[] = 'You forgot to enter the crankset name.';
	} else {
		$crankset_id = $_POST['crankset_id'];
	
		// Build the query
		$query = "SELECT * FROM crankset WHERE crankset_id=$crankset_id";
		$result = @mysqli_query ($dbc, $query);
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
			{
			$crankset_name=$row['crankset_name'];
			}
		}
		
		// Check for a size
	if (empty($_POST['size_id'])) {
		$errors[] = 'You forgot to enter the size .';
	} else {
		$size_id = $_POST['size_id'];
	
		// Build the query
		$query = "SELECT * FROM size WHERE size_id=$size_id";
		$result = @mysqli_query ($dbc, $query);
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
			{
			$size=$row['size'];
			}
		}
		
	
	if (empty($errors)) { // If everything's okay.
	
		// Add the movie to the database.
		
		// Make the query.
		$query = "INSERT INTO model (model_name, color, brand_id, kind_id, crankset_id, size_id) VALUES ('$model_name', '$color', $brand_id, $kind_id, $crankset_id, $size_id)";
		$result = @mysqli_query ($dbc, $query); // Run the query.
		if ($result) { // If it ran OK.
		
			// Print a message.
			echo '<h1 id="mainhead">Success!</h1>
		<p>You have added the following role:</p>';

		   echo "<table>
		<tr><td>MOdel</td><td>{$model_name}</td></tr>
		<tr><td>BRand:</td><td>{$brand_name}</td></tr>
		<tr><td>Color:</td><td>{$color}</td></tr>
		<tr><td>kind:</td><td>{$kind_name}</td></tr>
		<tr><td>Crankset:</td><td>{$crankset_name}</td></tr>
		<tr><td>kind:</td><td>{$size}</td></tr>";	
		
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
<?php if (isset($_POST['brand_id'])) $this_brand_id=$_POST['brand_id'];
	 if (isset($_POST['kind_id'])) $this_kind_id=$_POST['kind_id'];
	 if (isset($_POST['crankset_id'])) $this_crankset_id=$POST['crankset_id'];
	  if (isset($_POST['size_id'])) $this_size_id=$POST['size_id'];
?>
<div>
<h2></h2>
<form action="add_model.php" method="post">
<p>Model Name: <input type="text" name="model_name" size="35" maxlength="35" value="<?php if (isset($_POST['model_name'])) echo $_POST['model_name']; ?>" /></p>
	<p>Color: <input type="text" name="color" size="35" maxlength="35" value="<?php if (isset($_POST['color'])) echo $_POST['color']; ?>" /></p>
	<p>Brand: <select name="brand_id">
<?php 
// Build the query
$query = "SELECT * FROM brand ORDER BY brand_name ASC";
$result = @mysqli_query ($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{

	if ($row['brand_id'] == $this_brand_id) {
		echo '<option value="'.$row['brand_id'].'" selected="selected">'.$row['brand_name'].'</option>';
	} else {
	echo'<option value="'.$row['brand_id'].'">'.$row['brand_name'].'</option>';}
	}
?>
</select>&nbsp;&nbsp;&nbsp;<a href="add_brand.php">Add a new brand</a>
</p>
<p>Kind: <select name="kind_id">
<?php 
// Build the query
$query = "SELECT * FROM kind ORDER BY kind_name ASC";
$result = @mysqli_query ($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{

		if ($row['kind_id'] == $this_kind_id) {
		echo '<option value="'.$row['kind_id'].'" selected="selected">'.$row['kind_name'].'</option>';
		} else {
			echo'<option value="'.$row['kind_id'].'">'.$row['kind_name'].'</option>';}

}

?>
</select>&nbsp;&nbsp;&nbsp;<a href="add_kind.php">Add a new kind.</a>
<p>Crankset Name: <select name="crankset_id">
<?php 
// Build the query
$query = "SELECT * FROM crankset ORDER BY crankset_name ASC";
$result = @mysqli_query ($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{

		if ($row['crankset_name'] == $this_crankset_id) {
		echo '<option value="'.$row['crankset_id'].'" selected="selected">'.$row['crankset_name'].'</option>';
		} else {
			echo'<option value="'.$row['crankset_id'].'">'.$row['crankset_name'].'</option>';}

}

?>
</select>&nbsp;&nbsp;&nbsp;<a href="add_crankset.php">Add a new crankset.</a>
<p>Size <select name="size_id">
<?php 
// Build the query
$query = "SELECT * FROM size ORDER BY size ASC";
$result = @mysqli_query ($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{

		if ($row['size'] == $this_size_id) {
		echo '<option value="'.$row['size_id'].'" selected="selected">'.$row['size'].'</option>';
		} else {
			echo'<option value="'.$row['size_id'].'">'.$row['size'].'</option>';}

}

?>
</select>&nbsp;&nbsp;&nbsp;<a href="add_size.php">Add a size.</a>
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
