<?php #add_brand.php
echo "<fieldset><legend>Add a kind of bicycle</legend>";
$page_title = ' Add a Kind of Bicycle ';

include('mysqli_connect.php');


//Check to see if the form has been submitted.

if (isset($_POST['submitted'])) {

	$errors = array(); // array initalized to hold my errors
	
	//check for a kind_name
	
	if (empty($_POST['kind_name'])) {
	
		$errors[] = ' You did not enter a kind of bicycle. ';
		
	} else {
			
		$kind_name = $_POST['kind_name']; // assign variable value
		}
		
	// check for kind_descrption
	
	if (empty($_POST['kind_description'])) {
		$errors[]=' You did not enter a description for this kind of bicycle.';
	} elseif (is_numeric($_POST['kind_description'])) {
		$errors[] = ' Needs to be words! ';
	} else {
		$kind_description=$_POST['kind_description']; // assign variable value
	}
		if (empty($errors)) {
			
			// make the query and add the brand to the database
			
			$query = "insert into kind (kind_name, kind_description) values ('$kind_name', '$kind_description')";
			$result = @mysqli_query ($dbc, $query);
			if($result) {
				
				echo ' <h1 id="mainhead">Success!</h1>
				<p> You have added to the kinds table:</p>';
				echo "<table><tr><td>New kind:</td><td>{$kind_name}</td></tr>
				<tr><td>New kind description:</td><td>{$kind_description}</td></tr>";
				
				exit ();
				
			} else {
				echo '<h1 id="mainhead"> System Error </h1>
				<p class="error"> Data could not be added due to a system error.</p>';
				echo'<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';
				exit ();
			}
			
		} else { // Report Errors
			
			echo '<h1 id="mainhead">Error!</h1>
			<p class="error"> The following error(s) occurred:<br />';
			foreach ($errors as $msg) { // print each message
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p><p><br /></p>';
			
		}
		
		mysqli_close($dbc); // close it up
		
}

// end of main statement
?>

<form action="add_kind.php" method="post">
<p>New kind to add: <input type="text" name="kind_name" size="15" maxlength="15" value="<?php if (isset($_POST['kind_name'])) echo $_POST['kind_name']; ?>" /></p>
<p>Description of this kind: <input type="text" name="kind_description" size="45" maxlength="15" value="<?php if (isset($_POST['kind_description'])) echo $_POST['kind_description']; ?>" /></p>	
<p><input type="submit" name="submit" value="Add Kind and Description" /></p>
<input type="hidden" name="submitted" value="TRUE" />
</form



<?php
echo "</fieldset>";
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
	
