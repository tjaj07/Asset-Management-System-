<?php
	session_start();
	include_once 'include/dbh.inc.php';
  error_reporting(0);

	$query ="SELECT DISTINCT MODEL FROM category WHERE MAKE = '" . $_POST["MAKE"] . "'";
	$results = mysqli_query($conn,$query);
?>
	<option value="">Select Model</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["MODEL"]; ?>"><?php echo $rs["MODEL"]; ?></option>
<?php
}
?>
