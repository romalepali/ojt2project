<?php  
	include('config/os_verify.php');
	$date = date('Y-m-d');
	$output = '';
	$ifDisplay = 0;

	if(isset($_POST['view'])){
		$query = "SELECT a.*,b.job_kind AS 'kind' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id WHERE b.job_type=2 ORDER BY a.encoded_on DESC";
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){				
				$ddate = strtotime($row['deadline_on']);
				$cdate = strtotime($date);
				$timeleft = $ddate - $cdate;
				$days = round((($timeleft/24)/60)/60);
				
				$query2 = "SELECT a.status AS 'id',b.status AS 'stat' FROM jo_status a LEFT JOIN jos_list b ON a.status=b.id WHERE job_no=".$row['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
				$result2 = mysqli_query($conn, $query2);
				
				if(mysqli_num_rows($result2)>0){
					while($row2 = mysqli_fetch_array($result2)){
						if($ddate!=NULL){
							if($days<0 && ($row2['id']!=9 || $row2['id']!=10)){
								$output .= '<a class="dropdown-item order lvl-1" href="javascript: void" onclick="view_d('.$row["job_no"].')">
									<strong>J.O.# '.$row["job_no"].'</strong><br>
									<small><b><em>'.$row["customer"].'</em></b></small><br>
									<small><b>Job Kind: </b>&nbsp;<em>'.$row["kind"].'</em></small> <br>
									<small><b>Deadline: </b>&nbsp;<em>'.date("F d, Y", strtotime($row["deadline_on"])).'</em></small><br>
								</a>';
								$ifDisplay = 1;
							}
						}
					}
				}else{
					if($ddate!=NULL){
						if($days<0 && ($row2['id']!=9 || $row2['id']!=10)){
							$output .= '<a class="dropdown-item order lvl-1" href="javascript: void" onclick="view_d('.$row["job_no"].')">
								<strong>J.O.# '.$row["job_no"].'</strong><br>
								<small><b><em>'.$row["customer"].'</em></b></small><br>
								<small><b>Job Kind: </b>&nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small><b>Deadline: </b>&nbsp;<em>'.date("F d, Y", strtotime($row["deadline_on"])).'</em></small><br>
							</a>';
							$ifDisplay = 1;
						}
					}
				}
			}
		}
		else{
			$ifDisplay = 0;
		}

		if($ifDisplay==0){
			$output .= '<a class="dropdown-item order lvl-7" href="javascript: void">
				<strong>None as of Now</strong>
			</a>';
		}

		$data = array(
			'notification' => $output
		);

		echo json_encode($data);
	}
?>