/*Project Location Path in javascript are defined here*/
var proj_url		=	location.protocol + "//" + location.host+'/';
//var proj_url		=	location.protocol + "//" + location.host+'/sebastian/';
var ajax_url		=	proj_url+'admin/Ajax/get_ajax_data';
var request_url		=	proj_url+'admin/Request/get_request_data';
var img_url = "https://s3.amazonaws.com/thesebastian";

var add_parent_service_url =proj_url+'admin/HotelServices/addParentService';
var parent_service_img_url= img_url;//proj_url+'user_data/parent_service_pic';
var child_service_img_url=img_url;//proj_url+'user_data/child_service_pic';
var sub_child_service_img_url=img_url;//proj_url+'user_data/sub_child_service_pic';
var edit_parent_service_url =proj_url+'admin/HotelServices/editParentService';
var edit_child_service_url =proj_url+'admin/HotelServices/editChildService';
var edit_sub_child_service_url =proj_url+'admin/HotelServices/editSubChildService';
var add_child_service_url=proj_url+'admin/HotelServices/addChildServices';
var restaurant_pic_url = img_url;//proj_url+'user_data/restaurant_pic';
var user_pic_url=img_url;//proj_url+'user_data/hotel_user_pic';

