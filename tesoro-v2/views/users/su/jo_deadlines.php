<?php 
	include('config/su_verify.php');
	$date = date('Y-m-d');
	$ddcount = 0;

	if(isset($_POST['view'])){		
		$query = "SELECT a.job_no,a.description,a.deadline_on,b.job_kind FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id ORDER BY a.deadline_on DESC";
		$result = mysqli_query($conn, $query);
		$output = '';

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$query2 = "SELECT a.status AS 'id',b.status FROM jo_status a LEFT JOIN jos_list b ON a.status=b.id WHERE a.job_no=".$row['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
				$result2 = mysqli_query($conn, $query2);
				
				$ddate = strtotime($row['deadline_on']);
				$cdate = strtotime($date);
				$timeleft = $ddate - $cdate;
				$days = round((($timeleft/24)/60)/60);
				
				if(mysqli_num_rows($result2) > 0){
					while($row2 = mysqli_fetch_array($result2)){
						if($row2['id']==9 && $row['deadline_on']!=NULL){}
						else if($row2['id']==9 && $row['deadline_on']==NULL){}
						else if($row2['id']==10 && $row['deadline_on']!=NULL){}
						else if($row2['id']==10 && $row['deadline_on']==NULL){}
						else{
							if($days > 20){
								$output .= '
									<a class="dropdown-item text-primary" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>'.$days.' day/s remaining</em></small><br>
									</a>
								';
								$ddcount++;
							}else if ($days <=20 && $days > 10) {
								$output .= '
									<a class="dropdown-item text-success" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>'.$days.' day/s remaining</em></small><br>
									</a>
								';
								$ddcount++;
							}else if ($days <=10 && $days > 5) {
								$output .= '
									<a class="dropdown-item text-warning" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>'.$days.' day/s remaining</em></small><br>
									</a>
								';
								$ddcount++;
							}else if ($days <=5 && $days > 1) {
								$output .= '
									<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>'.$days.' day/s remaining</em></small><br>
									</a>
								';
								$ddcount++;
							}else if ($days==1){
								$output .= '
									<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>Tomorrow</em></small><br>
									</a>
								';
								$ddcount++;
							}else if ($days==0){
								$output .= '
									<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>Today</em></small><br>
									</a>
								';
								$ddcount++;
							}else if ($days==-1){
								$output .= '
									<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>Yesterday</em></small><br>
									</a>
								';
								$ddcount++;
							}else if ($days < -1 && $row['deadline_on']!=NULL){
								$output .= '
									<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
										<strong>J.O.# '.$row["job_no"].'</strong><br>
										<small><em>'.$row["job_kind"].'</em></small><br>
										<small><em>'.abs($days).' Day/s Late</em></small><br>
									</a>
								';
								$ddcount++;
							}
						}
					}
				}else{
					if($days > 20){
						$output .= '
							<a class="dropdown-item text-primary" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days <=20 && $days > 10) {
						$output .= '
							<a class="dropdown-item text-success" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days <=10 && $days > 5) {
						$output .= '
							<a class="dropdown-item text-warning" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days <=5 && $days > 1) {
						$output .= '
							<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days==1){
						$output .= '
							<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>Tomorrow</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days==0){
						$output .= '
							<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>Today</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days==-1){
						$output .= '
							<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>Yesterday</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days < -1 && $row['deadline_on']!=NULL){
						$output .= '
							<a class="dropdown-item text-danger" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["job_kind"].'</em></small><br>
								<small><em>'.abs($days).' Day/s Late</em></small><br>
							</a>
						';
						$ddcount++;
					}
				}
			}
		}else{
			$ddcount = 0;
		}

		if($ddcount <= 0){
			$output .= '
				<a class="dropdown-item" href="#" style="color: gray;">
					<strong>No Deadlines Yet!</strong><br>
				</a>
			';
		}
		
		$count = $ddcount;

		$data = array(
			'notification' => $output,
			'unseen_notification' => $count
		);

		echo json_encode($data);
	}
?>