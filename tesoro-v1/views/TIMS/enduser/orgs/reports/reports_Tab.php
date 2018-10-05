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

<form action= "<?php echo $tab?>.php" method='POST' class='input-group mb-3' style='z-index: 0; margin-top: 6px; margin-right: 30px;'>

	<div class="vertical form-control">
		<h6>Filter:</h6>
		
		<label>Artist: </label>
		  <select name="artist">
		  	<option selected="true" disabled="disabled" >-Select-</option>
		  	<option value="">None</option>
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

		 <label>Kind of Job: </label>
		  <select name="jobKind">
		  	<option selected="true" disabled="disabled">-Select-</option>
		  	<option value="">None</option>
		     <?php
		  	 
		  	 
		  	  $jobKindQuery = "SELECT kind_of_job,id FROM jobbings_kinds WHERE type = 2 ORDER BY kind_of_job ASC";
		  

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
		  	<option value="">None</option>
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

	</div>

	<div class="input-group-append">
		<button class="btn btn-outline-secondary"  name="submit" type="submit"><img src="images/search.png" width="25px"></button>
	</div>
</form>
<div class="input-group-append legend" >
	<label><b>Color Legend: </b></label>

	<p>
		<br> <span class="badge green"  >A&nbsp;&nbsp;</span><small>&nbsp;- Order out.</small>
		&nbsp; <span class="badge yellow" >A&nbsp;&nbsp;</span><small>&nbsp;- 20 days to 11 days left before deadline.</small>
		&nbsp;<span class="badge orange">A&nbsp;&nbsp;</span><small>&nbsp;- 10 days to 6 days left before deadline.</small>
		&nbsp;<span class="badge red">A&nbsp;&nbsp;</span><small>&nbsp;- 5 days left and until order overdue.</small>
		&nbsp; <span class="badge gray" >A&nbsp;&nbsp;</span><small>&nbsp;- Cancelled.</small>
	</p>
	</div>
