<?php
ob_start();
session_start();
include("includes/dbconfig.php");
extract($_REQUEST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DeeptiPublication Order History</title>
</head>

<body>
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="750" align="left" valign="middle" class="title_txt" background="images/long_bar1.jpg" height="26">&nbsp;&nbsp;Order History </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td height="5" class="orange_txt" style="font-size:13px; font-weight:normal" align="center"> Your Order Number : <strong>
      <?php echo $id; ?>
    </strong></td>
  </tr>
  
   		<?php
		
		$q_orders=mysql_query("select * from nile_orders where auto_id='$id'");
        $orders=mysql_fetch_array($q_orders);
		
		$q_ship=mysql_query("select * from nile_shipaddress where order_id='$id'");
        $ship=mysql_fetch_array($q_ship);
		$address=explode("|",$ship['address']);
		
		
		$qry_user=mysql_query("select * from nile_user where username='$orders[user_id]'");
		$user_info=mysql_fetch_array($qry_user);
		
	  ?>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="table_txt" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  align="center"><table cellspacing="1" cellpadding="1" border="0" width="100%" class="acborder">
      <tr align="center" valign="middle" class="accttr">
        <td width="20%" height="15" align="left" bgcolor="#83AC4C"><font class="protab_txt">User Info :</font></td>
      </tr>
    </table></td>
  </tr>
  <tr> </tr>
  <tr>
    <td align="left" class="cart-txt">
     Email : <?php echo $orders[user_id] ?> <br />
	   User Name  : <?php echo $user_info[fname]." ".$user_info[fname] ?> <br />
	     Phone : <?php echo $user_info[phone] ?> <br />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  align="center"><table cellspacing="1" cellpadding="1" border="0" width="100%" class="acborder">
      <tr align="center" valign="middle" class="accttr">
        <td width="20%" height="15" align="left" bgcolor="#83AC4C"><font class="protab_txt">Ship To :</font></td>
      </tr>
    </table></td>
  </tr>
  <tr> </tr>
  <tr>
    <td align="left" class="cart-txt"><font class="cart-txt ">
      <?php  foreach($address as $value) { 
	  echo $value."<br>";
	  }
	  ?>	  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  
  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php   $details = explode(",", $orders["order_details"]); ?>
  <tr>
    <td  align="center"><table cellspacing="1" cellpadding="1" border="0" width="99%" class="acborder">
      <tr align="center" valign="middle" bgcolor="#83AC4C" class="protab_txt">
        <td width="20%" height="25"><font class="accttrtext">Product Name</font></td>
        <td width="15%" height="25"><font class="accttrtext">Image</font></td>
        <td width="24%" height="25"><font class="accttrtext">SubCategory</font></td>
        <td width="15%" height="25"><font class="accttrtext">Category</font></td>
        <td width="9%" height="25"><font class="accttrtext">Ship Qty</font></td>
        <td width="10%">Unit Price</td>
        <td width="7%" height="25"><font class="accttrtext">Total</font></td>
        <!--<td width="17%" height="25"><font class="accttrtext">Tracking No</font></td>-->
      </tr>
      <?php 
	  foreach($details as $p_det) { 
	   
          $pro=explode("|",$p_det);	   
	   
	  $q_det=mysql_query("select * from nile_items where item_id='$pro[0]'");
	  $det=mysql_fetch_array($q_det);
	  
				
	?>
      <tr>
        <td class="accttrd" align="center"><?php echo $det['item_name'] ?>         </td>
        <td class="accttrd" align="center"><img src="images/thumbnail/<?php echo $det['item_address'] ?>" /></td>
        <td  class="accttrd" align="center"><?php $q_subcat=mysql_query("select * from  nile_sub_category where sub_cat_id=$det[sub_cat_id]");
		$subcat=mysql_fetch_array($q_subcat);
		echo $subcat[sub_cat_name];
		
		?>          </td>
        <td  class="accttrd" align="center">
		<?php $q_cat=mysql_query("select * from  nile_category where cat_id=$det[cat_id]");
		$cat=mysql_fetch_array($q_cat);
		echo $cat[cat_name];
		?>		</td>
        <td  class="accttrd" align="center"><?php echo $pro[1] ?></td>
        <td   class="accttrd" align="center"><?php echo $det['new_price'] ?></td>
        <td   class="accttrd" align="center"><?php echo $price[]=$pro[1]*$det['new_price'] ?></td>
      </tr>
      <?php } 
	  ?>
    </table></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><table width="100%">
      <tr align="center" bgcolor="#F3F1D1" class="table_txt" >
        <td height="21" colspan="6" align="right" bgcolor="#FFFFFF" >Sub Total&nbsp;&nbsp;&nbsp;</td>
        <td width="7%" height="21" align="left" valign="middle" bgcolor="#FFFFFF">
         <?php 
		 foreach($price as $pri)
		 	$act_price=$act_price+$pri;
		 
		 echo $act_price;
		 
		 ?>
          &nbsp;</td>
      </tr>
      <tr  bgcolor="#FFFFFF" align="center" class="table_txt" >
        <td height="21" colspan="6" align="right" >Shipping charge&nbsp;&nbsp;&nbsp;</td>
        <td width="7%" height="21" align="left" valign="middle">
         <?php		 
		 echo $shipping_price=$orders['order_total']-$act_price;
		 ?>
          &nbsp;</td>
      </tr>
      
      <tr  bgcolor="#F3F1D1" align="center" class="table_txt" >
        <td height="21" colspan="6" align="right" valign="top" bgcolor="#FFFFFF" >Total&nbsp;&nbsp;&nbsp;</td>
        <td width="7%" height="21" align="left" valign="top" bgcolor="#FFFFFF">
          <?php
		   echo $orders['order_total'];
		   ?>
		  
          &nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
