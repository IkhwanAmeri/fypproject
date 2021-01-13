<?php
//fetch.php
if(isset($_POST["id"]))
{
	include('db.php');
 $query=mysqli_query($con,"select * from customer where cust_id='".$_POST["id"]."'")or die(mysqli_error($con));
 while($row = mysqli_fetch_assoc($query))
 {
  $data["id"] = $_POST["id"];
  $data["name"] = $row["cust_name"];
  $data["cont"] = $row["cust_cont"];
  $data["address"] = $row["address"];
  $data["city"] = $row["city"];
  $data["state"] = $row["state"];
  $data["poscode"] = $row["poscode"];
 }

 echo json_encode($data);
}
?>