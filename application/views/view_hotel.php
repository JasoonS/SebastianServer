<div class="account-container">	
	<div class="content clearfix">
	
	<form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>View Hotel</legend>
				<table id="hotel-table"  class="table  table-bordered" >
					<tbody>
						<tr>
							<td>Hotel Name</td>
							<td><?php echo $hoteldata['sb_hotel_name'];?></td>
						</tr>
						<tr>
							<td>Hotel Picture</td>
							<td><img src='<?php echo FOLDER_BASE_URL.HOTEL_PIC."/".$hoteldata['sb_hotel_pic'];?>' height="100px" width="100px"/></td>
						</tr>
						<tr>
							<td>Hotel Address</td>
							<td><?php echo $hoteldata['sb_hotel_address'];?></td>
						</tr>
						<tr>
							<td>Hotel City</td>
							<td><?php echo $hoteldata['city_name'];?></td>
						</tr>
						<tr>
							<td>Hotel State</td>
							<td><?php echo $hoteldata['state_name'];?></td>
						</tr>
						<tr>
							<td>Hotel Country</td>
							<td><?php echo $hoteldata['country_name'];?></td>
						</tr>
						<tr>
							<td>Hotel Postal Code</td>
							<td><?php echo $hoteldata['sb_hotel_zipcode'];?></td>
						</tr>
						<tr>
							<td>Hotel Category</td>
							<td><?php echo $hoteldata['sb_hotel_category'];?></td>
						</tr>
						<tr>
							<td>Hotel Stars</td>
							<td><?php echo $hoteldata['sb_hotel_star'];?></td>
						</tr>
						<tr>
							<td>Hotel Owner</td>
							<td><?php echo $hoteldata['sb_hotel_owner'];?></td>
						</tr>
						<tr>
							<td>Hotel Website</td>
							<td><?php echo $hoteldata['sb_hotel_website'];?></td>
						</tr>
						<tr>
							<td>Hotel Email</td>
							<td><?php echo $hoteldata['sb_hotel_email'];?></td>
						</tr>
						<tr>
							<td>Hotel Property Built </td>
							<td><?php echo $hoteldata['sb_property_built_month'].$hoteldata['sb_property_built_year'];?></td>
						</tr>
						<tr>
							<td>Hotel Property Opened</td>
							<td><?php echo $hoteldata['sb_property_open_year'];?></td>
						</tr>
						<tr>
							<td>Hotel Languages</td>
							<td><?php echo $hoteldata['lang_name'];?></td>
						</tr>
                    </tbody>
				</table>
		</fieldset>
		
	</form>
	</div>
</div>



