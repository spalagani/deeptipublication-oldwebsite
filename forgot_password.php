<?php
session_start();
include("includes/dbconfig.php");
include("includes/class.phpmailer.php");
extract($_REQUEST);
	if(isset($_POST["submit"]) && !empty ($_POST["submit"]))
	{
		$email = $_POST["email"];
		$query = mysql_query("SELECT password FROM nile_user WHERE username ='$email'");
		$row = mysql_fetch_row($query);
		if((mysql_num_rows($query) == 1))
		{
			$upass = $row[0];
			$sql = mysql_query ("SELECT username FROM nile_user WHERE email='$email'");
			$em = mysql_fetch_row($sql);
			$uname = $em[0];
			$to = $email;
			$message = "
			<html>
			<head>
			<style type='text/css'>
				.style1 {
					font-family: Georgia, 'Times New Roman', Times, serif;
					font-size: 18px;
					color: #FFFF00;
				}
				</style>
			</head>
			<body>
			<div align = 'center'>
			<table width = '100%' border = '1' >
			<tr>
				<td align = 'center' class = 'style1' bgcolor='#3399FF'>DeeptiPublications Password Recovery</td>
			</tr>
			</table>
			<table width = '100%' border ='1'>
			<tr>
				<td width = '30%'>Username</td>
				<td width = '70%'>$email</td>
			</tr>
			<tr>
				<td width = '30%'>PassWord</td>
				<td width = '70%'>$upass</td>
			</tr>
			<tr>
				<td colspan = '2'><a href = 'http://www.deeptipublications.com/'>Click Here</a> To login</td>				
			</tr>
			</table>
			</div>
			</body>
			</html>";
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: DeeptiPublications<admin@deeptipublications.com>\r\n";
			$subject = "Password Recovery";
			
			mail($to, $subject, $message, $headers);
			$dis = "Username and password has been mailed to your E- Mail Address";
		}
		else
		{
			$dis = "Incorrect Email Address, PLease Check The Email Address";
		}
		
		
	}?>
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
                            <td width="565" background="images/-Featured_products_top_bg.jpg"><span class="add">&nbsp;About DeeptiPublishers </span></td>
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
                                        <?php if($dis){?>
                                        <tr>
                                          <td align="center" class="orange_txt"><?php echo $dis?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                          <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td><table border="0" align="center">
                                              <tr>
                                                <td><fieldset>
                                                  <legend class="points">Forgot Password</legend>
                                                  <table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <form action="" method="post" name="formx" id="formx" onsubmit="return login();">
                                                      <input type="hidden" name="dd" value="<?=$dd?>" />
                                                      <tr>
                                                        <td><table width="350" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                            <tr>
                                                              <td width="15" background="images/log_lf_line.gif" bgcolor="#FFFFFF"></td>
                                                              <td height="100" bgcolor="#FFFFFF"><table width="240" border="0" cellspacing="6" cellpadding="0" align="center">
                                                                  <tr>
                                                                    <td width="78" align="left" class="user">Email : </td>
                                                                    <td width="144" align="left"><input name="email" type="text" class="txt-box-bdr" /></td>
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
                                                                    <!-- <td class="whats_txt" colspan="2" align="right">New User? <a href="register.php?dd=1" class="orangelink12" style="font-size:11px">Register Now</a></td>-->
                                                                  </tr>
                                                              </table></td>
                                                              <td width="15" background="images/log_rg_line.gif"></td>
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
                                                  </table>
                                                </fieldset></td>
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
