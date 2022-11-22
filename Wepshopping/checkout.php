<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/e24f5b2fc8.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php
	session_start(); 
	include 'Connect/connect.php';
	?>
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
	<div class="container">
		<br><br>
		<table class="table table-striped table-hover">
			<tr>
				<th scope="col">#</th>
				<th scope="col">รหัสสินค้า</th>
				<th scope="col">ชื่อสินค้า</th>
				<th scope="col">รายละเอียด</th>
				<th scope="col">จำนวน</th>
				<th scope="col">รวม</th>
			</tr>
			<?php
			$Total = 0;
			$SumTotal = 0;
			for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
			{
				if($_SESSION["strProductID"][$i] != "")
				{
					$sql = "SELECT * FROM product WHERE ProductID = '".$_SESSION["strProductID"][$i]."' ";
					$result = mysqli_query($con,$sql) or die(mysqli_error($con));
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
						<td><?php echo number_format($SumTotal,2); ?></td>
					</tr>
				<?php } } ?>
			</table>
			<p class="text-end">ราคารวม <?php echo number_format($SumTotal,2);?>&nbsp;บาท</p>
			<form name="Form" method="POST" action="Save-form.php" >
				<div style="padding:20px; border:1px solid #000000; width: 500px; height: 450px ">
					<div class="mb-3">	
						<label for="name" class="form-label">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="name">
					</div>
					<div class="mb-3">
						<label for="Address" class="form-label">Address</label>
						<textarea type="text" class="form-control" id="Address" name="Address" placeholder="Address"></textarea>
					</div>
					<div class="mb-3">
						<label for="tel" class="form-label">tel</label>
						<input type="text" class="form-control" id="tel" name="tel" placeholder="tel">
					</div>
					<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Email address</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
					</div>
					<button type="submit" name="sudmit" class="btn btn-success">ยืนยันการสั่งซื้อ</button>
				</div>
			</form>
			<br><br>
		</div>
	</body>
	</html>