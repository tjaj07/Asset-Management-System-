
<?php
include_once "include/super_user_header.php";

  if (isset($_SESSION['u_uid'])){

    echo '
        <h5 style="background-color:#303030; color:white; text-align:center; margin:0;">Add User</h5>
     <section>
          <div class="index-login">
            <div class="jumbotron">
              <form method="POST">
                Username:
                <input class="submit" required=true type="text" name="uid">
                Password:
                <input class="submit" required=true type="password" name="pwd">
                <p style="font-size:7px; color:blue;">Length should be between 8-15<br>Must inlcude one number<br>Must include one character</p>
                Confirm Password:
                <input class="submit" required=true type="password" name="cpwd">
                <br>
                Type:
                <br>
                <select class="nav-item dropdown" name="type">
                  <option class="dropdown-item" value=1>User</option>
                  <option class="dropdown-item" value=2>Admin</option>
                </select>
                <br>
                <br>
                <button id="login-in" class="common" type="submit" name="submit">Create</button>
              </form>
            </div>
          </div>
        </section>';
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

  </body>
</html>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php

  if(isset($_POST['submit'])){

    include_once 'include/dbh.inc.php';

    $uid = mysqli_real_escape_string($conn,$_POST['uid']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    $cpwd = mysqli_real_escape_string($conn,$_POST['cpwd']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    // Error handlers
    //Check empty field
    if (strlen($_POST['pwd']) > 0 && strlen($_POST['pwd']) < 8) {
      echo "<script type='text/javascript'>
                alert('Password to short!');
            </script>";
      exit();
    }
    if (strlen($_POST['pwd']) > 15) {
      echo "<script type='text/javascript'>
                alert('Password too long!');
            </script>";
      exit();
    }
    if (!preg_match("#[0-9]+#", $_POST['pwd'])) {
      echo "<script type='text/javascript'>
                alert('Password must include at least one number!');
            </script>";
      exit();
    }
    if (!preg_match("#[a-zA-Z]+#", $_POST['pwd'])) {
      echo "<script type='text/javascript'>
                alert('Password must include at least one letter!');
            </script>";
      exit();
    }

        if($cpwd==$pwd){
          $sql = "SELECT * FROM users WHERE user_id='$uid'";
          $result = mysqli_query($conn,$sql);
          $resultcheck = mysqli_num_rows($result);
          if($resultcheck > 0){
              echo "<script type='text/javascript'>alert('User Name Taken');</script>";
          }else{
            // Insert the use into database
            $sql = "insert into users (user_id,user_pwd,user_type) values ('$uid','$pwd','$type');";
            mysqli_query($conn, $sql);
            echo "<script type='text/javascript'>alert('User Created');</script>";
          }
        }else{
          echo "<script type='text/javascript'>alert('Password Not Match!');</script>";
        }
      }
?>
