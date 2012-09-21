<?php # add_size.php

$page_title = 'Add a Size';

include ('mysqli_connect.php');
echo '<fieldset><legend> Add a Size';
echo'</legend>';
// Check if the form has been submitted.
if (isset($_POST['submitted'])) {

	$errors = array(); // Initialize error array.

	// Check for a size

	
	if (empty($_POST['size'])) {
		
		$errors[] = 'You did not enter a size.';
		} elseif (is_numeric($_POST['size'])) {
		$size = $_POST['size'];
							// check to make sure it is a number not a string
		} else {
		$errors[] = 'Needs to be a number';
		}

	
	
	if (empty($errors)) { // If there are no errors.
		
			// check to see if size is already in the DB
			$size=$_POST['size'];
			$query = "select distinct size from size where size=$size;";
			$result = @mysqli_query($dbc, $query); 
			$row=mysqli_fetch_array($result, MYSQL_ASSOC); 
			if ($row['size']==$size) {
				echo 'Error: This size is already in the DB!'; 
						exit ();
			}
			 else {
			
			$query = "INSERT IGNORE INTO size (size) VALUES ('$size')";		
			$result = @mysqli_query ($dbc, $query); // Run the query.
				}
				
				if ($result) { // If it ran OK.
		
			// Print a message.
			echo '<h1 id="mainhead">Success!</h1>
		<p>You have added to the sizes table:</p>';

		   echo "<table>
		<tr><td>New Size:</td><td>{$size}</td></tr>";
		
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
<form action="add_size.php" method="post">
<p>Size in centimeters: <input type="text" name="size" size="15" maxlength="15" value="<?php if (isset($_POST['size'])) echo $_POST['size']; ?>" /></p>
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
