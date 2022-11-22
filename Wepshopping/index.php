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
	<?php
	session_start();
	include "Connect/connect.php";
	$sql = "SELECT * FROM product ORDER BY ProductID asc" or die("Error:" . mysqli_error());
	$result = mysqli_query($con, $sql);
	?>
	<div class="container">
		<br><br>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ขื่อสินค้า</th>
      <th scope="col">ราคา</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <?php while($row = mysqli_fetch_array($result)) { ?>
  <tbody>
    <tr>
      <td><img src="images/<?php echo $row['Picture'];?>" width ="100px" height="100px"></td>
      <td><?php echo $row['ProductName'] ?></td>
      <td><?php echo number_format( $row['Price'],2) ?></td>
      <td><a href="order.php?ProductID=<?php echo $row['ProductID']; ?>" class="btn btn-primary" role="button" ><span class="fa-solid fa-basket-shopping"></span>&nbsp;หยิบใส่ตะกร้า</a></td>
    </tr>
  <?php  } ?>
</table>
</div>
</body>
</html>