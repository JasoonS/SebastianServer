<?php include('header.php'); ?>
	<div class="container-fluid" id="container">
		<div class="row">
			<?php include("menu.php"); ?>
			
			<div class="col-md-10">
				<div id="cotaints">
					<h3><u><?php echo $this->router->fetch_class(); ?></u></h3>
					<form method="post" class="form" enctype="multipart/form-data">
						<div class="marginclass">
							<label>User Email</label>
							<input type="text" name="email" class="form-control" /><span class="error"><?php echo form_error('email'); ?></span>
						</div>
						<div class="marginclass">
							<label>User Name</label>
							<input type="text" name="name" class="form-control" /><span class="error"><?php echo form_error('name'); ?></span>
						</div>
						<div class="marginclass">
							<label>Picture</label>
							<input type="file" name="sb_hotel_user_pic" id="sb_hotel_user_pic" />
						</div>
						<div class="marginclass">
							<input type="submit" name="submit" value="Create" class="btn btn-info"/>
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>				
</body>			
</html>	