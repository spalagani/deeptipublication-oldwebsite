<?php 
ob_start();
session_start();
include("includes/dbconfig.php");
$sql = mysql_query("SELECT * FROM `nile_items` where item_id='19' LIMIT 0 , 4");
while($row = mysql_fetch_array($sql)){
echo $row['item_id'];
echo "</br>";
echo $row['item_address'];
}
?>