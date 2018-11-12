<?php
	include ('config/su_verify.php');
	date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
	<title>JOMIS | Dashboard</title>
</head>

<style type="text/css">
	.nav-dashboard {
		text-decoration: none;
		color: #fff;
		background: rgba(0,0,0,.5);
	}

	.d-list {
		width: 100%;
		box-shadow: 0px 1px 5px gray;
		background-color: white;
		border-top: solid 10px #A90000;
		border-top-right-radius: 5px;
		border-top-left-radius: 5px;
		max-height: 100vh;
		overflow: auto;
	}

	.d-scroll {
		height: 40vh;
		overflow: auto;
	}

	.d-list-t1 {
		border-bottom: 3px solid #A90000;
		padding-bottom: 5px;
	}

	.dashboard{
		text-align: left;
		overflow: auto;
		padding: 5px;   
	}

	.order{
		margin-bottom: 3px;
		font-size: 14px;
		line-height: 16px;
		transition: all ease 1s;
	}

	.order:hover {
		color: black;
		box-shadow: 1px 1px 5px black;
		transition: all ease .5s;
		background-color: white;
	}

	.lvl-1{
		color: black;
		border-left: 10px solid red;
		border-right: 1px solid red;
		border-top: 1px solid red;
		border-bottom: 1px solid red;
	}

	.lvl-2{
		color: black;
		border-left: 10px solid orange;
		border-right: 1px solid orange;
		border-top: 1px solid orange;
		border-bottom: 1px solid orange;
	}

	.lvl-3{
		color: black; 
		border-left: 10px solid gold;
		border-right: 1px solid gold;
		border-top: 1px solid gold;
		border-bottom: 1px solid gold;
	}

	.lvl-4{
		color: black;
		border-left: 10px solid black;
		border-right: 1px solid black;
		border-top: 1px solid black;
		border-bottom: 1px solid black;
	}

	.lvl-5{
		color: black;
		border-left: 10px solid green;
		border-right: 1px solid green;
		border-top: 1px solid green;
		border-bottom: 1px solid green;
	}

	.lvl-6{
		color: black;
		border-left: 10px solid gray;
		border-right: 1px solid gray;
		border-top: 1px solid gray;
		border-bottom: 1px solid gray;
	}

	.lvl-7 {
		color: black;
		background-color: lightgray;
		text-align: center;
	}
</style>

<body style="background-color: #EDEDED">
	<?php include ('include/navbar.php');?>
	<div class="container-fluid">
		<div id="content">
			<div class="row" style="padding-top: 50px;">
				<div class="col-lg">
					<div class="d-lg-flex flex-row p-2 justify-content-center">
						<div class="p-2 d-list">
							<div class="d-list-t1">
								<b>PRIORITY</b>
							</div>
							<div class="list-group dashboard flex-fill list-priority d-scroll"></div>
						</div>
					</div>
				</div>
				<div class="col-lg">
					<div class="d-lg-flex flex-row p-2 justify-content-center">
						<div class="p-2 d-list">
							<div class="d-list-t1">
								<b>RECENT ORDERS</b>
							</div>
							<div class="list-group dashboard flex-fill list-recent d-scroll"></div>
						</div> 
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg">
					<div class="d-lg-flex flex-row p-2 justify-content-center">
						<div class="p-2 d-list">
							<div class="d-list-t1">
								<b>OVERDUE</b>
							</div>
							<div class="list-group dashboard flex-fill list-overdue d-scroll"></div>
						</div>
					</div>
				</div>
				<div class="col-lg mb-3">
					<div class="d-lg-flex flex-row p-2 justify-content-center">
						<div class="p-2 d-list">  
							<div class="d-list-t1">
								<b>OUT</b>
							</div>
							<div class="list-group dashboard flex-fill list-out d-scroll"></div>
						</div>    
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){ 
			function priority(view = ''){
				$.ajax({
					url:"dashboard_priority.php",
					method:"POST",
					data:{view:view},
					dataType:"json",
					success:function(data){
						$('.list-priority').html(data.notification);
					}
				});
			}
		
			priority();
			setInterval(function(){priority();;}, 5000);
		});
	</script>
	<script>
		$(document).ready(function(){ 
			function recent(view = ''){
				$.ajax({
					url:"dashboard_recent.php",
					method:"POST",
					data:{view:view},
					dataType:"json",
					success:function(data){
						$('.list-recent').html(data.notification);
					}
				});
			}
		
			recent();
			setInterval(function(){recent();;}, 5000);
		});
	</script>
	<script>
		$(document).ready(function(){ 
			function out(view = ''){
				$.ajax({
					url:"dashboard_out.php",
					method:"POST",
					data:{view:view},
					dataType:"json",
					success:function(data){
						$('.list-out').html(data.notification);
					}
				});
			}
		
		   out();
			setInterval(function(){out();;}, 5000);
		});
	</script>
	<script>
		$(document).ready(function(){ 
			function overdue(view = ''){
				$.ajax({
					url:"dashboard_overdue.php",
					method:"POST",
					data:{view:view},
					dataType:"json",
					success:function(data){
						$('.list-overdue').html(data.notification);
					}
				});
			}
		
		   overdue();
			setInterval(function(){overdue();;}, 3000);
		});
	</script>
</body>
</html>