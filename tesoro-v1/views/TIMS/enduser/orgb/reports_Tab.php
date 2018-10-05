<?php

	include ('TIMS_verify.php');

	$tab = $_SESSION["filter"];
	// $search = $_SESSION["searchPrev"];

?>
 <style type="text/css">

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

	#search{
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


</style>

<form action= "<?php echo $tab?>.php" method='POST' class='input-group mb-3' style='z-index: 0; margin-top: 6px; margin-right: 30px;'>

	<div class="vertical form-control">
		<h6>Filter:</h6>
		
		<label>Artist: </label>
		  <select name="artist">
		  	<option selected="true" disabled="disabled" >-Select-</option>
		  	<option  value="" >None</option>
		  	
		  	<?php
		  	 
		  	  $artQuery = "SELECT artist FROM jobbings ORDER BY artist ASC";
		  	  $result1=mysqli_query($conn,$artQuery);
				if(mysqli_num_rows($result1)>0){
				  while($row1=mysqli_fetch_assoc($result1)){

				  	$current1 = $row1['artist'];

				  if ($last1 != $current1){

				  	 echo "<option ". (($_POST['artist'] == $row1["artist"]) ? 'selected ' : '') ."value=\"".$row1["artist"]."\">".$row1["artist"]."</option>";
					  	
			

		    		$last1 = $current1;

		    	  }

			     }
			   }

			   else{

			   		mysqli_close ($artQuery);
			   	}

		    ?>
		  </select>


	<?php

		if($tab!="reports_small_jobs"&&$tab!="reports_big_jobs"){
	?>		
		 <label>Type of Job: </label>
		  <select name="jobType">
		  	<option selected="true" disabled="disabled">-Select-</option>
		  	<option  value="" >None</option>
		    <?php
		  	 
		  	  $jobTypeQuery = "SELECT job_type,id FROM jobbings_type WHERE id != 2 ORDER BY job_type ASC";

		  	  $result3=mysqli_query($conn,$jobTypeQuery);
				if(mysqli_num_rows($result3)>0){
				  while($row3=mysqli_fetch_assoc($result3)){
					  	
				echo "<option ". (($_POST['jobType'] == $row3["id"]) ? 'selected ' : '') ."value=\"".$row3["id"]."\">".$row3["job_type"]."</option>";

			     }
			   }

			   else{

			   		mysqli_close ($jobTypeQuery);
			   	}



		    ?>
		 </select>

	<?php } ?>
		

		 <label>Kind of Job: </label>
		  <select name="jobKind">
		  	<option selected="true" disabled="disabled">-Select-</option>
		  	<option  value="" >None</option>
		     <?php
		  	 
		  	 if($tab=="reports_small_jobs"){

		  	 	$jobKindQuery = "SELECT kind_of_job,id FROM jobbings_kinds WHERE type = 3 ORDER BY kind_of_job ASC";

		  	 }

		  	 elseif($tab=="reports_big_jobs"){

		  	 	$jobKindQuery = "SELECT kind_of_job,id FROM jobbings_kinds WHERE type = 1 ORDER BY kind_of_job ASC";

		  	 }

		  	 else{
		  	 
		  	  $jobKindQuery = "SELECT kind_of_job,id FROM jobbings_kinds WHERE type != 2 ORDER BY kind_of_job ASC";
		  	}

		  	  $result4=mysqli_query($conn,$jobKindQuery);
				if(mysqli_num_rows($result4)>0){
				  while($row4=mysqli_fetch_assoc($result4)){

					  	
				echo "<option ". (($_POST['jobKind'] == $row4["id"]) ? 'selected ' : '') ."value=\"".$row4["id"]."\">".$row4["kind_of_job"]."</option>";
		    	  

			     }
			   }

			   else{

			   		mysqli_close ($jobKindQuery);
			   	}



		    ?>
		 </select>

		 <label>Agent: </label>
		  <select name="agent">
		  	<option selected="true" disabled="disabled">-Select-</option>
		  	<option  value="" >None</option>
		    <?php
		  	 
		  	  $agentQuery = "SELECT agent FROM jobbings ORDER BY agent ASC";
		  	  $result5=mysqli_query($conn,$agentQuery);
				if(mysqli_num_rows($result5)>0){
				  while($row5=mysqli_fetch_assoc($result5)){

				  	$current5 = $row5['agent'];

				  if ($last5 != $current5){
					  	
				echo "<option ". (($_POST['agent'] == $row5["agent"]) ? 'selected ' : '') ."value=\"".$row5["agent"]."\">".$row5["agent"]."</option>";
 
		    		$last5 = $current5;

		    	  }

			     }
			   }

			   else{

			   		mysqli_close ($agentQuery);
			   	}

		    ?>
		 </select>

		 <?php

		if($tab!="reports_this_month"&&$tab!="reports_last_month"&&$tab!="reports_this_year"&&$tab!="reports_last_year"){
	?>

		 <label>Year: </label>
		  <select name="year">
		  	<option selected="true" disabled="disabled">-Select-</option>
		  	<option  value="" >None</option>
		    <?php
		  	 
		  	  $yearQuery = "SELECT YEAR(date_received) FROM jobbings ORDER BY date_received ASC LIMIT 1";
 			  $result6=mysqli_query($conn,$yearQuery);
			  $row6=mysqli_fetch_assoc($result6);
			  $year=$row6['YEAR(date_received)'];
			  $thisYear = date('Y');
			 
			 if($year==$thisYear){

			 	 echo "<option ". (($_POST['year'] == $o) ? 'selected ' : '') ."value=\"".$year."\">".$year."</option>";
			  }

			 if($year<$thisYear){
			  	for($o=$year;$o<=$thisYear;$o++){
			  echo "<option ". (($_POST['year'] == $o) ? 'selected ' : '') ."value=\"".$o."\">".$o."</option>";

				}

			}
			mysqli_close ($yearQuery);
			
		    ?>
		 </select>
		 <?php 
		}

		if($tab!="reports_this_month"&&$tab!="reports_last_month"){


		if($tab=="reports") {
			?>

			 <label><b>Month: </b> &nbsp;From: </label>
			  <select name="monthFrom">
			  	<option selected="true" disabled="disabled" >-Select-</option>
			  	<option  value="" >None</option>
			 <?php 
			 		$i = 0;
			 		for($i=1;$i<=12;$i++){

			 			$month= date('F', mktime(0, 0, 0, $i, 10));

			 			  echo "<option ". (($_POST['monthFrom'] == $i) ? 'selected ' : '') ."value=\"".$i."\">".$month."</option>";
			 		}

			 ?>
		    
		 </select>


			 <label> To: </label>
			  <select name="monthTo">
			  	<option selected="true" disabled="disabled" >-Select-</option>
			  	<option  value="" >None</option>
			 <?php 
			 		$i = 0;
			 		for($i=1;$i<=12;$i++){

			 			$month= date('F', mktime(0, 0, 0, $i, 10));

			 			  echo "<option ". (($_POST['monthTo'] == $i) ? 'selected ' : '') ."value=\"".$i."\">".$month."</option>";
			 		}

			 ?>
		    
		 </select>
		<?php }

		else if($tab=="reports_this_year"||$tab=="reports_last_year") {
			?>

			 <label>Month From: </label>
			  <select name="monthFrom">
			  	<option selected="true" disabled="disabled" >-Select-</option>
			  	<option  value="" >None</option>
			 <?php 
			 		$i = 0;
			 		for($i=1;$i<=12;$i++){

			 			$month= date('F', mktime(0, 0, 0, $i, 10));

			 			  echo "<option ". (($_POST['monthFrom'] == $i) ? 'selected ' : '') ."value=\"".$i."\">".$month."</option>";
			 		}

			 ?>
		    
		 </select>


			 <label>Month To: </label>
			  <select name="monthTo">
			  	<option selected="true" disabled="disabled" >-Select-</option>
			  	<option  value="" >None</option>
			 <?php 
			 		$i = 0;
			 		for($i=1;$i<=12;$i++){

			 			$month= date('F', mktime(0, 0, 0, $i, 10));

			 			  echo "<option ". (($_POST['monthTo'] == $i) ? 'selected ' : '') ."value=\"".$i."\">".$month."</option>";
			 		}

			 ?>
		    
		 </select>
		<?php }
			
			else{
			?>
			 <label>Month: </label>
			  <select name="month">
			  	<option selected="true" disabled="disabled" >-Select-</option>
			  	<option  value="" >None</option>
			 <?php 
			 		$i = 0;
			 		for($i=1;$i<=12;$i++){

			 			$month= date('F', mktime(0, 0, 0, $i, 10));

			 			  echo "<option ". (($_POST['month'] == $i) ? 'selected ' : '') ."value=\"".$i."\">".$month."</option>";
			 		}

			 ?>
			    
		 </select>
		 <?php 
		 	}
		}
 ?>



	</div>

	<div class="input-group-append">
		<button class="btn btn-outline-secondary"  name="submit" type="submit"><img src="images/search.png" width="25px"></button>
	</div>
</form>
<div class="input-group-append legend" >
	<label><b>Color Legend: </b></label>

	<p>
		<br> <span class="badge badge-success code" style="background-color: #a8dbb4;" >A&nbsp;&nbsp;</span><small>&nbsp;- Order out.</small>
		&nbsp; <span class="badge badge-warning code" style="background-color: #ffeeba;" >A&nbsp;&nbsp;</span><small>&nbsp;- 15 days to 11 days left before deadline.</small>
		&nbsp;<span class="badge badge-danger code" style="background-color: #f5c6cb;">A&nbsp;&nbsp;</span><small>&nbsp;- 10 days and less left before deadline.</small>
		&nbsp;<span class="badge badge-danger code" style="background-color: #f5c6cb; color: red;">A&nbsp;&nbsp;</span><small>&nbsp;- Deadline Today.</small>
		&nbsp; <span class="badge badge-secondary code" style="color: red;" >A&nbsp;&nbsp;</span><small>&nbsp;- Order Overdue.</small>
		&nbsp; <span class="badge badge-secondary code" style="color: white">A&nbsp;&nbsp;</span><small>&nbsp;- Cancelled.</small>
	</p>
	</div>
