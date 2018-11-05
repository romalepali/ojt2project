<?php
	if (isset($_POST['suggest'])){
		$report_type = 2;
		$message = mysqli_real_escape_string($conn,$_POST['message']);
		$sent_by = $_SESSION['user_id'];
		
		$report_bugs = "INSERT INTO system_reports (report_type,message,sent_by,sent_on) VALUES ('$report_type','$message','$sent_by',NOW())";

		if(mysqli_query($conn,$report_bugs)){?>
			<script type="text/javascript">
				swal({
					title: "Success",
					text: "You submitted a suggestion!",
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
					text: "Error submitting a suggestion",
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

<title>About JOMIS | Suggestions</title>
<div class="row">
	<div class="col-10">
		<h4 style="margin: 8px 0px;">Suggestions</h4>
	</div>
</div>

<div style="padding: 0px 10px">
	<form action="about.php?type=suggestions" method="POST">
		<div class="row">
			<div class="col-xl">
				<div class="form-group row">
					<label for="message" class="col-12 col-form-label">Message</label>
					<div class="col-12">
						<textarea class="form-control" placeholder="Enter Message" name="message" id="message" rows="20" style="resize: none;"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div style="float: right; padding: 20px 0px">
			<button class="btn btn-primary" type="submit"  id="suggest_e" name="suggest" style="display: none;">Suggest</button>
			<button class="btn btn-primary" type="submit"  id="suggest_d" name="suggest" disabled>Suggest</button>
		</div>
	</form>
</div>

<script>
	var myInput = document.getElementById("message");
	
	myInput.onkeyup = function() {
		if(myInput.value.length >= 8) {
			document.getElementById("suggest_e").style.display = "inline";
			document.getElementById("suggest_d").style.display = "none";
		} else {
			document.getElementById("suggest_e").style.display = "none";
			document.getElementById("suggest_d").style.display = "inline";
		}
	}
</script>