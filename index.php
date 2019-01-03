<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="final.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <h3 style="font-weight:bold;margin:0 auto;">Asset Management Portal</h3>
    </nav>
    <h5 style="background-color:#303030; color:white; text-align:center; margin:0;">Login</h5>
    <section>
      <div class="index-login">
        <div class="jumbotron">
          <form method="POST">
            <p>Username:</p>
            <input class="submit" type="text" name="uid">
            <p>Password:</p>
            <input class="submit" type="password" name="pwd">
            <button id="login-in" type="submit" name="submit">Login</button>
          </form>
        </div>
      </div>
    </section>
  </body>
  </html>

  <script>
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
  </script>

  <?php
    include_once 'include/dbh.inc.php';

    if(isset($_POST['submit'])){

      $uid = mysqli_real_escape_string($conn,$_POST['uid']);
      $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

      // Error handlers
      //Check empty field
      if(empty($uid)||empty($pwd)){
        echo "<script type='text/javascript'>
                  alert('Fill All Fields!');
              </script>";
        exit();
      }else{
        $sql = "SELECT * FROM users WHERE user_id='$uid'";
        $result = mysqli_query($conn,$sql);
        $resultcheck = mysqli_num_rows($result);
        if($resultcheck < 1){
          echo "<script type='text/javascript'>
                    alert('User Not Found!');
                </script>";
            exit();
        }else{
            if($row = mysqli_fetch_assoc($result)){
              if(!$row['user_pwd']==$pwd){
                echo "<script type='text/javascript'>
                          alert('Incorrect Password!');
                      </script>";
                exit();
              }else{
                // Log in the user here
                $_SESSION['u_uid'] = $row['user_id'];
                $_SESSION['u_type'] = $row['user_type'];
                if($row['user_type'] == 1){
                  header("Location: user_search.php?login=success");
                  exit();
                }elseif($row['user_type'] == 2){
                  header("Location: admin_user.php?login=success");
                  exit();
                }elseif($row['user_type'] == 3){
                  header("Location: super_user.php?login=success");
                  exit();
                }
              }
            }
          }
        }
    }
  ?>
