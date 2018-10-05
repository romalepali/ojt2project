<?php
	if(is_numeric($_GET['view']) && $_GET['view']!=0){
		$query0="SELECT a.job_no AS 'jon',a.due_date AS 'dd',a.current_status AS 'stat', b.type AS 'type' FROM jobbings a INNER JOIN jobbings_kinds b ON a.job_kind=b.id WHERE a.id=".$_GET['view'];

		$result_set0=mysqli_query($conn,$query0);
		if(mysqli_num_rows($result_set0)>0){
			$row0=mysqli_fetch_array($result_set0);
			$jo_date = strtotime($row0['dd']);
			$cu_date = strtotime(date('Y-m-d'));
			$diff = $jo_date - $cu_date;
			$remain = round((($diff/24)/60)/60);
			?>
			<div class="row">
				<div class="col-6">
					<h4 style="margin: 10px 0px;">J.O. No.: <?php echo $row0['jon'];?></h4>
					<?php
						if($row0['stat']==5 && round((($jo_date/24)/60)/60)!=0){
							?>
								<h6 style="color: green; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date)." (Out)";?></h6>
							<?php
						}
						else if($row0['stat']==5 && round((($jo_date/24)/60)/60)==0){
							?>
								<h6 style="color: green; margin-top: -10px; font-size: 13px;">Due Date: <?php echo "Not Set (Out)";?></h6>
							<?php
						}
						else if($row0['stat']==7 && round((($jo_date/24)/60)/60)!=0){
							?>
								<h6 style="color: gray; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date)." (Cancelled)";?></h6>
							<?php
						}
						else if($row0['stat']==7 && round((($jo_date/24)/60)/60)==0){
							?>
								<h6 style="color: gray; margin-top: -10px; font-size: 13px;">Due Date: <?php echo "Not Set (Cancelled)";?></h6>
							<?php
						}
						else{
							if($remain > 20){
								?>
									<h6 style="color: black; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></h6>
								<?php
							}else if ($remain <=20 && $remain > 10) {
								?>
									<h6 style="color: gold; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></h6>
								<?php
							}else if ($remain <=10 && $remain > 5) {
								?>
									<h6 style="color: orange; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></h6>
								<?php
							}else if ($remain <=5 && $remain > 1) {
								?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></h6>
								<?php
							}else if ($remain == 1) {
								 ?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date);?> (Tomorrow)</h6>
								<?php
							}else if ($remain == 0) {
								 ?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date);?> (Today)</h6>
								<?php
							}else if ($remain == -1){
								?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">Due Date: <?php echo date("F d, Y",$jo_date);?> (Yesterday)</h6>
								<?php
							}else if ($remain < -1 && round((($jo_date/24)/60)/60)!=0){
								?>
									<h6 style="color: red; margin-top: -10px; font-size: 12px;">Due Date: <?php echo date("F d, Y",$jo_date)." (".abs($remain)." day/s late)";?></h6>
								<?php
							}else{
								?>
									<h6 style="color: gray; margin-top: -10px; font-size: 12px;">Due Date: Not Set</h6>
								<?php
							}
						}
					?>              
				</div>
				<div class="col-6">
					<button class="btn btn-secondary" onclick="more('<?php echo $_GET['view']; ?>')" title="View Previous Status" style="font-size: 12px; height:32px; float: right; margin: 5px 0px 5px 5px;"><img src="images/more.png" width="12px" style="margin: -3px -3px 0px -3px;"></button>
					<button class="btn btn-secondary" onclick="remove('<?php echo $_GET['view']; ?>')" title="Remove Jobbing" style="font-size: 12px; height:32px; float: right; margin: 5px 0px 5px 5px;"><img src="images/delete.png" width="12px" style="margin: -3px -3px 0px -3px;"></button>
					<button class="btn btn-secondary" onclick="update('<?php echo $_GET['view']; ?>')" title="Update Status" style="font-size: 12px; height:32px; float: right; margin: 5px 0px 5px 5px;"><img src="images/update.png" width="12px" style="margin: -3px -3px 0px -3px;"></button>
					<button class="btn btn-secondary" onclick="edit('<?php echo $_GET['view']; ?>')" title="Edit Info" style="font-size: 12px; height:32px; float: right; margin: 5px 0px 5px 5px;"><img src="images/edit.png" width="12px" style="margin: -3px -3px 0px -3px;"></button>
				</div>
			</div>
			<div style="max-height: 75vh; overflow-x: hidden; padding: 0px 10px">
				<?php if($row0['type']==1){
					//Big Jobs Only
					include ('view/view_big.php');
				}
				else if($row0['type']==2){
					//Small Jobs Only
					include ('view/view_small.php');
				}else if($row0['type']==3){
					//Small Jobs Only
					include ('view/view_big_small.php');
				}?>
			</div>
		<?php
		} else {?>
			<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
				Sorry, job does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
			</div>
		<?php
		} 
	}else {?>
		<div style="max-height: 75vh; overflow-x: hidden; padding: 20px 10px">
			Sorry, job does not exist! <a class="btn btn-primary" href="<?php echo $_SESSION['page'];?>">Back</a>
		</div>
	<?php
	}
?>