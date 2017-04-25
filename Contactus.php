<?php
ob_start();
session_start();
include("includes/dbconfig.php");
extract($_REQUEST);
$q_row=mysql_query("select * from nile_staticpages where page_id='2'");
$row=mysql_fetch_array($q_row);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> DeeptiPublishers : Welcome to DeeptiPublishers.com</title>
<script type="text/javascript">
function regvalidate()
{
    var firstname = document.form.fname.value;
	var lastname = document.form.lname.value;
	var address = document.form.address.value;
	/*var city = document.form.city.value;
	var state = document.form.state.value;
	var zip = document.form.zipcode.value;
	var country = document.form.country.value;*/
	var email = document.form.email.value;
	var message = document.form.message.value;
		
	var emailFormat = /^\w(\.?[\w-])*@\w(\.?[\w-])*\.[a-zA-Z]{2,6}(\.[a-zA-Z]{2})?$/;
		
		if(firstname == "")
		{
			alert("Please enter First Name.");
			document.form.fname.focus();
			return false;
		}
	
		if(lastname == "")
		{
			alert("Please enter Phone Number.");
			document.form.lname.focus();
			return false;
		}	
		if(address == "")
		{
			alert("Please enter Address");
			document.form.address.focus();
			return false;
		}
		/*if(city == "")
		{
			alert("Please enter City.");
			document.form.city.focus();
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
			document.form.zipcode.focus();
			return false;
		}*/
		if(email == "")
		{	
			alert("Please enter Email Address.");
			document.form.email.focus();
			return false;
		}
		if(email!= "")
		{	
		 	var eres=email.search(emailFormat);
			if(eres == -1)
			{
				alert("Please Enter Valid Email Id ");
				document.form.email.focus();
				return false;
			}
		}
		if(message == "")
		{
			alert("Please enter Message.");
			document.form.message.focus();
			return false;
		}
		
		
		
		return true;
	
}

//-->
</script>
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
.style10 {color: #000000}
.style8 {color: #46719D;
	font-weight: bold;
}
.style9 {color: #FF0000}
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
                            <td width="565" background="images/-Featured_products_top_bg.jpg"><span class="add">&nbsp;Contact Us </span></td>
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
                                      <td class="event_txt"><?php echo $row['page_desc']?></td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td align="right"><a name="fed" id="fed"></a></td>
                                </tr>
                                <tr>
                                  <td align="right"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">

                                    <tr>
                                      <td><form action="contactus_success.php" method="post" name="form" id="form" onsubmit="javascript:return regvalidate()">
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td><fieldset>
                                                <legend class="points">FEED BACK FORM</legend>
                                                <table width="100%" height="200" border="0" cellpadding="5" cellspacing="5">
                                                  <tr>
                                                    <td width="50%" class="user"><div align="right">Name <span class="more style9">* <span class="style10">: </span></span></div></td>
                                                    <td width="50%" align="left"><input name="fname" type="text" class="textfield" size="30" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="user"><div align="right">Phone Number <span class="more style9">* <span class="style10">:</span></span></div></td>
                                                    <td align="left"><input name="lname" type="text" class="textfield" size="30" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="user"><div align="right">Your address<span class="more style9">* <span class="style10">:</span></span></div></td>
                                                    <td align="left"><textarea name="address" cols="30" class="textfield"></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <!--<td class="user"><div align="right">City<span class="more style9">* <span class="style10">:</span></span></div></td>
                                                    <td align="left"><input name="city" type="text" class="textfield" size="30" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="user"><div align="right">State <span class="more style9">* <span class="style10">:</span></span> </div></td>
                                                    <td align="left"><input name="state" type="text" class="textfield" id="city" size="30" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="user"><div align="right">Country<span class="more style9">* <span class="style10">:</span></span></div></td>
                                                    <td align="left"><input name="country" type="text" class="textfield" size="30" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="user"><div align="right">Post Code/ Zip Code<span class="more style9">* <span class="style10">:</span></span></div></td>
                                                    <td align="left"><input name="zipcode" type="text" class="textfield" size="30" /></td>-->
                                                  </tr>
                                                  <tr>
                                                    <td class="user"><div align="right">Email address<span class="more style9">* <span class="style10">:</span></span></div></td>
                                                    <td align="left"><input name="email" type="text" class="textfield" size="30" /></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="user"><div align="right">Message<span class="more style9">* <span class="style10">:</span></span></div></td>
                                                    <td align="left"><textarea name="message" cols="40" class="textfield" style="height:100px "></textarea></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="2" align="center"><span class="editlinks">
                                                      <input type="submit" name="Submit" value="Submit" class="textfield" />
                                                    </span></td>
                                                  </tr>
                                                </table>
                                              </fieldset></td>
                                            </tr>
                                          </table>
                                      </form></td>
                                    </tr>
                                    <tr>
                                      <td height="10"></td>
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
