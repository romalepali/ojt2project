<?php
	if (isset($_POST['report_bugs'])){
		$report_type = 1;
		$message = mysqli_real_escape_string($conn,$_POST['message']);
		$sent_by = $_SESSION['user_id'];
		
		$report_bugs = "INSERT INTO system_reports (report_type,message,sent_by,sent_on) VALUES ('$report_type','$message','$sent_by',NOW())";

		if(mysqli_query($conn,$report_bugs)){?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "You reported a bug!",
					type: "success"
				},function(isConfirm) {
					if (isConfirm) {
						window.location.href='index.php';
					}
				});
			</script><?php
		}else{?>
			<script type="text/javascript">
				swal({
					title: "Failed",
					text: "Error reporting a bug!",
					type: "error"
				},function(isConfirm) {
					if (isConfirm) {
						window.location.href='index.php';
					}
				});
			</script><?php
		}
	}
?>

<title>About JOMIS | Report Bugs</title>
<div class="row">
	<div class="col-10">
		<h4 style="margin: 8px 0px;">Report Bugs</h4>
	</div>
</div>

<div style="padding: 0px 10px">
	<form action="about.php?type=bugs" method="POST">
		<div class="row">
			<div class="col-xl">
				<div class="form-group row">
					<label for="message" class="col-12 col-form-label">Message</label>
					<div class="col-12">
						<textarea class="form-control" placeholder="Enter Message" name="message" id="message" rows="20" style="resize: none;" autofocus></textarea>
					</div>
				</div>
			</div>
		</div>

		<div style="float: right; padding: 20px 0px">
			<button class="btn btn-primary" type="submit" id="report_e" name="report_bugs" style="display: none;">Report Bugs</button>
			<button class="btn btn-primary" type="submit" id="report_d" name="report_bugs" disabled>Report Bugs</button>
		</div>
	</form>
</div>

<script>
	var myInput = document.getElementById("message");
	
	myInput.onkeyup = function() {
		if(myInput.value.length >= 8) {
			document.getElementById("report_e").style.display = "inline";
			document.getElementById("report_d").style.display = "none";
		} else {
			document.getElementById("report_e").style.display = "none";
			document.getElementById("report_d").style.display = "inline";
		}
	}
</script>