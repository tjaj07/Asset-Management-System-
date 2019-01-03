<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<?php
    include_once 'include/dbh.inc.php';
    error_reporting(0);
 ?>

<style>
  .addwidth2{
    width:131px;
    margin-left:5px;
    margin-right:9px;
    border-radius:3px;
  }

  .addwidth3{
    width:154px;
    margin-left:4px;
    margin-right:4px;
    border-radius:3px;
  }
</style>


<h5 style="background-color:#303030; color:white; text-align:center; margin:0;"  id="asst">Track Asset</h5>

<section id="track">
<nav style="height:40px;" class="navbar navbar-light bg-light">
  <form method="POST" style="margin-left:50px;" class="form-inline">
  	<label><input type="radio" name="unique" class="radio_edit" id="serial" value="serial">Serial No.</label>
  	<label><input type="radio" name="unique" class="radio_edit" id="mac" value="mac">Mac Id</label>
  	<label><input type="radio" name="unique" class="radio_edit" id="ip" value="ip">IP Address</label>
  	<label><input type="radio" name="unique" class="radio_edit" id="host" value="host">Hostname</label>
    <input type="text" name="uniqueno" style="margin-left:10px;margin-right:10px;">
    <button type="submit" id="login-in" class="common" name="submit1">Submit</button>
  </form>
</nav>

<nav>
  <form method="POST" class="form-inline">
    <select name="city" class="common transfer_button2" onChange="getLoc(this.value)">
      <option value="">Select City</option>
      <?php
      $query = mysqli_query($conn,"SELECT DISTINCT CITY FROM location");
      while($row = mysqli_fetch_array($query))
      {
      echo'
      <option value="'.$row['CITY'].'">'.$row["CITY"].'</option>';
      }
      ?>
    </select>

    <select id="locationlist" class="common transfer_button2" style="height:50px;" name="location[]" multiple>
      <option>Select Location</option>
    </select>

    <select name="category1"  class="common transfer_button2" onChange="getMake(this.value);">
      <option value="">Select Category</option>
      <?php
        $query = mysqli_query($conn,"SELECT DISTINCT CAT FROM category");
        while($row = mysqli_fetch_array($query)){
      ?>
      <option value="<?php echo $row['CAT']; ?>"><?php echo $row["CAT"]; ?></option>
      <?php
        }
      ?>
    </select>

    <select id="makelist" class="common transfer_button2" name="make1" onChange="getModel(this.value)">
      <option value="">Select Make</option>
    </select>

    <select id="modellist" name="model1">
      <option value="">Select Model</option>
    </select>

	  <select class="common transfer_button2" name="status1">
      <option value="">Status</option>
      <option value="NOT IN USE">NOT IN USE</option>
      <option value="IN USE">IN USE </option>
    </select>

    <div id="transfer">
      <label><input type="checkbox" id="transferde" style="padding: 10px;"><strong>Transfer Details</strong></label>
    </div>
    <button type="submit" id="login-in" class="common" name="submit2">Submit</button>
  </nav>

  <nav id="hidden" class="navbar navbar-light bg-light" id="transferform">
    <label for="STN">STN:</label>
    <input class="addwidth2" type="text" id="STN" name="stn" placeholder="Enter STN">
    <label for="STO">STO:</label>
    <input class="addwidth2" type="text" id="STO" name="sto" placeholder="Enter STO">
    <label for="GRN">GRN:</label>
    <input class="addwidth2" type="text" id="GRN" name="grn" placeholder="Enter GRN">
    <label for="GatePass">GatePass:</label>
    <input class="addwidth2" type="text" id="GatePass" name="gatepass" placeholder="GatePass">
    <label for="STNDate">Date Range:</label>
    <input class="addwidth3" type="date" id="STNDate" name="date1" placeholder="STNDate">
    <label for="GRNd">--</label>
    <input class="addwidth3" type="date" id="GRNd" name="date2" placeholder="Date">
    <br>
  </nav>
</form>

