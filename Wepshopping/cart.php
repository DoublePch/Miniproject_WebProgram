<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/e24f5b2fc8.js" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Wedshopping</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php">หน้าเเรก</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="cart.php">ตะกร้าสินค้า</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<br><br>
	<?php 
	session_start();
	if (!isset($_SESSION["intLine"])) {
		echo "<div class ='container'><div class='alert alert-danger' role='alert'> ไม่มีสินค้าในตะกร้า </div></div>";
		exit();
	}
	include "Connect/connect.php";
	?>
	<div class="container">
		<br><br>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">ขื่อสินค้า</th>
					<th scope="col">ราคา</th>
					<th scope="col">จำนวน</th>
					<th scope="col">รวม</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<?php
			$Total = 0;
			$SumTotal = 0;
			for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
			{
				if($_SESSION["strProductID"][$i] != "")
				{
					$sql = "SELECT * FROM product WHERE ProductID = '".$_SESSION["strProductID"][$i]."' ";
					$result = mysqli_query($con,$sql)  or die(mysql_error());
					$row = mysqli_fetch_array($result);
					$Total = $_SESSION["strQty"][$i] * $row["Price"];
					$SumTotal = $SumTotal + $Total;
					?>
					<tr>
						<td><?php echo $_SESSION["strProductID"][$i];?></td>
						<td><?php echo $row["ProductName"];?></td>
						<td><?php echo $row["Price"];?></td>
						<td><?php echo $_SESSION["strQty"][$i];?></td>
						<td><?php echo number_format($Total,2);?></td>
						<td><a href="delete.php?Line=<?php echo $i;?>">x</a></td>
					</tr>
					<?php
				}
			}
			?>
		</table>
		Sum Total <?php echo number_format($SumTotal,2);?>
		<br><br><a href="product.php">Go to Product</a>
		<?php
		if($SumTotal > 0)
		{
			?>
			| <a href="checkout.php">CheckOut</a>
			<?php
		}
		?>
	</div>
</body>
</html>