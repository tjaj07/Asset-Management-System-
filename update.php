 <style media="screen">
 	.qw:hover{
 		text-decoration:none;
		font-weight:bold;
 	}
	td{
		line-height:25px;
	}
 </style>

<?php
include_once "include/super_user_header.php";
if (isset($_SESSION['u_uid'])){
include_once 'include/dbh.inc.php';

$query2 = "SELECT * FROM users  ";
$data2 = mysqli_query($conn , $query2);
$total=mysqli_num_rows($data2);
if($total!=0)
{
?>
  <h5 style="background-color:#303030; color:white; text-align:center; margin:0;">User Details</h5>
  <br>
  <table id="self"  class="table-hover">
		<tr>
			<th>USER NAME</th>
			<th>PASSWORD</th>
			<th>USER TYPE</th>
			<th colspan ='2'> OPERATIONS </th>
		</tr>
<?php
  $usertype = "";
	while($result = mysqli_fetch_assoc($data2)){
    if($result['user_type']==1 ){
	     $usertype="User";
    }elseif($result['user_type']==2){
		   $usertype = "Admin";
	  }elseif($result['user_type']==3){
	     $usertype = "Super User";
    }

    echo "<tr>
			<td>".$result['user_id']."</td>
			<td>".$result['user_pwd']."</td>
			<td>".$usertype."</td>

			<td><a class='qw' href='update_user.php?un=$result[user_id]&pass=$result[user_pwd]&n=$usertype'>Edit</a></td>
			<td><a class='qw' href='deleteuser.php?un=$result[user_id]' onclick='return checkdel()'>Remove</a></td>
		</tr>";
	}
	echo"<h6 style='margin-left:10px;'>Number Of Records  = ".$total."<h6>";
}
}
?>

<script>
function checkdel()
{
return	confirm("Are you sure you want to delete this entery");
}
</script>
