<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.blogspot.com             ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $country=intval($_GET['country']);
$con = mysql_connect('localhost', 'root', ''); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('gloress');

$query="SELECT * FROM sub_categories WHERE category_id='$country'";
$result=mysql_query($query);

?>
<select name="state" onchange="getCity(<?php echo $country?>,this.value)" class="validate[required] form-control placeholder">
<option>Select Sub Categories</option>
<?php while ($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['sub_category_id']?> ><?php echo $row['name']?></option>
<?php } ?>
</select>
