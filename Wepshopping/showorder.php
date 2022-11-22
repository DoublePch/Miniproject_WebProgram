<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include 'Connect/connect.php';

$sql = "SELECT * FROM orders WHERE OrderID = '".$_GET["OrderID"]."' ";
$result = mysqli_query($con,$sql)  or die(mysqli_error());
$row = mysqli_fetch_array($result);
?>

 <table width="304" border="1">
    <tr>
      <td width="71">OrderID</td>
      <td width="217">
	  <?php echo $row["OrderID"];?></td>
    </tr>
    <tr>
      <td width="71">Name</td>
      <td width="217">
	  <?php echo $row["Name"];?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php echo $row["Address"];?></td>
    </tr>
    <tr>
      <td>Tel</td>
      <td><?php echo $row["Tel"];?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $row["Email"];?></td>
    </tr>
  </table>

  <br>

<table width="400"  border="1">
  <tr>
    <td width="101">ProductID</td>
    <td width="82">ProductName</td>
    <td width="82">Price</td>
    <td width="79">Qty</td>
    <td width="79">Total</td>
  </tr>
<?php

$Total = 0;
$SumTotal = 0;

$sql2 = "SELECT * FROM orders_detail WHERE OrderID = '".$_GET["OrderID"]."' ";
$result2 = mysqli_query($con,$sql2)  or die(mysql_error());

while($row2 = mysqli_fetch_array($result2))
{
		$sql3 = "SELECT * FROM product WHERE ProductID = '".$row2["ProductID"]."' ";
		$result3 = mysqli_query($con,$sql3)  or die(mysqli_error());
		$row3 = mysqli_fetch_array($result3);
		$Total = $row2["Qty"] * $row3["Price"];
		$SumTotal = $SumTotal + $Total;
	  ?>
	  <tr>
		<td><?php echo $row2["ProductID"];?></td>
		<td><?php echo $row3["ProductName"];?></td>
		<td><?php echo $row3["Price"];?></td>
		<td><?php echo $row2["Qty"];?></td>
		<td><?php echo number_format($Total,2);?></td>
	  </tr>
	  <?php
 }
  ?>
</table>
Sum Total <?php echo number_format($SumTotal,2);?>

<?php
mysqli_close($con);
?>
</body>
</html>