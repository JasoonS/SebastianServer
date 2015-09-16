<?php include('header.php'); ?>
		</div>
	</div>	
	<div class="container-fluid" id="container">
		<div class="row">
			<?php include("menu.php"); ?>
			
			<div class="col-md-10">
				<div id="cotaints">
					<h3><u><?php echo $this->router->fetch_class(); ?></u></h3>
					<form method="post" class="form" enctype="multipart/form-data">
						<label>User Email</label>
						<input type="text" name="email" class="form-control" /><span class="error"><?php echo form_error('email'); ?></span>
						<br />
						<label>User Name</label>
						<input type="text" name="name" class="form-control" /><span class="error"><?php echo form_error('name'); ?></span><br />
						
						<label>Picture</label>
					    <input type="file" name="sb_hotel_user_pic" id="sb_hotel_user_pic" />
						<input type="submit" name="submit" value="Create" class="btn btn-info" style="margin-left:200px;">
					</form>	
				</div>
			</div>
		</div>
	</div>				
</body>			
</html>	