<script type="text/javascript">
	$(function() {
  var checkbox = $("#transferde");
  var hidden = $("#hidden");
  hidden.hide();
  checkbox.change(function() {
    if (checkbox.is(':checked')) {
      hidden.show();
    } else {
      hidden.hide();
    }
  });
});
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
  $query = "SELECT * FROM asset ";

  if(isset($_POST['submit1']))
  {
  	$uniqueid=$_POST['unique'];
  	$val=$_POST['uniqueno'];
	//for substring search
	  $val=preg_replace("#[^0-9a-z.]#i","",$val);
  	if($uniqueid=='serial')
  		$query .= " WHERE SERIALNO LIKE '%$val%'";
  	else if($uniqueid=='mac')
  		$query .= " WHERE MACADD LIKE '%$val%'";
  	else if($uniqueid=='ip')
  		$query.="WHERE IPADD LIKE '%$val%'";
  	else if($uniqueid=='host')
  		$query .= " WHERE HOSTNAME LIKE '%$val%'";
  	else{
        echo "<div class='container'>
                <h2>Select an option</h2>
              </div>";
         exit();
    }

    $query .= ";";

    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);

    if($num < 1)
    {
        echo "<div class='container'>
                <h2>Asset Not Present</h2>
              </div>";
        exit();
    }
    else
    {
      echo '<br>';
      echo '<table id="self" class="table-hover">
          <thead>
              <tr>
                  <th scope="row">#</th>
                  <th>Make</th>
                  <th>Category</th>
                  <th>Model</th>
                  <th>SerialNo</th>
                  <th>IP Address</th>
                  <th>Status</th>
                  <th>Other Details</th>
                  <th>Location Details</th>
                  <th>Transfer Details</th>
              </tr>
            </thead>
            <tbody>';
            for($i=1; $i <= $num; $i++){
              $row = mysqli_fetch_array($result);
              $use_row1 = $row['CATEGORYID'];
              $use_row2 = $row['LOCATIONID'];
              $use_row3 = $row['TRANSFERID'];
              $result2 = mysqli_query($conn,"select * from category where CAT_ID=$use_row1;");
              $row1 = mysqli_fetch_array($result2);
              $result3 = mysqli_query($conn,"select * from location where LOC_ID=$use_row2;");
              $row2 = mysqli_fetch_array($result3);
              $result4 = mysqli_query($conn,"select * from transfer where TRA_ID=$use_row3;");
              echo '       <tr>
                              <td>'.$i.'</td>
                              <td>'.$row1["MAKE"].'</td>
                              <td>'.$row1["CAT"].'</td>
                              <td>'.$row1["MODEL"].'</td>
                              <td>'.$row["SERIALNO"].'</td>
                              <td>'.$row["IPADD"].'</td>
                              <td>'.$row["STATUS"].'</td>
                              <th><img onclick="myFunction'.$i.'()" id="imgo'.$i.'" class="imm" style="margin-left:30px; heigth:30px; width:30px;" src="plus.png" alt=""></th>
                              <th><img onclick="myFunctionn'.$i.'()" id="imgl'.$i.'" class="imm" style="margin-left:40px; heigth:30px; width:30px;" src="plus.png" alt=""></th>
                              <th><img onclick="myFunctionnn'.$i.'()" id="imgt'.$i.'" class="imm" style="margin-left:40px; heigth:30px; width:30px;" src="plus.png" alt=""></th>

                            </tr>
                            <tr style="display:none; font-weight:470;" class="aa" id="transferform'.$i.'">
                                <td></td>
                                <td colspan="9">    Host Name : '.$row['HOSTNAME'].'<br>
                                                  Mac Address : '.$row['MACADD'].'<br>
                                                      Details : '.$row['DETAIL'].'<br>
                                                  Vendor Name : '.$row['VEN_NAME'].'<br>
                                                Vendor Contact: '.$row['VEN_CONTACT'].'<br>';
                                                if($_SESSION['u_type']!=1){
                                                  echo '<button onclick="myFunctionnnn'.$i.'()" id="result-hover" class="result">Edit</button>';
                                                }
                            echo '</tr>
                            <tr style="display:none; font-weight:470;" class="aa" id="transferformm'.$i.'">
                                <td></td>
                                <td colspan="9">  City : '.$row2['CITY'].'<br>
                                                  State : '.$row2['STATE'].'<br>
                                                  Type : '.$row2['OFFICETYPE'].'<br>
                                                  Location : '.$row2['OFFICELOC'].'<br>
                                                  Address : '.$row2['OFFICEADD'].'<br>
                                                  Local Person : '.$row2['NAME'].'<br>
                                                  Local Contact : '.$row2['CONTACT'].'<br>
                                                  Local Email : '.$row2['EMAIL'].'<br>';
                                                  if($_SESSION['u_type']!=1){
                                                    echo '<button onclick="myFunctionnnnn'.$i.'()" id="result-hover" class="result">Edit</button></td>';
                                                  }
                            echo '</tr>
                                  <tr style="display:none; font-weight:470;" class="aa" id="transferformmmm'.$i.'">
                                          <td></td>
                                          <td colspan="9">
                                            <form style="background-color:#eaeae5;" method="POST"><br>
                                              Host Name     :<input type="text" name="HOSTNAME" value='.$row['HOSTNAME'].'><br><br>
                                              <input type="text" hidden=true name="SERIAL" value='.$row["SERIALNO"].'>
                                              Details       :<input type="text" name="DETAIL" value='.$row['DETAIL'].'><br><br>
                                              Vendor Name   :<input type="text" name="VEN_NAME" value='.$row['VEN_NAME'].'><br><br>
                                              Vendor Contact:<input type="text" name="VEN_CONTACT" value='.$row['VEN_CONTACT'].'><br><br>
                                              IP ADD        :<input type="text" name="IPADD" value='.$row["IPADD"].'><br><br>
                                              STATUS        :
                                              <select class="common transfer_button2" name="STATUS">
                                                <option value="">Status</option>
                                                <option value="NOT IN USE">NOT IN USE</option>
                                                <option value="IN USE">IN USE </option>
                                              </select><br><br>
                                              <button id="result-hover" class="result" name="submit_other">Update</button>
                                              </form>
                                            <br>
                                            </td>
                                  </tr>


                            <tr style="display:none; font-weight:470;" class="aa" id="transferformmm'.$i.'">
                                <td></td>
                                <td colspan="9">';
                                $num_po = mysqli_num_rows($result4);
                                if($num_po < 1){
                                  echo ' No Details Present!<br>';
                                  if($_SESSION['u_type']!=1){
                                    echo '<button onclick="myFunctionnnnnn'.$i.'()" id="result-hover" class="result">Edit</button></td></td>';
                                  }
                                  echo '</tr>
                                  <tr style="display:none; font-weight:470;" class="aa" id="transferformmmmmm'.$i.'">
                                          <td></td>
                                          <td colspan="9">
                                            <form style="background-color:#eaeae5" method="POST"><br>
                                              <input name="serial" value='.$row['SERIALNO'].' type="text" hidden=true>
                                              STN : <input name="stnt" type="text"><br><br>
                                              <button id="result-hover" class="result" name="submit_transfer">Add</button>
                                            </form><br>
                                          </td>
                                  </tr>';
                                }else{
                                  $row3 = mysqli_fetch_array($result4);
                                  echo 'STN : '.$row3['STN'].'<br>
                                        Stn Date : '.$row3['STNDATE'].'<br>
                                        STO : '.$row3['STO'].'<br>
                                        Grn : '.$row3['GRN'].'<br>
                                        Grn Date : '.$row3['GRNDATE'].'<br>
                                        Gate Pass : '.$row3['GATEPASS'].'<br>';
                                        if($_SESSION['u_type']!=1){
                                          echo '<button onclick="myFunctionnnnnn'.$i.'()" id="result-hover" class="result">Edit</button></td></td>';
                                        }
                                        echo '
                                        </tr>
                                        <tr style="display:none; font-weight:470;" class="aa" id="transferformmmmmm'.$i.'">
                                            <td></td>
                                            <td colspan="9">
                                            <form style="background-color:#eaeae5" method="POST"><br>
                                              <input name="serial" value='.$row['SERIALNO'].' type="text" hidden=true>
                                              STN: <input name="stnt" value='.$row3['STN'].' type="text">
                                              <button id="result-hover" class="result" name="submit_transfer">Update</button>
                                            </form><br>
                                          </td>
                                        </tr>

                                        <tr style="display:none; font-weight:470;" class="aa" id="transferformmmmm'.$i.'">
                                                <td></td>
                                                <td colspan="9">
                                                  <form style="background-color:#eaeae5" method="POST"><br>
                                                    <input name="serial" value='.$row['SERIALNO'].' type="text" hidden=true>
                                                    <select class="common transfer_button2" name="location123" >
                                                      <option value="">Select Address</option>';
                                                      $queryy = mysqli_query($conn,"SELECT DISTINCT OFFICEADD FROM location");
                                                      while($roww = mysqli_fetch_array($queryy))
                                                      {
                                                      echo'
                                                      <option value="'.$roww['OFFICEADD'].'">'.$roww['OFFICEADD'].'</option>';
                                                      }
                                                    echo'
                                                    </select>
                                                    <button id="result-hover" class="result" name="submit_location">Update</button>
                                                  </form>
                                                  <br>
                                                </td>
                                          </tr>';
                                }

                            echo '
                            <script type="text/javascript">
                            function myFunction'.$i.'() {
                              var x = document.getElementById("transferform'.$i.'");
                              var im = document.getElementById("imgo'.$i.'");
                              if(x.style.display=="table-row"){
                                  x.style.display = "none";
                                  im.src = "plus.png";
                              }else{
                                var y = document.getElementsByClassName("aa");
                                for(i = 0;i<y.length;i++){
                                      y[i].style.display = "none";
                                }
                                var k = document.getElementsByTagName("img");
                                for(i = 0;i<k.length;i++){
                                      k[i].src = "plus.png";
                                }
                                x.style.display = "table-row";
                                im.src = "minus.png";
                              }
                            }

                            function myFunctionn'.$i.'() {
                              var x = document.getElementById("transferformm'.$i.'");
                              var im = document.getElementById("imgl'.$i.'");
                              if(x.style.display=="table-row"){
                                  x.style.display = "none";
                                  im.src = "plus.png";
                              }else{
                                var y = document.getElementsByClassName("aa");
                                for(i = 0;i<y.length;i++){
                                      y[i].style.display = "none";
                                }
                                var k = document.getElementsByTagName("img");
                                for(i = 0;i<k.length;i++){
                                      k[i].src = "plus.png";
                                }
                                x.style.display = "table-row";
                                im.src = "minus.png";
                              }
                            }

                            function myFunctionnn'.$i.'() {
                              var x = document.getElementById("transferformmm'.$i.'");
                              var im = document.getElementById("imgt'.$i.'");
                              if(x.style.display=="table-row"){
                                  x.style.display = "none";
                                  im.src = "plus.png";
                              }else{
                                var y = document.getElementsByClassName("aa");
                                for(i = 0;i<y.length;i++){
                                      y[i].style.display = "none";
                                }
                                var k = document.getElementsByTagName("img");
                                for(i = 0;i<k.length;i++){
                                      k[i].src = "plus.png";
                                }
                                x.style.display = "table-row";
                                im.src = "minus.png";
                              }
                            }


                              function myFunctionnnn'.$i.'() {
                                            var y = document.getElementsByClassName("aa");
                                            for(i = 0;i<y.length;i++){
                                                  y[i].style.display = "none";
                                            }
                                            var x = document.getElementById("transferformmmm'.$i.'");
                                            x.style.display = "table-row";
                                          }
                              function myFunctionnnnn'.$i.'() {
                                            var y = document.getElementsByClassName("aa");
                                            for(i = 0;i<y.length;i++){
                                                  y[i].style.display = "none";
                                            }
                                            var x = document.getElementById("transferformmmmm'.$i.'");
                                            x.style.display = "table-row";
                                          }
                              function myFunctionnnnnn'.$i.'() {
                                            var y = document.getElementsByClassName("aa");
                                            for(i = 0;i<y.length;i++){
                                                  y[i].style.display = "none";
                                            }
                                            var x = document.getElementById("transferformmmmmm'.$i.'");
                                            x.style.display = "table-row";
                                          }
                              </script>';
            }
      echo '</tbody>
            </table>
            <br>
            <br>
            <br>';

    }
   }

   if(isset($_POST['submit2']))
   {
   		$city=$_POST['city'];
   		$location=$_POST['location'];
   		$category=mysqli_real_escape_string($conn,$_POST['category1']);
   		$model=mysqli_real_escape_string($conn,$_POST['model1']);
   		$make=mysqli_real_escape_string($conn,$_POST['make1']);
   		$status=mysqli_real_escape_string($conn,$_POST['status1']);
      $stn=mysqli_real_escape_string($conn,$_POST['stn']);
      $sto=mysqli_real_escape_string($conn,$_POST['sto']);
   		$grn=mysqli_real_escape_string($conn,$_POST['grn']);
   		$gatepass=mysqli_real_escape_string($conn,$_POST['gatepass']);
   		$date1=mysqli_real_escape_string($conn,$_POST['date1']);
   		$date2=mysqli_real_escape_string($conn,$_POST['date2']);
   		$c=0;
   		if($make!="" ||!empty($model)||$category !="")
   		{
          	$sql = "SELECT CAT_ID FROM CATEGORY WHERE";
          	$count = 0;
            if($category !="")
            {
              $count = 1;
                  $sql .=" CAT LIKE '$category'";
            }

          	if($make !="")
          	{
              if($count<1){
                $count = 1;
                $sql .=" MAKE = '$make'";
              }else{
                $sql .=" AND MAKE LIKE '$make'";
              }
          	}

          	if($model!="")
          	{
            	if($count<1)
            	{
              		$sql .=" MODEL = '$model'";
              		$count = 1;
            	}
            	else
            	{
              		$sql .=" AND MODEL LIKE '$model'";
            	}
          	}


          	$sql .=";";
          	$catid = mysqli_query($conn, $sql);
          	$numuse = mysqli_num_rows($catid);
          	if($numuse<1)
          	{
            	echo "<div class='container'>
                	     <h2>Asset Not Present</h2>
                   	 </div>";
            	exit();
          	}

          	$array_name = array();
          	for($i=1; $i <= $numuse; $i++)
          	{
           	    $row = mysqli_fetch_array($catid);
              	$array_name[$i-1] = $row[0];
          	}

          	$query .= ' WHERE CATEGORYID IN (' . implode(',', $array_name) . ')';
          	$c = 1;
      	}
      	if(city!=""||$location!="")
      	{
      		$q="SELECT LOC_ID FROM location ";
      		$check=0;
      		if($city!="")
      		{
      			$q.= "WHERE CITY='$city' ";
      			$check=1;
      		}
      		if($location!="")
      		{
      			$location = "'" . implode ( "', '", $location ) . "'";
          		if($check<1)
          		{
            		$q .= ' WHERE OFFICEADD IN ('.$location.')';

          		}
          		else
          		{
            		$q .= ' AND OFFICEADD IN ('. $location .')';
          		}
            	$check = 1;

      		}
      		$q .=";";
          	$locid = mysqli_query($conn, $q);
          	$numuse = mysqli_num_rows($locid);
          	if($numuse<1)
          	{
            	echo "<div class='container'>
                	     <h2>Asset Not Present</h2>
                   	 </div>";
            	exit();
          	}
          	$array_name = array();
          	for($i=1; $i <= $numuse; $i++)
          	{
           	    $row = mysqli_fetch_array($locid);
              	$array_name[$i-1] = $row[0];
          	}
          	if($c<1)
          		$query .= ' WHERE LOCATIONID IN (' . implode(',', $array_name) . ')';
          	else
          		$query .= ' AND LOCATIONID IN (' . implode(',', $array_name) . ')';
          	$c=1;

        }
      	if($status !="")
      	{
        	if($c<1)
        	{
          		$query .= " WHERE STATUS = '$status'";
        	}
        	else
        	{
          		$query .= " AND STATUS = '$status'";
        	}
        	$c=1;
      	}
      	if($stn!=""||$sto!=""||$grn!=""||$gatepass!=""||$date1!=""||$date2!="")
      	{
      		$q="SELECT TRA_ID FROM transfer ";
      		$check=0;

      		if($stn!="")
      		{
      			$q.= "WHERE STN='$stn' ";
      			$check=1;
      		}
          if($sto!="")
          {
            if($check<1)
              $q.= "WHERE STO='$sto' ";
            else
              $q.= "AND STO='$sto' ";
            $check=1;
          }

      		if($grn!="")
      		{
      			if($check<1)
      				$q.= "WHERE GRN='$grn' ";
      			else
      				$q.= "AND GRN='$grn' ";
      			$check=1;
      		}
      		if($gatepass!="")
      		{
      			if($check<1)
      				$q.= "WHERE GATEPASS='$grn' ";
      			else
      				$q.= "AND GATEPASS='$grn' ";
      			$check=1;
      		}
      		if($date1!="")
      		{
      			if($date2!="")
      			{
      				if($check<1)
      					$q.="WHERE STNDATE BETWEEN '$date1' AND '$date2' ";
      				else
      					$q.="AND STNDATE BETWEEN '$date1' AND '$date2' ";
      			}
      			else
      			{
      				if($check<1)
      					$q.="WHERE STNDATE = '$date1' ";
      				else
      					$q.="AND STNDATE ='$date1' ";

      			}
      			$check=1;
      		}
      		$q .=";";
          	$transferid = mysqli_query($conn, $q);
          	$numuse = mysqli_num_rows($transferid);
          	if($numuse<1)
          	{
            	echo "<div class='container'>
                	     <h2>Asset Not Present</h2>
                   	 </div>";
            	exit();
          	}
          	$array_name = array();
          	for($i=1; $i <= $numuse; $i++)
          	{
           	    $row = mysqli_fetch_array($transferid);
              	$array_name[$i-1] = $row[0];
          	}
          	if($c<1)
          		$query .= ' WHERE TRANSFERID IN (' . implode(',', $array_name) . ')';
          	else
          		$query .= ' AND TRANSFERID IN (' . implode(',', $array_name) . ')';
          	$c=1;
      	}


      $query .= ";";

    	$result = mysqli_query($conn, $query);
    	$num = mysqli_num_rows($result);

    	if($num < 1)
    	{
      		echo "<div class='container'>
        	         <h2>Asset Not Present</h2>
             	  </div>";
      		exit();
    	}
    	else
    	{
        echo '<br>';
        echo '<table id="self" class="table-hover">
            <thead>
                <tr>
                    <th scope="row">#</th>
                    <th>Make</th>
                    <th>Category</th>
                    <th>Model</th>
                    <th>SerialNo</th>
                    <th>IP Address</th>
                    <th>Status</th>
                    <th>Other Details</th>
                    <th>Location Details</th>
                    <th>Transfer Details</th>
                </tr>
              </thead>
              <tbody>';
        for($i=1; $i <= $num; $i++){
          $row = mysqli_fetch_array($result);
          $use_row1 = $row['CATEGORYID'];
          $use_row2 = $row['LOCATIONID'];
          $use_row3 = $row['TRANSFERID'];
          $result2 = mysqli_query($conn,"select * from category where CAT_ID=$use_row1;");
          $row1 = mysqli_fetch_array($result2);
          $result3 = mysqli_query($conn,"select * from location where LOC_ID=$use_row2;");
          $row2 = mysqli_fetch_array($result3);
          $result4 = mysqli_query($conn,"select * from transfer where TRA_ID=$use_row3;");
          echo '       <tr>
                          <td>'.$i.'</td>
                          <td>'.$row1["MAKE"].'</td>
                          <td>'.$row1["CAT"].'</td>
                          <td>'.$row1["MODEL"].'</td>
                          <td>'.$row["SERIALNO"].'</td>
                          <td>'.$row["IPADD"].'</td>
                          <td>'.$row["STATUS"].'</td>
                          <th><img onclick="myFunction'.$i.'()" id="imgo'.$i.'" class="imm" style="margin-left:30px; heigth:30px; width:30px;" src="plus.png" alt=""></th>
                          <th><img onclick="myFunctionn'.$i.'()" id="imgl'.$i.'" class="imm" style="margin-left:40px; heigth:30px; width:30px;" src="plus.png" alt=""></th>
                          <th><img onclick="myFunctionnn'.$i.'()" id="imgt'.$i.'" class="imm" style="margin-left:40px; heigth:30px; width:30px;" src="plus.png" alt=""></th>

                        </tr>
                        <tr style="display:none; font-weight:470;" class="aa" id="transferform'.$i.'">
                            <td></td>
                            <td colspan="9">    Host Name : '.$row['HOSTNAME'].'<br>
                                              Mac Address : '.$row['MACADD'].'<br>
                                                  Details : '.$row['DETAIL'].'<br>
                                              Vendor Name : '.$row['VEN_NAME'].'<br>
                                            Vendor Contact: '.$row['VEN_CONTACT'].'<br>';
                                            if($_SESSION['u_type']!=1){
                                              echo '<button onclick="myFunctionnnn'.$i.'()" id="result-hover" class="result">Edit</button>';
                                            }
                        echo '</tr>
                        <tr style="display:none; font-weight:470;" class="aa" id="transferformm'.$i.'">
                            <td></td>
                            <td colspan="9">  City : '.$row2['CITY'].'<br>
                                              State : '.$row2['STATE'].'<br>
                                              Type : '.$row2['OFFICETYPE'].'<br>
                                              Location : '.$row2['OFFICELOC'].'<br>
                                              Address : '.$row2['OFFICEADD'].'<br>
                                              Local Person : '.$row2['NAME'].'<br>
                                              Local Contact : '.$row2['CONTACT'].'<br>
                                              Local Email : '.$row2['EMAIL'].'<br>';
                                              if($_SESSION['u_type']!=1){
                                                echo '<button onclick="myFunctionnnnn'.$i.'()" id="result-hover" class="result">Edit</button></td>';
                                              }
                        echo '</tr>
                              <tr style="display:none; font-weight:470;" class="aa" id="transferformmmm'.$i.'">
                                      <td></td>
                                      <td colspan="9">
                                        <form style="background-color:#eaeae5;" method="POST"><br>
                                          Host Name     :<input type="text" name="HOSTNAME" value='.$row['HOSTNAME'].'><br><br>
                                          <input type="text" hidden=true name="SERIAL" value='.$row["SERIALNO"].'>
                                          Details       :<input type="text" name="DETAIL" value='.$row['DETAIL'].'><br><br>
                                          Vendor Name   :<input type="text" name="VEN_NAME" value='.$row['VEN_NAME'].'><br><br>
                                          Vendor Contact:<input type="text" name="VEN_CONTACT" value='.$row['VEN_CONTACT'].'><br><br>
                                          IP ADD        :<input type="text" name="IPADD" value='.$row["IPADD"].'><br><br>
                                          STATUS        :
                                          <select class="common transfer_button2" name="STATUS">
                                            <option value="">Status</option>
                                            <option value="NOT IN USE">NOT IN USE</option>
                                            <option value="IN USE">IN USE </option>
                                          </select><br><br>
                                          <button id="result-hover" class="result" name="submit_other">Update</button>
                                          </form>
                                        <br>
                                        </td>
                              </tr>

                              <tr style="display:none; font-weight:470;" class="aa" id="transferformmmmm'.$i.'">
                                      <td></td>
                                      <td colspan="9">
                                        <form style="background-color:#eaeae5" method="POST"><br>
                                          <input name="serial" value='.$row['SERIALNO'].' type="text" hidden=true>
                                          <select class="common transfer_button2" name="location123" >
                                            <option value="">Select Address</option>';
                                            $queryy = mysqli_query($conn,"SELECT DISTINCT OFFICEADD FROM location");
                                            while($roww = mysqli_fetch_array($queryy))
                                            {
                                            echo'
                                            <option value="'.$roww['OFFICEADD'].'">'.$roww['OFFICEADD'].'</option>';
                                            }
                                          echo'
                                          </select>
                                          <button id="result-hover" class="result" name="submit_location">Update</button>
                                        </form>
                                        <br>
                                      </td>
                                </tr>

                        <tr style="display:none; font-weight:470;" class="aa" id="transferformmm'.$i.'">
                            <td></td>
                            <td colspan="9">';
                            $num_po = mysqli_num_rows($result4);
                            if($num_po < 1){
                              echo ' No Details Present!<br>';
                              if($_SESSION['u_type']!=1){
                                echo '<button onclick="myFunctionnnnnn'.$i.'()" id="result-hover" class="result">Edit</button></td></td>';
                              }
                              echo '</tr>
                              <tr style="display:none; font-weight:470;" class="aa" id="transferformmmmmm'.$i.'">
                                      <td></td>
                                      <td colspan="9">
                                        <form style="background-color:#eaeae5" method="POST"><br>
                                          <input name="serial" value='.$row['SERIALNO'].' type="text" hidden=true>
                                          STN : <input name="stnt" type="text"><br><br>
                                          <button id="result-hover" class="result" name="submit_transfer">Add</button>
                                        </form><br>
                                      </td>
                              </tr>';
                            }else{
                              $row3 = mysqli_fetch_array($result4);
                              echo 'STN : '.$row3['STN'].'<br>
                                    Stn Date : '.$row3['STNDATE'].'<br>
                                    STO : '.$row3['STO'].'<br>
                                    Grn : '.$row3['GRN'].'<br>
                                    Grn Date : '.$row3['GRNDATE'].'<br>
                                    Gate Pass : '.$row3['GATEPASS'].'<br>';
                                    if($_SESSION['u_type']!=1){
                                      echo '<button onclick="myFunctionnnnnn'.$i.'()" id="result-hover" class="result">Edit</button></td></td>';
                                    }
                                    echo '
                                    </tr>
                                    <tr style="display:none; font-weight:470;" class="aa" id="transferformmmmmm'.$i.'">
                                        <td></td>
                                        <td colspan="9">
                                        <form style="background-color:#eaeae5" method="POST"><br>
                                          <input name="serial" value='.$row['SERIALNO'].' type="text" hidden=true>
                                          STN: <input name="stnt" value='.$row3['STN'].' type="text">
                                          <button id="result-hover" class="result" name="submit_transfer">Update</button>
                                        </form><br>
                                      </td>
                                    </tr>


                                  ';
                            }

                        echo '
                        <script type="text/javascript">
                        function myFunction'.$i.'() {
                          var x = document.getElementById("transferform'.$i.'");
                          var im = document.getElementById("imgo'.$i.'");
                          if(x.style.display=="table-row"){
                              x.style.display = "none";
                              im.src = "plus.png";
                          }else{
                            var y = document.getElementsByClassName("aa");
                            for(i = 0;i<y.length;i++){
                                  y[i].style.display = "none";
                            }
                            var k = document.getElementsByTagName("img");
                            for(i = 0;i<k.length;i++){
                                  k[i].src = "plus.png";
                            }
                            x.style.display = "table-row";
                            im.src = "minus.png";
                          }
                        }

                        function myFunctionn'.$i.'() {
                          var x = document.getElementById("transferformm'.$i.'");
                          var im = document.getElementById("imgl'.$i.'");
                          if(x.style.display=="table-row"){
                              x.style.display = "none";
                              im.src = "plus.png";
                          }else{
                            var y = document.getElementsByClassName("aa");
                            for(i = 0;i<y.length;i++){
                                  y[i].style.display = "none";
                            }
                            var k = document.getElementsByTagName("img");
                            for(i = 0;i<k.length;i++){
                                  k[i].src = "plus.png";
                            }
                            x.style.display = "table-row";
                            im.src = "minus.png";
                          }
                        }

                        function myFunctionnn'.$i.'() {
                          var x = document.getElementById("transferformmm'.$i.'");
                          var im = document.getElementById("imgt'.$i.'");
                          if(x.style.display=="table-row"){
                              x.style.display = "none";
                              im.src = "plus.png";
                          }else{
                            var y = document.getElementsByClassName("aa");
                            for(i = 0;i<y.length;i++){
                                  y[i].style.display = "none";
                            }
                            var k = document.getElementsByTagName("img");
                            for(i = 0;i<k.length;i++){
                                  k[i].src = "plus.png";
                            }
                            x.style.display = "table-row";
                            im.src = "minus.png";
                          }
                        }


                          function myFunctionnnn'.$i.'() {
                                        var y = document.getElementsByClassName("aa");
                                        for(i = 0;i<y.length;i++){
                                              y[i].style.display = "none";
                                        }
                                        var x = document.getElementById("transferformmmm'.$i.'");
                                        x.style.display = "table-row";
                                      }
                          function myFunctionnnnn'.$i.'() {
                                        var y = document.getElementsByClassName("aa");
                                        for(i = 0;i<y.length;i++){
                                              y[i].style.display = "none";
                                        }
                                        var x = document.getElementById("transferformmmmm'.$i.'");
                                        x.style.display = "table-row";
                                      }
                          function myFunctionnnnnn'.$i.'() {
                                        var y = document.getElementsByClassName("aa");
                                        for(i = 0;i<y.length;i++){
                                              y[i].style.display = "none";
                                        }
                                        var x = document.getElementById("transferformmmmmm'.$i.'");
                                        x.style.display = "table-row";
                                      }
                          </script>';
        }
        echo '</tbody>
              </table>
              <br>
              <br>
              <br>';
      }
    }
