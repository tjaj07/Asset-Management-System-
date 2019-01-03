<?php
    session_start();
    include_once 'include/dbh.inc.php';
    error_reporting(0);
    $query = "SELECT DISTINCT OFFICEADD FROM location WHERE CITY = '".$_POST["CITY"]."'";
    $results = mysqli_query($conn,$query);
?>
    <option value="">Select Location</option>
<?php
    while($rs=$results->fetch_assoc()) {
?>
    <option value="<?php echo $rs['OFFICEADD']; ?>"><?php echo $rs["OFFICEADD"]; ?></option>
<?php
}
?>
