<?php # add_size.php

$page_title = 'Add a Crankset Brand';

include ('mysqli_connect.php');
echo '<fieldset><legend> Add a crankset brand';
echo'</legend>';
// Check if the form has been submitted.
if (isset($_POST['submitted'])) {

	$errors = array(); // Initialize error array.

	// Check for a size

	
	if (empty($_POST['cr_brand_name'])) {
		
		$errors[] = 'You did not enter a crankset.';
	} else {
		$cr_brand_name = $_POST['cr_brand_name'];
		}

	
	
	if (empty($errors)) { // If there are no errors.
		
			// check to see if size is already in the DB
			$size=$_POST['cr_brand_name'];
			$query = "select distinct cr_brand_name from cr_brand where cr_brand_name='$cr_brand_name'";
			$result = @mysqli_query($dbc, $query); 
			$row=mysqli_fetch_array($result, MYSQL_ASSOC); 
			if ($row['cr_brand_name']==$cr_brand_name) {
				echo 'Error: Someone else beat you to it.'; 
						exit ();
			}
			// Not already in DB, proceed!
			 else {
			
			$query = "INSERT IGNORE INTO cr_brand (cr_Brand_name) VALUES ('$cr_brand_name')";		
			$result = @mysqli_query ($dbc, $query); // Run the query.
				}
				
				if ($result) { // If it ran OK.
		
			// Print a message.
			echo '<h1 id="mainhead">Success!</h1>
		<p>You have added to the crankset brand table:</p>';

		   echo "<table>
		<tr><td>New Size:</td><td>{$cr_brand_name}</td></tr>";
		
			exit();
			
		} else { // If it did not run OK.
			echo '<h1 id="mainhead">System Error</h1>
			<p class="error">The size could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message.
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


	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<form action="add_crankset.php" method="post">
<p>Name of brand: <input type="text" name="cr_brand_name" size="15" maxlength="15" value="<?php if (isset($_POST['cr_brand_name'])) echo $_POST['cr_brand_name']; ?>" /></p>
	<p><input type="submit" name="submit" value="Add Size" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
echo '</fieldset>';
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
