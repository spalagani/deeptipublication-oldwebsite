<?php
session_start();
include("includes/dbconfig.php");
$uid=$_REQUEST['id'];


$acc=mysql_query("select * from nile_user where username='$_SESSION[uname]'");
$resUser=mysql_fetch_array($acc);
/*$item=mysql_query("select * from nile_items where user_id=''");
$cnt_item=mysql_num_rows($item);
if($cnt_item>0)
{
$upitem=mysql_query("update nile_items set user_id='$_SESSION[uid]' where user_id=''");
}*/

    $ok=$_REQUEST[ok];
	$colors=$_REQUEST['chk'];
	$chk1=$_REQUEST['chk1'];
	$number=count($colors);
	if($ok=='alldel')
	{
		foreach($colors as $chk1)
		{
			$seldelete=mysql_query("select * from nile_orders where auto_id='$chk1'");
			$seldelda=mysql_fetch_array($seldelete);
			$sta=$seldelda['order_status'];
			if($sta!=1)
			{
			$delete2=mysql_query("update nile_orders set order_status=3 where auto_id='$chk1'");
			}else
			{
			header("location:orderhistory.php?msg=1");
			exit;
			}
		}
		header("location:orderhistory.php");
		exit;	
			
	}
	
///////////////////paging////////////////////
$PageSize = 30;
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
   
	$TRecord=mysql_query("select * from nile_orders where user_id='$_SESSION[uname]' and order_status!='3' order by auto_id desc");
	$sql=mysql_query("select * from nile_orders where user_id='$_SESSION[uname]' and order_status!='3' order by auto_id desc LIMIT ". $StartRow .",". $PageSize."");

 $RecordCount = mysql_num_rows($TRecord);
$MaxPage = $RecordCount % $PageSize;
if($RecordCount % $PageSize == 0){
    $MaxPage = $RecordCount / $PageSize;
 }
else{
    $MaxPage = ceil($RecordCount / $PageSize);
 }

