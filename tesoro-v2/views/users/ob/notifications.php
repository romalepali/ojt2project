<?php
include ("config/ob_verify.php");

$array=array();
$rows=array();

$list_query = "SELECT * FROM jo_notifications WHERE user_id=".$_SESSION['user_id']." AND notify='Yes'";
$list_result=mysqli_query($conn,$list_query);
if(mysqli_num_rows($list_result)>0){
	while($list=mysqli_fetch_assoc($list_result)){
		$data['title'] = "You have notifications!";
		$data['msg'] = $list['message']." J.O. No.: ".$list['job_no'];
		$data['icon'] = 'images/notify.png';
		$data['url'] = 'all_jobs.php?view='.$list['job_no'];
		$rows[] = $data;
	}
}
$array['notif'] = $rows;
echo json_encode($array);
?>