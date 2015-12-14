$(document).ready(function () {
    //We attached Clone Event Listener to copy row on add more for Child
	$('#addButton').click(function(e) {
					e.preventDefault();
					var clone=$('#idAddChildServices tbody>tr:last').clone(true);
					var index=$('#idAddChildServices tbody>tr:last').index()+1;
					clone.find(".radio").prop("name", "is_menu[" +index +"]");
					//clone.find(".radio").prop("name", "is_menu[" +index +"]");
					clone.find(".fileControl").prop("name", "sb_child_service_pic" +index);
					clone.insertAfter('#idAddChildServices tbody>tr:last');
				});
	 //We attached Clone Event Listener to copy row on add more for Sub Child
	$('#addSubChildButton').click(function(e) {
					e.preventDefault();
					var clone=$('#idAddSubChildServices tbody>tr:last').clone(true);
					var index=$('#idAddSubChildServices tbody>tr:last').index()+1;
					clone.find(".subfileControl").prop("name", "sb_child_service_pic" +index);
					clone.insertAfter('#idAddSubChildServices tbody>tr:last');
				});
	$(".upload").click(function(e) {
					e.preventDefault();
					var rank=$(this).closest('.table').find('.upload').index(this);				
					$(".fileControl:eq("+rank+")").click();
					
					
				});
	$(".fileControl").change(function(){
	        var rank=$(this).closest('.table').find('.fileControl').index(this);
			readChildURL(this,rank);
		});
	$(".subupload").click(function(e) {
					e.preventDefault();
					var rank=$(this).closest('.table').find('.subupload').index(this);				
					$(".subfileControl:eq("+rank+")").click();
					
				});
	$(".subfileControl").change(function(){
	        var rank=$(this).closest('.table').find('.subfileControl').index(this);
			console.log($(this).closest('.table'));
			readSubChildURL(this,rank);
		});
    $("#addChildServices").click(function(e) {
					e.preventDefault();
					$form=$("#formAddChild");
					var totalRecords=$('input[name*="sb_child_service_name"]').length;
					//Atleast one child service name has to be provided.
					var flag=0;
					var serviceNamesArray=[];
					var servicesArray=[];
					$("input[name='sb_child_service_name[]']").each(function() {
						var value=$(this).val();
						if(value != "" ){
							flag =1;
							serviceNamesArray.push(value);
							servicesArray.push(value);
						}
					});
					
					var uniqueServiceNamesArray =jQuery.unique( serviceNamesArray );
					if(servicesArray.length != uniqueServiceNamesArray.length){
						flag =2;
					}
					if(flag == 0){
						$("#childErrorDiv").html("Service name is compulsory.");
						$("#childErrorDiv").show();
					}
					else{
						$("#childErrorDiv").hide();
						if(flag == 2){
							$("#childErrorDiv").html("Service name is unique for each child service.");
							$("#childErrorDiv").show();
						}
						else{
								$form.submit();	
						}
					}
					
				});		
    //Submit Sub Services Form After Validation
	$("#addSubChildServices").click(function(e) {
					e.preventDefault();
					$form=$("#formAddSubChild");
					var totalRecords=$('input[name*="sb_child_service_name"]').length;
					//Atleast one child service name has to be provided.
					var flag=0;
					var serviceNamesArray=[];
					var servicesArray=[];
					$("input[name='sb_child_service_name[]']").each(function() {
						var value=$(this).val();
						if(value != "" ){
							flag =1;
							serviceNamesArray.push(value);
							servicesArray.push(value);
						}
					});
					
					var uniqueServiceNamesArray =jQuery.unique( serviceNamesArray );
					if(servicesArray.length != uniqueServiceNamesArray.length){
						flag =2;
					}
					if(flag == 0){
						$("#subchildErrorDiv").html("Service name is compulsory.");
						$("#subchildErrorDiv").show();
					}
					else{
						$("#subchildErrorDiv").hide();
						if(flag == 2){
							$("#childErrorDiv").html("Service name is unique for each child service.");
							$("#childErrorDiv").show();
						}
						else{
								$form.submit();	
						}
					}
					
				});		
    
	//Show Uploaded Image in div after upload in Child Service Creation Grid.
	var readChildURL = function(input,rank) {
     if (input.files && input.files[0]) {
            var reader = new FileReader();		
            reader.onload = function (e) {
			    $(".uploadImage:eq("+rank+")").show(200);
                $(".uploadImage:eq("+rank+")").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
	};
	//Show Uploaded Image in div after upload in Child Sub Service Creation Grid.
	var readSubChildURL = function(input,rank) {
     if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
			    $(".subuploadImage:eq("+rank+")").show(200);
                $(".subuploadImage:eq("+rank+")").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
	};
	
	//We attach This Element Listners For Elements Which Are Dynamically created in Child Services.
	var addChildElementListers = function(){
		$("#id_sbServicePic").change(function(){
			readURL(this);
		});	
		$('#btn-upload').click(function(e){
			e.preventDefault();
			$('#id_sbServicePic').click();}
		);
		$("#idServiceActionButton").click(function(e){
			e.preventDefault();
			editChildService();
				
		});
	};
    //We attach This Element Listners For Elements Which Are Dynamically created in add Parent Services 
	// And Edit Parent Services Popup.
	var addElementListers = function(){
		$('.colorpicker').colorpicker();
		$("#id_sbServicePic").change(function(){
			readURL(this);
		});	
		$('#btn-upload').click(function(e){
			e.preventDefault();
			$('#id_sbServicePic').click();}
		);
		$("#idServiceActionButton").click(function(e){
			e.preventDefault();
			var type=$("#idServiceActionButton").html();
			if(type=="Add"){
					addParentService();
				}
			else{
					editParentService();
				}
		});
	};
	//We attach Listeners For the buttons created in Parent Services Grid
	//1.Show Details 2. Edit
	var attachShowChildLister = function(obj){
		$.each( obj, function( key, value ) {
		    //Event Attachment For Showing Child Services Grid
			$("#show_parent_details_"+value[0]).click(function(e){
				e.preventDefault();
				$("#id_ChildServicesGridWrap").show();
				$("#idChildServiceCreationWrap").hide();
				$("#idChildSubServiceCreationWrap").hide();
				$("#id_ChildSubServicesGridWrap").hide();
				$("#id_ChildServicesGridWrap").show();
				$("#idChildServicesLabel").html(value[1]+ " Child Services");
				createChildServiceGrid(value);
			});
			//Event Attachment For Editing Existing Parent Service in table row
			$("#edit_parent_"+value[0]).click(function(e){
				e.preventDefault();
				var html=populateEditServiceDialog('Parent',value);
				$(".modal-body").html(html);
				$("#myModalLabel").html("Edit Parent Service");
				$("#idServiceActionButton").html("Edit");
				addElementListers();
				$("#sb_service_color").colorpicker();
				$("#modal-dialog").modal('show');
			});
			
			//Event Attachment For Adding Child Service For selected Parent Service in table row
			$("#add_subservices_"+value[0]).click(function(e){
				e.preventDefault();
				$("#id_ChildServicesGridWrap").hide();
				$("#idChildServiceCreationWrap").hide();
			    $("#idChildSubServiceCreationWrap").hide();
				$("#id_ChildSubServicesGridWrap").hide();
				$("#idChildServiceCreationWrap").show();
				$("[name='child_parent_service_id']").val(value[0]);
				$("#idChildServicesCreationLabel").html("Create Child Services For "+value[1]);
			});
		});
	};
	//We attach Listeners For the buttons created in Child Services Grid
	//1.Show Details 2.Edit Child Services
	var attachShowSubChildLister = function(obj){
		$.each( obj, function( key, value ) {
			$("#show_child_details_"+value[0]).click(function(e){
				e.preventDefault();
				$("#id_ChildSubServicesGridWrap").show();
				$("#idChildSubServicesLabel").html(value[1]+ " Sub Services");
				createSubChildServiceGrid(value);
			});
			
			$("#edit_child_"+value[0]).click(function(e){
				e.preventDefault();
				var html=populateEditServiceDialog('Child',value);
				$(".modal-body").html(html);
				$("#myModalLabel").html("Edit Child Service");
				$("#idServiceActionButton").html("Edit");
				addChildElementListers();
				$("#modal-dialog").modal('show');
			});
			
			$("#add_child_subservices_"+value[0]).click(function(e){
				e.preventDefault();
				$("#id_ChildServicesGridWrap").hide();
				$("#idChildServiceCreationWrap").hide();
			    $("#idChildSubServiceCreationWrap").hide();
				$("#id_ChildSubServicesGridWrap").hide();
				$("#idChildSubServiceCreationWrap").show();
				$("[name='child_sub_parent_service_id']").val(value[0]);
				$("#child_sub_parent_service_id").val(value[0]);
				$("#idSubChildServicesCreationLabel").html("Create Child Services For "+value[1]);
			});
		});
	};
	//We attach Listeners For the buttons created in Sub Child Services Grid
	//2.Edit Sub Child Services
	var attachEditSubChildLister = function(obj){
		$.each( obj, function( key, value ) {
			$("#edit_sub_child_"+value[0]).click(function(e){
				e.preventDefault();
				var html=populateEditServiceDialog('Subchild',value);
				$(".modal-body").html(html);
				$("#myModalLabel").html("Edit Child Service");
				$("#idServiceActionButton").html("Edit");
				addSubChildElementListers();
				$("#modal-dialog").modal('show');
			
			});
			
		});
	};
	//This function is to edit sub child service.
	//We attach This Element Listners For Elements Which Are Dynamically created in Child Services.
	var addSubChildElementListers = function(){
		$("#id_sbServicePic").change(function(){
			readURL(this);
		});	
		$('#btn-upload').click(function(e){
			e.preventDefault();
			$('#id_sbServicePic').click();}
		);
		$("#idServiceActionButton").click(function(e){
			e.preventDefault();
			editSubChildService();
				
		});
	};
	//This function is to edit child service.
	var editSubChildService = function(){
		if($("#id_sbHotelService").val()=="")
		{
			$("#id_sbHotelServiceError").html("Please Provide service name");
			$("#id_sbHotelServiceError").show(200);
		}
		else{
			$.ajax({
					url: request_url,
					type:"post",
					data:{flag:'7',service_name:$("#id_sbHotelService").val(),service_id:$("#id_sbHotelServiceId").val()},
					dataType:"json",
					success:function(count)
					{
						if(count >0){
							$("#id_sbHotelServiceError").html("Service with same name already exists.");
							$("#id_sbHotelServiceError").show(200);
						}
						else{
							$("#id_sbHotelServiceError").hide(200);
							$form =$("#id_SubChildServiceCreation");
							$form.submit();
						}
					}
				});	
		}
	}
	//This function is to edit child service.
	var editChildService = function(){
		if($("#id_sbHotelService").val()=="")
		{
			$("#id_sbHotelServiceError").html("Please Provide service name");
			$("#id_sbHotelServiceError").show(200);
		}
		else{
			$.ajax({
					url: request_url,
					type:"post",
					data:{flag:'6',service_name:$("#id_sbHotelService").val(),service_id:$("#id_sbHotelServiceId").val()},
					dataType:"json",
					success:function(count)
					{
						if(count >0){
							$("#id_sbHotelServiceError").html("Service with same name already exists.");
							$("#id_sbHotelServiceError").show(200);
						}
						else{
							$("#id_sbHotelServiceError").hide(200);
							$form =$("#id_ChildServiceCreation");
							$form.submit();
						}
					}
				});	
		}
	}
	//Creation Of Sub Child Services Grid Of Particular Child
	var createSubChildServiceGrid =function(rowdata){
		$('#idSubChildServices').dataTable({
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"bDestroy":true,	
					"ajax": {
						"url": request_url,
						"data":{flag:'4',tablename:'tbname',orderkey: ' sb_sub_child_services ',orderdir:' desc ',parent_id:rowdata[0]},
						"type": "POST",
						"dataSrc": function ( json ) {
									//Make your callback here.
									tbl_data=json.data;
									return json.data;
						}
					},
					"order": [[ 0, "desc" ]],
					"aoColumnDefs": [
						{
							'bSortable': false,
							'aTargets': [2],
						}, //disables sorting for column one
						{
							'bSortable': false,
							'visible':false,
							'aTargets': [3,4,5],
						} //
					],
					"sPaginationType": "full_numbers",
					"dom": 'T<"clear">lfrtip',
					"fnInitComplete": function(oSettings, json) {
						//attachShowSubChildLister(json.data);
						//We need to open dialog for details
						attachEditSubChildLister(json.data);
						addSubChildElementListers(json.data);
					}
				});
				$("tfoot input").keyup(function () {
					
					oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
				});
				$("tfoot input").each(function (i) {
					asInitVals[i] = this.value;
				});
				$("tfoot input").focus(function () {
					if (this.className == "search_init") {
						this.className = "";
						this.value = "";
					}
				});
				$("tfoot input").blur(function (i) {
					if (this.value == "") {
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				});
		
	};
	//Creation Of Child Services Grid Of Particular Parent
	var createChildServiceGrid =function(rowdata){
		$('#idChildServices').dataTable({
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"bDestroy":true,	
					"ajax": {
						"url": request_url,
						"data":{flag:'3',tablename:'tbname',orderkey: ' sb_hotel_child_services ',orderdir:' desc ',parent_id:rowdata[0]},
						"type": "POST",
						"dataSrc": function ( json ) {
									//Make your callback here.
									tbl_data=json.data;
									return json.data;
						}
					},
					"order": [[ 0, "desc" ]],

					"aoColumnDefs": [
						
						{
							'bSortable': false,
							'aTargets': [2,3]
						}
					],
					"sPaginationType": "full_numbers",
					"dom": 'T<"clear">lfrtip',
					"fnInitComplete": function(oSettings, json) {
						attachShowSubChildLister(json.data);
					}
				});
				$("tfoot input").keyup(function () {
					
					oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
				});
				$("tfoot input").each(function (i) {
					asInitVals[i] = this.value;
				});
				$("tfoot input").focus(function () {
					if (this.className == "search_init") {
						this.className = "";
						this.value = "";
					}
				});
				$("tfoot input").blur(function (i) {
					if (this.value == "") {
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				});
		
	};
	//Creation Of Parent Services Grid 
	var createParentServiceGrid = function(){
	    var tbl_data;  
		$('#idParentServices').dataTable({
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"bDestroy":true,	
					"ajax": {
						"url": request_url,
						"data":{flag:'2',tablename:'tbname',orderkey: ' sb_parent_service_id ',orderdir:' desc '},
						"type": "POST",
						"dataSrc": function ( json ) {
									//Make your callback here.
									tbl_data=json.data;
									attachShowChildLister(json.data);
									return json.data;
						}
					},
					"order": [[ 0, "desc" ]],

					"aoColumnDefs": [
						{
							'bSortable': false,
							'aTargets': [2,3]
						},
						{
							'bSortable': false,
							'visible':false,
							'aTargets': [4]
						} //disables sorting for column one		//disables sorting for column one
					],
					"sPaginationType": "full_numbers",
					"dom": 'T<"clear">lfrtip',
					//We need to attach events for buttons in parent grid after initialization.
					"fnInitComplete": function(oSettings, json) {
						attachShowChildLister(json.data);
					},
					//We need to attach events for buttons in parent grid after everytime datatable refershed or created. 
					"drawCallback": function( settings ) {
						var api = this.api();
					    // Output the data for the visible rows to the browser's console
						attachShowChildLister(api.rows( {page:'current'} ).data());
					}						  
				});
				$("tfoot input").keyup(function () {
					
					oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
				});
				$("tfoot input").each(function (i) {
					asInitVals[i] = this.value;
				});
				$("tfoot input").focus(function () {
					if (this.className == "search_init") {
						this.className = "";
						this.value = "";
					}
				});
				$("tfoot input").blur(function (i) {
					if (this.value == "") {
						this.className = "search_init";
						this.value = asInitVals[$("tfoot input").index(this)];
					}
				});

	};
	//Open Popup For Parent Services addition dialog.
	$("#idAddParents").click(function(e){
        e.preventDefault();
		var html=populateAddServiceDialog('Parent');
		$(".modal-body").html(html);
		$("#myModalLabel").html("Add Parent Service");
		$("#idServiceActionButton").html("Add");
		addElementListers();
		$("#modal-dialog").modal('show');
	});
	//Ajax Call for Parent Service Creation.
	var addParentService = function(){
		if($("#id_sbHotelService").val()=="")
		{
			$("#id_sbHotelServiceError").html("Please Provide service name");
			$("#id_sbHotelServiceError").show(200);
		}
		else{
			$.ajax({
					url: request_url,
					type:"post",
					data:{flag:'1',service_name:$("#id_sbHotelService").val()},
					dataType:"json",
					success:function(count)
					{
						if(count >0){
							$("#id_sbHotelServiceError").html("Service with same name already exists.");
							$("#id_sbHotelServiceError").show(200);
						}
						else{
							$("#id_sbHotelServiceError").hide(200);
							$form =$("#id_ParentServiceCreation");
							$form.submit();
						}
					}
				});	
		}
	}
	//Ajax Call for Parent Service Update.
	var editParentService = function(){
		if($("#id_sbHotelService").val()=="")
		{
			$("#id_sbHotelServiceError").html("Please Provide service name");
			$("#id_sbHotelServiceError").show(200);
		}
		else{
			$.ajax({
					url: request_url,
					type:"post",
					data:{flag:'4',service_name:$("#id_sbHotelService").val(),service_id:$("#id_sbHotelServiceId").val()},
					dataType:"json",
					success:function(count)
					{
						if(count >0){
							$("#id_sbHotelServiceError").html("Service with same name already exists.");
							$("#id_sbHotelServiceError").show(200);
						}
						else{
							$("#id_sbHotelServiceError").hide(200);
							$form =$("#id_ParentServiceCreation");
							$form.submit();
						}
					}
				});	
		}
	}
	//Show Uploaded Image in div after upload.
	var readURL = function(input) {
     if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
			    $("#id_uploadImage").show(200);
                $('#id_uploadImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
	};
	//Populate Edit Parent Services Dialog
	var populateEditServiceDialog = function(servicetype,rowdata){
		var html='';
		console.log(rowdata);
		if(servicetype == 'Parent')
		{
			html ='<div class="row"><form id="id_ParentServiceCreation" action="'+edit_parent_service_url+'" method="post" enctype="multipart/form-data"><div class = "form-group classFormInputsBox">'+
                    			'<label for="sbHotelName" class="col-xs-3 control-label">Service Name : </label>'+
							    '<div class="col-xs-10">'+
									'<input id="id_sbHotelService"  name="sb_service_name" type="text" placeholder="Type service name here ...." class="form-control" value="'+rowdata[1]+'"/>'+
								    '<div id="id_sbHotelServiceError"></div>'+
									'<input id="id_sbHotelServiceId"  name="sb_service_id" type="hidden" placeholder="Type service name here ...." class="form-control" value="'+rowdata[0]+'"/>'+								    
								'</div>'+
                   '</div>'+
				   '<div class="form-group classFormInputsBox">'+
									'<label for="sbServicePic" class="col-xs-3 control-label">Service Picture :</label>'+
									'<div class="col-xs-10">'+
									    '<div class="col-xs-6">'+
										'<input id="id_sbServicePic" name="sb_service_pic"  type="file" style="display:none"/>'+
										'<button id="btn-upload">Upload</button>'+
                                        '</div>'+	
										'<div id="id_filePreview" class="col-xs-6">'+
										    '<img id="id_uploadImage" style="width:100%;height:100%" src="'+parent_service_img_url+'/'+rowdata[4]+'" alt="your image" />'+
										'</div>'+										
									'</div>'+
					'</div>'+
					'<div class="form-group">'+
                        '<label for="id_sbServiceColor" class="col-xs-3 control-label">Service Color</label>'+
                            '<div class="col-xs-10">'+
                                    '<input type="text" id="sb_service_color" name="sb_service_color" class="colorpicker form-control" value="'+rowdata[2]+'" />'+
                            '</div>'+
                    '</div></form></div>';
			return html;	
		}
		if(servicetype == 'Child')
		{
			html ='<div class="row"><form id="id_ChildServiceCreation" action="'+edit_child_service_url+'" method="post" enctype="multipart/form-data"><div class = "form-group classFormInputsBox">'+
                    			'<label for="sbHotelName" class="col-xs-3 control-label">Service Name : </label>'+
							    '<div class="col-xs-10">'+
									'<input id="id_sbHotelService"  name="sb_service_name" type="text" placeholder="Type service name here ...." class="form-control" value="'+rowdata[1]+'"/>'+
								    '<div id="id_sbHotelServiceError"></div>'+
									'<input id="id_sbHotelServiceId"  name="sb_service_id" type="hidden" placeholder="Type service name here ...." class="form-control" value="'+rowdata[0]+'"/>'+								    
								'</div>'+
                   '</div>'+
				   '<div class="form-group">'+
                        '<label for="id_sbServiceDetails" class="col-xs-3 control-label">Service Detail :</label>'+
                            '<textarea id="textarea" class="form-control col-md-7 col-xs-12" name="service_detail" >'+rowdata[4]+'</textarea>'+
                    '</div>'+
				   '<div class="form-group classFormInputsBox">'+
									'<label for="sbServicePic" class="col-xs-3 control-label">Service Picture :</label>'+
									'<div class="col-xs-10">'+
									    '<div class="col-xs-6">'+
										'<input id="id_sbServicePic" name="sb_service_pic"  type="file" style="display:none"/>'+
										'<button id="btn-upload">Upload</button>'+
                                        '</div>'+	
										'<div id="id_filePreview" class="col-xs-6">'+
										    '<img id="id_uploadImage" style="width:100%;height:100%" src="'+child_service_img_url+'/'+rowdata[5]+'" alt="your image" />'+
										'</div>'+										
									'</div>'+
					'</div>'+
					'</form></div>';
			return html;	
		}
		if(servicetype == 'Subchild')
		{
			html ='<div class="row"><form id="id_SubChildServiceCreation" action="'+edit_sub_child_service_url+'" method="post" enctype="multipart/form-data"><div class = "form-group classFormInputsBox">'+
                    			'<label for="sbHotelName" class="col-xs-3 control-label">Service Name : </label>'+
							    '<div class="col-xs-10">'+
									'<input id="id_sbHotelService"  name="sb_service_name" type="text" placeholder="Type service name here ...." class="form-control" value="'+rowdata[1]+'"/>'+
								    '<div id="id_sbHotelServiceError"></div>'+
									'<input id="id_sbHotelServiceId"  name="sb_service_id" type="hidden" placeholder="Type service name here ...." class="form-control" value="'+rowdata[0]+'"/>'+								    
								'</div>'+
                   '</div>'+
				   '<div class="form-group">'+
                        '<label for="id_sbServiceDetails" class="col-xs-3 control-label">Service Detail :</label>'+
                            '<textarea id="textarea" class="form-control col-md-7 col-xs-12" name="service_detail" >'+rowdata[5]+'</textarea>'+
                    '</div>'+
				   '<div class="form-group classFormInputsBox">'+
									'<label for="sbServicePic" class="col-xs-3 control-label">Service Picture :</label>'+
									'<div class="col-xs-10">'+
									    '<div class="col-xs-6">'+
										'<input id="id_sbServicePic" name="sb_service_pic"  type="file" style="display:none"/>'+
										'<button id="btn-upload">Upload</button>'+
                                        '</div>'+	
										'<div id="id_filePreview" class="col-xs-6">'+
										    '<img id="id_uploadImage" style="width:100%;height:100%" src="'+sub_child_service_img_url+'/'+rowdata[4]+'" alt="your image" />'+
										'</div>'+										
									'</div>'+
					'</div>'+
					'</form></div>';
			return html;	
		}
	};
	//Populate Add Parent Services Dialog
	var populateAddServiceDialog = function(servicetype)
	{
		var html='';
		if(servicetype == 'Parent')
		{
			html ='<div class="row"><form id="id_ParentServiceCreation" action="'+add_parent_service_url+'" method="post" enctype="multipart/form-data"><div class = "form-group classFormInputsBox">'+
                    			'<label for="sbHotelName" class="col-xs-3 control-label">Service Name : </label>'+
							    '<div class="col-xs-10">'+
									'<input id="id_sbHotelService"  name="sb_service_name" type="text" placeholder="Type service name here ...." class="form-control" />'+
									'<div id="id_sbHotelServiceError"></div>'+
							    '</div>'+
                   '</div>'+
				   '<div class="form-group classFormInputsBox">'+
									'<label for="sbServicePic" class="col-xs-3 control-label">Service Picture :</label>'+
									'<div class="col-xs-10">'+
									    '<div class="col-xs-6">'+
										'<input id="id_sbServicePic" name="sb_service_pic"  type="file" style="display:none"/>'+
										'<button id="btn-upload">Upload</button>'+
                                        '</div>'+	
										'<div id="id_filePreview" class="col-xs-6">'+
										    '<img id="id_uploadImage" style="width:100%;height:100%" src="#" alt="your image" />'+
										'</div>'+										
									'</div>'+
					'</div>'+
					'<div class="form-group">'+
                        '<label for="id_sbServiceColor" class="col-xs-3 control-label">Service Color</label>'+
                            '<div class="col-xs-10">'+
                                    '<input type="text" id="sb_service_color" name="sb_service_color" class="colorpicker form-control" value="#5367ce" />'+
                            '</div>'+
                    '</div></form></div>';
			return html;	
		}
	};
	//Call To Parent Services grid.
	createParentServiceGrid();
});