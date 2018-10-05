<?php
	$_SESSION['page']='job_inputs.php';
?>
<title>Job Inputs</title>
<ul id="tabsJustified" class="nav nav-tabs">
	<li class="nav-item">
		<a href="job_inputs.php?input=colors" class="nav-link small text-uppercase">
			Colors
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($ccount_result)>0){
					while($ccount=mysqli_fetch_assoc($ccount_result)){
						echo $ccount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=job_kind" class="nav-link small text-uppercase">
			Job Kind
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($jkcount_result)>0){
					while($jkcount=mysqli_fetch_assoc($jkcount_result)){
						echo $jkcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=job_type" class="nav-link small text-uppercase">
			Job Type
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($jtcount_result)>0){
					while($jtcount=mysqli_fetch_assoc($jtcount_result)){
						echo $jtcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=materials" class="nav-link small text-uppercase">
			Materials
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($mcount_result)>0){
					while($mcount=mysqli_fetch_assoc($mcount_result)){
						echo $mcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=paper_size" class="nav-link small text-uppercase">
			Paper Size
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($pscount_result)>0){
					while($pscount=mysqli_fetch_assoc($pscount_result)){
						echo $pscount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=payments" class="nav-link small text-uppercase">
			Payments
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($ptcount_result)>0){
					while($ptcount=mysqli_fetch_assoc($ptcount_result)){
						echo $ptcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=printing" class="nav-link small text-uppercase">
			Printing
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($prcount_result)>0){
					while($prcount=mysqli_fetch_assoc($prcount_result)){
						echo $prcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=status" class="nav-link small text-uppercase">
			Status
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($stcount_result)>0){
					while($stcount=mysqli_fetch_assoc($stcount_result)){
						echo $stcount['count'];
					}
				}?>
			</span>
		</a>
	</li>
	<li class="nav-item">
		<a href="job_inputs.php?input=units" class="nav-link small text-uppercase">
			Units
			<span class="float-right badge badge-pill badge-danger" style="margin-left:10px"><?php
				if(mysqli_num_rows($ucount_result)>0){
					while($ucount=mysqli_fetch_assoc($ucount_result)){
						echo $ucount['count'];
					}
				}?>
			</span>
		</a>
	</li>
</ul>