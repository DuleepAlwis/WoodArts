<?php // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $error = "Username or Password is invalid";
}
else
{
//echo $_POST['username'],$_POST['password']; Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include_once('../inc/connection.php');
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
//$username = mysqli_real_escape_string($username);
//$password = mysqli_real_escape_string($password);
// Selecting Database
//$db = mysqli_select_db("woodsart", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($connection,"select * from users where password='$password' AND username='$username'");

$rows = mysqli_num_rows($query);
if ($rows == 1) {
  $userlevel=mysqli_fetch_array($query);
session_start();
$_SESSION['login_user']=$username;
$_SESSION['login_level']=$userlevel['ulevel'];
$_SESSION['user_branch']=$userlevel['showroom'];
 // Initializing Session
header("location: /woodarts/index.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($connection); // Closing Connection
}
}
?>
