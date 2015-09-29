<div class="col-md-2" id="menu">
	<div id='cssmenu'>
		<ul>
			<li>
				<div  style="width:200px;margin-left:-50px;color: #fff;font-size:12px;">
					Your listing - 10% complete
					<div class="progress">
					  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10"
					  aria-valuemin="0" aria-valuemax="100" style="width:10%">
					    10%
					  </div>
					</div>
				</div>
			</li>
			<li>
				<a href='#' class="<?php if($this->router->fetch_class()== "Hotel"){echo "read";}else{echo "not-active" ;} ?>"><span>basic info</span></a>
			</li>
		   	<li>
		   		<a href='<?php echo BASE_URL; ?>addProperty/Admin' class="<?php if($this->router->fetch_class()== "Admin"){echo "read";}else{echo "not-active" ;} ?>"><span>Create Admin</span></a>
		   	</li>
		   	<li>
		   		<a href='<?php echo BASE_URL; ?>addProperty/Upload' class="<?php if($this->router->fetch_class()== "Upload"){echo "read";}else{echo "not-active" ;} ?>"><span>Upload Images</span></a>
		   	</li>
		</ul>
	</div>
</div>	