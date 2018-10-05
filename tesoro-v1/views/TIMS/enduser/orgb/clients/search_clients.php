<?php
	$tab = $_SESSION["filter"];
?>
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

<div class="input-group mb-3" style="z-index: 0; margin-top: 6px; margin-right: 30px;">
	<input id="search" onkeyup="myFunction()" type="text" name=search class="form-control" autocomplete="off"  placeholder="search for clients" aria-label="search for clients" aria-describedby="basic-addon2" value="<?php echo isset($_POST['search']) ? $_POST['search'] : '' ?>" >
</div>