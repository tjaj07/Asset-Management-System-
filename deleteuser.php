
<?php
  include_once 'include/dbh.inc.php';
  $uid = $_GET['un'];
  $query="DELETE FROM users WHERE user_id='$uid';";
  $data=mysqli_query($conn, $query);
  	if($data)
  	{
  		echo "<script> alert('ENTRY HAS BEEN DELETED')</script>";
      header("Location: update.php?delete=true");
    }else{
      echo "<script> alert('ENTRY HAS NOT BEEN DELETED')</script>";
      header("Location: update.php?delete=fa;se");
    }
 ?>
