<?php 
	include('TIMS_verify.php');
	$date = date('Y-m-d');
	$ddcount = 0;
	if(isset($_POST['view'])){		
		$query = "SELECT a.*,b.kind_of_job FROM jobbings a LEFT JOIN jobbings_kinds b  ON a.job_kind=b.id WHERE b.type=2 ORDER BY a.due_date ASC";
		$result = mysqli_query($conn, $query);
		$output = '';

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$ddate = strtotime($row['due_date']);
				$cdate = strtotime($date);
				$timeleft = $ddate - $cdate;
				$days = round((($timeleft/24)/60)/60);

				if($row['current_status']==5 && round(((strtotime($row['due_date'])/24)/60)/60)!=0){}
				else if($row['current_status']==5 && round(((strtotime($row['due_date'])/24)/60)/60)==0){}
				else if($row['current_status']==7 && round(((strtotime($row['due_date'])/24)/60)/60)!=0){}
				else if($row['current_status']==7 && round(((strtotime($row['due_date'])/24)/60)/60)==0){}
				else{
					if($days > 20){
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color:black">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}
					else if ($days <=20 && $days > 10) {
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color: gold;">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days <=10 && $days > 5) {
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color: orange;">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days <=5 && $days > 1) {
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color: red;">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>'.$days.' day/s remaining</em></small><br>
							</a>
						';
						$ddcount++;
					}else if ($days==1){
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color: red;">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>Tomorrow</em></small><br>
							</a>
						';
						$ddcount++;
					}
					else if ($days==0){
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color: red;">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>Today</em></small><br>
							</a>
						';
						$ddcount++;
					}
					else if ($days==-1){
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color: red;">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>Yesterday</em></small><br>
							</a>
						';
						$ddcount++;
					}
					else if ($days < -1 && round(((strtotime($row['due_date'])/24)/60)/60)!=0){
						$output .= '
							<a class="dropdown-item" href="javascript: void" onclick="view('.$row["id"].')" style="color: red;">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><em>'.$row["kind_of_job"].'</em></small><br>
								<small><em>'.abs($days).' Day/s Late</em></small><br>
							</a>
						';
						$ddcount++;
					}
				}
			}
		}
		else{
			$ddcount = 0;
		}

		if($ddcount <= 0){
			$output .= '
				<a class="dropdown-item" href="#" style="color: gray;">
					<strong>No Due Dates Yet!</strong><br>
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