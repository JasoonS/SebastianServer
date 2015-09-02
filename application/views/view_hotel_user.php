<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">    
<link href="<?php echo THEME_ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/star-rating.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-checktree.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/fileinput.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-checktree.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>

<div class="right_col" role="main">
    <div class="">
	<legend>View Hotel User</legend>
	<form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
		<fieldset>
				<table id="hotel-table"  class="table  table-bordered" >
					<tbody>
						<tr>
							<td>Hotel Name</td>
							<td><?php echo $userinfo->sb_hotel_name;?></td>
						</tr>
						<tr>
							<td>User Name</td>
							<td><?php echo $userinfo->sb_hotel_username;?></td>
						</tr>
						<tr>
							<td>User Email</td>
							<td><?php echo $userinfo->sb_hotel_useremail;?></td>
						</tr>
						<tr>
							<td>User Picture</td>
							<td><img src='<?php echo FOLDER_BASE_URL."/".HOTEL_USER_PIC."/".$userinfo->sb_hotel_user_pic;?>' height="100px" width="100px"/></td>
						</tr>
						<?php print_r($userinfo);?>
					    <?php if(($userinfo->sb_hotel_user_type == 's')||($userinfo->sb_hotel_user_type == 'm')) {?>
						<tr>
							<td>User Shift From</td>
							<td><?php echo date("g:i A",strtotime($userinfo->sb_hotel_user_shift_from));?></td>
						</tr>
						<tr>
							<td>User Shift To</td>
							<td><?php echo date("g:i A",strtotime($userinfo->sb_hotel_user_shift_to));?></td>
						</tr>
						<tr>
							<td>Designation</td>
							<td><?php echo $userinfo->sb_staff_designation_name;?></td>
						</tr>
						<tr>
							<td>Service</td>
							<td><?php echo $userinfo->sb_parent_service_name;?></td>
						</tr>
						<?php }?>
						<tr>
							<td>Hotel User Type</td>
							<td>
							<?php 
									switch($userinfo->sb_hotel_user_type)
									{
										case 'u': {
													echo "Super Administrator";
													break;
												   }
										case 'a': {
													echo "Hotel Administrator";
													break;
												   }	
										case 'm': {
													echo "Hotel Manager";
													break;
												   }
										case 's': {
													echo "Hotel Staff";
													break;
												   }
													
									}
								?></td>
						</tr>
                    </tbody>
				</table>
		</fieldset>
	</form>
	</div>
</div>



