<!DOCTYPE html>
<?php
	$user_query="SELECT * FROM users WHERE id=".$_SESSION['TIMS_id'];
	$user_result=mysqli_query($conn,$user_query);
	$user=mysqli_fetch_array($user_result);
?>

<html>

<style type="text/css">
	.input-list {
		padding-left: 10px;
		font-size: 11px;
	}
</style>

<script>
	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var h2 = h%12;
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);

		if(h > 12){
			if(h2 < 12){
				document.getElementById('txt').innerHTML =
				h2 + ":" + m + ":" + s + " PM";
			}else{
				document.getElementById('txt').innerHTML =
				h2 + ":" + m + ":" + s + " AM";
			}
		}else{
			if(h < 12){
				document.getElementById('txt').innerHTML =
				h + ":" + m + ":" + s + " AM";
			}else{
				document.getElementById('txt').innerHTML =
				h + ":" + m + ":" + s + " PM";
			}
		}
		
		var t = setTimeout(startTime, 500);
	}

	function checkTime(i) {
		if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		return i;
	}
</script>

<body onload="startTime()">
	<div id="wrapper">
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="sidebar-brand">
					<a href="index.php">
						<img src="images/TIMS_logo.png" width="100px">
					</a>
				</li>
				<li>
					<a href="users.php" class="nav-users">Users</a>
				</li>
				<div id="accordion">
					<li>
						<a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						  Inputs
						</a>
					</li>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
						<li>
							<a class="input-list nav-colors" href="input_colors.php">Colors</a>
						</li>
						<li>
							<a class="input-list nav-job-kind" href="input_job_kind.php">Job Kind</a>
						</li>
						<li>
							<a class="input-list nav-job-type" href="input_job_type.php">Job Type</a>
						</li>
						<li>
							<a class="input-list nav-materials" href="input_materials.php">Materials</a>
						</li>
						<li>
							<a class="input-list nav-paper-size" href="input_paper_size.php">Paper Size</a>
						</li>
						<li>
							<a class="input-list nav-payments" href="input_payments.php">Payments</a>
						</li>
						<li>
							<a class="input-list nav-printing" href="input_printing.php">Printing</a>
						</li>
						<li>
							<a class="input-list nav-status" href="input_status.php">Status</a>
						</li>
						<li>
							<a class="input-list nav-units" href="input_units.php">Units</a>
						</li>
					</div>
				</div>
				<li>
					<a href="all_jobs.php" class="nav-job-orders">Jobbings</a>
				</li>
			</ul>
		</div>

		<div style="background-color: #a90000;">
			<a href="#menu-toggle" class="btn btn-danger" id="menu-toggle">&#9776;</a>
			<div style="color: white;float: right;padding: 1px 8px;">
				<div id=txt style="font-size: 21px;font-weight: bold;"></div>
				<div style="margin-top:-8px;font-size:11px;"><?php  echo date('F d, Y')." (".date('l').")";?></div>
			</div>
		</div>
	</div>

	<div class="custom-nav">
        <div style="float: right; color: white;">
            <button type="button" class="btn btn-danger notify" data-toggle="dropdown">
                <img style="margin-top: -14px; margin-left: -15px; position: absolute; width: 30px; border-radius: 100px; height: 30px;" src="../users/images/<?php echo $user['picture'].".png";?>">
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Account</div>
                <a class="dropdown-item" href="profile.php">Profile</a>
                <a class="dropdown-item" href="javascript: logout()">Logout</a>
            </div>
        </div>

        <div style="float: right; color: white;">
            <button type="button" class="btn btn-danger notify jobbings-due" title="Due Dates" data-toggle="dropdown">
                <img style="margin-top: -13px; margin-left: -15px; position: absolute;" src="images/due.png" width="30px">
                <div style="position: absolute; background-color: white; width:15px; border-radius: 10px; border: 1px solid #a90000; height: 15px;  color: #a90000; margin-top: -15px; margin-left: 15px;">
                    <div class="count-due" style="font-size: 10px; margin-top: -1px; margin-left: -0.5px; letter-spacing: -1pt;">
                    	0
                    </div>
                </div>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Due Dates</div>
                <div class="list-group list-due" style="max-height: 320px; overflow: auto;"></div>
            </div>
        </div>
	</div>

	<div class="modal fade" id="TIMS">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<?php include ('include/TIMS.php');?>
			</div>
		</div>
	</div>

	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$("#notify-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper2").toggleClass("toggled");
	});

	$("#account-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper3").toggleClass("toggled");
	});
	</script>

	<script type="text/javascript">
		function logout(){
			swal({
			  title: "WARNING",
			  text: "Are you sure to logout your account!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Yes",
			  cancelButtonText: "No",
			  closeOnConfirm: false,
			  closeOnCancel: true
			},
			function(isConfirm) {
			  if (isConfirm) {
				window.location.href='TIMS_logout.php';
			  }
			});
		}
	 </script>

	 <script>
		$(document).ready(function(){ 
			function load_unseen_due(view = ''){
				$.ajax({
					url:"jobbings-due.php",
					method:"POST",
					data:{view:view},
					dataType:"json",
					success:function(data){
						$('.list-due').html(data.notification);
						if(data.unseen_notification > 0){
							$('.count-due').html(data.unseen_notification);
						}
					}
				});
			}
		
			load_unseen_due();
 
			$(document).on('click', '.jobbings-due', function(){
				$('.count-due').html('0');
				load_unseen_due('yes');
			});

			setInterval(function(){load_unseen_due();;}, 2000);
		});
	</script>

	<script>
		$(document).ready(function(){ 
			function load_unseen_chat(view = ''){
				$.ajax({
					url:"users-chats.php",
					method:"POST",
					data:{view:view},
					dataType:"json",
					success:function(data){
						$('.list-chat').html(data.notification);
						if(data.unseen_notification > 0){
							$('.count-chat').html(data.unseen_notification);
						}
					}
				});
			}
		
			load_unseen_chat();
 
			$(document).on('click', '.users-chats', function(){
				$('.count-chat').html('0');
				load_unseen_chat('yes');
			});

			setInterval(function(){load_unseen_chat();;}, 2000);
		});
	</script>
	<script src="js/chats.js"></script>
	<script src="js/inputs.js"></script>
</body>
</html>