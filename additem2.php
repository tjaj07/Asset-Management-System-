<?php
  include_once 'include/dbh.inc.php';
  error_reporting(0);
  session_start();
  $inactive = 1800;
  if( !isset($_SESSION['timeout']) )
  $_SESSION['timeout'] = time() + $inactive;

  $session_life = time() - $_SESSION['timeout'];

  if($session_life > $inactive)
  {  session_destroy();
     unset($_SESSION['uid']);
     header("Location:index.php");     }

  $_SESSION['timeout']=time();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="final.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">
      function myFunction() {
        var x = document.getElementById("transferform");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }

      function myFunction2() {
        var x = document.getElementById("transferform2");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }

      function myFunction1() {
        var x = document.getElementById("transferform1");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }

      function myFunction3() {
        var x = document.getElementById("transferform3");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }

      function myFunction4() {
        var x = document.getElementById("transferform4");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }
    </script>

    <style media="screen">
      #transferform1{
        display: none;
      }

      #transferform3{
        display: none;
      }

      #transferform4{
        display: none;
      }

      .addwidth2{
        width:110px;
        margin-left:10px;
        margin-right:10px;
        border-radius:3px;
      }

      .addwidth22{
        width:150px;
        margin-left:10px;
        margin-right:10px;
        border-radius:3px;
      }

      .addwidth3{
        width:155px;
        margin-left:4px;
        margin-right:4px;
        border-radius:3px;
      }

    </style>
  </head>
  <body>

