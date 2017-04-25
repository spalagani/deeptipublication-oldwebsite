<?php
ob_start();
session_start();
include("includes/dbconfig.php");
extract($_REQUEST);
$q_row=mysql_query("select * from nile_staticpages where page_id='1'");
$row=mysql_fetch_array($q_row);
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
                                      <td class="event_txt"><?php echo $row['page_desc']?></td>
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
