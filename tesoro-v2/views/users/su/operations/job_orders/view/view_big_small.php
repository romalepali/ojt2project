<?php
	$jo="SELECT a.job_no,a.description,a.customer,a.agent,a.artist,a.cover,b.job_kind,c.job_type,d.firstname AS 'agf',d.lastname AS 'agl',e.firstname AS 'arf',e.lastname AS 'arl',f.firstname AS 'cof',f.lastname AS 'col',a.pages,g.payment,h.size,a.received_on,a.encoded_on,i.firstname AS 'efn',i.lastname AS 'eln' FROM jo a LEFT JOIN jo_kinds b ON a.job_kind=b.id LEFT JOIN jo_type c ON b.job_type=c.id LEFT JOIN users_list d ON a.agent=d.id LEFT JOIN users_list e ON a.artist=e.id LEFT JOIN users_list f ON a.cover=f.id LEFT JOIN jo_payments g ON a.payment=g.id LEFT JOIN jo_size h ON a.size=h.id LEFT JOIN users_list i ON a.encoded_by=i.id WHERE a.job_no=".$_GET['view'];

	$jo_result=mysqli_query($conn,$jo);
	$jo=mysqli_fetch_array($jo_result);?>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="des" class="col-12 col-form-label">Description</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['description']!=NULL){ echo $jo['description'];} else {echo "N/A";} ?>" id="des" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="customer" class="col-12 col-form-label">Customer</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['customer']!=NULL){echo $jo['customer'];}else{echo "N/A";}?>" id="customer" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="koj" class="col-12 col-form-label">Job Kind</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $jo['job_kind'];?>" id="koj" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="jt" class="col-12 col-form-label">Job Type</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $jo['job_type'];?>" id="jt" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="agent" class="col-12 col-form-label">Agent</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['agent']!=NULL){echo $jo['agf']." ".$jo['agl'];}else{echo "N/A";}?>" id="agent" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="artist" class="col-12 col-form-label">Artist</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['artist']!=NULL){echo $jo['arf']." ".$jo['arl'];}else{echo "N/A";}?>" id="artist" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="cover" class="col-12 col-form-label">Cover</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['cover']!=NULL){echo $jo['cof']." ".$jo['col'];}else{echo "N/A";}?>" id="cover" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="pages" class="col-12 col-form-label">Pages</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['pages']!=NULL){echo $jo['pages'];}else{echo "N/A";}?>" id="pages" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row"><?php

		$total_copies = 0;
		$units = "";
		$copies_query="SELECT a.copies,b.units FROM jo_copies a LEFT JOIN joc_units b ON a.units=b.id WHERE a.job_no=".$jo['job_no']." ORDER BY a.added_on DESC";
		$copies_result=mysqli_query($conn,$copies_query);
		if(mysqli_num_rows($copies_result)>0){
			while($copies=mysqli_fetch_assoc($copies_result)){
				$total_copies += $copies['copies'];
				$units = $copies['units'];
			}
		}?>

    	<div class="col-xl">
			<div class="form-group row">
				<label for="copies" class="col-12 col-form-label">Total Copies</label>
				<div class="col-12">
					<div class="input-group">
						<input class="form-control" type="text" value="<?php if($total_copies>0){echo $total_copies;}else{echo "N/A";}?> <?php if($units!=NULL){echo $units;}?>" id="copies" disabled>
						<div class="input-group-append index-z">
							<button class="btn btn-outline-secondary" onclick="add_copy('<?php echo $_GET['view']; ?>')">+</button>
							<button class="btn btn-outline-secondary" onclick="copies('<?php echo $_GET['view']; ?>')">more info</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="size" class="col-12 col-form-label">Size</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['size']!=NULL){echo $jo['size'];}else{echo "N/A";}?>" id="size" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="received_on" class="col-12 col-form-label">Received On</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo date('F d, Y',strtotime($jo['received_on']));?>" id="received_on" disabled>
				</div>
			</div>
		</div>

		<div class="col-xl">
			<div class="form-group row">
				<label for="payment" class="col-12 col-form-label">Payment</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php if($jo['payment']!=NULL){echo $jo['payment'];}else{echo "N/A";}?>" id="payment" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl">
			<div class="form-group row">
				<label for="encoded_on" class="col-12 col-form-label">Encoded On</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo date('F d, Y h:i A',strtotime($jo['encoded_on']));?>" id="encoded_on" disabled>
				</div>
			</div>
		</div>
		
		<div class="col-xl">
			<div class="form-group row">
				<label for="encoded_on" class="col-12 col-form-label">Encoded By</label>
				<div class="col-12">
					<input class="form-control" type="text" value="<?php echo $jo['efn']." ".$jo['eln'];?>" id="encoded_on" disabled>
				</div>
			</div>
		</div>
	</div>

	<div class="row"><?php
		$status_query="SELECT a.notes,b.status FROM jo_status a INNER JOIN jos_list b ON a.status=b.id WHERE a.job_no=".$jo['job_no']." ORDER BY a.updated_on DESC LIMIT 1";
		$status_result=mysqli_query($conn,$status_query);
		if(mysqli_num_rows($status_result)>0){
			while($status=mysqli_fetch_assoc($status_result)){?>
				<div class="col-xl">
					<div class="form-group row">
						<label for="status" class="col-12 col-form-label">Current Status</label>
						<div class="col-12">
							<div class="input-group">
								<input class="form-control" type="text" value="<?php echo $status['status'];?>" id="status" disabled>
								<div class="input-group-append index-z">
									<button class="btn btn-outline-secondary" onclick="status('<?php echo $_GET['view']; ?>')">more info</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl">
					<div class="form-group row">
						<label for="notes" class="col-12 col-form-label">Notes</label>
						<div class="col-12">
							<textarea class="form-control" rows="10" id="notes" style="resize: none;" disabled><?php if($status['notes']!=NULL){echo $status['notes'];}else{echo "N/A";}?></textarea>
						</div>
					</div>
				</div><?php
			}
		}else{?>
			<div class="col-xl">
				<div class="form-group row">
					<label for="status" class="col-12 col-form-label">Current Status</label>
					<div class="col-12">
						<div class="input-group">
							<input class="form-control" type="text" value="<?php echo "N/A";?>" id="status" disabled>
							<div class="input-group-append index-z">
								<button class="btn btn-outline-secondary" onclick="status('<?php echo $_GET['view'];?>')">more info</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl">
				<div class="form-group row">
					<label for="notes" class="col-12 col-form-label">Notes</label>
					<div class="col-12">
						<textarea class="form-control" rows="10" id="notes" style="resize: none;" disabled><?php echo "N/A";?></textarea>
					</div>
				</div>
			</div><?php
		}?>
	</div>