<?php 
ob_start();
session_start();
include("includes/dbconfig.php");
$sid = session_id();
?>

<HTML>
<HEAD>
<TITLE>Sub-merchant checkout page</TITLE>
</HEAD>

<?php
require("libfuncs.php3");
session_unregister(redirect);
if(isset($_POST["ordertotal"]))
{	
	$_SESSION["ShipingInfo"] = array();
	$_SESSION["ShipingInfo"]["name"]    = $_POST["fname"]."&nbsp;".$_POST["lname"];
	$_SESSION["ShipingInfo"]["address"] = $_POST["address1"];
	$_SESSION["ShipingInfo"]["city"]    = $_POST["city"];
	$_SESSION["ShipingInfo"]["zipcode"] = $_POST["zipcode"];
	$_SESSION["ShipingInfo"]["state"]   = $_POST["state"];
	$_SESSION["ShipingInfo"]["country"] = $_POST["country"];
	$_SESSION["ShipingInfo"]["phone"] = $_POST["phone"];
	$_SESSION["basket"] = array();
	$_SESSION["basket"]["ordertotal"] = $_POST["ordertotal"];
	$_SESSION["basket"]["quantity"]   = $_POST["quantity"];
	$_SESSION["basket"]["shipping"]   = $_POST["shipping"];
	$total=$_POST["ordertotal"]+$_POST["shipping"];
	

	$Merchant_Id = "M_deeptipu_13439" ;//This id(also User Id)  available at "Generate Working Key" of "Settings & Options" 
	$Amount = $total ;//your script should substitute the amount in the quotes provided here
	$Order_Id = $sid ;//your script should substitute the order description in the quotes provided here
	$Redirect_Url = "http://www.deeptipublications.com/success.php?sid= $sid" ;//your redirect URL where your customer will be redirected after authorisation from CCAvenue

	$WorkingKey = "xjjlqi6hlgfxvb4r7j"  ;//put in the 32 bit alphanumeric key in the quotes provided here.Please note that get this key ,login to your CCAvenue merchant account and visit the "Generate Working Key" section at the "Settings & Options" page. 
	$Checksum = getCheckSum($Merchant_Id,$Amount,$Order_Id ,$Redirect_Url,"xjjlqi6hlgfxvb4r7j");

	$billing_cust_name= $_POST["fname"];
	$billing_cust_address= $_POST["address1"];
	$billing_cust_country= $_POST["country"];
	$billing_cust_tel="";
	$billing_cust_email= $_SESSION['uname'];
	$delivery_cust_name= $_POST["fname"];
	$delivery_cust_address= $_POST["address1"];
	$delivery_cust_tel="";
	$delivery_cust_notes="";
	$Merchant_Param="" ;

// Start the entering the sales record before paying
$order_details = "";
foreach($_SESSION['add'] as $key=>$val){		 
 $order_details.= $_SESSION['add'][$key]['id']."|".$_SESSION['add'][$key]['qty'].",";
}
$order_details = substr($order_details,0,-1);
$order_total = $_SESSION["basket"]["ordertotal"];
mysql_query("INSERT INTO nile_orders (user_id, ran, order_details, order_date, order_total, order_status) VALUES ('$_SESSION[uname]', '$_SESSION[ran]', '$order_details', now(), '$Amount', '0');") or die(mysql_error());
$order_id=mysql_insert_id();


//paying End

/////////////////Shipping Address////////////////////
$address = $_SESSION["ShipingInfo"]["name"]."|".$_SESSION["ShipingInfo"]["address"]."|".$_SESSION["ShipingInfo"]["city"]."|".$_SESSION["ShipingInfo"]["state"]."|".$_SESSION["ShipingInfo"]["country"]."|".$_SESSION["ShipingInfo"]["zipcode"]."|".$_SESSION["ShipingInfo"]["phone"];


	mysql_query("INSERT INTO nile_shipaddress (order_id, address, date) VALUES ('$order_id', '$address', now())") 
	or die(mysql_error());


//Shipping End
?>
	<form  name="frmpay"  method="post" action="https://www.ccavenue.com/shopzone/cc_details.jsp" >
	<input type=hidden name=Merchant_Id value="<?php echo $Merchant_Id; ?>">
	<input type=hidden name=Amount value="<?php echo $Amount; ?>">
	<input type=hidden name=Order_Id value="<?php echo $Order_Id; ?>">
	<input type=hidden name=Redirect_Url value="<?php echo $Redirect_Url; ?>">
	<input type=hidden name=Checksum value="<?php echo $Checksum; ?>">
	<input type="hidden" name="billing_cust_name" value="<?php echo $billing_cust_name; ?>"> 
	<input type="hidden" name="billing_cust_address" value="<?php echo $billing_cust_address; ?>"> 
	<input type="hidden" name="billing_cust_country" value="<?php echo $billing_cust_country; ?>"> 
	<input type="hidden" name="billing_cust_tel" value="<?php echo $billing_cust_tel; ?>"> 
	<input type="hidden" name="billing_cust_email" value="<?php echo $billing_cust_email; ?>"> 
	<input type="hidden" name="delivery_cust_name" value="<?php echo $delivery_cust_name; ?>"> 
	<input type="hidden" name="delivery_cust_address" value="<?php echo $delivery_cust_address; ?>"> 
	<input type="hidden" name="delivery_cust_tel" value="<?php echo $delivery_cust_tel; ?>"> 
	<input type="hidden" name="delivery_cust_notes" value="<?php echo $delivery_cust_notes; ?>"> 
	<input type="hidden" name="Merchant_Param" value="<?php echo $Merchant_Param; ?>"> 
	</form>
	
 <?php }?>
	<BODY>
	<script language="javascript">
	document.frmpay.submit();
</script>
</BODY>
</HTML>