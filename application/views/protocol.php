<?php
ob_start();
require("../db_classes/User.php");
require("../db_classes/Setting.php");
require("../db_classes/News.php");
require("../db_classes/Content.php");
require("../db_classes/Chat.php");
// print_r($_REQUEST);
error_reporting(0);
//error_reporting(E_ALL);
$usr = new User();
$usr1 = clone  $usr;
$setting = new Setting();
$news = new News();
$content = new Content();
$content1 = clone $content;
$content2 = clone $content;
$chat = new Chat(); 
$chat1 = clone $chat; 
$appkey = "28e336ac6c9423d946ba02d19c6a2632";  // for security purpose which is same @ app side
$json = array();
// get data in json format
//$_REQUEST = json_decode($_REQUEST["data"],true); 
//$_POST = json_decode($_POST["data"],true); 

/*print_r( $_REQUEST ); */


// check for webservice access through mobile devices only
/*if(md5($appkey)!= $_REQUEST["appkey"])
{
	$json["status"]=0;
	$json["statusInfo"]="fail";
	$json["error"]="invalid app key";
	echo $jsondata  = json_encode($json);
	exit;
}*/

// Guest Login
if($_REQUEST["operation"]=="guestlogin")
{
	if(!isset($_REQUEST["guestPasscode"]) || !isset($_REQUEST["deviceToken"]) || !isset($_REQUEST["deviceType"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		// first check user's billing status 
		require_once($_SERVER["DOCUMENT_ROOT"] . "/account/lib/Check_AppBilling.php");
		$VALIDATE  =  new CHECKTHISAPP_validate();
		$flag = $VALIDATE->validate_user($_REQUEST["guestPasscode"]);
		if($flag)
		{ 
		//$rss = $usr->guestLogin($_REQUEST["guestPasscode"]);	
		$rss = $usr->guestadcodeLogin($_REQUEST["guestPasscode"],$_REQUEST["adcode"],$_REQUEST["deviceToken"],$_REQUEST["deviceType"]);	
		if($rss=="wrongpass")
		{
		   $json["status"]=0;
		   $json["statusInfo"]="fail";
		   $json["error"] = "Wrong Password";
		}			
		else
		{
		   // check app is imported from another app
		   $role="guest";
		   $expld = explode("##", $rss);
		   $rs = $expld[0];
		   $name = $expld[1];
		   if($expld[2]) { 
		   $profilepic = AbstractDB::PROFILE_IMAGE.$expld[2]; }
		   else { $profilepic = "";  }
		   $userid = $expld[3];
		   //$adcode = $expld[4];
		   $guestID = $expld[4];
		   $adcode = $expld[5];
		   $themeColor = $expld[6];
		   $appdisplayname = $setting->getAppDisplayName($rs);
		   $appid = $setting->chkAppIsImported($rs);		   
		   //$businessJoinURL = $setting->getAppJoinBusinessurl($appid); //changed on 4th Sept 14
		   $businessJoinURL = $setting->getAppJoinBusinessurl($rs); 
		   
		   // get app's contact details		   
		   $contact = $setting->getAppContactDetails($rs);
		   if($contact=="nodata")
		   {
			   $contact = $setting->getAppContactDetails($appid);
		   }
		   
		   // get left sidebar navigation menu
		   $navigation_menu = $setting->getNavigationMenu($appid,$rs,"guest");
		   //$navigation_menu = $setting->getNavigationMenu($appid,"guest");
		   
		   // get app's sharing setting data
		   $sharingsetting = $setting->getAppShareSettingData($appid);
		   
		   // get unread news count for guest
		   //$news->getNewsCountGuest($appid,'guest');
		   //$newscount=$news->numofrows();
		   $newscount = $usr->getUnreadNewsCount($userid,"guest");
		   
		   $bgrs = $usr->getAppBackground($appid);
		   $rec=$usr->numofrows();
		   if($rec>0)
		   {
			   $usr->getrow();
			   $bgURL = $usr->getField("backgroundImageURL");
			   $isvisible = $usr->getField("visibleTo");
			   if($isvisible=="guest" || $isvisible=="everyone")
			   {
				  // get background URL
				  $json["status"]=1;
		          $json["statusInfo"]="success";
				  $json["appid"]= $rs;  //$appid;
				  $json["imported_appid"]=$appid;   
				  $json["appBackgroundImageURL"]= AbstractDB::APP_BACKGROUND.$bgURL;
				  $json["businessJoinURL"]= $businessJoinURL; // get started button link
			   }
			   else
		       {
				  $json["status"]=1;
				  $json["statusInfo"]="success"; 
				  $json["appid"]=$rs;  //$appid; 
				  $json["imported_appid"]=$appid;   
				  $json["appBackgroundImageURL"]= "no access";
				  $json["businessJoinURL"]= $businessJoinURL; 
		       }	
		   }
		   else
		   {
			  $json["status"]=1;
		      $json["statusInfo"]="success"; 
			  $json["appid"]=$rs;  //$appid;  
			  $json["imported_appid"]=$appid;  
			  $json["appBackgroundImageURL"]= "no access";
			  $json["businessJoinURL"]= $businessJoinURL; 
		   }
		    //$json["appName"]=$rs;
		   	$json["contact_data"]=$contact;  	 
			$json["leftside_navigation_menu"]=$navigation_menu;  
			if($sharingsetting=="") { } else {
			$json["appShareSetting"]=$sharingsetting; } 
			
			
			 // get left sidebar navigation menu
		   //$navigation_menu = $setting->getNavigationMenu($appid,"guest");
		   
		   // empty same device token record
		  
		   
		    //$emptydevice = $usr1->emptyguestdevicetoken($guestID,$_REQUEST["deviceToken"]); 
		   
			//$json["newsCount"]=$newscount;
			$newscount = $news->getUnreadNewsCount($appid,$guestID,$role,"app_guestViewedNews","guestID");
		$trainingcount = $news->getUnreadTrainingArticleCount($appid,$guestID,$role,"app_guestViewedTraining","guestID");
			$calendarcount = $news->getUnreadCalendarCount($appid,$guestID,$role,"app_guestViewedCalendar","guestID");
			$mediacount = $news->getUnreadMediaCount($appid,$guestID,$role);
			$slidesdocscount = $news->getUnreadSlideDocsCount($appid,$guestID,$role,"app_guestViewedPPTDocs","guestID");
			$unreadflag = 0;
			if($chatcount>0)
			{
				$unreadflag = 1;
			}
			else if($newscount>0)
			{
				$unreadflag = 1;
			}
			else if($trainingcount>0)
			{
				$unreadflag = 1;
			}
			else if($calendarcount>0)
			{
				$unreadflag = 1;
			}
			else if($mediacount>0)
			{
				$unreadflag = 1;
			}
			else if($slidesdocscount>0)
			{
				$unreadflag = 1;
			}
			else
			{
				$unreadflag = 0;
			}
			
			$makeonline = $usr->makeonlineguest($guestID);
			$json["newsCount"]=$newscount;
			$json["trainingCount"]=$trainingcount;
			$json["calendarCount"]=$calendarcount;
			$json["mediaCount"]=$mediacount;
			$json["slidedocsCount"]=$slidesdocscount;			
			$json["unreadFlag"]=$unreadflag;
			
			//$json["name"]=$name;
			$json["name"]=$appdisplayname;
			$json["userProfilePic"]=$profilepic;
			$json["userid"]=$guestID;
			//$json["userid"]=$userid;
			$json["guestID"]=$guestID;
			$json["adcode"]=$adcode; 
			$json["themeColor"]=$themeColor;	
			$json["useridForPic"]=$userid;
		}
		
	  }		
	  else
	  {
		 $json["status"]=0;
		 $json["statusInfo"]="fail";
		 $json["error"] = "Your billing status is pending";
	  }
	}
 }

// Member Login
if($_REQUEST["operation"]=="login")
{
	if(!isset($_REQUEST["username"]) || !isset($_REQUEST["password"]) || !isset($_REQUEST["deviceToken"]) || !isset($_REQUEST["deviceType"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		// first check user's billing status 
		require_once($_SERVER["DOCUMENT_ROOT"] . "/account/lib/Check_AppBilling.php");
		$VALIDATE  =  new CHECKTHISAPP_validate();
		$flag = $VALIDATE->validate_user($_REQUEST["username"]);
		if($flag)
		{ 
		$rs = $usr->memberLogin($_REQUEST);		
		if($rs=="wrongusernm")
		{
		   $json["status"]=0;
		   $json["statusInfo"]="fail";
		   $json["error"] = "Wrong Username";
		}
		else if($rs=="wrongpass")
		{
		   $json["status"]=0;
		   $json["statusInfo"]="fail";
		   $json["error"] = "Wrong Password";
		}		
		else
		{
		   $expld=explode("##",$rs);
		   $memberID = $expld[0];
		   $appID = $expld[1];
		   $role = $expld[2];
		   $name = $expld[3];
		   $profile_image = $expld[4];
		   $adcode = $expld[5];
		   $themecolor = $expld[6];
		   //$json["name"]=$name;
		   $appdisplayname = $setting->getAppDisplayName($appID);
		   $json["name"]=$appdisplayname;
		   if($profile_image!="") {
		   $json["userProfilePic"]= AbstractDB::PROFILE_IMAGE.$profile_image;  }
		   else { $json["userProfilePic"]=""; }
		   $rsupdt = $usr->makeonline($memberID,$_REQUEST["deviceToken"],$_REQUEST["deviceType"]);
		   // check app is imported from another app
		   $appid = $setting->chkAppIsImported($appID);
		   //$businessJoinURL = $setting->getAppJoinBusinessurl($appid);
		   $businessJoinURL = $setting->getAppJoinBusinessurl($appID); // changed to 20th Aug 14
		   $chatcount = $chat->getUnreadChatMessageCount($memberID);
		   // get app's contact details
		   $contact = $setting->getAppContactDetails($appID);
		   
		   // get left sidebar navigation menu
		   if($role=="TL")
		   {
			  $navigation_menu = $setting->getNavigationMenuTL($appid,$appID,$role); 
		   }
		   else
		   {
		      $navigation_menu = $setting->getNavigationMenu($appid,$appID,$role);
		   }
		   //$navigation_menu = $setting->getNavigationMenu($appid,$appID,$role);
		   
		   // get app's sharing setting data
		   $sharingsetting = $setting->getAppShareSettingData($appid);
		   
		   //$newscount = $usr->getUnreadNewsCount($memberID,"member");
		   
		   $bgrs = $usr->getAppBackground($appid);
		   $rec=$usr->numofrows();
		   if($rec>0)
		   {
			   $usr->getrow();
			   $bgURL = $usr->getField("backgroundImageURL");
			   $isvisible = $usr->getField("visibleTo");
			   if($isvisible==$role || $isvisible=="everyone")
			   {
				  // get background URL
				  $json["status"]=1;
		          $json["statusInfo"]="success";   
				  $json["userid"]=$memberID;
				  $json["appid"]=$appID;
				  $json["role"]=$role;
				  $json["appBackgroundImageURL"]= AbstractDB::APP_BACKGROUND.$bgURL;
				  $json["businessJoinURL"]= $businessJoinURL; // get started button link
			   }
			   else
		       {
				  $json["status"]=1;
				  $json["statusInfo"]="success"; 
				  $json["userid"]=$memberID;
				  $json["appid"]=$appID;
				  $json["role"]=$role;
				  $json["appBackgroundImageURL"]= "no access";
				  $json["businessJoinURL"]= $businessJoinURL; 
		       }	
		   }
		   else
		   {
			  $json["status"]=1;
		      $json["statusInfo"]="success"; 
			  $json["userid"]=$memberID;
			  $json["appid"]=$appID;
			  $json["role"]=$role;
			  $json["appBackgroundImageURL"]= "no access";
			  $json["businessJoinURL"]= $businessJoinURL; 
		   }
		   
		    //$json["contact_data"]=$contact; 
			$json["imported_appid"]=$appid;   	 
			$json["leftside_navigation_menu"]=$navigation_menu; 
			if($sharingsetting=="") { } else { 
			$json["appShareSetting"]=$sharingsetting; }
			
			// get left sidebar navigation menu
		    //$navigation_menu = $setting->getNavigationMenu($appid,$role); 
			
			$newscount = $news->getUnreadNewsCount($appid,$memberID,$role,"app_memberViewedNews","memberID");
	$trainingcount = $news->getUnreadTrainingArticleCount($appid,$memberID,$role,"app_memberViewedTraining","memberID");
			$calendarcount = $news->getUnreadCalendarCount($appid,$memberID,$role,"app_memberViewedCalendar","memberID");
			$mediacount = $news->getUnreadMediaCount($appid,$memberID,$role);
			$slidesdocscount = $news->getUnreadSlideDocsCount($appid,$memberID,$role,"app_memberViewedPPTDocs","memberID");
			$unreadflag = 0;
			if($chatcount>0)
			{
				$unreadflag = 1;
			}
			else if($newscount>0)
			{
				$unreadflag = 1;
			}
			else if($trainingcount>0)
			{
				$unreadflag = 1;
			}
			else if($calendarcount>0)
			{
				$unreadflag = 1;
			}
			else if($mediacount>0)
			{
				$unreadflag = 1;
			}
			else if($slidesdocscount>0)
			{
				$unreadflag = 1;
			}
			else
			{
				$unreadflag = 0;
			}
			$json["newsCount"]=$newscount;
			$json["trainingCount"]=$trainingcount;
			$json["calendarCount"]=$calendarcount;
			$json["mediaCount"]=$mediacount;
			$json["slidedocsCount"]=$slidesdocscount;
			$json["chatcount"]=$chatcount;	
			$json["unreadFlag"]=$unreadflag;
			$json["adcode"]=$adcode;
			$json["themeColor"]=$themecolor; 			  
		}
		
	   }
	   else
	   {
		  $json["status"]=0;
		  $json["statusInfo"]="fail";
		  $json["error"] = "Your billing status is pending"; 
	   }
	}
}

if($_REQUEST["operation"]=="logout")
{
	if(!isset($_REQUEST["userid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$usr->makeoffline($_REQUEST["userid"]);
		$affectedrows = $usr->getEffectedrows();
		$json["status"]=1;
		$json["statusInfo"]="success";
		/*if($affectedrows>0)
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
		}
		else
		{
			$json["status"]=0;
		    $json["statusInfo"]="fail";
		}*/
	}
}

if($_REQUEST["operation"]=="guestlogout")
{
	if(!isset($_REQUEST["guestid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$usr->makeofflineguest($_REQUEST["guestid"]);		
		$json["status"]=1;
		$json["statusInfo"]="success";		
	}
}

if($_REQUEST["operation"]=="news")
{
	if(!isset($_REQUEST["role"]) || !isset($_REQUEST["appid"]) || !isset($_REQUEST["imported_appid"]) || !isset($_REQUEST["offset"]) || !isset($_REQUEST["userid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data = $news->getAllNews($_REQUEST["role"],$_REQUEST["appid"],$_REQUEST["offset"],$_REQUEST["userid"],$_REQUEST["imported_appid"]);
		//$data= $rs; //$news->getRowReal();
		$timezone = date_default_timezone_get();
		if($data)
		{
			$usr->updateUnreadNewsCount($_REQUEST["userid"],$_REQUEST["role"]);
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["news"]= $data;
			$json["timezone"]=$timezone;
		}
		else
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["news"]=array();
			$json["timezone"]=$timezone;
			//$json["error"]="nodata";
		}
	}
}

if($_REQUEST["operation"]=="newsDetail")
{
	if(!isset($_REQUEST["newsid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data = $news->getNewsDetail($_REQUEST["newsid"]); 
		//$data= $news->getRowReal();
		if($data)
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["news"]= $data;
		}
		else
		{
			$json["status"]=0;
		    $json["statusInfo"]="fail";
			$json["news"]=array();
		}
	}
}

if($_REQUEST["operation"]=="trainingArticle")
{
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["imported_appid"]) || !isset($_REQUEST["role"]) || !isset($_REQUEST["offset"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data = $news->getAllTrainingArticle($_REQUEST["role"],$_REQUEST["appid"],$_REQUEST["offset"],$_REQUEST["imported_appid"]);
		//$data= $news->getRowReal();
		//print_r($data);
		$timezone = date_default_timezone_get();
		if($data)
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["trainingArticles"]= $data;
			$json["timezone"]=$timezone;
		}
		else
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["trainingArticles"]=array();
			$json["timezone"]=$timezone; 
		}
	}
}

if($_REQUEST["operation"]=="trainingArticleDetail")
{
	if(!isset($_REQUEST["trainingArticleID"]) || !isset($_REQUEST["userid"]) || !isset($_REQUEST["appid"]) || !isset($_REQUEST["role"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data = $news->getTrainingArticleDetail($_REQUEST["trainingArticleID"],$_REQUEST["userid"],$_REQUEST["role"]);
		//$data= $news->getRowReal();
		if($data)
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["trainingArticles"]= $data;
			if($_REQUEST["role"]=="guest")
			{
				$tablename = "app_guestViewedTraining";
				$fieldname = "guestID";
			}
			else
			{
				$tablename = "app_memberViewedTraining";
				$fieldname = "memberID";
			}
		$trainingcount = $news->getUnreadTrainingArticleCount($_REQUEST["appid"],$_REQUEST["userid"],$_REQUEST["role"],$tablename,$fieldname);
			$json["trainingCount"]=$trainingcount;
		}
		else
		{
			$json["status"]=0;
		    $json["statusInfo"]="fail";
			$json["trainingArticles"]=array();
		}
	}
}

if($_REQUEST["operation"]=="calendarEvent")
{
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["imported_appid"]) || !isset($_REQUEST["role"]) || !isset($_REQUEST["userid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data = $news->getCalendarEvent($_REQUEST["role"],$_REQUEST["appid"],$_REQUEST["userid"],$_REQUEST["imported_appid"]);
		//$data= $news->getRowReal(); 
		if($data)
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["calendarEvent"]= $data;
		}
		else
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["calendarEvent"]=array();
		}
	}
 }
 
 if($_REQUEST["operation"]=="media")
 {
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["imported_appid"]) || !isset($_REQUEST["role"]) || !isset($_REQUEST["userid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$audio = $content->getAudioData($_REQUEST["role"],$_REQUEST["appid"],$_REQUEST["userid"],$_REQUEST["imported_appid"]); //print_r($audio); exit;
		$video = $content1->getVideoData($_REQUEST["role"],$_REQUEST["appid"],$_REQUEST["userid"],$_REQUEST["imported_appid"]);
		$image = $content2->getImageData($_REQUEST["role"],$_REQUEST["appid"],$_REQUEST["userid"],$_REQUEST["imported_appid"]);
		//print_r($audio); print_r($video);print_r($image); 
		$final = array_merge($audio,$video,$image);	//print_r($final);	
		if(sizeof($final>0))
		{
			array_multisort($final,SORT_DESC); 
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["media"]= $final;
		}
		else
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["media"]=array();
		}
	}
}

if($_REQUEST["operation"]=="slides_docs")
{
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["imported_appid"]) || !isset($_REQUEST["role"]) || !isset($_REQUEST["userid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data = $content->getSlidesDocsData($_REQUEST["role"],$_REQUEST["appid"],$_REQUEST["userid"],$_REQUEST["imported_appid"]);			
		if(sizeof($data>0))
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["slides_docs"]= $data;
		}
		else
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
			$json["slides_docs"]=array();
		}
	}
}

if($_REQUEST["operation"]=="updateChatStatus")
{
	if(!isset($_REQUEST["userid"]) || !isset($_REQUEST["status"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data = $chat->updateChatStatus($_REQUEST["userid"],$_REQUEST["status"]);			
		if($data)
		{
			$json["status"]=1;
		    $json["statusInfo"]="success";
		}
		else
		{
			$json["status"]=0;
		    $json["statusInfo"]="fail";
		}
	}
}

if($_REQUEST["operation"]=="onlineuserlist")
{
	if(!isset($_REQUEST["userid"]) || !isset($_REQUEST["appid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$chat->getAppids($_REQUEST["userid"],$_REQUEST["appid"]);
		$rec=$chat->numofrows();  
		$appids[]= $_REQUEST["appid"];
		if($rec>0)
		{   
		  while($chat->getRow())
		  {
			$appids[]=$chat->getField('id');
		  }
		}
		//print_r($appids);
		$appids = implode(",",$appids);
		// get all app users
		$list = $chat1->getOnlineUserList($appids,$_REQUEST["userid"]);
		$total_message = $chat->getUnreadChatMessageCount($_REQUEST["userid"]);
		$json["status"]=1;
		$json["statusInfo"]="success";
		$json["onlineUserList"]=$list;	
		$json["total_unread_message"]=$total_message;	
		$json["user_status"]=$chat->getUserSatus($_REQUEST["userid"]);
	}
}

if($_REQUEST["operation"]=="appBackground")
{
	if(!isset($_REQUEST["userid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		
		$data = $chat->appBackgroundNotificationData($_REQUEST["userid"]);
		if($data)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		}
		else
		{
		  $json["status"]=0;
		  $json["statusInfo"]="fail";
		}
	}
}

if($_REQUEST["operation"]=="saveChat")
{
	header('Content-Type: application/json; Charset=UTF-8');
	$chatdata = $_REQUEST['data'];
	$reqdata = json_decode($chatdata); 
	//if(!isset($_REQUEST["userid"]) || !isset($_REQUEST["appid"]) || !isset($_REQUEST["receiverid"]) || !isset($_REQUEST["message"])) 
	if($reqdata->appid=="" || $reqdata->userid=="" || $reqdata->message=="" || $reqdata->receiverid=="")
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		// get unread message count	
		$data = $chat->saveChatDetails($reqdata);
		if($data)
		{
		  //check receiver's app is in background or not? IF yes then send push notification
		  //For now only send push notification to receiverid for evry message
		  $usr->getUserDeviceDetails($reqdata->receiverid);//($_REQUEST["receiverid"]); 
		  if($usr->numofrows()>0)
		  {
			 $usr->getRow();
			 $device_token =  $usr->getField("deviceToken");
			 $device_type = $usr->getField("deviceType");
			 $usr->getUserDeviceDetails($reqdata->userid);//($_REQUEST["userid"]); 
			 $usr->getRow();
			 $sendername =  $usr->getField("name"); 
			 $senderProfilePic = $usr->getField("profileImage"); 
			 if($senderProfilePic)
			 { 
			     $senderProfilePic = AbstractDB::PROFILE_IMAGE.$senderProfilePic;
			 }
			 $total_message = $chat->getUnreadChatMessageCount($reqdata->receiverid);//($_REQUEST["receiverid"]);
			 if($device_type=="IOS")
			 {
			    // send apple push notification
				include_once('includes/Notification.php');				  
				$push = new Notification();
				//$sound = 'default';  
				$message = "You have received Chat message from ".$sendername;
				$payloadArr = array('alert' => $message, 'senderid' => $reqdata->userid,"sendername" => $sendername,"senderProfilePic" => $senderProfilePic, 'type' => "chat",'totalUnreadCount' => $total_message);
				$result = $push->send_notification($device_token,$payloadArr);
			 }
			 else
			 {
				include_once('includes/GCM.php');				  
				$gcm = new GCM();				
				$registatoin_ids = array($device_token);
				$message = array("message" => "You have received Chat message from ".$sendername,"senderid" => $reqdata->userid,"sendername" => $sendername,"senderProfilePic" => $senderProfilePic,"totalUnreadCount" => $total_message);  
				$result = $gcm->send_notification($registatoin_ids, $message);
			 }
		  }
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		}
		else
		{
		  $json["status"]=0;
		  $json["statusInfo"]="fail";
		}
	}
}

if($_REQUEST["operation"]=="getChat")
{
	if(!isset($_REQUEST["recieverid"]) || !isset($_REQUEST["senderid"]) || !isset($_REQUEST["offset"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$timezone = date_default_timezone_get();
		$data = $chat->getChatDetails($_REQUEST["recieverid"],$_REQUEST["senderid"],$_REQUEST["offset"],$_REQUEST["devicetype"]);
		if(sizeof($data)>0)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["message"]=$data ;
		  $json["timezone"]=$timezone;
		}
		else
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success"; 
		  $json["message"]=$data;
		  $json["timezone"]=$timezone;
		}
	}
}

if($_REQUEST["operation"]=="saveGroupChat")
{
	header('Content-Type: application/json; Charset=UTF-8');
	$groupchat = $_REQUEST['data'];
	$reqdata = json_decode($groupchat); //echo $reqdata->appid;
	//$_REQUEST = json_decode($_REQUEST["data"],true); 
	//if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["senderid"]) || !isset($_REQUEST["message"]))
	if($reqdata->appid=="" || $reqdata->senderid=="" || $reqdata->message=="")
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		//$data = $chat->saveGroupChatData($_REQUEST);
		$data = $chat->saveGroupChatData($reqdata);
		$expld = explode("#",$data);
		$msgid = $expld[0];
		$datetime = $expld[1];
		if($msgid)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["messageID"]=$msgid;
		  $json["datetime"]=$datetime;
		}
		else
		{
		  $json["status"]=0;
		  $json["statusInfo"]="fail";
		}
	}
}

if($_REQUEST["operation"]=="getGroupChatData")
{
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["offset"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data=$chat->getGroupChat($_REQUEST["appid"],$_REQUEST["offset"]);
		$timezone = date_default_timezone_get();
		if(sizeof($data)>0)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["Timezone"]=$timezone;
		  $json["message"]=$data;
		}
		else
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["Timezone"]=$timezone;
		  $json["message"]=$data;
		}
	}
}

/*if($_REQUEST["operation"]=="getRecentGroupChatData")
{
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["lastmessageid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data=$chat->getRecentGroupChat($_REQUEST);
		$timezone = date_default_timezone_get();
		if(sizeof($data)>0)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["Timezone"]=$timezone;
		  $json["message"]=$data;
		}
		else
		{
		  $json["status"]=0;
		  $json["statusInfo"]="fail";
		  $json["Timezone"]=$timezone;
		  $json["message"]=$data;
		}
	}
}

if($_REQUEST["operation"]=="getPreviousGroupChatData")
{
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["lastmessageid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing"; 
	}
	else
	{
		$data=$chat->getPreviousGroupChat($_REQUEST);
		$timezone = date_default_timezone_get();
		if(sizeof($data)>0)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["Timezone"]=$timezone;
		  $json["message"]=$data;
		}
		else
		{
		  $json["status"]=0;
		  $json["statusInfo"]="fail";
		  $json["Timezone"]=$timezone;
		  $json["message"]=$data;
		}
	}
}*/
if($_REQUEST["operation"]=="presentationSlides")
{
	if(!isset($_REQUEST["appid"]) || !isset($_REQUEST["imported_appid"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data=$setting->getAppPresentationSlides($_REQUEST["appid"],$_REQUEST["imported_appid"]);
		if(sizeof($data)>0)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["slides"]=$data;
		  $businessJoinURL = $setting->getAppJoinBusinessurl($_REQUEST["appid"]); 
		  $json["businessJoinURL"]= $businessJoinURL;

		}
		else
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";
		  $json["slides"]=$data;
		  $businessJoinURL = $setting->getAppJoinBusinessurl($_REQUEST["appid"]); 
		  $json["businessJoinURL"]= $businessJoinURL;

		}
	}
}


if($_REQUEST["operation"]=="updatethemeColor")
{
	if(!isset($_REQUEST["userid"]) || !isset($_REQUEST["themeColor"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		$data=$setting->updateThemeColor($_REQUEST["userid"],$_REQUEST["themeColor"]); 
		if($data)
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";		  
		}
		else
		{
		  $json["status"]=1;
		  $json["statusInfo"]="success";		 
		}
	}
}

if($_REQUEST["operation"]=="getappdisplayname")
{
	if(!isset($_REQUEST["appid"]) && !isset($_REQUEST["userid"]) && !isset($_REQUEST["role"]))
	{
		$json["status"]=0;
		$json["statusInfo"]="fail";
		$json["error"]="parameter missing";
	}
	else
	{
		if($_REQUEST["role"]=="guest")
		{
			$themeColor = $usr->getThemeColorGuest($_REQUEST["guestpasscode"]);
			if($themeColor=="nodata")
			{
				$json["status"]=0;
			    $json["statusInfo"]="fail";
			}
			else
			{
			   $appdisplayname = $setting->getAppDisplayName($_REQUEST["appid"]);	 
		       $profileimage = $setting->getUserProfilePic($_REQUEST["userid"]);//  
			   $json["status"]=1;
			   $json["statusInfo"]="success";
			   $json["themeColor"]=$themeColor;
			   $json["name"]=$appdisplayname;
		       $json["userProfilePic"]=$profileimage;
			}
		}
		else
		{
		  $appdisplayname = $setting->getAppDisplayName($_REQUEST["appid"]);	 
		  $profileimage = $setting->getUserProfilePic($_REQUEST["userid"]);//  
		  $json["status"]=1;
		  $json["statusInfo"]="success";	
		  $json["name"]=$appdisplayname;
		  $json["userProfilePic"]=$profileimage;	
		}
	}
}




echo $jsondata  = json_encode($json);
//date_default_timezone_set('Asia/Calcutta');
// create log file
$logfile = "ServerLog/serverLog".date("d-m-Y").".txt";
$fp = fopen($logfile, 'a');
$req_dump = print_r($_REQUEST, TRUE);
fwrite($fp, "\n\nDateTime => ".date("l d/m/Y h:i:s A"));
fwrite($fp, "\nServer Request => ".$req_dump); // for direct post data
fwrite($fp, "Response => ".$jsondata);
fwrite($fp, "\nHTTP_USER_AGENT  => ".$_SERVER['HTTP_USER_AGENT']); 
fwrite($fp, "\nREQUEST_METHOD => ".$_SERVER['REQUEST_METHOD']); 
fwrite($fp, "\nREQUEST_URI => ".$_SERVER['REQUEST_URI']); 
fwrite($fp, "\nREMOTE_ADDR => ".$_SERVER['REMOTE_ADDR']); 
fwrite($fp, "\n************************************************************");
fclose($fp);


function send_notification($device_token,$payloaddata)
{
        $badge = 3;	
		$sound = 'default';
		$development = true; 
		$payload = array();		
		$payload['aps'] = $payloaddata; 
		$payload = json_encode($payload); 
		$apns_url = NULL;
		$apns_cert = NULL;
		$apns_port = 2195; 
		if($development)
		{
			$apns_url = 'gateway.sandbox.push.apple.com'; 
			$apns_cert = 'includes/push/CheckThisApp.pem'; // vapetilly.pem 
			//$apns_cert = '/checkthisapp/webapi/api/includes/push/CheckThisApp.pem'; // vapetilly.pem 
		}
		else
		{
			//$apns_url = 'gateway.push.apple.com';
			//$apns_cert = 'push/ck.pem';
		}		
		$stream_context = stream_context_create();
		stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
		stream_context_set_option($stream_context, 'ssl', 'passphrase', 'checkThisApp');
		$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);		 
			
		$apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $device_token)) . chr(0) . chr(strlen($payload)) . $payload;
		return $rs = fwrite($apns, $apns_message);    
		echo $rs; 
        @socket_close($apns);
        @fclose($apns);    	
}
?>