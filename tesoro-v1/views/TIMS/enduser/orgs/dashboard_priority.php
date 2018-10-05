<?php  
	include('TIMS_verify.php');
	$date = date('Y-m-d');
	if(isset($_POST['view'])){		
		$query = "SELECT a.*,b.kind_of_job,c.status_name FROM jobbings a LEFT JOIN jobbings_kinds b  ON a.job_kind=b.id INNER JOIN jobbings_statuses c ON a.current_status = c.id  WHERE YEAR(a.due_date) != 0 AND b.type=2 ORDER BY a.due_date ASC ";
		$result = mysqli_query($conn, $query);
		$output = '';
		$stat = '';
		$ifDisplay = 0;
		$ddateDisplay ='';
		$res=0;

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$ddate = strtotime($row['due_date']);
				$cdate = strtotime($date);
				$timeleft = $ddate - $cdate;
				$days = round((($timeleft/24)/60)/60) ;
				$stat = $row["current_status"];

				if($stat!=5&&$stat!=7){
					if($ddate!=0){
						if($days >20){
							$output .= '<a class="dropdown-item order lvl-4" href="javascript:void" onclick="view('.$row["id"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
						else if ($days <=20 && $days > 10) {
							$output .= '<a class="dropdown-item order lvl-3" href="javascript:void" onclick="view('.$row["id"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
						else if ($days <=10 && $days >5) {
							$output .= '<a class="dropdown-item order lvl-2" href="javascript:void" onclick="view('.$row["id"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
						else if ($days <=5 && $days >1) {
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view('.$row["id"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
						else if ($days == 1) {
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view('.$row["id"].')"> 
								<img style="float:right; margin-right:-15px;" src="images/alert.gif" width="80px">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>Tomorrow!</em></b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
						else if ($days==0){
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view('.$row["id"].')">
								<img style="float:right; margin-right:-15px;" src="images/alert.gif" width="80px">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>Today!</em><b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
						else if ($days==-1){
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view('.$row["id"].')">
								<img style="float:right; margin-right:-15px;" src="images/alert.gif" width="80px">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>Yesterday!</em><b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
						else if ($days <-1) {
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view('.$row["id"].')">
								<img style="float:right; margin-right:-15px;" src="images/alert.gif" width="80px">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Kind of Job: &nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
								<small>Current Status: &nbsp;<em>'.$row["status_name"].'</em></small><br>
								<small><b><em>'.abs($days).' day/s late!</em><b></small>
							</a>';
							$ifDisplay = 1;
							$res++;
						}
					}//filter unset duedate
				}//Filter stat 
			}
		}
		else{
			$ifDisplay = 0;
		}

		if($ifDisplay==0){
			$output .= '<a class="dropdown-item order lvl-7" href="javascript: void">
				<strong>None as of now</strong>
			</a>';
		}

		$data = array(
			'notification' => $output
		);

		echo json_encode($data);
	}
?>