<?php
if (isset($_SESSION['u_uid'])){
  echo'<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
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
            </li>';
            if($_SESSION['u_type']==3){
              echo'
            <li class="nav-item">
              <a class="nav-link" href="signup.php">Add User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="update.php">Update User</a>
            </li>';
            }
            echo'
            <li>
              <a class="nav-link" href="additem2.php">Add Asset</a>
            </li>
          </ul>
              <h3 style="font-weight:bold;margin-right:300px;">Asset Management Portal</h3>
          <form class="form-inline my-2 my-lg-0" action="include/logout.inc.php" method="POST">
            <button class="btn btn-outline-success my-2 my-sm-0" id="logout_margin" type="submit" name="submit">Logout</button>
          </form>
        </div>
      </nav>
      <h5 style="background-color:#303030; color:white; text-align:center; margin:0;">Add Assets</h5>

<button style="margin-top:30px;margin-left:20px" onclick="myFunction()" id="transfer-hover" class="common tranfer_button">Add Transfer Details</button><br>
<nav  class="navbar navbar-light bg-light" id="transferform">
  <form method="POST" class="form-inline">
    <label for="STN">STN:</label>
    <input class="addwidth2" type="text" id="STN" required=true name="stn" placeholder="Enter STN">
    <label for="STNDate">STNDate:</label>
    <input class="addwidth3" type="date" id="STNDate" required=true name="stndate" placeholder="STNDate">
    <label for="STO">STO:</label>
    <input class="addwidth2" type="text" id="STO" name="sto" required=true placeholder="Enter STO">
    <label for="GRN">GRN:</label>
    <input class="addwidth2" type="text" id="GRN" name="grn" placeholder="Enter GRN">
    <label for="GRNd">GRN Date:</label>
    <input class="addwidth3" type="date" id="GRNd" name="grndate" placeholder="Date">
    <label for="GatePass">GatePass:</label>
    <input class="addwidth2" type="text" id="GatePass" name="gatepass" placeholder="GatePass">
    <button type="submit" id="login-in" class="common" name="submit2">Done</button>
  </form>
</nav>
<br>

<button style="margin-top:10px;margin-left:20px;" onclick="myFunction1()" id="transfer-hover" class="common tranfer_button">Add Category</button><br>
<nav  class="navbar navbar-light bg-light" id="transferform1">
  <form method="POST" class="form-inline">
    <select class="common transfer_button2" name="cat1" id="category" onChange="getMake(this.value);">
      <option value="">Select Category</option>';
      $query = mysqli_query($conn,"SELECT DISTINCT CAT FROM category");
      while($row = mysqli_fetch_array($query))
      {
      echo'<option value="'.$row["CAT"].'">'.$row["CAT"].'</option>';
      }
    echo'
    </select>

    <label for="category1">Category:</label>
    <input class="addwidth2" type="text" id="category1" name="cat2" placeholder="New Category">

    <select class="common transfer_button2" name="make1" id="make" onChange="getModel(this.value)">
     <option value="">Select Make</option>';
     $query = mysqli_query($conn,"SELECT DISTINCT MAKE FROM category");
     while($row = mysqli_fetch_array($query))
     {
    echo'
     <option value="'.$row['MAKE'].'">'.$row["MAKE"].'</option>';
    }
    echo'
    </select>

    <label for="make1">Make:</label>
    <input class="addwidth2" type="text" id="make" name="make2" placeholder="New Make">

    <label for="model1">Model:</label>
    <input class="addwidth2" type="text" id="model1" name="model1" required=true placeholder="New Model">
    <button type="submit" id="login-in" class="common" name="submit1">Done</button>
  </form>
</nav>
<br>

<button  style="margin-top:10px;margin-left:20px;" onclick="myFunction2()" id="transfer-hover" class="common tranfer_button">Add Item</button>
<nav class="navbar navbar-light bg-light" id="transferform2">
  <form method="POST" class="form-inline">

    <nav class="navbar navbar-light bg-light">
      <select class="common transfer_button2" name="city" onChange="getLoc(this.value);">
       <option value="">Select City</option>';
       $query = mysqli_query($conn,"SELECT DISTINCT CITY FROM location");
       while($row = mysqli_fetch_array($query))
       {
       echo'
       <option value="'.$row['CITY'].'">'.$row["CITY"].'</option>';
       }
     echo'
     </select>
     <select id="locationlist" class="common transfer_button2" name="location" >
       <option>Select Location</option>
     </select>
    </nav>
    <br>

    <nav class="navbar navbar-light bg-light">
    <label for="category">Category:</label>
    <select class="common transfer_button2" name="category" id="category" onChange="getMake(this.value);">
      <option value="">Select Category</option>';

      $query = mysqli_query($conn,"SELECT DISTINCT CAT FROM category");
      while($row = mysqli_fetch_array($query))
      {
      echo'
      <option value="'.$row['CAT'].'">'.$row["CAT"].'</option>';
      }
    echo'
    </select>

    <label for="make">Make:</label>
    <select class="common transfer_button2" name="make" id="make" onChange="getModel(this.value)">
     <option value="">Select Make</option>
    </select>


    <label for="model">Model:</label><br>
    <select id="model" class="common transfer_button2" name="model" required=true>
     <option value="">Select Model</option>
    </select>

    <label for="status">Status:</label>
    <select class="common transfer_button2" name="status" id="status">
           <option value="IN USE">IN USE</option>
           <option value="NOT IN USE">NOT IN USE</option>
    </select>
  </nav>
    <nav class="navbar navbar-light bg-light">
    <label for="SerailNo">SerialNo:</label>
    <input class="addwidth22" type="text" id="SerailNo" required=true name="serialno" placeholder="Enter SerialNo">
    <label for="MacAddess">MacAddess</label>
    <input class="addwidth22" type="text" id="MacAddess" required=true name="macaddress" placeholder="Enter MacAddess">
    <label for="ipaddress">IP Address:</label>
    <input class="addwidth22" type="text" id="ipaddress" name="ipaddress" placeholder="Enter IP">
    <label for="Hostname">Hostname:</label>
    <input class="addwidth22" type="text" id="Hostname" name="hostname" placeholder="Enter Hostname">
  </nav>
    <nav class="navbar navbar-light bg-light">
    <label for="assetDetails">Asset Details:</label><br>
    <input class="addwidth22" type="text" id="assetDetails" required=true name="assetdetails" placeholder="Enter Asset Details">
    <label for="Vendor">Vendor:</label>
    <input class="addwidth22" type="text" id="Vendor" name="vendor" placeholder="Enter Vendor">
    <label for="VendorContact">Vendor Conatact:</label>
    <input class="addwidth22" type="text" id="VendorContact" name="vendorcontact" placeholder="Enter Vendor Contact">
    <label for="STN">STN:</label>
    <input class="addwidth22" type="text" id="STN" name="stn" placeholder="Enter STN">

    <button id="login-in" class="common" type="submit" name="submit">Add</button>
  </nav>
  </form>
</nav>
<br>

<button style="margin-top:30px;margin-left:20px" onclick="myFunction3()" id="transfer-hover" class="common tranfer_button">Bulk data insertion</button><br>
<nav class="navbar navbar-light bg-light" id="transferform3">
    <button style="margin-top:5px;margin-left:15px;" onclick="myFunction4()" id="transfer-hover" class="common">See Dummy Data</button><br><br>
    <p id="transferform4" style="margin-left:15">&nbsp &nbsp &nbsp &nbsp 1.Category &nbsp &nbsp 2.Make  &nbsp &nbsp 3.Model <br>
                                                 &nbsp &nbsp &nbsp &nbsp 4.Office Type &nbsp &nbsp 5.City &nbsp &nbsp 6.State &nbsp &nbsp 7.Office Location &nbsp &nbsp 8.Office Address &nbsp &nbsp 9.Local Person Name &nbsp &nbsp 10.Local Contact &nbsp &nbsp 11. Local Email<br>
                                                 &nbsp &nbsp &nbsp &nbsp 12.Stn &nbsp &nbsp 13.Stn Date &nbsp &nbsp 14.Grn &nbsp &nbsp 15.Grn Date &nbsp &nbsp 16.Gatepass &nbsp &nbsp 17.Sto<br>
                                                 &nbsp &nbsp &nbsp &nbsp 18.Serial No. &nbsp &nbsp 19.Details &nbsp &nbsp 20.Mac Address &nbsp &nbsp 21.IP Address &nbsp &nbsp 22.Hostname &nbsp &nbsp 23.Status &nbsp &nbsp 24.Vendor Name &nbsp &nbsp 25.Vendor Contact</p>
  <form  method="POST" class="form-inline" enctype="multipart/form-data">
    <nav class="navbar navbar-light bg-light">
	     Select File : <input style="margin-left:10px; border-radius:5px;" type="file" name="file" id="file" size="25" />
      <button id="login-in" class="common" type="submit" name="Import">Upload</button>
	  </nav
  </form>
</nav>';
} else {
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

<script >
function getLoc(val) {
	$.ajax({
	type: "POST",
	url: "getlocation.php",
	data:'CITY='+val,
	success: function(data){
		$("#locationlist").html(data);
	}
	});
}
  function getMake(val) {
  	$.ajax({
  	type: "POST",
  	url: "get_make.php",
  	data:'CATEGORY='+val,
  	success: function(data){
  		$("#make").html(data);
  	}
  	});
  }
  function getModel(val) {
  	$.ajax({
  	type: "POST",
  	url: "get_model.php",
  	data:'MAKE='+val,
  	success: function(data){
  		$("#model").html(data);
  	}
  	});
}
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


<?php

if(isset($_POST["Import"])){

    $count = 0;
		$filename=$_FILES["file"]["tmp_name"];

		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
             $make = strtoupper($getData[1]);
             $model = strtoupper($getData[2]);
             $category = strtoupper( $getData[0]);
             $sql = "SELECT CAT_ID FROM category WHERE MAKE = '$make' AND MODEL LIKE '$model' AND CAT LIKE '$category';";
             $result_use = mysqli_query($conn, $sql);
             $num_use = mysqli_num_rows($result_use);
             if($num_use<1){
               mysqli_query($conn,"INSERT INTO CATEGORY(CAT,MAKE,MODEL) VALUES('$category','$make','$model');");
               $result_use = mysqli_query($conn, $sql);
             }
             $qwerty = mysqli_fetch_assoc($result_use);
             $cat_id =  $qwerty['CAT_ID'];


             $type = strtoupper($getData[3]);
             $city = strtoupper($getData[4]);
             $state = strtoupper($getData[5]);
             $officeloc = strtoupper($getData[6]);
             $officeadd = strtoupper($getData[7]);
             $name = strtoupper($getData[8]);
             $contact = strtoupper($getData[9]);
             $email = strtoupper($getData[10]);
             $sql = "SELECT LOC_ID FROM location WHERE OFFICEADD = '$officeadd';";
             $result_use = mysqli_query($conn, $sql);
             $num_use = mysqli_num_rows($result_use);
             if($num_use<1){
               mysqli_query($conn,"INSERT INTO LOCATION(OFFICETYPE,CITY,STATE,OFFICELOC,OFFICEADD,NAME,CONTACT,EMAIL)
                                   VALUES('$type','$city','$state','$officeloc','$officeadd','$name','$contact','$email');");
               $result_use = mysqli_query($conn, $sql);
             }
             $qwerty = mysqli_fetch_assoc($result_use);
             $loc_id =  $qwerty['LOC_ID'];


             $stn = strtoupper($getData[11]);
             $stndate = strtoupper($getData[12]);
             $grn = strtoupper($getData[13]);
             $grndate = strtoupper($getData[14]);
             $gatepass = strtoupper($getData[15]);
             $sto = strtoupper($getData[16]);
             $tra_id = -1;
             if($stn!=""){
               $sql = "SELECT TRA_ID from transfer WHERE STN='$stn';";
               $result_use = mysqli_query($conn,$sql);
               $num_use2 = mysqli_num_rows($result_use);
               if($num_use2<1){
                 mysqli_query($conn,"INSERT INTO transfer(STN,STNDATE,STO,GATEPASS,GRN,GRNDATE) VALUES('$stn','$stndate','$sto','$gatepass','$grn','$grndate');");
                 $result_use = mysqli_query($conn, $sql);
               }
               $qwerty = mysqli_fetch_assoc($result_use);
               $tra_id =  $qwerty['TRA_ID'];
             }


             $sql = "";
             if($tra_id==-1){
	              $sql = "INSERT INTO asset(SERIALNO,DETAIL,MACADD,IPADD,HOSTNAME,STATUS,VEN_NAME,VEN_CONTACT,LOCATIONID,CATEGORYID) VALUES
                   ('".$getData[17]."','".$getData[18]."','".$getData[19]."','".$getData[20]."','".$getData[21]."','".$getData[22]."'
                     ,'".$getData[23]."','".$getData[24]."','".$loc_id."','".$cat_id."');";
             }else{
               $sql = "INSERT INTO asset(SERIALNO,DETAIL,MACADD,IPADD,HOSTNAME,STATUS,VEN_NAME,VEN_CONTACT,LOCATIONID,CATEGORYID,TRANSFERID) VALUES
                   ('".$getData[17]."','".$getData[18]."','".$getData[19]."','".$getData[20]."','".$getData[21]."','".$getData[22]."'
                     ,'".$getData[23]."','".$getData[24]."','".$loc_id."','".$cat_id."','".$tra_id."');";
             }
             $result = mysqli_query($conn, $sql);
				     if($result){
					      $count = $count + 1;
				     }
           }
	         fclose($file);
		    }
        echo "<script type='text/javascript'>
                  alert('".$count." Entries Entered!');
              </script>";
	}


  if(isset($_POST['submit2'])){

    include_once 'include/dbh.inc.php';

    $stn = strtoupper(mysqli_real_escape_string($conn,$_POST['stn']));
    $stndate = strtoupper(mysqli_real_escape_string($conn,$_POST['stndate']));
    $grn = strtoupper(mysqli_real_escape_string($conn,$_POST['grn']));
    $grndate = strtoupper(mysqli_real_escape_string($conn,$_POST['grndate']));
    $gatepass = strtoupper(mysqli_real_escape_string($conn,$_POST['gatepass']));
    $sto = strtoupper(mysqli_real_escape_string($conn,$_POST['sto']));

    $result_use = mysqli_query($conn, "SELECT TRA_ID from transfer WHERE STN='$stn';");
    $num_use2 = mysqli_num_rows($result_use);
    if($num_use2>0){
      echo "<script type='text/javascript'>
              alert('Transfer Details Already Present!');
            </script>";
    }else{
      mysqli_query($conn,"INSERT INTO transfer(STN,STNDATE,STO,GATEPASS,GRN,GRNDATE) VALUES('$stn','$stndate','$sto','$gatepass','$grn','$grndate');");
      echo "<script type='text/javascript'>
              alert('Transfer Details Entered!');
            </script>";
    }
  }

  if(isset($_POST['submit1'])){

    include_once 'include/dbh.inc.php';

    $cat1 = mysqli_real_escape_string($conn,$_POST['cat1']);
    $cat2 = mysqli_real_escape_string($conn,$_POST['cat2']);
    $model = mysqli_real_escape_string($conn,$_POST['model1']);
    $make1 = mysqli_real_escape_string($conn,$_POST['make1']);
    $make2 = mysqli_real_escape_string($conn,$_POST['make2']);

    $cat = "";
    if($cat1==""){
      $cat = $cat2;
    }else{
      $cat = $cat1;
    }

    $make = "";
    if($make1==""){
      $make = $make2;
    }else{
      $make = $make1;
    }

    $make = strtoupper($make);
    $cat = strtoupper($cat);
    $model = strtoupper($model);

    if($make!="" && $cat!=""){
      $result_use = mysqli_query($conn, "SELECT CAT_ID from category WHERE CAT='$cat' AND MODEL='$model' AND MAKE='$make';");
      $num_use2 = mysqli_num_rows($result_use);
      if($num_use2>0){
        echo "<script type='text/javascript'>
                alert('Category Details Already Present!');
              </script>";
      }else{
        mysqli_query($conn,"INSERT INTO category(CAT,MAKE,MODEL) VALUES('$cat','$make','$model');");
        echo "<script type='text/javascript'>
                alert('Category Details Entered!');
              </script>";
      }
    }else{
      echo "<script type='text/javascript'>
              alert('Enter All Details!');
            </script>";
    }
  }

  if(isset($_POST['submit'])){

    include_once 'include/dbh.inc.php';

    $locationi = strtoupper(mysqli_real_escape_string($conn,$_POST['location']));
    $category = strtoupper(mysqli_real_escape_string($conn,$_POST['category']));
    $make = strtoupper(mysqli_real_escape_string($conn,$_POST['make']));
    $model = strtoupper(mysqli_real_escape_string($conn,$_POST['model']));
    $status = strtoupper(mysqli_real_escape_string($conn,$_POST['status']));
    $macaddress = strtoupper(mysqli_real_escape_string($conn,$_POST['macaddress']));
    $hostname = strtoupper(mysqli_real_escape_string($conn,$_POST['hostname']));
    $details = strtoupper(mysqli_real_escape_string($conn,$_POST['assetdetails']));
    $serialno = strtoupper(mysqli_real_escape_string($conn,$_POST['serialno']));
    $ipaddress = strtoupper(mysqli_real_escape_string($conn,$_POST['ipaddress']));
    $hotsname = strtoupper(mysqli_real_escape_string($conn,$_POST['hostname']));
    $assetdetails = strtoupper(mysqli_real_escape_string($conn,$_POST['assetdetails']));
    $vendor = strtoupper(mysqli_real_escape_string($conn,$_POST['vendor']));
    $vendorcontact = strtoupper(mysqli_real_escape_string($conn,$_POST['vendorcontact']));
    $stn = strtoupper(mysqli_real_escape_string($conn,$_POST['stn']));


    $sql = "SELECT CAT_ID FROM category WHERE MAKE = '$make' AND MODEL LIKE '$model' AND CAT LIKE '$category';";
    $result_use = mysqli_query($conn, $sql);
    $num_use = mysqli_num_rows($result_use);
    if($num_use<1){
      mysqli_query($conn,"INSERT INTO CATEGORY(CAT,MAKE,MODEL) VALUES('$category','$make','$model');");
      $result_use = mysqli_query($conn, $sql);
    }

    $qwerty = mysqli_fetch_assoc($result_use);
    $cat_id =  $qwerty['CAT_ID'];

    $sql1 = "SELECT LOC_ID FROM location WHERE OFFICEADD = '$locationi';";
    $result_use1 = mysqli_query($conn, $sql1);
    $qwerty1 = mysqli_fetch_assoc($result_use1);
    $location =  $qwerty1['LOC_ID'];

    if(empty($stn)){
      $check = mysqli_query($conn,"INSERT INTO asset(SERIALNO,DETAIL,MACADD,IPADD,HOSTNAME,STATUS,VEN_NAME,VEN_CONTACT,LOCATIONID,CATEGORYID) VALUES('$serialno','$details','$macaddress','$ipaddress','$hostname','$status','$vendor','$vendorcontact','$location','$cat_id');");
      if($check){
        echo "<script>alert('Asset Added');</script>";
      }
    }else{
      $result123 = mysqli_query($conn, "SELECT TRA_ID from transfer WHERE STN='$stn';");
      $num_use123 = mysqli_num_rows($result123);
      if($num_use123<1){
        echo "<script type='text/javascript'>
                alert('Transfer Details Not Present!');
              </script>";
      }else{
        $qwerty1 = mysqli_fetch_assoc($result123);
        $stn_id = $qwerty1['TRA_ID'];
        mysqli_query($conn,"INSERT INTO ASSET(SERIALNO,DETAIL,MACADD,IPADD,HOSTNAME,STATUS,VEN_NAME,VEN_CONTACT,LOCATIONID,CATEGORYID,TRANSFERID) VALUES('$serialno','$details','$macaddress','$ipaddress','$hostname','$status','$vendor','$vendorcontact','$location','$cat_id','$stn_id');");
        echo "<script type='text/javascript'>
                alert('Details Entered!');
              </script>";
      }
    }
  }
?>
