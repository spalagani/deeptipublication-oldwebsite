<?php
ob_start();
session_start();
include("includes/dbconfig.php");
extract($_REQUEST);

if($subcategory) {
$extra.= "where sub_cat_id='".$subcategory."' ";
}
if($_SESSION['numb']) {
$PageSize=$_SESSION['numb'];
}
else
{ 
///////////////////paging////////////////////
$PageSize = 5;
$_SESSION['numb']=$PageSize;
}
$StartRow = 0;
if(empty($_GET['PageNo'])){
    if($StartRow == 0){
        $PageNo = $StartRow + 1;
    }
}else{
    $PageNo = $_GET['PageNo'];
    $StartRow = ($PageNo - 1) * $PageSize;
}

if($PageNo % $PageSize == 0){
    $CounterStart = $PageNo - ($PageSize - 1);
}else{
    $CounterStart = $PageNo - ($PageNo % $PageSize) + 1;
}
//Counter End
$CounterEnd = $CounterStart + ($PageSize - 1);
//////////////////end //////////////////////////////





////////////////properties ///////////////////
$pro=mysql_query("select * from nile_items ".$extra."");
$property=mysql_fetch_array($pro);
$property_id=$property['property_id'];


$TRecord=mysql_query("select * from nile_items ".$extra." ");
$sql=mysql_query("select * from nile_items ".$extra." LIMIT ". $StartRow .",". $PageSize."");


$RecordCount = mysql_num_rows($TRecord);
$MaxPage = $RecordCount % $PageSize;
if($RecordCount % $PageSize == 0){
    $MaxPage = $RecordCount / $PageSize;
 }
else{
    $MaxPage = ceil($RecordCount / $PageSize);
 }

$num=mysql_num_rows($sql);




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
.border1 {	border: 1px solid #269FE8;
}
.style5 {	font-family: Verdana, Arial, Helvetica, sans-serif;
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
                            <td width="565" background="images/-Featured_products_top_bg.jpg"><span class="add">&nbsp;Deepti Publishers Text Books </span></td>
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
                                      <td class="event_txt"><table width="100%" border="0" cellpadding="0" cellspacing="4" class="textfield">
                                        <tr>
                                          <td height="25"><div align="center"><a href="textbooks.php?subcategory=1" class="points">Junior Intermediate Text Books </a></div></td>
                                          <td height="25"><div align="center">
                                            <p><a href="textbooks.php?subcategory=2" class="points">Senior Intermediate Text Books</a></p>
                                            </div></td>
                                        </tr>
                                        <tr>
                                          <td height="25"><div align="center"><a href="textbooks.php?subcategory=3" class="points">Engineering Text Books </a></div></td>
                                          <td height="25"><div align="center"><a href="textbooks.php?subcategory=4" class="points">B.S.c Text Books </a></div></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                    <tr>
                                      <td class="event_txt"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="30"></td>
                                        </tr>
                                        <?php 
			 $i=0;
			 while($row=mysql_fetch_array($sql)) { 
			
			 ?>
                                        <tr>
                                          <td width="100%"><table border="0" align="center" class="border1">
                                              <tr>
                                                <td width="100" height="70" rowspan="3" valign="top"><a href="#" onclick="openmypage('<?php echo $row[item_id]?>','<?php echo $row[item_name]; ?>');" class="none" >
	<img src="<?php if($row['item_address']==""){ ?>images/notavailable.jpg<?php }else{ ?>../images/thumbnail/<?php echo $row['item_address']?><?php }?>" border="0"/></a> </td>
                                                <td width="301" align="left" class="mem"><span class="maininfo">Name :</span> <a href="#" onclick="openmypage('<?php echo $row[item_id]?>','<?php echo $row[item_name]; ?>');" class="star"><?php echo $row[item_name]; ?></a></td>
                                                <td width="177" align="left" class="star"><?php /*?><span class="maininfo">Old price :</span> <?php echo $row[old_price]; ?><?php */?>
                                                    <span class="maininfo">Price :</span> <?php echo $row[new_price]; ?></td>
                                              </tr>
                                              <tr>
                                                <td rowspan="2" align="left" valign="top" class="user"><div align="justify" class="speech"><?php echo $row[item_shortdesc]; ?></div></td>
                                                <td align="left" class="star">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td align="left" class="style5"><?php if(($row['status']==1) && ($row['old_price'] > 0)) { ?>
                                                    <a href="add2cart.php?id=<?php echo $row['item_id']?>"><img src="images/add.gif" width="97" height="18" border="0" /></a>
                                                  <?php } ?></td>
                                              </tr>
                                            </table>
                                              <br /></td>
                                          <?php  } ?>
                                        </tr>
                                        <tr>
                                          <td height="30" align="right" class="body-txt7"><div align="right"><span class="bold_txt5">[</span>
                                                  <?php
													  
        if($num != 0)
		{
													  
					 $ord=$_SESSION['ord'];
                      $name=$_SESSION['name'];
					
			if($searching =='')
				{
			//Print First & Previous Link is necessary
			if($CounterStart != 1){
			$PrevStart = $CounterStart - 1;
			print "<a href=textbooks.php?subcategory=$subcategory&PageNo=1>First </a>: ";
			print "<a href=textbooks.php?subcategory=$subcategory&PageNo=$PrevStart>Previous </a>";
			}
			
			
			
			//Print Page No
			for($c=$CounterStart;$c<=$CounterEnd;$c++){
			if($c < $MaxPage){
			if($c == $PageNo){
			if($c % $PageSize == 0){
			print "$c ";
			}else{
			print "$c , ";
			}
			}elseif($c % $PageSize == 0){
			echo "<a href=textbooks.php?subcategory=$subcategory&PageNo=$c>$c</a> ";
			}else{
			echo "<a href=textbooks.php?subcategory=$subcategory&PageNo=$c>$c</a> , ";
			}//END IF
			
			
			}else{
			if($PageNo == $MaxPage){
			print "$c ";
			break;
			}else{
			echo "<a href=textbooks.php?subcategory=$subcategory&PageNo=$c>$c</a> ";
			break;
			}
			}
			}
			
			
			
			if($CounterEnd < $MaxPage){
			
			$NextPage = $CounterEnd + 1;
			echo "<a href=textbooks.php?subcategory=$subcategory&PageNo=$NextPage>Next</a>";
			}
			
			//Print Last link if necessary
			if($CounterEnd < $MaxPage){
			$LastRec = $RecordCount % $PageSize;
			if($LastRec == 0){
			$LastStartRecord = $RecordCount - $PageSize;
			}
			else{
			$LastStartRecord = $RecordCount - $LastRec;
			}
			
			print " : ";
			echo "<a href=textbooks.php?subcategory=$subcategory&PageNo=$MaxPage>Last</a>";
			}}
		}
	
			?>
                                                  <span class="bold_txt5">]</span></div></td>
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