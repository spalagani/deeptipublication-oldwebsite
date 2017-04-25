<?php
ob_start();
session_start();
include("includes/dbconfig.php");
extract($_REQUEST);	
$id=$_REQUEST['id'];
$product_id=$id;
//////////////////////////////////////////Multiple Product Add//////////////////////////////////		
	    $colors=$_REQUEST['chk'];
		$chk1=$_REQUEST['chk1'];
		
		 $number=count($colors);
		 
			if(isset($chk1) &&  $product_id=="")
			{
				if(isset($_GET[cat]))
				{
					$chk1=array();
					$colors=array();
					$chk1[]=$_REQUEST['chk1'];
					$colors[]=$_REQUEST['chk'];
				}
										
					foreach($colors as $chk1)
					{
						$cart=array();
						$cart['id']  = $chk1;
						$cart['qty'] = 1;
						if(isset($_SESSION['add']))
						{
							$check_id = 0;
							foreach($_SESSION['add'] as $cart_key=>$cart_val )
							{
								if($_SESSION['add'][$cart_key]['id'] == $cart['id'])
								{
									$check_id = 1;
									$_SESSION['add'][$cart_key]['qty'] = $_SESSION['add'][$cart_key]['qty'] + 1;
									break;
								}
							}
							if($check_id == 0)
							{
								array_push($_SESSION['add'],$cart);
							}
						}else
						{
							$_SESSION['add'] = array();
							array_push($_SESSION['add'],$cart);
						}
					
				}
				header("Location:cart.php");
				exit;	
			}
			/*else
				{
					header("Location:index.php");
					exit;
				}*/
//////////////////////////////////////////Single Product Add//////////////////////////////////		
if(isset($product_id) )
{
	$cart=array();
	echo $cart['id']  = $product_id;
	$cart['qty'] = 1;
	if(isset($_SESSION['add']))
	{
		$check_id = 0;
		foreach($_SESSION['add'] as $cart_key=>$cart_val )
		{
			if($_SESSION['add'][$cart_key]['id'] == $cart['id'])
			{
				$check_id = 1;
				$_SESSION['add'][$cart_key]['qty'] = $_SESSION['add'][$cart_key]['qty'] + 1;
				break;
			}
		}
		if($check_id == 0)
		{
			array_push($_SESSION['add'],$cart);
		}
	}else
	{
		$_SESSION['add'] = array();
		array_push($_SESSION['add'],$cart);
	}
	header("Location:cart.php");
	exit;
}else
{
	header("Location:index.php");
	exit;
}
////////////////////////////////////////////////////////////End//////////////////////////////
?>