<?php # view_crankset.php

$page_title = 'View Crankset';
echo '<fieldset>';
// Page header.
echo '<h1 style="text-align:center"id="mainhead">Kinds of Bicycles Currently in the Database:</h1>';
echo '<p>&nbsp;</p>';

include ('mysqli_connect.php');

// Number of records to show per page:
$display = 5;

// Determine how many pages there are. 
if (isset($_GET['np'])) { // Already been determined.
	$num_pages = $_GET['np'];
} else { // Need to determine.

 	// Count the number of records
	$query = "select count(*) from cr_brand";
	$result = @mysqli_query ($dbc, $query);
	$row = mysqli_fetch_array ($result, MYSQL_NUM);
	$num_records = $row[0];
	
	// Calculate the number of pages.
	if ($num_records > $display) { // More than 1 page.
		$num_pages = ceil ($num_records/$display);
	} else {
		$num_pages = 1;
	}

} // End of np IF.


// Determine where in the database to start returning results.
if (isset($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Default column links.
$link1 = "{$_SERVER['PHP_SELF']}?sort=b_a";
$link2 = "{$_SERVER['PHP_SELF']}?sort=o_d";

// Determine the sorting order.
if (isset($_GET['sort'])) {

	// Use existing sorting order.
	switch ($_GET['sort']) {
		case 'b_a':
			$order_by = 'cr_brand_name ASC';
			$link1 = "{$_SERVER['PHP_SELF']}?sort=b_d";
			break;
		case 'b_d':
			$order_by = 'cr_brand_name DESC';
			$link1 = "{$_SERVER['PHP_SELF']}?sort=b_a";
			break;
	}
	
	// $sort will be appended to the pagination links.
	$sort = $_GET['sort'];
	
} else { // Use the default sorting order.
	$order_by = 'cr_brand_name ASC';
	$sort = 'b_a';
}

// Make the query.
$query = "select cr_brand_id, cr_brand_name from cr_brand order by $order_by limit $start, $display";
$result = @mysqli_query ($dbc, $query); // Run the query.

// Format group_by 

if ($order_by=='cr_brand_name ASC') {
	$formatted_order="brand name, ascending.";
} elseif ($order_by=='cr_brand_name DESC') {
	$formatted_order="brand name, descending.";
} 

// table header

echo '<p style="text-align:center">This list is currently ordered by '.$formatted_order.'</p>';
echo '<table align="center" cellspacing="0" cellpadding="5">
<tr>
	<td align="left"><b>Add</b></td>
	<td align="left"><b>Edit</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b><a href="' . $link1 . '">Crankset Brand </a></b></td>
</tr>';


// Fetch and print all the records.
$bg = '#eeeeee'; // Set the background color.
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee'); // Switch the background color.
	echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="add_crankset.php?id='. $row['cr_brand_id'] . '">Add</a></td>
		<td align="left"><a href="edit_crankset.php?id=' . $row['cr_brand_id'] . '">Edit</a></td>
		<td align="left"><a href="del_crankset.php?id=' . $row['cr_brand_id'] . '">Delete</a></td>
		<td align="left">' . $row['cr_brand_name'] . '</td>
		<td align="left"><a href="view_crankset_names.php?id=' . $row['cr_brand_id'] . '">View Examples</a></td>
	</tr>
	';
}

echo '</table>';

mysqli_free_result ($result); // Free up the resources.	

mysqli_close($dbc); // Close the database connection.

// Make the links to other pages, if necessary.
if ($num_pages > 1) {
	
	echo '<br /><p>';
	// Determine what page the script is on.	
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a First button and a Previous button.
	if ($current_page != 1) {
		echo '<a href="view_crankset.php?s=0&np=' . $num_pages . '&sort=' . $sort .'">First</a> ';
		echo '<a href="view_crankset.php?s=' . ($start - $display) . '&np=' . $num_pages . '&sort=' . $sort .'">Previous</a> ';
	}
	
	// Make all the numbered pages.
	for ($i = 1; $i <= $num_pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_crankset.php?s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&sort=' . $sort .'">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	}
	
	// If it's not the last page, make a Last button and a Next button.
	if ($current_page != $num_pages) {
		echo '<a href="view_crankset.php?s=' . ($start + $display) . '&np=' . $num_pages . '&sort=' . $sort .'">Next</a> ';
		echo '<a href="view_crankset.php?s=' . (($num_pages-1) * $display) . '&np=' . $num_pages . '&sort=' . $sort .'">Last</a>';

	}
	
	echo '</p>';
	
} // End of links section.

?>

<?php
echo'</fieldset>';
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