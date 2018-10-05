<style type="text/css">
	.btn-outline-secondary{
		margin-right: 9px;
		color: white;
		background-color: #8B0000;
	}

	.btn-outline-secondary:hover{
		color: #8B0000;
		background-color: white;
	}
</style>
<form action="clients_small_jobs.php" method="POST" class="input-group mb-3" style="z-index: 0; margin-top: 6px; margin-right: 30px;">
	<input type="search" name="search" class="form-control" placeholder="search for Small Job Clients" aria-label="search for clients" aria-describedby="basic-addon2" value="<?php if(isset($search)){echo $search;}?>">
	<div class="input-group-append">
		<button class="btn btn-outline-secondary" name="submit" type="submit"><b>SEARCH</b></button>
	</div>
</form>