<?php include('header.php'); ?>
	<div class="container-fluid" id="container">
		<div class="row">	
			<?php include("menu.php"); ?>
			<div class="col-md-10">
				<div id="cotaints">
					<h3><u><?php echo $this->router->fetch_class(); ?></u></h3>
					<form method="post" class="form" enctype="multipart/form-data">
						<label>Picture</label>
						<input type="file" name="upload[]" class="form-control" multiple reqired/>
						<span class="error"><?php if(isset($error)){echo $error;} ?></span>
						<br />	
						<input type="submit" name="submit" value="Upload" class="btn btn-success">
					</form>	
				</div>
			</div>
		</div>
	</div>				