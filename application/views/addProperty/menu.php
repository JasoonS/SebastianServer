<div class="col-md-2" id="menu">
	<div id='cssmenu'>
		<ul>
		   <li  style="background-color: white;"><a href='#' class="<?php if($this->router->fetch_class()== "Hotel"){echo "read";}else{echo "not-active" ;} ?>"><span>Create Hotel</span></a></li>
		   <li><a href='<?php echo BASE_URL; ?>/addProperty/Admin' class="<?php if($this->router->fetch_class()== "Admin"){echo "read";}else{echo "not-active" ;} ?>"><span>Create Admin</span></a></li>
		   <li><a href='<?php echo BASE_URL; ?>/addProperty/Upload' class="<?php if($this->router->fetch_class()== "Upload"){echo "read";}else{echo "not-active" ;} ?>"><span>Upload Images</span></a></li>
		</ul>
	</div>
</div>	