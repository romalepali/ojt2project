<?php
	if(is_numeric($_GET['view']) && $_GET['view']!=0){
		$test_query="SELECT a.job_no,a.deadline_on,b.job_type FROM jo a INNER JOIN jo_kinds b ON a.job_kind=b.id WHERE a.job_no=".$_GET['view'];

		$test_result=mysqli_query($conn,$test_query);
		if(mysqli_num_rows($test_result)>0){
			$test=mysqli_fetch_array($test_result);
			$jo_date = strtotime($test['deadline_on']);
			$cu_date = strtotime(date('Y-m-d'));
			$diff = $jo_date - $cu_date;
			$remain = round((($diff/24)/60)/60);?>
			<title>J.O. No.: <?php echo $_GET['view'];?> | Basic Information</title>
			<div class="row">
				<div class="col-6">
					<h4 style="margin: 10px 0px;">J.O. No.: <?php echo $test['job_no'];?></h4><?php
					if($jo_date!=NULL){
						$stat_query="SELECT a.id,b.status FROM jo_status a INNER JOIN jos_list b ON a.status=b.id WHERE a.job_no=".$test['job_no']." ORDER BY a.updated_on DESC LIMIT 1";

						$stat_result=mysqli_query($conn,$stat_query);
						if(mysqli_num_rows($stat_result)>0){
							$stat=mysqli_fetch_array($stat_result);

							if($stat['status']=='Out'){?>
								<h6 style="color: green; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date);?></strong>
									<br>
									Current Status: <strong><?php echo $stat['status'];?></strong>
								</h6><?php
							}else if($stat['status']=='Cancelled'){?>
								<h6 style="color: gray; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date);?></strong>
									<br>
									Current Status: <strong><?php echo $stat['status'];?></strong>
								</h6><?php
							}else{
								if($remain>20){?>
									<h6 style="color: black; margin-top: -10px; font-size: 13px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}else if($remain<=20 && $remain>10){?>
									<h6 style="color: gold; margin-top: -10px; font-size: 13px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}else if($remain<=10 && $remain>5){?>
									<h6 style="color: orange; margin-top: -10px; font-size: 13px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}else if($remain<=5 && $remain>1){?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}else if($remain==1){?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date);?> (Tomorrow)</strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}else if($remain==0){?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date);?> (Today)</strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}else if($remain==-1){?>
									<h6 style="color: red; margin-top: -10px; font-size: 13px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date);?> (Yesterday)</strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}else if ($remain<-1 && round((($jo_date/24)/60)/60)!=0){?>
									<h6 style="color: red; margin-top: -10px; font-size: 12px;">
										Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".abs($remain)." day/s late)";?></strong>
										<br>
										Current Status: <strong><?php echo $stat['status'];?></strong>
									</h6><?php
								}
							}
						}else{
							if($remain>20){?>
								<h6 style="color: black; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}else if($remain<=20 && $remain>10){?>
								<h6 style="color: gold; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}else if($remain<=10 && $remain>5){?>
								<h6 style="color: orange; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}else if($remain<=5 && $remain>1){?>
								<h6 style="color: red; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".$remain." day/s remaining)";?></strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}else if($remain==1){?>
								<h6 style="color: red; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date);?> (Tomorrow)</strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}else if($remain==0){?>
								<h6 style="color: red; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date);?> (Today)</strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}else if($remain==-1){?>
								<h6 style="color: red; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date);?> (Yesterday)</strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}else if ($remain<-1 && round((($jo_date/24)/60)/60)!=0){?>
								<h6 style="color: red; margin-top: -10px; font-size: 12px;">
									Deadline On: <strong><?php echo date("F d, Y",$jo_date)." (".abs($remain)." day/s late)";?></strong>
									<br>
									Current Status: <strong>No Updates Yet</strong>
								</h6><?php
							}
						}
					}else{
						$stat_query="SELECT a.id,b.status FROM jo_status a INNER JOIN jos_list b ON a.status=b.id WHERE a.job_no=".$test['job_no']." ORDER BY a.updated_on DESC LIMIT 1";

						$stat_result=mysqli_query($conn,$stat_query);
						if(mysqli_num_rows($stat_result)>0){
							$stat=mysqli_fetch_array($stat_result);

							if($stat['status']=='Out'){?>
								<h6 style="color: green; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo "Not Set";?></strong>
									<br>
									Current Status: <strong><?php echo $stat['status'];?></strong>
								</h6><?php
							}else if($stat['status']=='Cancelled'){?>
								<h6 style="color: gray; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo "Not Set";?></strong>
									<br>
									Current Status: <strong><?php echo $stat['status'];?></strong>
								</h6><?php
							}else{?>
								<h6 style="color: black; margin-top: -10px; font-size: 13px;">
									Deadline On: <strong><?php echo "Not Set";?></strong>
									<br>
									Current Status: <strong><?php echo $stat['status'];?></strong>
								</h6><?php								
							}
						}else{?>
							<h6 style="color: black; margin-top: -10px; font-size: 13px;">
								Deadline On: <strong>Not Set</strong>
								<br>
								Current Status: <strong>No Updates Yet</strong>
							</h6><?php
						}
					}?>              
				</div>
			</div>
			<div style="padding: 0px 10px">
				<?php if($test['job_type']==1){
					//Big Jobs Only
					include ('view/view_big.php');
				}else if($test['job_type']==2){
					//Small Jobs Only
					include ('view/view_small.php');
				}else if($test['job_type']==3){
					//Small Jobs Only
					include ('view/view_big_small.php');
				}?>
			</div><?php
		}else{?>
			<div style="padding: 20px 10px">
				Sorry, job does not exist! <a class="btn btn-primary" href="index.php">Back</a>
			</div><?php
		} 
	}else{?>
		<div style="padding: 20px 10px">
			Sorry, job does not exist! <a class="btn btn-primary" href="index.php">Back</a>
		</div><?php
	}
?>