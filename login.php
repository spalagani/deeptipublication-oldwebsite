<?php
ob_start();
session_start();
include("includes/dbconfig.php");
include("includes/class.phpmailer.php");
extract($_REQUEST);
if($ok=='check')
{
if($_POST['email'])
{
$selQuery = "SELECT * FROM nile_user WHERE username='$email' and password='$password'";
	$rsQuery = mysql_query($selQuery) or die(mysql_error());
	echo $num=mysql_num_rows($rsQuery);
	$result=mysql_fetch_array($rsQuery);
	echo $uid=$result['auto_id'];
$ran = rand(1111,2222);
	if($num<=0)
	{
	$error=1;
	}
	else
	{
		$_SESSION['uname']=$email;
		$_SESSION['uid']=$uid;
               $_SESSION['ran']=$ran;
		
		if($dd==1)
		{
		header("location:checkout.php");
		exit;
		}
		else
		{
		header("Location:myaccount.php");
		exit;
		}
	}
}  
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
<link rel="stylesheet" href="windowfiles/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="windowfiles/dhtmlwindow.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style2 {color: #477CB2}
.style3 {font-size:12px; font-weight:bold; text-decoration:none; text-transform:uppercase; padding:4px; font-family: tahoma, Arial, Helvetica, sans-serif;}
.style4 {font-size: 13px}
.style5 {color: #000000}
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
                            <td width="565" background="images/-Featured_products_top_bg.jpg"><span class="add">Login</span></td>
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
                                      <td class="event_txt"><table border="0" cellspacing="0" cellpadding="0">
                                        
                                        <tr>
                                          <td width="577">&nbsp;</td>
                                        </tr>
                                        <?php if($error==1){?>
                                        <tr>
                                          <td align="center" class="home"> Invalid Email or Password </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                          <td height="5">&nbsp;</td>
                                        </tr>
                                        <?php if($_GET['msg']==1){?>
                                        <tr>
                                          <td align="center" class="home"> Thank you for registering with Deeptipublications.com.</td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                          <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td><table border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <form action="login.php?ok=check" method="post" name="formx" id="formx" onsubmit="return login();">
                                                <input type="hidden" name="dd" value="<?php echo $dd?>" />
                                                <tr>
                                                  <td><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td><fieldset>
                                                          <legend class="points">Customer Login</legend>
                                                          <table width="350" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                            <tr>
                                                              <td align="left" valign="middle" background="images/customer_bar.jpg" bgcolor="#FFFEF0" class="title_txt"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                                                              </table></td>
                                                            </tr>
                                                            <tr>
                                                              <td height="150" bgcolor="#FFFFFF"><table border="0" cellspacing="6" cellpadding="0" align="center">
                                                                  <tr>
                                                                    <td width="78" align="left" class="user">Email : </td>
                                                                    <td width="144" align="left"><input name="email" type="text" class="textfield" size="30" /></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td align="left" class="user">Password :</td>
                                                                    <td align="left"><input name="password" type="password" class="textfield" size="30" />                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td height="5"></td>
                                                                    <td height="5" align="center"></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td align="center" colspan="2"><input type="submit" name="submit" value="submit" class="textfield" />                                                                    </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>&nbsp;</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td class="whats_txt" colspan="2" align="right"><span class="maininfo style3">New User?</span> <a href="register.php?dd=1" class="add" style="font-size:11px">Register Now</a></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td class="whats_txt" colspan="2" align="right"><div align="right"><a href="forgot_password.php" class="add" style="font-size:11px">forgot password?</a> </div></td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                          </table>
                                                        </fieldset></td>
                                                      </tr>
                                                  </table></td>
                                                </tr>
                                              </form>
                                            <tr>
                                                <td height="10" align="left" valign="top"></td>
                                            </tr>
                                              <tr>
                                                <td height="10" align="left" valign="top"></td>
                                              </tr>
                                          </table></td>
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