<?php  
	include('config/ob_verify.php');
	$month = date('n');
	$date = date('Y-m-d');
	$output = '';
	$ifDisplay = 0;

	if(isset($_POST['view'])){
		$query = "SELECT a.*,b.job_kind AS 'kind' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id WHERE MONTH(a.encoded_on) = ('$month') AND b.job_type!=2 ORDER BY a.received_on DESC";
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result)){
				$query2 = "SELECT a.status AS 'id',b.status AS 'stat' FROM jo_status a LEFT JOIN jos_list b ON a.status=b.id WHERE job_no=".$row['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
				$result2 = mysqli_query($conn, $query2);
				
				$ddate = strtotime($row['deadline_on']);
				$cdate = strtotime($date);
				$timeleft = $ddate - $cdate;
				$days = round((($timeleft/24)/60)/60);
				
				if(mysqli_num_rows($result2)>0){
					while($row2 = mysqli_fetch_array($result2)){
						if ($row2['id']==9){
							if($ddate==NULL){
								$output .= '<a class="dropdown-item order lvl-5" href="javascript:void" onclick="view_d('.$row["job_no"].')">
									<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
									<small><b>'.$row["customer"].'</b></small><br>
									<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small><br>
									<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
									<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
									<small><em><b>Deadline: N/A</b></em></small>
								</a>';						
								$ifDisplay = 1;
							}else{
								$output .= '<a class="dropdown-item order lvl-5" href="javascript:void" onclick="view_d('.$row["job_no"].')">
									<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
									<small><b>'.$row["customer"].'</b></small><br>
									<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
									<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
									<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
									<small><em><b>'.date('F d, Y',strtotime($row["deadline_on"])).'</b></em></small>
								</a>';						
								$ifDisplay = 1;
							}
						}else if($row2['stat']==7){
							if($ddate==NULL){
								$output .= '<a class="dropdown-item order lvl-6" href="javascript:void" onclick="view_d('.$row["job_no"].')">
									<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
									<small><b>'.$row["customer"].'</b></small><br>
									<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
									<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
									<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
									<small><em><b>Deadline: N/A</b></em></small>
								</a>';
							}else {
								$output .= '<a class="dropdown-item order lvl-6" href="javascript:void" onclick="view_d('.$row["job_no"].')">
									<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
									<small><b>'.$row["customer"].'</b></small><br>
									<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
									<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
									<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
									<small><em><b>'.date('F d, Y',strtotime($row["deadline_on"])).'</b></em></small>
								</a>';
							}
							$ifDisplay = 1;
						}else{
							if($ddate!=NULL){
								if($days >20){
									$output .= '<a class="dropdown-item order lvl-4" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>'.$days.' day/s remaining</em></b></small>
									</a>';						
									$ifDisplay = 1;
								}else if ($days <=20 && $days > 10) {
									$output .= '<a class="dropdown-item order lvl-3" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>'.$days.' day/s remaining</em></b></small>
									</a>';
									$ifDisplay = 1;
								}else if ($days <=10 && $days >5) {
									$output .= '<a class="dropdown-item order lvl-2" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>'.$days.' day/s remaining</em></b></small>
									</a>';
									$ifDisplay = 1;
								}else if ($days <=5 && $days >1) {
									$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>'.$days.' day/s remaining</em></b></small>
									</a>';
									$ifDisplay = 1;
								}else if ($days==1){
									$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>Deadline: Tomorrow!</em><b></small>
									</a>';
									$ifDisplay = 1;
								}else if ($days==0){
									$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>Deadline: Today!</em><b></small>
									</a>';
									$ifDisplay = 1;
								}else if ($days==-1){
									$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>Deadline: Yesterday!</em><b></small>
									</a>';
									$ifDisplay = 1;
								}else if ($days <-1) {
									$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
										<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
										<small><b>'.$row["customer"].'</b></small><br>
										<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
										<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
										<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
										<small><b><em>'.abs($days).' day/s late!</em><b></small>
									</a>';
									$ifDisplay = 1;
								}
							}else if ($ddate==NULL){
								$output .= '<a class="dropdown-item order lvl-4" href="javascript:void" onclick="view_d('.$row["job_no"].')">
									<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
									<small><b>'.$row["customer"].'</b></small><br>
									<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
									<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
									<small>Current Status: &nbsp;<em>'.$row2["stat"].'</em></small><br>
									<small><b><em>Deadline: N/A</em></b></small>
								</a>';
								$ifDisplay = 1;
								$ddateDisplay = '';
							}
						}
					}
				}else{
					if($ddate!=NULL){
						if($days >20){
							$output .= '<a class="dropdown-item order lvl-4" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';						
							$ifDisplay = 1;
						}else if ($days <=20 && $days > 10) {
							$output .= '<a class="dropdown-item order lvl-3" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';
							$ifDisplay = 1;
						}else if ($days <=10 && $days >5) {
							$output .= '<a class="dropdown-item order lvl-2" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';
							$ifDisplay = 1;
						}else if ($days <=5 && $days >1) {
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>'.$days.' day/s remaining</em></b></small>
							</a>';
							$ifDisplay = 1;
						}else if ($days==1){
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>Deadline: Tomorrow!</em><b></small>
							</a>';
							$ifDisplay = 1;
						}else if ($days==0){
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>Deadline: Today!</em><b></small>
							</a>';
							$ifDisplay = 1;
						}else if ($days==-1){
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>Deadline: Yesterday!</em><b></small>
							</a>';
							$ifDisplay = 1;
						}else if ($days <-1) {
							$output .= '<a class="dropdown-item order lvl-1" href="javascript:void" onclick="view_d('.$row["job_no"].')">
								<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
								<small><b>'.$row["customer"].'</b></small><br>
								<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
								<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
								<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
								<small><b><em>'.abs($days).' day/s late!</em><b></small>
							</a>';
							$ifDisplay = 1;
						}
					}else if ($ddate==NULL){
						$output .= '<a class="dropdown-item order lvl-4" href="javascript:void" onclick="view_d('.$row["job_no"].')">
							<strong style="font-size: 16px;">J.O.# '.$row["job_no"].'</strong><br>
							<small><b>'.$row["customer"].'</b></small><br>
							<small>Job Kind: &nbsp;<em>'.$row["kind"].'</em></small> <br>
							<small>Received On: &nbsp;<em>'.date("F d, Y", strtotime($row["received_on"])).'</small><br>
							<small>Current Status: &nbsp;<em>No Updates Yet</em></small><br>
							<small><b><em>Deadline: N/A</em></b></small>
						</a>';
						$ifDisplay = 1;
					}
				}
			}
		}else{
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