<style>
	.nav-weekly{
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.4);
	}
	#note{
		color: red;
	}
</style>

<script type="text/javascript">
	function doSearch() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("search");
		filter = input.value.toUpperCase();
		table = document.getElementById("myTable");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[2];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				}else {
					tr[i].style.display = "none";
				}
			}       
		}
	}
</script>

<script type="text/javascript">
	$(document).ready(function($) {
		$('#agent').change( function(){
			var selection = $(this).val();
			$('table')[selection? 'show' : 'hide']();
			if (selection) {  // iterate only if `selection` is not empty
				$.each($('#myTable tbody #dataRow'), function(index, item) {
					$(item)[$(item).is(':contains('+ selection  +')')? 'show' : 'hide']();
				});
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function($) {
		$('#jobKind').change( function(){
			var selection = $(this).val();
			$('table')[selection? 'show' : 'hide']();
			if (selection) {  // iterate only if `selection` is not empty
				$.each($('#myTable tbody #dataRow'), function(index, item) {
					$(item)[$(item).is(':contains('+ selection  +')')? 'show' : 'hide']();
				});
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function($) {
		$('#artist').change( function(){
			var selection = $(this).val();
			$('table')[selection? 'show' : 'hide']();
			if (selection) {  // iterate only if `selection` is not empty
				$.each($('#myTable tbody #dataRow'), function(index, item) {
					$(item)[$(item).is(':contains('+ selection  +')')? 'show' : 'hide']();
				});
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function($) {
		$('#status').change( function(){
			var selection = $(this).val();
			$('table')[selection? 'show' : 'hide']();
			if (selection) {  // iterate only if `selection` is not empty
				$.each($('#myTable tbody #dataRow'), function(index, item) {
					$(item)[$(item).is(':contains('+ selection  +')')? 'show' : 'hide']();
				});
			}
		});
	});
</script>


<div id="tabsJustifiedContent" class="tab-content">
	<div id="weekly" class="tab-pane fade active show">
		<div class="table-responsive" >
			<table class="table table-hover" id="myTable">
				<thead>
					<tr>
						<th>Date Received</th>
						<th>Agent<br>
							<select name="agent" id="agent">
		  						<option selected disabled>Select</option><?php
		  						$colorCode ="";
								$agentQuery = "SELECT firstname, lastname, id FROM users_list WHERE type = 6 ORDER BY firstname ASC";
								$agentResult=mysqli_query($conn,$agentQuery);
								if(mysqli_num_rows($agentResult)>0){
									while($agentRow=mysqli_fetch_assoc($agentResult)){ 	
										echo "<option ". (($_POST['agent'] == $agentRow["firstname"]." ".$agentRow["lastname"]) ? 'selected ' : '') ."value=\"".$agentRow["firstname"]." ".$agentRow["lastname"]."\">".$agentRow["firstname"]." ".$agentRow["lastname"]."</option>";
									}
								}else{
									echo "<option disabled='disabled'>N/A</option>";
									mysqli_close ($agentQuery);
								}?>
							</select>
						</th>
						<th>J.O. No.</th>
						<th>Customer</th>
						<th>Job Type</th>
						<th>Job Kind<br>
							<select name="jobKind" id="jobKind">
		  						<option selected disabled>Select</option><?php
								$kindQuery = "SELECT job_kind FROM jo_kinds WHERE job_type !=2 ORDER BY job_kind ASC";
								$kindResult=mysqli_query($conn,$kindQuery);
								if(mysqli_num_rows($kindResult)>0){
									while($kindRow=mysqli_fetch_assoc($kindResult)){
										echo "<option ". (($_POST['jobKind'] == $kindRow["job_kind"]) ? 'selected ' : '') ."value=\"".$kindRow["job_kind"]."\">".$kindRow["job_kind"]."</option>";
									}
								}else{
									echo "<option disabled='disabled'>N/A</option>";
									mysqli_close ($kindQuery);
								}?>
							</select>
						</th>
						<th>Quantity</th>
						<th>Artist<br>						
							<select name="artist" id="artist">
			  					<option selected disabled>Select</option><?php
								$artistQuery = "SELECT firstname, lastname FROM users_list WHERE type = 7 ORDER BY firstname ASC";
								$artistResult=mysqli_query($conn,$artistQuery);
								if(mysqli_num_rows($artistResult)>0){
									while($artistRow=mysqli_fetch_assoc($artistResult)){	
										echo "<option ". (($_POST['artist'] == $artistRow["firstname"]." ".$artistRow["lastname"]) ? 'selected ' : '') ."value=\"".$artistRow["firstname"]." ".$artistRow["lastname"]."\">".$artistRow["firstname"]." ".$artistRow["lastname"]."</option>";
									}
								}else{
									echo "<option disabled='disabled'>N/A</option>";
									mysqli_close ($artistQuery);
								}?>
							</select>
						</th>
						<th>Pages</th>
						<th>Status<br>
							<select name="status" id="status">
		  						<option selected disabled>Select</option><?php
								$statusQuery = "SELECT status FROM jos_list ORDER BY status ASC";
								$statusResult=mysqli_query($conn,$statusQuery);
								if(mysqli_num_rows($statusResult)>0){
									while($statusRow=mysqli_fetch_assoc($statusResult)){
										echo "<option ". (($_POST['status'] == $statusRow["status"]) ? 'selected ' : '') ."value=\"".$statusRow["status"]."\">".$statusRow["status"]."</option>";
									}
								}else{
									echo "<option disabled='disabled'>N/A</option>";
									mysqli_close ($statusQuery);
								}?>
							</select>
						</th>
						<th>Deadline On</th>
						<th>Notes</th>
					</tr>
				</thead>
				<tbody><?php
					$colorCode = $noted= $ddateDisplay = $headYear = $prevHeadYear = $headMonth = $prevHeadMonth = $agentNo= $stat= $notes= $jobKind= $statDesc= $kind= $type= $quantity= $totalCopies= $unitNo= $unit= $artistName= $artistLast= $artistNo= $dateSearch= $receivedDate= $prevWeek= $week_No= $prevWeekNo= $typeId= "" ;
					$date = date('Y-m-d');
					$mon = date("m");
					$curMonth= date('F', mktime(0, 0, 0, $mon, 10));
					$deadline = "";

					if(isset($_POST['view'])){
						$dateSearch1 = $_POST['dateStart'];
						$dateSearch2 = $_POST['dateEnd'];

						if(empty($_POST['dateStart'])&&empty($_POST['dateEnd'])){
							$sql_query="SELECT a.received_on,a.job_kind,a.agent,a.artist,a.job_no as JobNo ,a.customer,a.description,a.pages,a.deadline_on,a.encoded_on,b.firstname,b.lastname,b.type,c.copies FROM jo a LEFT JOIN users_list b ON a.agent=b.id LEFT JOIN jo_copies c ON a.job_no=c.job_no WHERE a.agent=".$_SESSION['user_id']." AND a.received_on BETWEEN DATE_ADD(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY) AND DATE_ADD(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY) ORDER BY a.received_on DESC";
						}else{
							$d1 = date("Y-m-d", strtotime($dateSearch1));
							$d2 = date("Y-m-d", strtotime($dateSearch2));
							if(empty($_POST['dateEnd'])){
								$sql_query="SELECT a.received_on,a.job_kind,a.agent,a.artist,a.job_no as JobNo ,a.customer,a.description,a.pages,a.deadline_on,a.encoded_on,b.firstname,b.lastname,b.type,c.copies FROM jo a LEFT JOIN users_list b ON a.agent=b.id LEFT JOIN jo_copies c ON a.job_no=c.job_no WHERE a.agent=".$_SESSION['user_id']." AND a.received_on = '$d1' ORDER BY a.received_on DESC";
							}elseif(empty($_POST['dateStart'])){
								$sql_query="SELECT a.received_on,a.job_kind,a.agent,a.artist,a.job_no as JobNo ,a.customer,a.description,a.pages,a.deadline_on,a.encoded_on,b.firstname,b.lastname,b.type,c.copies FROM jo a LEFT JOIN users_list b ON a.agent=b.id LEFT JOIN jo_copies c ON a.job_no=c.job_no WHERE a.agent=".$_SESSION['user_id']." AND a.received_on ='$d2' ORDER BY a.received_on DESC";
							}else{
								$sql_query="SELECT a.received_on,a.job_kind,a.agent,a.artist,a.job_no as JobNo ,a.customer,a.description,a.pages,a.deadline_on,a.encoded_on,b.firstname,b.lastname,b.type,c.copies FROM jo a LEFT JOIN users_list b ON a.agent=b.id LEFT JOIN jo_copies c ON a.job_no=c.job_no WHERE a.agent=".$_SESSION['user_id']." AND a.received_on BETWEEN DATE_ADD('$d1', INTERVAL 1-DAYOFWEEK('$d1') DAY) AND DATE_ADD('$d2', INTERVAL 7-DAYOFWEEK('$d2') DAY) ORDER BY a.received_on DESC";
							}
						}
					}else{
						$sql_query="SELECT a.received_on,a.job_kind,a.agent,a.artist,a.job_no as JobNo ,a.customer,a.description,a.pages,a.deadline_on,a.encoded_on,b.firstname,b.lastname,b.type,c.copies FROM jo a LEFT JOIN users_list b ON a.agent=b.id LEFT JOIN jo_copies c ON a.job_no=c.job_no WHERE a.agent=".$_SESSION['user_id']." AND a.received_on BETWEEN DATE_ADD(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY) AND DATE_ADD(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY) ORDER BY a.received_on DESC";
					}

					$result_set=mysqli_query($conn,$sql_query);

					if(mysqli_num_rows($result_set)>0){
						while($row=mysqli_fetch_assoc($result_set)){ 
							$headYear = date("Y", strtotime($row['received_on']));
							$ddate = strtotime($row['deadline_on']);
							$cdate = strtotime($date);
							$timeleft = $ddate - $cdate;
							$days = round((($timeleft/24)/60)/60);
							$JO = $row['JobNo'];
							$jobKind=$row['job_kind'];
							$id ='';
							$agentNo= $row['type'];
							$artistNo = $row['artist'];
							$receivedDate = $row['received_on'];
							$noted="*";
							$statQuery="SELECT status,notes FROM jo_status WHERE job_no='$JO' ORDER BY id DESC LIMIT 1";
							$res=mysqli_query($conn,$statQuery);
							
							if(mysqli_num_rows($res)>0){
								while($statRow=mysqli_fetch_assoc($res)){
									$stat=$statRow['status'];
									$notes=$statRow['notes'];
								}
							}else{
								$stat=0;
							}
							$sQuery="SELECT status FROM jos_list WHERE id='$stat'";
							$res0=mysqli_query($conn,$sQuery);

							if(mysqli_num_rows($res0)>0){
								while($sRow=mysqli_fetch_assoc($res0)){
									$statDesc=$sRow['status'];
								}
							}else{
								$statDesc="N/A";
							}
							
							$kQuery="SELECT a.id AS JTypeId, a.job_type as JType, b.job_kind FROM jo_type a LEFT JOIN jo_kinds b ON a.id=b.job_type WHERE b.id='$jobKind'";
							$r=mysqli_query($conn,$kQuery);
							
							if(mysqli_num_rows($r)>0){
								while($kRow=mysqli_fetch_assoc($r)){
									$kind=$kRow['job_kind'];
									$type=$kRow['JType'];
									$typeId=$kRow['JTypeId'];
								}
							}
							
							$qQuery="SELECT job_no, units, SUM(copies) as total FROM jo_copies WHERE job_no='$JO'";
							$r1=mysqli_query($conn,$qQuery);
							
							if(mysqli_num_rows($r1)>0){
								while($qRow=mysqli_fetch_assoc($r1)){
									$totalCopies=$qRow['total'];
									$unitNo=$qRow['units'];
								}
							}else{
								$totalCopies=0;
								$unitNo=0;
							}
							
							if($totalCopies==0){
								$unit='N/A';
							}else{
								$uQuery="SELECT units FROM joc_units WHERE id='$unitNo' LIMIT 1";
								$r2=mysqli_query($conn,$uQuery);
							
								if(mysqli_num_rows($r2)>0){
									while($uRow=mysqli_fetch_assoc($r2)){
										$unit=$uRow['units'];
									}
								}else{
									$unit='<b style="color: red">'.$noted.'</b>';
								}
							}
							
							$aQuery="SELECT firstname, lastname, type FROM users_list WHERE id='$artistNo'";
							$r3=mysqli_query($conn,$aQuery);
							
							if(mysqli_num_rows($r3)>0){
								while($aRow=mysqli_fetch_assoc($r3)){
									$artistName=$aRow['firstname'];
									$artistLast=$aRow['lastname'];
									$artistNo=$aRow['type'];
								}
							}else{
								$artistName ='N/A';
								$artistLast = '';
								$artistNo = 0;
							}
							
							if($prevHeadYear!=$headYear){?>
								<tr height="10px">
									<td style="text-align:center; font-size: 13px; color: white; background: rgb(170,0,0); " colspan="12"><?php echo $headYear; ?></td>
								</tr><?php								
							}
							
							$prevHeadYear = $headYear;
							$headMonth = date("F", strtotime($row['received_on']));	

							if($prevHeadMonth!=$headMonth){?>
								<tr height="10px">
									<td style="text-align:left; font-size: 13px; color: rgb(170,0,0); background-color: #E0E0E0;  box-shadow: 0px 3px 1px 0px rgba(0,0,0,0.5); " colspan="12"><b><?php echo strtoupper($headMonth); ?></b></td>
								</tr><?php						
							}
							
							$prevHeadMonth=$headMonth;
							$weeknoQuery="SELECT WEEK('$receivedDate',5) - WEEK(DATE_SUB('$receivedDate', INTERVAL DAYOFMONTH('$receivedDate')-1 DAY),5)+1 as weekno";
							$r5=mysqli_query($conn,$weeknoQuery);
							
							if(mysqli_num_rows($r5)>0){
								while($weeknoRow=mysqli_fetch_assoc($r5)){
									$week_No = $weeknoRow['weekno'];
								}
							}
							
							if($prevWeekNo!=$week_No){?>
								<tr height="10px">
									<td style="text-align:center; font-size: 13px; color: rgb(100,0,0); background-color: #F0F0E0;  box-shadow: 0px 3px 1px 0px rgba(0,0,0,0.5); " colspan="12">WEEK <?php echo $week_No; ?></td>
								</tr><?php
							}	
							
							$prevWeekNo = $week_No;	
							$weekQuery="SELECT DAYNAME('$receivedDate') as weekname";
							$r4=mysqli_query($conn,$weekQuery);
							
							if(mysqli_num_rows($r4)>0){
								while($weekRow=mysqli_fetch_assoc($r4)){
									$weekName = $weekRow['weekname'];
								}
							}
							
							if($prevWeek!=$weekName){?>
								<tr height="10px"  >
									<td style="text-align:left; font-size: 13px; color: rgb(100,0,0); background-color: #E0F0E0;  box-shadow: 0px 3px 1px 0px rgba(0,0,0,0.5); " colspan="12"><b><?php echo $weekName; ?></b></td>
								</tr><?php									
							}
							
							$prevWeek = $weekName;	
							
							if($stat==9){//OUT
								$colorCode = "green";
								$statDesc="Out";		
							
								if($ddate==0){
									$deadline = "N/A";
								}else{
									$deadline = date('F d, Y',strtotime($row['deadline_on']));
								}
							}else if($stat==10){
								$colorCode = "gray";
								$statDesc="Cancelled";
							
								if($ddate==0){
									$deadline = "N/A";
								}else{
									$deadline = date('F d, Y',strtotime($row['deadline_on']));
								}
							}else{
								if($ddate!=0){
									if($days >20){
										$colorCode = "white";
										$deadline = date('F d, Y',strtotime($row['deadline_on']));
									}else if ($days <=20 && $days >=11) {
										$colorCode = "yellow";
										$deadline = "".date('F d, Y',strtotime($row['deadline_on']))."<b style='color: #666600;'><br> (".$days." day/s left)</em>";
									}else if ($days <=10 && $days >=6) {
										$colorCode = "orange";
										$deadline = "".date('F d, Y',strtotime($row['deadline_on']))."<b style='color: #994c00;'><br> &nbsp;(".$days." day/s left)</b>";
									}else if ($days <= 5 && $days >=2) {
										$colorCode = "red";
										$deadline = "".date('F d, Y',strtotime($row['deadline_on']))."<b style='color: red;'><br> (".$days." day/s left)</b>";
									}else if ($days == 1) {
										$colorCode = "red";
										$deadline = "<b style='color: #990000;'>TOMMOROW!</b>";
									}else if($days==0){
										$colorCode = "red";
										$deadline = "<b style='color:  #CC0000;'>TODAY!</b>";
									}else if($days==-1){
										$colorCode = "red";
										$deadline = "<b style='color:  darkred;;'>YESTERDAY!</b>";
									}else if ($days <-1){
										$colorCode = "red";
										$deadline = "".date('F d, Y',strtotime($row['deadline_on']))."<b style='color: darkred;'><br> (".abs($days)." day/s late)</b>";
									}
								}else{
									$colorCode = "white";
									$deadline = "N/A";
								}
							}
							
							if($typeId!=2){?>  
								<tr class="<?php echo $colorCode;?>" id="dataRow"> 
								<td><?php echo date('F d, Y',strtotime($row['received_on']));?></td>
								<td><?php
									echo $row['firstname']." ".$row['lastname'];?><?php 
									
									if ($agentNo!=6){?>
										<b style="color: red"><?php echo $noted;?></b><?php
									}?>
								</td>
								<td><?php echo $row['JobNo'];?></td>
								<td><?php echo $row['customer'];?></td>
								<td><?php echo $type;?></td>
								<td><?php echo $kind;?></td> 
								<td><?php echo $totalCopies;?>&nbsp;<?php echo $unit;?></td>
								<td><?php
									echo $artistName." ".$artistLast; 
									
									if ($artistNo!=7){?>
										<b style="color: red"><?php echo $noted;?></b><?php
									}?></td>
								<td><?php 
									if($row['pages']!=""){
										echo $row['pages'];
									}else{?>
										N/A<?php
									};?>
								</td>
								<td><?php echo $statDesc;?></td>
								<td><?php echo $deadline;?></td>
								<td><?php
									if($notes==NULL){?>
										N/A<?php
									}else{
										echo $notes;
									}?>
								</tr><?php				
							}
						}  
					}else{?>
						<tr>
							<td colspan="12" style="text-align: center;">
								No Data Yet!
							</td>
						</tr><?php
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>