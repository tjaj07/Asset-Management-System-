<?php
  session_start();
  $inactive = 1800;
  if( !isset($_SESSION['timeout']) )
  $_SESSION['timeout'] = time() + $inactive;

  $session_life = time() - $_SESSION['timeout'];

  if($session_life > $inactive)
  {  session_destroy(); header("Location:index.php");     }

  $_SESSION['timeout']=time();

  include_once 'include/dbh.inc.php';
  error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="final.css">
    <link rel="stylesheet" href="final2.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>

    <?php
      if (isset($_SESSION['u_uid'])){
        echo '    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">';
                            if($_SESSION['u_type']==1){
                              echo '<a class="nav-link" id="home_margin" href="user_search.php">Home <span class="sr-only">(current)</span></a>';
                            }elseif($_SESSION['u_type']==2){
                              echo '<a class="nav-link" id="home_margin" href="admin_user.php">Home <span class="sr-only">(current)</span></a>';
                            }elseif($_SESSION['u_type']==3){
                              echo '<a class="nav-link" id="home_margin" href="super_user.php">Home <span class="sr-only">(current)</span></a>';
                            }

                      echo' </li>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="signup.php">Add User</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="update.php">Update User</a>
                  </li>
                  <li>
                    <a class="nav-link" href="additem2.php">Add Asset</a>
                  </li>
                </ul>
                    <h3 style="font-weight:bold;margin-right:300px;">Asset Management Portal</h3>
                <form class="form-inline my-2 my-lg-0" action="include/logout.inc.php" method="POST">
                  <button class="btn btn-outline-success my-2 my-sm-0" id="logout_margin" type="submit" name="submit">Logout</button>
                </form>
              </div>
            </nav>';
            include "search.php";
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
