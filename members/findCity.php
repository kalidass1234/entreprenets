<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.blogspot.com             ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->

<?php 
$stateId=intval($_GET['state']);
$con = mysql_connect('localhost', 'root', ''); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('gloress');

$query="SELECT * FROM sub_sub_categories WHERE sub_category_id='$stateId'";
$result=mysql_query($query);

?>
<select name="city"  onchange="getProduct(this.value)" class="validate[required] form-control placeholder">
<option>Select Sub Sub Categories</option>
<?php while($row=mysql_fetch_array($result)) { ?>
<option value="<?php echo $row['sub_sub_category_id'];?>"><?php echo $row['name']?></option>
<?php } ?>
</select>
