<?php
    include ('TIMS_verify.php');
    $notifCount = 0;
	$today = date('Y-m-d');

	$checkNotif = "SELECT * FROM jobbings";
	$notif = mysqli_query($conn, $checkNotif);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include ('include/head.php');?>
    <title>TIMS | Dashboard</title>
</head>

<body>
	<?php

	if(mysqli_num_rows($notif) > 0){
		while($notifRow = mysqli_fetch_array($notif)){
			$ddate = strtotime($notifRow['due_date']);
			$cdate = strtotime($today);
			$timeleft = $ddate - $cdate;
			$days = round((($timeleft/24)/60)/60);

			if($days <= 10 && $days >=0){
				$notifCount++;
			}
		}
	}

	if($notifCount > 0){?>
		<script type="text/javascript">
			window.location="dashboard.php?checkNotif=true";
		</script><?php
	}
	else {?>
		<script type="text/javascript">
			window.location="dashboard.php";
		</script><?php
	}
	?>
</body>

</html>
