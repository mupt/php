<?php #add_brand.php
echo "<fieldset><legend>Add a brand</legend>";
$page_title = ' Add a Brand ';

include('mysqli_connect.php');


//Check to see if the form has been submitted.

if (isset($_POST['submitted'])) {

	$errors = array(); // array initalized to hold my errors
	
	//check for a brand
	
	if (empty($_POST['brand_name'])) {
	
		$errors[] = ' You did not enter a brand name ';
		
	}
	
	elseif (is_numeric($_POST['brand_name'])) {
	
		$errors[] = ' Needs to be words! '; // validate form data
		
		} else {
			
		$brand_name = $_POST['brand_name']; // assign variable value
		}
		
	// check for origin
	
	if (empty($_POST['brand_origin'])) {
		$errors[]=' You did not enter a country of origin.';
	} elseif (is_numeric($_POST['brand_origin'])) {
		$errors[] = ' Needs to be words! ';
	} else {
		$origin=$_POST['brand_origin']; // assign variable value
	}
		if (empty($errors)) {
			
			// make the query and add the brand to the database
			
			$query = "insert into brand (brand_name, brand_origin) values ('$brand_name', '$origin')";
			$result = @mysqli_query ($dbc, $query);
			if($result) {
				
				echo ' <h1 id="mainhead">Success!</h1>
				<p> You have added to the Brand table:</p>';
				echo "<table><tr><td>New Brand:</td><td>{$brand_name}</td></tr>
				<tr><td>New Brand Origin:</td><td>{$origin}</td></tr>";
				
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

<form action="add_brand.php" method="post">
<p>New Brand to add: <input type="text" name="brand_name" size="15" maxlength="15" value="<?php if (isset($_POST['brand_name'])) echo $_POST['brand_name']; ?>" /></p>
<p>Origin of this brand: <input type="text" name="brand_origin" size="15" maxlength="15" value="<?php if (isset($_POST['brand_origin'])) echo $_POST['brand_origin']; ?>" /></p>	
<p><input type="submit" name="submit" value="Add Brand and Origin" /></p>
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
			
			
