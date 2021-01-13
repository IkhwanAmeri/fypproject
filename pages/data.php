<?php session_start();

include('db.php');
	
	$year=date("Y");
	$id=$_SESSION['id'];
	$query = mysqli_query($con,"select *,SUM(total) as amount,DATE_FORMAT(date_added,'%b') as month from sales where YEAR(date_added)='$year' and user_id='$id' group by MONTH(date_added)") or die(mysqli_error($con));

	$category = array();

	$series1 = array();
	$series1['name'] = 'Monthly Sales(RM)';

	while($r = mysqli_fetch_assoc($query)) {
		
	    $category['name'][] =$r['month'];
	    $category['data'][] =$r['month'];
	    $series1['data'][] = $r['amount'];
}

$result = array();
array_push($result,$category);
array_push($result,$series1);

print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);

?> 
