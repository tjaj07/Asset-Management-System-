<?php
	session_start();
	include_once 'include/dbh.inc.php';
  error_reporting(0);

	$query ="SELECT DISTINCT MAKE FROM category WHERE CAT = '" . $_POST["CATEGORY"] . "'";
	$results = mysqli_query($conn,$query);
?>
	<option value="">Select Make</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["MAKE"]; ?>"><?php echo $rs["MAKE"]; ?></option>
<?php
}
?>