?>
</section>

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
function getLocc(val) {
	$.ajax({
	type: "POST",
	url: "getlocation.php",
	data:'CITY='+val,
	success: function(data){
		$("#locationlistt").html(data);
	}
	});
}
function getMake(val) {
	$.ajax({
	type: "POST",
	url: "get_make.php",
	data:'CATEGORY='+val,
	success: function(data){
		$("#makelist").html(data);
	}
	});
}
function getModel(val) {
	$.ajax({
	type: "POST",
	url: "get_model.php",
	data:'MAKE='+val,
	success: function(data){
		$("#modellist").html(data);
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

   if(isset($_POST['submit_location'] )){
     $NEW_LOC=$_POST['location123'];
     $SERIAL = $_POST['serial'];

     $sql = "SELECT * FROM location WHERE OFFICEADD='$NEW_LOC';";
     $ress = mysqli_query($conn, $sql);
     $req_id = mysqli_fetch_array($ress);

     $req_id_y = $req_id['LOC_ID'];
     $query="UPDATE asset SET LOCATIONID='$req_id_y' WHERE SERIALNO='$SERIAL'; ";

   	  $data=mysqli_query($conn, $query);
   	  if($data)
   	  {
        echo '<script>alert("Location Updated!");</script>';
   	  }
  	  else
      {
  	     echo '<script>alert("Location Not Updated!");</script>';
      }
    }

    if(isset($_POST['submit_other'] )){
      $HOSTNAME=$_POST['HOSTNAME'];
      $DETAIL=$_POST['DETAIL'];
      $SERIAL=$_POST['SERIAL'];
      $VEN_NAME=$_POST['VEN_NAME'];
      $VEN_CONTACT=$_POST['VEN_CONTACT'];
      $IPADD=$_POST['IPADD'];
      $STATUS=$_POST['STATUS'];
      $query = "";
      if($STATUS==""){
        $query="UPDATE ASSET SET HOSTNAME='$HOSTNAME' ,DETAIL='$DETAIL',VEN_NAME='$VEN_NAME',VEN_CONTACT='$VEN_CONTACT',IPADD='$IPADD' WHERE SERIALNO='$SERIAL';";
      }else{
        $query="UPDATE ASSET SET HOSTNAME='$HOSTNAME' ,DETAIL='$DETAIL',VEN_NAME='$VEN_NAME',VEN_CONTACT='$VEN_CONTACT',IPADD='$IPADD',STATUS='$STATUS' WHERE SERIALNO='$SERIAL';";
      }
      $data=mysqli_query($conn, $query);
      if($data)
      {
        echo '<script>alert("Record Updated!");</script>';
      }else
      {
        echo '<script>alert("Record Not Updated!");</script>';
      }
    }


    if(isset($_POST['submit_transfer'] )){

      $STN = $_POST['stnt'];
      $SERIAL = $_POST['serial'];
      $sql = "SELECT * FROM transfer WHERE STN='$STN'; ";
      $ress = mysqli_query($conn, $sql);
      $req_id = mysqli_fetch_array($ress);

      $req_id_y = $req_id['TRA_ID'];
      $query="UPDATE asset SET TRANSFERID='$req_id_y' WHERE SERIALNO='$SERIAL'; ";
      $data=mysqli_query($conn, $query);
      if($data)
      {
        echo '<script>alert("Transfer Details Updated!");</script>';
      }
      else
      {
         echo '<script>alert("Transfer Details Not Updated!");</script>';
      }
    }
?>
