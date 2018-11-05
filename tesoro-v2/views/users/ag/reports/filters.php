<?php
	include ('config/ag_verify.php');
	$_SESSION['page']='reports.php';
	$tab=$_SESSION['filter'];	
?>

 <style type="text/css">
 	*{
		color-adjust: exact;
		-webkit-print-color-adjust: exact;
		print-color-adjust: exact;
	}

 	@media print {
    	footer {
			page-break-after: always;
		}
	}

	label{
		font-size: 12px;
		margin-right: 3px;
	}

	select{
		font-size: 11px;
		margin-right: 3px;
	}
	#search{
		font-size: 11px;
		margin: 5px;
	}

	.btn-outline-secondary{
		margin-right: 9px;
		color: white;
		background-color: #8B0000;
	}

	.btn-outline-secondary:hover{
		color: #8B0000;
		background-color: #CB0000;
	}

	#dateStart,#dateEnd{
		font-size: 11px;
		margin: 5px;
	}	

	.legend{
		margin: 2px; 
		font-size: 13px; 
	}

	.code{	
		color: #000000;
	}

	.badge-secondary{
		background-color:#c6c8ca;
	}

	.yellow{
		background-color: #FFFF66;
	}
	.orange{
		background-color: #FFB266;
	}
	.red{
		background-color: #FF9999;
	}
	.white{
		background-color: white;
	}
	.green{
		background-color:#99FF99;
	}
	.gray{
		background-color:#A0A0A0;
	}


</style>

<form action= "reports.php" method='POST' class='input-group mb-3' style='z-index: 0; margin-top: 6px; margin-right: 30px;'>
	<div class="vertical form-control">
		<h6><b>Filters: </b></h6>

		<div class="form-inline">
			<label>Search for:</label> <input type="search" name="search" id="search" class="form-control" placeholder="J.O. #" onkeyup="doSearch()" aria-label="search for J.O. #" aria-describedby="basic-addon2"> &nbsp;&nbsp;<?php
			if($tab=='daily'){?>
				<label>View Report On:</label> 
				<input type="date" name="dateStart" class="form-control" id="dateStart" value="<?php if(isset($_POST['dateStart'])){echo $_POST['dateStart'];}?>">&nbsp;<label><?php 
			}else if($tab=='monthly'){
				$i=0;?>
				<label>View Report On Month Of:</label> 
				<select name="monStart" id="monStart" class="form-control monStart" style="font-size: 11px;">
					<option selected="true" value="" >Select</option><?php
					for($i = 1;$i<=12;$i++){
						$Month= date('F', mktime(0, 0, 0, $i, 10));
						echo "<option ". (($_POST['monStart'] == $i) ? 'selected ' : '') ."value=\"".$i."\">".$Month."</option>";
					}?>
				</select>
				&nbsp;<label> To:</label> 
				<select name="monEnd" id="monEnd" class="form-control monEnd" style="font-size: 11px;">
					<option selected="true" value="" >Select</option><?php
					for($i = 1;$i<=12;$i++){
						$Month= date('F', mktime(0, 0, 0, $i, 10));
						echo "<option ". (($_POST['monEnd'] == $i) ? 'selected ' : '') ."value=\"".$i."\">".$Month."</option>";
					}?>
				</select> &nbsp; &nbsp;  &nbsp;<?php
			}elseif($tab=='yearly'){
				$i=0;?>
				<label>View Report From:</label> 
				<select name="yearStart" id="yearStart" class="form-control" style="font-size: 10px;">
					<option selected="true" value="" >Select</option><?php
					$yearQuery = "SELECT YEAR(received_on) FROM jo ORDER BY received_on ASC LIMIT 1";
					$result6=mysqli_query($conn,$yearQuery);
					$row6=mysqli_fetch_assoc($result6);
					$year=$row6['YEAR(received_on)'];
					$thisYear = date('Y');
					
					if($year==$thisYear){
						echo "<option ". (($_POST['yearStart'] == $o) ? 'selected ' : '') ."value=\"".$year."\">".$year."</option>";
					}
					if($year<$thisYear){
						for($o=$year;$o<=$thisYear;$o++){
							echo "<option ". (($_POST['yearStart'] == $o) ? 'selected ' : '') ."value=\"".$o."\">".$o."</option>";
						}
					}?>
				</select>
				&nbsp;<label> To:</label> 
				<select name="yearEnd" id="yearEnd" class="form-control" style="font-size: 10px;">
					<option selected="true" value="" >Select</option><?php
					$yearQuery = "SELECT YEAR(received_on) FROM jo ORDER BY received_on ASC LIMIT 1";
					$result6=mysqli_query($conn,$yearQuery);
					$row6=mysqli_fetch_assoc($result6);
					$year=$row6['YEAR(received_on)'];
					$thisYear = date('Y');
					if($year==$thisYear){
						echo "<option ". (($_POST['yearEnd'] == $o) ? 'selected ' : '') ."value=\"".$year."\">".$year."</option>";
					}
					if($year<$thisYear){
						for($o=$year;$o<=$thisYear;$o++){
							echo "<option ". (($_POST['yearEnd'] == $o) ? 'selected ' : '') ."value=\"".$o."\">".$o."</option>";
						}
					}?>
				</select>
				&nbsp;&nbsp;<?php
			}else{?>
				<label>View Report From:</label> 
				<input type="date" name="dateStart"  class="form-control" id="dateStart" value="<?php if(isset($_POST['dateStart'])){echo $_POST['dateStart'];}?>">&nbsp;<label>To:</label> 
				<input type="date" name="dateEnd"  class="form-control" id="dateEnd" value="<?php if(isset($_POST['dateEnd'])){echo $_POST['dateEnd'];}?>" > &nbsp;<?php
			}?>
			<button class="btn btn-secondary avoid-this" id="view" name="view" style="font-size: 12px; margin-top: 2px;">GENERATE</button>&nbsp;&nbsp;
			<script src="js/others/jquery.min.js"></script>
			<script src="js/print/jQuery.print.min.js"></script> 
			<button type="button" class="btn btn-default btn-sm avoid-this" id="print" style="float: right; position: relative; background-color: #0064b0; color: #fff; margin-right: 10px">PRINT</button>
		</div>
	</div>
</form>

<div class="input-group-append legend" >
	<label><b>Color Legend: </b></label>
	<p><br>
		<span class="badge green"  >A&nbsp;&nbsp;</span><small>&nbsp;- Order out.</small>
		&nbsp; <span class="badge yellow" >A&nbsp;&nbsp;</span><small>&nbsp;- 20 days to 11 days left before deadline.</small>
		&nbsp;<span class="badge orange">A&nbsp;&nbsp;</span><small>&nbsp;- 10 days to 6 days left before deadline.</small>
		&nbsp;<span class="badge red">A&nbsp;&nbsp;</span><small>&nbsp;- 5 days left and until order overdue.</small>
		&nbsp; <span class="badge gray" >A&nbsp;&nbsp;</span><small>&nbsp;- Cancelled.</small>
		&nbsp;&nbsp;<b style="color: red">*</b>&nbsp;<small>- Need to address.</small>
	</p>
</div>
	
<script type='text/javascript'>
	jQuery(function($){
		'use strict';
		$("#printArea").find('#print').on('click', function() {
			$("#printArea").print({
				globalStyles : false,
				mediaPrint : true,
				noPrintSelector : ".avoid-this",
				prepend : "<h4>TESORO'S JOB ORDER REPORT</h4>",
			});
		});
	});
</script>