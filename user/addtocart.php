<?php
session_start();
//include('header.php');
include('database.php');


switch($_GET['action'])
{
	case 'add':
			if(isset($_POST['quantity']) AND !empty($_POST['quantity']))
			{
				$result = mysqli_query("SELECT * FROM `product` WHERE `product_id`='".$_GET['pro_id']."'");
				$row = mysqli_fetch_array($result);
				
				$itemArray = array($row['product_code']=>array(
									
									'name'=>$row['product_name'],
									'id'=>$row['product_id'],
									'code'=>$row['product_code'],
									'price'=>$row['product_price'],
									'image'=>$row['product_img'],
									'quantity'=>$_POST['quantity'],
									'size'=>$_POST['size'],
									
									
									)
									);
				if(!empty($_SESSION['cart_item']))
				{
					foreach($_SESSION['cart_item'] as $key => $value)
					{
						if($value['id'] == $_GET['pro_id'])
						{
							echo "<script>alert('already in cart.');</script>";
						}
						else
						{
							$_SESSION['cart_item'] = array_merge($_SESSION['cart_item'],$itemArray);
						}
					}
				}
				else
				{
					$_SESSION['cart_item'] = $itemArray;
				}
			}
			header('location:'.$_SERVER['HTTP_REFERER']);
		break;
		case 'remove':
			if(!empty($_SESSION['cart_item']))
			{
				foreach($_SESSION['cart_item'] as $key => $value)
				{
					if($_GET['pro_id'] == $key)
					{
						unset($_SESSION['cart_item'][$key]);
					}
							
				}
			}
			header("location:cart.php");
		break;
		
		case 'update':
			if(!empty($_SESSION['cart_item']))
			{
				foreach($_SESSION['cart_item'] as $key => $value)
				{
					if($_GET['pro_id'] == $key)
					{
						$_SESSION['cart_item'][$key]['quantity']=$_POST['quantity'];
					}
				}
			}
			header("location:cart.php");
		break;
		case 'empty':
			if(!empty($_SESSION['cart_item']))
			{
				unset($_SESSION['cart_item']);
				
			}
			header("location:cart.php");
		break;
}
				
?>
