<?php
	include('config/ob_verify.php');

	$check_query = "SELECT * FROM jo WHERE artist=".$_SESSION['user_id'];
	$check_result = mysqli_query($conn,$check_query);
	if(mysqli_num_rows($check_result)>0){
		while($check=mysqli_fetch_assoc($check_result)){
			$stat_query="SELECT a.*,b.status FROM jo_status a LEFT JOIN jos_list b ON a.status=b.id WHERE a.job_no=".$check['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
			$stat_result=mysqli_query($conn,$stat_query);
			if(mysqli_num_rows($stat_result)>0){
				while($stat=mysqli_fetch_assoc($stat_result)){
					if($stat['status']>=1 && $stat['status']<=8){
						if($check['deadline_on']!=NULL){
							$jon = $check['job_no'];
							$user = $_SESSION['user_id'];
							$message = "deadline on ".date('F d, Y',strtotime($check['deadline_on']))." for";

							$duple_query="SELECT * FROM jo_notifications WHERE BINARY (job_no='$jon' AND user_id='$user' AND message='$message' AND DATE(published_on)=DATE(NOW()))";
							$duple_result=mysqli_query($conn,$duple_query);
							$duple=mysqli_num_rows($duple_result);

							if($duple==0){
								$notif_query = "INSERT INTO jo_notifications (job_no,user_id,message,published_on) VALUES ('$jon','$user','$message',NOW())";
								mysqli_query($conn,$notif_query);
							}
						}
					}
				}
			}else{
				if($check['deadline_on']!=NULL){
					$jon = $check['job_no'];
					$user = $_SESSION['user_id'];
					$message = "deadline on ".date('F d, Y',strtotime($check['deadline_on']))." for";

					$duple_query="SELECT * FROM jo_notifications WHERE BINARY (job_no='$jon' AND user_id='$user' AND message='$message' AND DATE(published_on)=DATE(NOW()))";
					$duple_result=mysqli_query($conn,$duple_query);
					$duple=mysqli_num_rows($duple_result);

					if($duple==0){
						$notif_query = "INSERT INTO jo_notifications (job_no,user_id,message,published_on) VALUES ('$jon','$user','$message',NOW())";
						mysqli_query($conn,$notif_query);
					}
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<body>
    <?php header("location: dashboard.php");?>
</body>
</html>
