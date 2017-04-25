<?php
ob_start();
session_start();
include("includes/dbconfig.php");
extract($_POST);
$siteurl="http://www.deeptipublishers.com/";
include("includes/class.phpmailer.php");

$mails="nanda@webarrant.com";

$ok=$_REQUEST['ok'];
if($ok=="insert")
{
echo $selQuery = "SELECT * FROM nile_user WHERE email='$usname'";

	$rsQuery	= mysql_query($selQuery) or die(mysql_error());
	if(mysql_num_rows($rsQuery) == 0){
	
		
		echo $insert_query = "INSERT INTO nile_user (user_id , fname , lname , username ,password , email , address ,  city , state , country , zipcode , date_registered , last_login , ipaddress ,phone , status) VALUES ('','$fname', '','$usname', '$password','$usname','$address', '$city', '$state', '$country' , '$pincode',  now(),'', '$_SERVER[REMOTE_ADDR]', '$phone','1');";
		mysql_query($insert_query) or die(mysql_error());
		$user_id = mysql_insert_id();
		
		//this subject will be visible only for you
		$sub = "Successful Registration At deeptipublications.com";
	
		$msg = "<html>
			<head>
			 <style type='text/css'>
				<!--
				.body-txt{font-family:tahoma; font-size:11px; color:#000000; font-weight:normal; text-align:justify; line-height:16px; }
				.cart-txt{font-family:tahoma; font-size:11px; color:#000000; font-weight:normal; line-height:16px; }
				.protab_txt{font-family:tahoma; font-size:12px; color:#FFFFFF; font-weight:bold;}
				.table_txt{font-family:tahoma; font-size:11px; color:#434121; font-weight:bold;}
				.orangelink12:link, a.orangelink12:visited, a.orangelink12:active{font-family: tahoma;font-size: 12px;font-weight: bold;text-decoration:none; color:#CC3B00;}
a.orangelink12:hover{color:#000000; text-decoration:underline;}
				-->
				</style>
				</head>
<body bgcolor='#ffffff' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
<table width='100%'  border='0' cellspacing='0' cellpadding='0'>
		            <tr><td align=center><img src='".$siteurl."images/logo.gif' border=0></td></tr>
					  <tr>
						<td bgcolor='#739C3E'>&nbsp;</td>
					  </tr>
					  <tr>
						<td height='4'></td>
					  </tr>
					  <tr>
						<td height='1' bgcolor='#739C3E'></td>
					  </tr>
					   <tr>
						<td align='left'></td>
					  </tr>
					  <tr>
						<td height='8'></td>
					  </tr>
					  <tr>
						<td height='8'></td>
					  </tr>
					
					  <tr>
						<td height='8'></td>
					  </tr>
					  <tr>
						<td style='font-family:Verdana; font-size:12px; font-weight:normal; color:#000000' align='left'>
							Thank you for registering at deeptipublications.com <br>
							<br>
							Below are the Email id and Password for you to login on <a href='".$siteurl."login.php' target='_blank'>Vikrambooks.com</a></td>
					  </tr>
					  <tr>
						<td height='8'></td>
					  </tr>
					  <tr>
						<td style='font-family:Verdana; font-size:12px; font-weight:normal; color:#000000' align='left'>
							Email : ".$email."<br>
							Password  : ".$password."
						</td>
					  </tr>
					  <tr>
						<td height='8'></td>
					  </tr>
					  <tr>
						<td height='8'><hr></td>
					  </tr>
					  <tr>
						<td height='8'></td>
					  </tr>
					  <tr>
						<td align='left' style='font-family:Verdana; font-size:12px; font-weight:bold; color:#AF192E'>Thank You,<br> 
						Deeptipublications Support Team</td>
					  </tr>
					  <tr>
						<td height='8'></td>
					  </tr>
					  <tr>
						<td height='1' bgcolor='#739C3E'></td>
					  </tr>
					  <tr>
						<td height='4'></td>
					  </tr>
					</table></body></html>";
		$msg = stripslashes($msg);
		
		$mail = new PHPMailer();
		$mail->IsMail();
		/*$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "www.richerwebs.com";  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = "sridevi@richerwebs.com";  // SMTP username
		$mail->Password = "rwsridevi"; // SMTP password
		//$mail->From = "bhargavi@richerwebs.com";*/
		$mail->FromName = "Deeptipublication.com";
		$mail->AddAddress($email,$fname);
		//$mail->AddCC($mails);
		$mail->IsHTML(true);                                  // set email format to HTML
		$mail->Subject = $sub;
		$mail->Body = $msg;
		$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
		$mail->Send();
		header("Location:login.php?msg=1");
		exit;	
	} else
	{
	header("Location:register.php?msg=error");
	exit;
	}
	
}
if($ok=='update')
{
$selDetail1 = mysql_query("SELECT * FROM nile_user WHERE username='$_SESSION[uname]'");
$GetselData1=mysql_fetch_array($selDetail1);
$id=$GetselData1['user_id'];
echo "UPDATE nile_user SET fname ='$fname',email ='$usname',username='$usname',address= '$address',city = '$city',state= '$state',country= '$country',zipcode='$pincode',phone= '$phone',last_modified = now(),status= '1'  WHERE user_id ='$id'";
mysql_query("UPDATE nile_user SET fname ='$fname',email ='$usname',username='$usname',address= '$address',city = '$city',state= '$state',country= '$country',zipcode='$pincode',phone= '$phone',status= '1'  WHERE user_id ='$id'");

header("Location:myaccount.php?msg=success");
exit;
}
?>

<?php 
if($_SESSION['uname']) {

$selDetail = mysql_query("SELECT * FROM nile_user WHERE username='$_SESSION[uname]'");
$GetselData=mysql_fetch_array($selDetail);
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
<script type="text/javascript">
function regvalidate()
{
    var firstname = document.form.fname.value;
	var username = document.form.usname.value;
	var password = document.form.password.value;
	var cpassword = document.form.cpassword.value;
	
	var address = document.form.address.value;
	var state = document.form.state.value;
	var zip = document.form.pincode.value;
	var phone = document.form.phone.value;
	var country = document.form.country.value;
	
	var emailFormat = /^\w(\.?[\w-])*@\w(\.?[\w-])*\.[a-zA-Z]{2,6}(\.[a-zA-Z]{2})?$/;
		
		if(firstname == "")
		{
			alert("Please enter First Name.");
			document.form.fname.focus();
			return false;
		}
	
		if(username == "")
		{
			alert("Please enter User Name.");
			document.form.usname.focus();
			return false;
		}	
		if(username!= "")
		{	
		 	var eres=username.search(emailFormat);
			if(eres == -1)
			{
				alert("Please Enter Valid Email Id ");
				document.form.usname.focus();
				return false;
			}
		}
		if(password == "")
		{	
			alert("Please enter Password.");
			document.form.password.focus();
			return false;
		}
		if(cpassword != password)
		{	
			alert("Please enter correct Confirm Password.");
			document.form.cpassword.focus();
			return false;
		}
		
		if(address == "")
		{
			alert("Please enter Address");
			document.form.address.focus();
			return false;
		}
		if(state == "")
		{
			alert("Please enter State.");
			document.form.state.focus();
			return false;
		}
		if(country == "")
		{	
			alert("Please enter Country.");
			document.form.country.focus();
			return false;
		}
		
		if(zip == "")
		{
			alert("Please enter Zip Code.");
			document.form.pincode.focus();
			return false;
		}
		if(phone == "")
		{
			alert("Please enter Phone.");
			document.form.phone.focus();
			return false;
		}
		return true;
	
}
</script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style2 {color: #477CB2}
.style3 {font-size:12px; font-weight:bold; text-decoration:none; text-transform:uppercase; padding:4px; font-family: tahoma, Arial, Helvetica, sans-serif;}
.style4 {font-size: 13px}
.border1 {	border: 1px solid #269FE8;
}
.style6 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
-->
</style>
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
                            <td width="565" background="images/-Featured_products_top_bg.jpg"><span class="add">&nbsp;<span class="side_title_txt">User Registration  </span></span></td>
                            <td width="9"><img src="images/-Featured_products_top_righ.jpg" width="9" height="34" /></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="center" background="images/-Featured_products_body_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td  align="left" valign="top" ><form action="<?php if($_SESSION['uname']) { ?>register.php?ok=update <?php } else { ?>register.php?ok=insert<?php } ?>" method="post" name="form" id="form" onsubmit="javascript:return regvalidate()"  <?php if(!$_SESSION['uname']) { ?> <?php } ?> >
                                            <table width="100%" border="0" cellspacing="10" cellpadding="10">
                                              <tr>
                                                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <!-- <tr>
                  <td><img src="images/TV2002-copy_11.jpg" width="592" height="37" /></td>
                </tr>-->
                                                    <tr>
                                                      <td><fieldset>
                                                        <legend class="points">New User Registration</legend>
                                                        <table width="80%" border="0" align="center" cellpadding="3" cellspacing="3">
                                                          <tr>
                                                            <td width="46%">&nbsp;</td>
                                                            <td width="2%">&nbsp;</td>
                                                            <td width="52%">&nbsp;</td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" > Name : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="fname" type="text" class="textfield" id="fname" value="<?php echo $GetselData['fname']?>" size="30" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" >User Name(email) : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="usname" type="text" class="textfield" id="usname" value="<?php echo $GetselData['username']?>" size="30" <?php if($_SESSION['uname']) { ?> <?php } ?> /></td>
                                                          </tr>
                                                          <?php if($_SESSION['uname']) { } else { ?>
                                                          <tr>
                                                            <td align="right" class="user" > New Password : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="password" type="password" class="textfield" id="password" size="30" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" >Confirm Password : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="cpassword" type="password" class="textfield" id="cpassword" size="30" /></td>
                                                          </tr>
                                                          <?php } ?>
                                                          <tr>
                                                            <td align="right" class="user" >Address : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><textarea name="address" cols="30" class="textfield" id="address"><?php echo $GetselData['address']?></textarea>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" >City : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="city" type="text" class="textfield" id="city" value="<?php echo $GetselData['city']?>" size="35" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" >State : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="state" type="text" class="textfield" id="state" value="<?php echo $GetselData['state']?>" size="30" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" >County : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="country" type="text" class="textfield" id="country" value="<?php echo $GetselData['country']?>" size="30" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" >Zip Code : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="pincode" type="text" class="textfield" id="pincode" value="<?php echo $GetselData['zipcode']?>" size="30" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" class="user" >Phone Number : </td>
                                                            <td align="center">&nbsp;</td>
                                                            <td align="left"><input name="phone" type="text" class="textfield" id="phone" value="<?php echo $GetselData['phone']?>" size="30" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right" ><input name="Submit" type="submit" class="textfield" value="Submit" />
                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td align="left"><input name="Reset" type="reset" class="textfield" id="Reset" value="Reset" /></td>
                                                          </tr>
                                                          <tr>
                                                            <td >&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                        </table>
                                                      </fieldset></td>
                                                    </tr>
                                                </table></td>
                                              </tr>
                                            </table>
                                        </form></td>
                                      </tr>
                                  </table></td>
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
