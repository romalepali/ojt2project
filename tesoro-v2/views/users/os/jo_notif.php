<?php 
	include('config/os_verify.php');
	$date = date('Y-m-d');
	$ddcount = 0;

	if(isset($_POST['view'])){
		if($_POST["view"] != ''){
			$update_query = "UPDATE jo_notifications SET seen='Yes' WHERE seen='No' AND user_id=".$_SESSION['user_id'];
			mysqli_query($conn, $update_query);
		}
		
		$query = "SELECT * FROM jo_notifications WHERE (status='unread' || DATE(published_on)=DATE(NOW())) AND user_id=".$_SESSION['user_id']." ORDER BY published_on DESC";
		$result = mysqli_query($conn, $query);
		$output = '';

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				if($row['status']=='unread'){
					$output .= '
						<a class="dropdown-item bg-light";" href="javascript: void" onclick="view_d('.$row["job_no"].')" style="color:black">
							<small><em>'.$row["message"].'</em></small><br>
							<strong>J.O.# '.$row["job_no"].'</strong><br>
							<small><em>'.date('F d, Y h:i A',strtotime($row["published_on"])).'</em></small><br>
						</a>
					';
				}else{
					$output .= '
						<a class="dropdown-item" href="javascript: void" onclick="view_d('.$row["job_no"].')" style="color:black">
							<small><em>'.$row["message"].'</em></small><br>
							<strong>J.O.# '.$row["job_no"].'</strong><br>
							<small><em>'.date('F d, Y h:i A',strtotime($row["published_on"])).'</em></small><br>
						</a>
					';
				}
				$ddcount++;
			}
		}else{
			$ddcount = 0;
		}

		if($ddcount <= 0){
			$output .= '
				<a class="dropdown-item" href="#" style="color: gray;">
					<strong>No Notifications Yet!</strong><br>
				</a>
			';
		}
		
		$count_query = "SELECT * FROM jo_notifications WHERE user_id=".$_SESSION['user_id']." AND seen='No' ORDER BY published_on DESC";
		$count_result = mysqli_query($conn, $count_query);
		$count = mysqli_num_rows($count_result);

		$data = array(
			'notification' => $output,
			'unseen_notification' => $count
		);

		echo json_encode($data);
	}
?>