$num=mysql_num_rows($sql);
/////////////Paging Ends////////////////////////////
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
                            <td width="565" background="images/-Featured_products_top_bg.jpg"><span class="add">Orders History </span></td>
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
                                          <td width="577" align="left" valign="middle" class="event_heading" background="images/long_bar1.jpg" height="26">&nbsp;&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <?php 
			/* $wish_qr=mysql_query("select * from nile_wishlist where user_name='$_SESSION[uname]' and auto_id='$uid'");
			 $cn=mysql_fetch_array($wish_qr);*/
			 ?>
                                        <form method="post" name="formx" id="formx">
                                          <tr align="left">
                                            <td height="20" colspan="6" class="orange_txt" align="center"><?php  if($_REQUEST['msg']==1) { ?>
                                              Its not possible to cancel this Order.Its Already Delivered.
                                              <?php  }?></td>
                                          </tr>
                                          <tr>
                                            <td align="right"><table align="right">
                                                <!-- <tr>
                          <td width="493" height="10" align="right" valign="top"><a href="javascript:document.formx.action='orderhistory.php?ok=alldel';document.formx.submit();" onclick="return callmsg()"><img src="images/cancel.gif" border="0" /></a></td>
                        <td width="70"><a href="myaccount.php"><img src="images/back.gif" alt="Back" border="0"/></a></td>
                      </tr>-->
                                            </table></td>
                                          </tr>
                                          <tr align="left">
                                            <td height="15" colspan="6" class="price_txt">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="5" colspan="6" style="padding-left:10px;"></td>
                                          </tr>
                                          <?php
		 	  if($RecordCount > 0){
		?>
                                          <tr>
                                            <td><table width="100%" height="25" border="0" class="acborder">
                                                <tr bgcolor="#83AC4C" class="protab_txt" >
                                                  <?php /*?><td width="5%" height="25" align="center" class="protab_txt" ><!--<input type="checkbox" name="selall" onclick="checkstate('chk[]')">--></td><?php */?>
                                                  <td width="16%" height="25" align="center" class="footer2" >Order No.</td>
                                                  <td width="13%" height="25" align="center" class="footer2" >Order Date</td>
                                                  <td width="16%" height="25" align="center" class="footer2" >Total Amt</td>
                                                  <td width="11%" height="25" align="center" class="footer2">Status</td>
                                                  <td width="10%" height="25" align="center"  class="footer2">Action</td>
                                                  <!--<td width="10%" height="25" align="center"  class="protab_txt">Invoice</td>-->
                                                </tr>
                                                <?php 
				
				$i = 1;
				while($resUserOrders = mysql_fetch_assoc($sql)){
				 $details = explode(",", $resUserOrders["order_details"]);
				 $oid=$resUserOrders['auto_id'];
				 $len=strlen($oid);
if($len==1) {
$numo=1000;}else{$numo=100;}
//$ord_query=mysql_query("select * from nile_orders where auto_id='$oid'");
$ordno=$numo.$oid;
$location=$resUserOrders['location'];
				 if($location=="us")
				{
				$prtype='$';
				}
				if($location=="rs")
				{
				$prtype='Rs';
				}
				$totalord=$resUserOrders["order_total"] + $resUserOrders["order_shipping"] + $resUserOrders["order_tax"];
			    ?>
                                                <tr >
                                                  <?php /*?>  <td height="25" align="center"  class="accttrd" width="5%"><input type="hidden" name="chk1[]"  id="chk1" value="<?php echo $resUserOrders['auto_id']; ?>" />
                              <input type="checkbox" name="chk[]"  id="chk" value="<? echo $resUserOrders['auto_id']; ?>" onclick="checkval('chk[]')" /></td><?php */?>
                                                  <td height="25" align="center"  class="accttrd"><?php echo $ordno?></td>
                                                  <td height="25" align="center" class="accttrd"><?php  list($year,$mon,$day)=split('-',$resUserOrders["order_date"]); echo $mon.'/'.$day.'/'.$year;?></td>
                                                  <td height="25" align="center"  class="accttrd"><?php echo $prtype?> &nbsp; <?php echo number_format($totalord,2)?></td>
                                                  <td height="25" align="center" class="accttrd" ><?php  if($resUserOrders[order_status]==1){ echo "Delivered"; } if($resUserOrders[order_status]==0){ echo "Processing";} if($resUserOrders[order_status]==2) { echo "Shipped"; } if($resUserOrders[order_status]==3) { echo "Cancelled"; } if($resUserOrders[order_status]==4) { echo "Partial Ship"; } ?>
                                                  </td>
                                                  <td height="25" align="center"  class="accttrd" ><a href="order_details.php?id=<?php echo $resUserOrders['auto_id']?>" class="back" target="_blank">View</a></td>
                                                  <?php /*?> <?php  if($resUserOrders['order_invoice']<>'') { ?>
                          <td height="25" align="center"  class="accttrd" ><a href="invoice/<?php echo $resUserOrders['order_invoice']?>" target="_blank" class="back"> Yes</a></td>
                          <?php  } else {?>
                          <td height="25" align="center"  class="accttrd" ><b> No</b></td>
                          <?php  }?><?php */?>
                                                </tr>
                                                <?php  $i++; }?>
                                            </table></td>
                                          </tr>
                                        </form>
                                        <tr>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td align="right" class="paging_txt"><?php 				
										//Print First & brvious Link is necessary
										if($CounterStart != 1){
											$brvStart = $CounterStart - 1;
											print "<a href=orderhistory.php?id=$id&sortval=$sortvalue&PageNo=1 class='leftlink'>First </a>: ";
											print "<a href=orderhistory.php?id=$id&sortval=$sortvalue&PageNo=$brvStart class='leftlink'>previous </a>";
										}
										print " <font color='red'><b> [ </b></font>";
										$c = 0;
								
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
													echo "<a href=orderhistory.php?id=$id&sortval=$sortvalue&PageNo=$c class='leftlink'>$c</a> ";
												}else{
													echo "<a href=orderhistory.php?id=$id&sortval=$sortvalue&PageNo=$c class='leftlink'>$c</a> , ";
												}//END IF
								
								
											}else{
												if($PageNo == $MaxPage){
													print "$c ";
													break;
												}else{
													echo "<a href=orderhistory.php?id=$id&sortval=$sortvalue&PageNo=$c class='leftlink'>$c</a> ";
													break;
												}
											}
									   }
								
									  echo "<font color='red'><b> ]</b> </font> ";
								
									  if($CounterEnd < $MaxPage){
								
										  $NextPage = $CounterEnd + 1;
										  echo "<a href=orderhistory.php?id=$id&sortval=$sortvalue&PageNo=$NextPage class='leftlink'>Next</a>";
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
										echo "<a href=orderhistory.php?id=$id&sortval=$sortvalue&PageNo=$MaxPage class='leftlink'>Last</a>";
										}
									//////////Page links Ends//////////////////////////////////
								?>
                                          </td>
                                        </tr>
                                        <?php  }else{?>
                                        <tr align="center">
                                          <td height="35" colspan="6" class="orange_txt">-- No New Orders -- </td>
                                        </tr>
                                        <?php
							  }  ?>
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
