<?php
session_start();
include 'Connect/connect.php';
  $Total = 0;
  $SumTotal = 0;

  $sql = " INSERT INTO orders (OrderDate,Name,Address,Tel,Email) VALUES ('".date("Y-m-d H:i:s")."','".$_POST["name"]."','".$_POST["Address"]."' ,'".$_POST["tel"]."','".$_POST["email"]."')";
  $row = mysqli_query($con,$sql) or die(mysqli_error());

  $strOrderID = mysqli_insert_id($con);

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
		$sql = "INSERT INTO orders_detail (OrderID,ProductID,Qty) VALUES ('".$strOrderID."','".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."')";
		$row = mysqli_query($con,$sql) or die(mysqli_error());
	  }
  }

mysqli_close($con);

session_destroy();

header("location:finishorder.php?OrderID=".$strOrderID);
?>