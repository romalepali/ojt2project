<?php  
	include('TIMS_verify.php');
	$date = date('Y-m-d');
	if(isset($_POST['view'])){
		$query = "SELECT a.*,b.kind_of_job,c.status_name FROM jobbings a LEFT JOIN jobbings_kinds b  ON a.job_kind=b.id INNER JOIN jobbings_statuses c ON a.current_status = c.id WHERE b.type!=2 ORDER BY a.date_added DESC ";
		$result = mysqli_query($conn, $query);
		$output = '';
		$stat = '';
		$ifDisplay = 0;

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$ddate = strtotime($row['due_date']);
				$cdate = strtotime($date);
				$timeleft = $ddate - $cdate;
				$days = round((($timeleft/24)/60)/60);
				$stat = $row["current_status"];

				if($ddate!=0){
					if($days<0 && $stat !=5){
						$output .= '<a class="dropdown-item order lvl-1" href="javascript: void" onclick="view('.$row["id"].')">
							<strong>J.O.# '.$row["job_no"].'</strong><br>
							<small><b><em>'.$row["customer"].'</em></b></small><br>
							<small><b>Kind of Job: </b>&nbsp;<em>'.$row["kind_of_job"].'</em></small> <br>
							<small><b>Duedate: </b>&nbsp;<em>'.date("F j, Y", strtotime($row["due_date"])).'</em></small><br>
						</a>';
						$ifDisplay = 1;
					}
				}
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