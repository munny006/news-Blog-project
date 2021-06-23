<?php
 include("config.php");
 if ($_SESSION['user_role'] == '0') {
  header("Location:{$hostname}/admin/post.php");

}
 $userid = $_GET['id'];

 $sql = "DELETE FROM user WHERE user_id='$userid'";

 if (mysqli_query($conn,$sql)) {
 	 header("Location:{$hostname}/admin/users.php");
 }
 else{
 	echo "<p class='alert alert-danger;margin:10px 0;'>Cant delete user record</p>";
 }

mysqli_close($conn)








?>