<div class="account-container">	
        <legend>Hotels List </legend>
		<div class="container">
			<table id="hotel-grid"  class="table table-striped table-bordered" >
					<thead>
                        <tr>
                            <th>Hotel ID</th>
                            <th>Hotel Name</th>
                            <th>Hotel Owner</th>
							<th>Hotel Email</th>
							<th>Hotel Website</th>
							<th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
			</table>
		</div>
</div>
<script type="text/javascript">
var table;

$(document).ready(function () {
     var columnnames=['sb_hotel_id','sb_hotel_name','sb_hotel_owner','sb_hotel_email','sb_hotel_website','sb_hotel_website'];
     table = $('#hotel-grid').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
			"data":{flag:'3',tablename:'sb_hotels',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:columnnames},
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
		 "order": [[ 0, "desc" ]]

      });
	
	
});
</script>


