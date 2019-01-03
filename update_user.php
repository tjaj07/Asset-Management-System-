<style media="screen">
  .addwidth2{
    width:120px;
    margin-left:10px;
    margin-right:10px;
    border-radius:3px;
  }

  td{
    height:40px;
  }
</style>

<?php
  include_once "include/super_user_header.php";
  include_once 'include/dbh.inc.php';
  if (isset($_SESSION['u_uid'])){
    echo '
    <h5 style="background-color:#303030; color:white; text-align:center; margin:0;">Update User</h5>
        <br>
    <div style="width:400px;" class="container jumbotron">
    <table id="self" style="width:180px;">
      <form method="GET">
        <tr>
          <td>Username: </td>
          <td><input class=".addwidth2" type="text" readonly name="username" value="';echo $_GET["un"];  echo '"></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td>Password: </td>
          <td> <input class=".addwidth2" type="text" name="password" value="';echo $_GET["pass"];  echo '"></td>
        </tr>
        <tr>
        </tr>
          <td></td>
          <td>
            <p style="font-size:10px; color:blue;">Length should be between 8-15<br>Must inlcude one number<br>Must include one character</p>
          </td>
        <tr>
          <td>User Type:</td>
          <td>';echo $_GET["n"];  echo '</td>
        </tr>
        <tr>
          <td>
            <select class="nav-item dropdown" name="myvalue">
              <option class="dropdown-item" value=0>Change User Type</option>
              <option class="dropdown-item" value=1>User</option>
              <option class="dropdown-item" value=2>Admin</option>
            </select>
          </td>
        </tr>

        <tr><td><button id="login-in" class="common" type="submit" name="submit">Update</button></td></tr>
      </form>
    </table>
    </div>';
  }else{
    echo '
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <h3 style=" backgroundfont-weight:bold;margin:2px auto;">Asset Management Portal</h3>
      </nav>
      <nav class="navbar navbar-expand-lg">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a style="margin-left:20px; color:black;" class="nav-link" href="index.php">Login</a>
                </li>
              </ul>
        </nav>';
  }
?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
if(isset($_GET['submit']))
{
	$name=$_GET['username'];
	$pass=$_GET['password'];
	$usertype=$_GET['myvalue'];

  if (strlen($pass) > 0 && strlen($pass) < 8) {
    echo "<script type='text/javascript'>
              alert('Password to short!');
          </script>";
    header("Location: update.php?update=false");
    exit();
  }
  if (strlen($pass) > 15) {
    echo "<script type='text/javascript'>
              alert('Password too long!');
          </script>";
    header("Location: update.php?update=false");
    exit();
  }
  if (!preg_match("#[0-9]+#",$pass)) {
    echo "<script type='text/javascript'>
              alert('Password must include at least one number!');
          </script>";
    header("Location: update.php?update=false");
    exit();
  }
  if (!preg_match("#[a-zA-Z]+#", $pass)) {
    echo "<script type='text/javascript'>
              alert('Password must include at least one letter!');
          </script>";
    header("Location: update.php?update=false");
    exit();
  }
  if($usertype==0){
    $query="UPDATE users SET user_pwd='$pass' WHERE user_id='$name';";
    $data=mysqli_query($conn, $query);
  }else{
    $query="UPDATE users SET user_pwd='$pass',user_type='$usertype' WHERE user_id='$name';";
    $data=mysqli_query($conn, $query);
  }
	if($data)
	{
    echo "<script type='text/javascript'>
              alert('Updated!');
          </script>";
    header("Location: update.php?update=true");
	}
	else
	{
    echo "<script type='text/javascript'>
              alert('Not Updated!');
          </script>";
    header("Location: update.php?update=false");
	}
}
?>
