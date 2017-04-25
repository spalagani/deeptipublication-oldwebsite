<?php
ob_start();
session_start();
include("includes/dbconfig.php");
$sid = session_id();
if(!$_SESSION['uname']){
header("Location:login.php?dd=1");
exit;
}

function curencyformat($price){
	$pos = strpos($price, '.');
	if($pos === false){
		$price .= '.00';
	}elseif($pos == (strlen($price)-2) ){
		$price .= '0';
	}
	return $price;
}
$selShipDetails = "SELECT * FROM nile_user WHERE username='".$_SESSION['uname']."'";
$rsShipDetails  = mysql_query($selShipDetails) or die(mysql_error());
if(mysql_num_rows($rsShipDetails) > 0){
	$resShipDetails = mysql_fetch_assoc($rsShipDetails);
	$fname = $resShipDetails['fname'];
	$lname = $resShipDetails['lname'];
	$address1 = $resShipDetails['address'];
	$city = $resShipDetails['city'];
	$state = $resShipDetails['state'];
	$country = $resShipDetails['country'];
	$zipcode = $resShipDetails['zipcode'];
	//$phone = $resShipDetails['phone'];
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VikramBooks</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/bg_new.jpg);
	background-repeat: repeat;
}
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
-->
</style></head>
<script language="javascript">
function redirect(ss)
{
	document.formx.action=ss;document.formx.submit();
}
function update_cart(){
	document.formx.action = "cart.php?ok=edit";
	document.formx.submit();
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
</script>
<body>
<div align="center">
  <table width="781" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><?php  include("includes/header.php"); ?></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="24%" valign="top"><?php include("includes/leftpanel.php"); ?></td>
          <td width="76%" valign="top" bgcolor="#F7F7F7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td background="images/bg_bar.jpg" width="592" height="35" class="side_title_txt" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shopping Cart</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="4" cellpadding="4">
              <tr>
                <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                 
                
				  <tr><td height="20"></td></tr>
                  
                  
                  <tr>
                <td><table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
                       <tr>
                          <td>
						<form action="checkout1.php" method="post" name="formx" id="formx">
<?php /*?>				<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']?>" />
				<input type="hidden" name="id" value="<?php echo $_REQUEST['id']?>" />
<?php */?>				
				<table border="0" width="90%" align="center">
				<tr bgcolor="#EE812E"><td class="bold_txt" style=" font-size:12px" colspan="3">&nbsp;&nbsp;Shipping Details</td></tr>
				<tr>
                                  <td height="15" class="to" style="padding-left:20px;"></td>
                                  <td height="15" align="center" valign="middle"></td>
                                  <td height="15" ></td>
                                </tr>
                                <tr>
                                  <td width="26%" class="to" style="padding-left:20px;"><strong class="to">First Name</strong></td>
                                  <td width="4%" height="15" align="center" valign="middle"></td>
                                  <td width="70%" align="left"><input type="text" name="fname" size="30" class="style2" value="<?php echo $fname?>" /></td>
                                </tr>
								<tr>
                                  <td width="26%" class="to" style="padding-left:20px;"><strong class="to">Last Name</strong></td>
                                  <td width="4%" height="20" align="center" valign="middle">&nbsp;</td>
                                  <td width="70%" align="left"><input type="text" name="lname" size="30" class="style2" value="<?php echo $lname?>" /></td>
                                </tr>
                                <tr>
                                  <td class="to" style="padding-left:20px;"><strong>Address</strong></td>
                                  <td height="15" align="center" valign="middle"></td>
                                  <td align="left">
								  <textarea name="address1" class="style2"  cols="20" rows="5"><?php echo $address1?></textarea></td>
                                </tr>
                                <tr>
                                  <td class="to" style="padding-left:20px;"><strong class="to">City</strong></td>
                                  <td height="15" align="center" valign="middle"></td>
                                  <td align="left"><input type="text" class="style2" name="city" size="30"  value="<?php echo $city?>" /></td>
                                </tr>
                                <tr>
                                  <td class="to" style="padding-left:20px;"><strong class="to">State</strong></td>
                                  <td height="15" align="center" valign="middle"></td>
                                  <td align="left"><input type="text" class="style2" name="state" size="30"  value="<?php echo $state?>" onkeyup="javascript:sales_tax(this.value);" /></td>
                                </tr>
                                <tr>
                                  <td class="to" style="padding-left:20px;"><strong class="to">Zip Code</strong></td>
                                  <td height="15" align="center" valign="middle"></td>
                                  <td align="left"><input type="text" class="style2" name="zipcode" size="30"  value="<?php echo $zipcode?>" /></td>
                                </tr>
                                <tr>
                                  <td class="to" style="padding-left:20px;"><strong class="to">Country</strong></td>
                                  <td height="15" align="center" valign="middle"></td>
                                  <td align="left"><input name="country" class="style2" type="text" id="country" value="<?php echo $country?>" size="30" /></td>
                                </tr>
                                <?php /*?><tr>
                                  <td class="bold_txt" style="padding-left:20px;"><strong>Phone</strong></td>
                                  <td height="19" align="center" valign="middle">&nbsp;</td>
                                  <td class="body-txt"><input name="phone" type="text" class="ptext" id="phone" value="<?php echo $phone?>" size="30" /></td>
                                </tr><?php */?>
				</table>
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                   
								   <tr><td>&nbsp;</td></tr>
											        <tr>
									
                           	  <td >
							    <table width="96%" border="0" align="center" style="border-style:solid; border-width:1px; border-color:#999999">
								
                                   <tr bgcolor="#EE812E">
								    <td width="58" height="20" align="center" class="bold_txt"><strong>&nbsp;PAYMENT</strong></td>
								   <td align="center"><span class="bold_txt"><strong>Amount</strong></span></td>
								    <td align="center" class="bold_txt"><strong> Shipping </strong></td>
                                     <td align="center" class="bold_txt"><strong>Total Amount</strong></td>
                                    </tr>
								 <?php
								foreach($_SESSION['add'] as $key=>$val){		 
									$sel_item="select * from nile_items where item_id=".$_SESSION['add'][$key]['id'];
									$rs_item=mysql_query($sel_item);
									$res_item=mysql_fetch_assoc($rs_item);
									$tot_qty = $_SESSION['add'][$key]['qty'];
									
									$tot_price += ($res_item['new_price'] * $_SESSION['add'][$key]['qty'])* (1-$discounts/100);
									$shipping+= $res_item['shipprice'];
									
								}
								$tot_price = curencyformat($tot_price);
								$shipping=($tot_price*10)/100; 
								$shipping = curencyformat($shipping);
								
								
								$total  = $tot_price+ $shipping + $salestax;
								$amount = $tot_price ;
							  ?>
                                <input type="hidden" name="amount" value="<?php echo $tot_price?>" />
                                <input type="hidden" name="totprice" value="<?php echo $tot_price?>" />
                                <input type="hidden" name="shipping" value="<?php echo $shipping?>" />
                                <!--<input type="hidden" name="salestax" value="<?php echo $salestax?>" />-->
                                <input type="hidden" name="quantity" value="<?php echo count($_SESSION['add'])?>" />
                                <input type="hidden" name="ordertotal" value="<?php echo curencyformat($total);?>" />
								       
									   <tr class="txt11bold" align="center">
                                  <td height="30" align="center"  class="body-txt" style="padding-left:10px;">Paypal</td>
                                  <td height="30" align="center" class="body-txt" id="total"><div align="center">
                                    <?php echo curencyformat($tot_price);?></div></td>
                                  <td height="30" align="center" class="body-txt"><div align="center"> 
                                 
                                    <?php echo curencyformat($shipping);?></div></td>
<?php /*?>                                  <td align=center class="colorblack" id="Sales">$ <?php echo curencyformat($salestax);?></td>
<?php */?>                                  <td height="30" align="center" class="body-txt" id="orderTOT"><div align="center">
                                    <?php echo curencyformat($total);?></div></td>
                                </tr>
							</table></td></tr>
							
							<tr>
                            <td height="20" colspan="5" align="right" style="padding-right:10px;"><table width="73" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="5" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="5"></td>
                                      </tr>
                                      <tr>
                                        <td align="center" valign="middle"><input type="image" name="submit" src="images/continue.gif" border="0" /><!--<a href="javascript:redirect(this);" class="redbut_link" ><img src="images/continue.gif" border="0" /></a>--></td>
                                      </tr>
                                      <tr>
                                        <td height="5"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                                </table>
						  </form></td>
                        </tr>
						
                  
					
                  
                </table></td>
              </tr>
                  
                  <!--<tr>
                    <td height="20"><table width="544" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="15" height="15" align="left" valign="top"><img src="images/top_lf.gif" width="15" height="15" /></td>
                        <td width="514" height="15" background="images/top_line.gif"></td>
                        <td width="15"><img src="images/top_rg.gif" width="15" height="15" /></td>
                      </tr>
                      <tr>
                        <td background="images/lf_line.gif">&nbsp;</td>
                        <td align="left" valign="top" bgcolor="#FCF7EA"><table width="513" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="28" colspan="2" align="left" valign="top"><table width="513" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="31" align="left" valign="middle" background="images/musicbar.jpg"><table width="210" border="0" align="left" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="15" align="left" valign="middle" class="side_title_txt">&nbsp;</td>
                                        <td width="195" align="left" valign="middle" class="side_title_txt">Music Cd's </td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td width="44%">&nbsp;</td>
                            <td width="56%">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><img src="images/img2.jpg" width="179" height="91" /></td>
                            <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td align="left" valign="top" class="body-txt1">Mauris eget diam. Integer nisl neque, tempus quis, varius se</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="2" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
                                      <tr>
                                        <td height="1" bgcolor="#000000"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="middle"><span class="side_title_txt">$60.00</span></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                  <td width="66%" align="left" valign="middle"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
                                      <tr>
                                        <td width="83%" align="right" valign="middle"><img src="images/DownloadI_icongif.gif" width="15" height="14" /></td>
                                        <td width="17%" class="toplinks"><a href="#" class="editlinks">Download</a></td>
                                      </tr>
                                  </table></td>
                                  <td width="20%" align="left" valign="top"><a href="#"><img src="images/add.gif" width="97" height="18" border="0" /></a></td>
                                  <td width="14%" align="left" valign="top"><a href="#"><img src="images/details1.gif" width="68" height="18" border="0" /></a></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table></td>
                        <td background="images/rg-line.gif">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="15" height="15" align="left" valign="top"><img src="images/down_lf.gif" width="15" height="15" /></td>
                        <td height="15" background="images/down_line.gif"></td>
                        <td align="left" valign="top"><img src="images/down_rg.gif" width="15" height="15" /></td>
                      </tr>
                    </table></td>
                  </tr>-->
                  
                  <!--<tr>
                    <td height="20"><table width="544" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="15" height="15" align="left" valign="top"><img src="images/top_lf.gif" width="15" height="15" /></td>
                        <td width="514" height="15" background="images/top_line.gif"></td>
                        <td width="15"><img src="images/top_rg.gif" width="15" height="15" /></td>
                      </tr>
                      <tr>
                        <td background="images/lf_line.gif">&nbsp;</td>
                        <td align="left" valign="top" bgcolor="#FCF7EA"><table width="513" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="28" colspan="2" align="left" valign="top"><table width="513" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="31" align="left" valign="middle" background="images/musicbar.jpg"><table width="210" border="0" align="left" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="15" align="left" valign="middle" class="side_title_txt">&nbsp;</td>
                                        <td width="195" align="left" valign="middle" class="side_title_txt">Music Cd's </td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td width="44%">&nbsp;</td>
                            <td width="56%">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><img src="images/img2.jpg" width="179" height="91" /></td>
                            <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td align="left" valign="top" class="body-txt1">Mauris eget diam. Integer nisl neque, tempus quis, varius se</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="2" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
                                      <tr>
                                        <td height="1" bgcolor="#000000"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="middle"><span class="side_title_txt">$60.00</span></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                  <td width="66%" align="left" valign="middle"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
                                      <tr>
                                        <td width="83%" align="right" valign="middle"><img src="images/DownloadI_icongif.gif" width="15" height="14" /></td>
                                        <td width="17%" class="toplinks"><a href="#" class="editlinks">Download</a></td>
                                      </tr>
                                  </table></td>
                                  <td width="20%" align="left" valign="top"><a href="#"><img src="images/add.gif" width="97" height="18" border="0" /></a></td>
                                  <td width="14%" align="left" valign="top"><a href="#"><img src="images/details1.gif" width="68" height="18" border="0" /></a></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table></td>
                        <td background="images/rg-line.gif">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="15" height="15" align="left" valign="top"><img src="images/down_lf.gif" width="15" height="15" /></td>
                        <td height="15" background="images/down_line.gif"></td>
                        <td align="left" valign="top"><img src="images/down_rg.gif" width="15" height="15" /></td>
                      </tr>
                    </table></td>
                  </tr>-->
                  
                  <!--<tr>
                    <td height="20"><table width="544" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="15" height="15" align="left" valign="top"><img src="images/top_lf.gif" width="15" height="15" /></td>
                        <td width="514" height="15" background="images/top_line.gif"></td>
                        <td width="15"><img src="images/top_rg.gif" width="15" height="15" /></td>
                      </tr>
                      <tr>
                        <td background="images/lf_line.gif">&nbsp;</td>
                        <td align="left" valign="top" bgcolor="#FCF7EA"><table width="513" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="28" colspan="2" align="left" valign="top"><table width="513" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="31" align="left" valign="middle" background="images/musicbar.jpg"><table width="210" border="0" align="left" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="15" align="left" valign="middle" class="side_title_txt">&nbsp;</td>
                                        <td width="195" align="left" valign="middle" class="side_title_txt">Music Cd's </td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td width="44%">&nbsp;</td>
                            <td width="56%">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center" valign="top"><img src="images/img2.jpg" width="179" height="91" /></td>
                            <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td align="left" valign="top" class="body-txt1">Mauris eget diam. Integer nisl neque, tempus quis, varius se</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="2" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
                                      <tr>
                                        <td height="1" bgcolor="#000000"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="middle"><span class="side_title_txt">$60.00</span></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                  <td width="66%" align="left" valign="middle"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
                                      <tr>
                                        <td width="83%" align="right" valign="middle"><img src="images/DownloadI_icongif.gif" width="15" height="14" /></td>
                                        <td width="17%" class="toplinks"><a href="#" class="editlinks">Download</a></td>
                                      </tr>
                                  </table></td>
                                  <td width="20%" align="left" valign="top"><a href="#"><img src="images/add.gif" width="97" height="18" border="0" /></a></td>
                                  <td width="14%" align="left" valign="top"><a href="#"><img src="images/details1.gif" width="68" height="18" border="0" /></a></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table></td>
                        <td background="images/rg-line.gif">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="15" height="15" align="left" valign="top"><img src="images/down_lf.gif" width="15" height="15" /></td>
                        <td height="15" background="images/down_line.gif"></td>
                        <td align="left" valign="top"><img src="images/down_rg.gif" width="15" height="15" /></td>
                      </tr>
                    </table></td>
                  </tr>-->
                  
                </table></td>
              </tr>
            </table></td>
            </tr>
            
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><?php include("includes/footer.php"); ?></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
</body>
</html>
