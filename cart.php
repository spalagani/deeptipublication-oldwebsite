<?php
ob_start();
session_start();
include("includes/dbconfig.php");
if($_REQUEST['type'])
{
$_SESSION['ptype']=$_REQUEST['type'];
$ptype=$_SESSION['ptype'];
}
else 
{
$ptype=$_SESSION['ptype'];
}
if($_SESSION['ptype']=='')
{
$ptype="us";
}
extract($_REQUEST);
if(!$_SESSION['uname']){
//header("Location:index.php");
}
if($ok == 'delete'){
	$old_cart = array();
	$new_cart = array();
	$old_cart = $_SESSION['add'];	
	foreach($old_cart as $cart_key=>$cart_val )
	{
		if( $old_cart[$cart_key]['id'] != $del_id )
		{
			array_push( $new_cart,$old_cart[$cart_key] );
		}
	}
	$_SESSION['add'] = array();
	$_SESSION['add'] = $new_cart;
	if($_SESSION['uid']<>'') { 
	$del_item=mysql_query("delete from nile_items where item='$it' and user_id=$_SESSION[uid]");
	}
	else {
	$del_item=mysql_query("delete from nile_items where item='$it' and user_id=''");
	}
	header("Location:cart.php");
	exit;
}
if( $ok == 'edit' ){
	foreach($pid as $key_pid=>$val_pid){
		if($quantity[$key_pid] == 0){
			$_SESSION['add'][$key_pid]['qty'] = 1;
		}else{
		////////////checking the avalibal items and updating/////
		   $element=$_SESSION['add'][$key_pid]['id'];
		   $q_value=$quantity[$key_pid];
		   $q_item=mysql_query("select * from nile_items where item_id = '$element'");
		   $no_items=mysql_fetch_array($q_item);	
	        if($no_items['old_price'] >= $q_value)	
			$_SESSION['add'][$key_pid]['qty'] = $quantity[$key_pid];
		}
	}
	unset($_POST);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> DeeptiPublishers : Welcome to DeeptiPublishers.com</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #686868;
}
-->
</style>
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style2 {color: #477CB2}
.style3 {font-size:12px; font-weight:bold; text-decoration:none; text-transform:uppercase; padding:4px; font-family: tahoma, Arial, Helvetica, sans-serif;}
.style4 {font-size: 13px}
-->
</style>
<script language="javascript">
function redirect(ss)
{
	document.form.action=ss;document.form.submit();
}
function update_cart(){
	document.form.action = "cart.php?ok=edit";
	document.form.submit();
}
function del_item(id,it){
	document.location.href = 'cart.php?ok=delete&del_id='+id+'&it='+it;
}
</script>
<script language="javascript" type="text/javascript">
function playaudio(f)
{
	window.open("audio_play.php?id="+f,'Events','toolbar=no,menubar=no,location=no,resizable=no,scrollbars=yes,width=750,height=500,top=600,left=750');

}
function validate_cart(val)
{

for(j=1;j<=val;j++){
ava=document.getElementById("avaliable"+j).value;
/*act=document.getElementById("quantity"+j).value;
alert(ava);
alert(act);
if(ava<act)
alert("Your Shopping is Exceeded the Avaliablity Limit");*/
}

}
</script>
</head>

<body>
<table width="996" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/Top_corner.jpg" width="996" height="10" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
			<!---Header Start Head of the page -->
			<?php include("includes/header.php"); ?>
			<!---Header END  Head of the page --></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="203" valign="top">
				<!-- Left Nav Starts Here-->
				<?php include("includes/left_nav.php"); ?>
				<!-- Left Nav Ends Her--></td>
                <td valign="top"><table width="97%" border="0" align="right" cellpadding="0" cellspacing="2">
                  
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                      <tr>
                        <td><table width="566" border="0" cellpadding="0" cellspacing="0" s>
                          <tr>
                            <td width="10"><img src="images/-Featured_products_left_cor.jpg" width="10" height="34" /></td>
                            <td width="565" background="images/-Featured_products_top_bg.jpg"><span class="add">&nbsp;<span class="side_title_txt">Shopping Cart</span></span></td>
                            <td width="9"><img src="images/-Featured_products_top_righ.jpg" width="9" height="34" /></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="center" background="images/-Featured_products_body_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div>
                              <table width="100%" border="0" cellspacing="2" cellpadding="0">
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                      <td align="center" class="event_txt"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td height="10"></td>
                                        </tr>
                                        <tr>
                                          <td height="20"></td>
                                        </tr>
                                        <tr>
                                          <td align="center" valign="middle" bgcolor="#F7F7F7"><table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td><form action="login.php?ok=check" method="post" name="form" id="form">
                                                    <input type="hidden" name="new_action" />
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td>&nbsp;</td>
                                                      </tr>
                                                      <?php if( count($_SESSION['add'])>0 ){?>
                                                      <tr>
                                                        <td ><table width="96%" border="0" align="center" style="border-style:solid; border-width:1px; border-color:#999999">
                                                            <tr bgcolor="#EE812E">
                                                              <td width="75" height="20" align="center" bgcolor="#477CB2"  class="footer2">Order ID</td>
                                                              <td width="101" align="center" bgcolor="#477CB2" class="footer2"><span class="footer1"><strong>Name</strong></span></td>
                                                              <td width="73" align="center" bgcolor="#477CB2" class="footer2">Avaliable</td>
                                                              <td width="73" align="center" bgcolor="#477CB2" class="footer2"><strong> Price </strong></td>
                                                              <td width="85" align="center" bgcolor="#477CB2" class="footer2"><strong>Quantity</strong></td>
                                                              <td width="99"  align="center" bgcolor="#477CB2" class="footer2"><strong>Total Price</strong></td>
                                                              <td width="52"  align="center" bgcolor="#477CB2" class="footer2"><strong>Delete</strong></td>
                                                            </tr>
                                                            <?php	  	
								 $i = 0;
								 $tot_price = 0;
								 unset($_SESSION['tot_quantity']);
							   $tot_quantity = 0;
								 foreach($_SESSION['add'] as $key=>$val)
								 {		 
								 
									 $i++;
									 $sel_item="select * from nile_items where item_id=".$_SESSION['add'][$key]['id'];
									 $rs_item=mysql_query($sel_item);
									 $res_item=mysql_fetch_assoc($rs_item);
									 $price=$res_item['new_price'];
									 $tot_quantity+=$_SESSION['add'][$key]['qty'];
									
								?>
                                                            <tr>
                                                              <td align="center" valign="middle" bgcolor="#FFFFFF" class="body-txt"><div align="center"><?php echo $i?></div></td>
                                                              <td height="35" align="center" bgcolor="#FFFFFF" class="body-txt"><div align="center"><?php echo $res_item['item_name']?></div></td>
                                                              <td align="center" bgcolor="#FFFFFF" class="body-txt"><div align="center"><?php echo $res_item['old_price']?></div>
                                                                  <input type="hidden" name= "avaliable<?php echo $i?>" value="<?php echo $res_item['old_price']?>" /></td>
                                                              <td height="35" align="center" bgcolor="#FFFFFF" class="body-txt"><div align="center"><?php echo number_format($price,2);?></div></td>
                                                              <td height="35" align="center" bgcolor="#FFFFFF" class="body-txt"><div align="center">
                                                                <input align="middle" name="quantity[]" type="text" id="quantity" value="<?php echo $_SESSION['add'][$key]['qty']?>" size="2" maxlength="3"/>
                                                                </div>
                                                                  <input type="hidden" name="pid[]" value="<?php echo $_SESSION['add'][$key]['id']?>" />
                                                              </td>
                                                              <td height="35" align="center" bgcolor="#FFFFFF" class="body-txt"><div align="center"><?php echo number_format($price * $_SESSION['add'][$key]['qty'],2);?></div></td>
                                                              <td height="35" align="center" bgcolor="#FFFFFF"><strong><a href="javascript:del_item('<?php echo $_SESSION['add'][$key]['id']?>','<?php echo $res_item['item_name']?>')"><img src="images/delete.jpg" alt="Delete Item" width="32" height="32" border="0" /></a></strong></td>
                                                            </tr>
                                                            <?php 
								   $tot_price += $price * $_SESSION['add'][$key]['qty'];
								 }
								 $act_total=$tot_price;
								 $shipping=($tot_price*10)/100;
								 $tot_price += $shipping;
								$_SESSION['tot_quantity']=$tot_quantity;
							    ?>
                                                            <tr>
                                                              <td colspan="5" align="right" class="bold_txt">Actual Cost</td>
                                                              <td height="10" align="center" class="txt11bold"><strong class="bold_txt">
                                                                <div align="center"> <?php echo number_format($act_total,2);?> </div>
                                                              </strong></td>
                                                            </tr>
                                                            <tr>
                                                              <td colspan="5" align="right" class="bold_txt">Shipping Charge(10%)</td>
                                                              <td height="10" align="center" class="txt11bold"><strong class="bold_txt">
                                                                <div align="center"><?php echo number_format($shipping,2);?></div>
                                                              </strong></td>
                                                            </tr>
                                                            <tr>
                                                              <td colspan="5" align="right" class="bold_txt">SubTotal: </strong></td>
                                                              <td height="10" align="center" class="txt11bold"><strong class="bold_txt">
                                                                <div align="center"><?php echo number_format($tot_price,2);?></div>
                                                              </strong></td>
                                                            </tr>
                                                        </table></td>
                                                      </tr>
                                                    </table>
                                                  <table width="289"  border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr class="ptext">
                                                        <td width="36%" align="right">&nbsp;</td>
                                                        <td width="28%" align="right">&nbsp;</td>
                                                        <td width="36%" align="right">&nbsp;</td>
                                                      </tr>
                                                      <tr class="ptext">
                                                        <td align="center" valign="top"><a href="javascript:history.back();">
<img src="images/Continue.jpg" width="83" height="28" border="0" /></a>&nbsp;</td>
                                                        <td align="center"><a href="javascript:update_cart();"><img src="images/update.jpg" width="83" height="28" border="0" /></a>&nbsp;</td>
                                                        <td align="center" valign="top"><a href="javascript:<?php if($_SESSION['user_id']){?>redirect('checkout.php');<?php }else{ $_SESSION["redirect"]= 'checkout.php' ?>redirect('checkout.php');<?php } ?>" >
<img src="images/checkout.jpg" width="83" height="28" border="0" /></a>&nbsp;</td>
                                                      </tr>
                                                    </table>
                                                  <?php }else{ ?>
                                                    <table width="518"  border="0" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td align="center" valign="middle" width="480"><table width="480" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td width="15" height="15" align="left" valign="top">&nbsp;</td>
                                                              <td width="514" height="15" background="images/top_line.gif"></td>
                                                              <td width="15">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                              <td background="images/lf_line.gif">&nbsp;</td>
                                                              <td align="left" valign="top" bgcolor="#FCF7EA"><table width="513" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td height="28" colspan="2" align="left" valign="top"><table width="513" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                          <td height="31" align="left" valign="middle" background="images/musicbar.jpg"><table width="504" border="0" align="left" cellpadding="0" cellspacing="0">
                                                                              <tr align="center">
                                                                                <td class="side_title_txt">Your basket is empty</td>
                                                                              </tr>
                                                                          </table></td>
                                                                        </tr>
                                                                    </table></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                                                        <!--<tr>
                                  <td width="66%" align="left" valign="middle">&nbsp;</td>
                                  <td width="20%" align="left" valign="top">&nbsp;</td>
                                  <td width="14%" align="left" valign="top">&nbsp;</td>
                                </tr>-->
                                                                    </table></td>
                                                                  </tr>
                                                              </table></td>
                                                              <td background="images/rg-line.gif">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                              <td width="15" height="15" align="left" valign="top">&nbsp;</td>
                                                              <td height="15" background="images/down_line.gif"></td>
                                                              <td align="left" valign="top">&nbsp;</td>
                                                            </tr>
                                                        </table></td>
                                                      </tr>
                                                    </table>
                                                  <?php	}?>
                                                </form></td>
                                              </tr>
                                              <tr>
                                                <td height="10" align="left" valign="top"></td>
                                              </tr>
                                              <tr>
                                                <td height="10" align="left" valign="top"></td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td height="20"></td>
                                        </tr>
                                        <tr>
                                          <td height="20"></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td align="right">&nbsp;</td>
                                </tr>
                              </table>
                            </div></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td background="images/-Featured_products_bottom.jpg" style="background-repeat:no-repeat">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="185" rowspan="2" valign="top">
				<!-- Right Nav Starts Here-->
				<?php include("includes/right_nav.php"); ?>
				<!-- Right Nav Ends Her-->
				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="80" valign="bottom" background="images/-footer.jpg">
	<!-- Footer  Nav Starts Here-->
				<?php include("includes/footer.php"); ?>
	<!-- Footer Nav Ends Her-->
		</td>
  </tr>
</table>
</body>
</html>
