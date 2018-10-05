<?php
if(isset($_POST['export']) && $_POST['export']!=NULL){
	$query = $_POST['export'];

	function export ($record){
		include ('TIMS_verify.php');
		$csv_filename = 'export.'.date("Y.m.d.h.i.sa").'.csv';
		$query = $record;

		if (!$result = mysqli_query($conn, $query)) {
			exit(mysqli_error($conn));
		}

		$record = array();
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$record[] = $row;
			}
		}

		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=".$csv_filename."");
		$output = fopen('php://output', 'w');

		if (count($record) > 0) {
			foreach ($record as $row) {
				fputcsv($output, $row);
			}
		}
	}

	export($query);
}
?>