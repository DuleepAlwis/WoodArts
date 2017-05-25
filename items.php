<?php
session_start();
if (!isset($_SESSION['login_user'])){
	header("location: login/index.php");
}
if ($_SESSION['user_level']==2){
	header("location: ../error.html");
}
include_once('inc/connection.php');
$query="SELECT * FROM items";
$result=mysqli_query($connection,$query);
if(mysqli_num_rows($result)>0){
	$str='';
	while($row=mysqli_fetch_assoc($result)){
		$str.="<tr><td>$row[ItemID]</td><td>$row[ItemName]</td><td>$row[price]</td><td>$row[type]</td><td>$row[Quantity]</td></tr>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>WoodArts Company</title>
<link rel="stylesheet" href="css/navmenu.css">
<link rel="stylesheet" href="css/formbox.css">
</head>
<body>
	<div id="profile">
		<b id="welcome">User : <i><?php echo $_SESSION['login_user']; ?></i></b>
		<b id="logout"><a href="/woodarts/login/logout.php">Log Out</a></b>
	</div>
<p align="center"><img src="img/logo.png"></p>
<h1 align="center"> Wood Arts Comapany Managment System</h1>
<div class="container">
	<a class="active" href="index.php">Home</a>
	<div class="dropdown">
    <button class="dropbtn">Add Record</button>
    <div class="dropdown-content">
      <a href="addcustomer.php">Add a Customer</a>
      <a href="additem.php">Add an Item</a>
      <a href="addorder.php">Add a Order</a>
			<a href="adduser.php">Add New User</a>
    </div>
  </div>
	<a href="items.php">Items</a>
	<a href="customer.php">Customers</a>
	<a href="deliver.php">Deliver Status</a>
  <a href="updateqty.php">Update Quantity</a>
  <a href="branch.php">Branch info</a>
</div>
<h1 align="center">Available Items and Quantity</h1>

<table caption='All available Items' border='2' align='center' style="width:800px">
	<tr>
		<th>Item ID</th>
		<th>Item Name</th>
		<th> Price </th>
		<th> Type </th>
		<th> Quantity </th>
	</tr>
	<?php if(isset($str)) {echo $str;} ?>
</table>

 </div>
</body>
</html>
