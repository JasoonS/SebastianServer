<?php
/* Model handles user crud operations
 * user authentication , module permssions
 * by checking access rights
 */
Class Hotel_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/* Method create Hotel 
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function create_hotel($hotel_data)
	{
		$this->db->insert('sb_hotels',$hotel_data);
	
		return $this->db->insert_id();
	}
	
	/* Method Return If Hotel Present  
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel($hotel_name)
	{
	    $this->db->select('COUNT(`sb_hotel_name`) as hotelcount',false);
		$this->db->where('sb_hotel_name',$hotel_name);
		$query=$this->db->get('sb_hotels');
		return $query->result_array();
	}
	
	/* Method Return If Hotel User is present by username 
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel_user_by_name($hotel_user_name)
	{
	    $this->db->select('COUNT(`sb_hotel_username`) as hotelusercount',false);
		$this->db->where('sb_hotel_username',$hotel_user_name);
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	
	/* Method Return If Hotel User is present by username 
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel_user_by_email($hotel_email)
	{
	    $this->db->select('COUNT(`sb_hotel_useremail`) as hotelusercount',false);
		$this->db->where('sb_hotel_useremail',$hotel_email);
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	/* Method create Hotel Admin
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function create_hotel_admin($hotel_admin_data)
	{
		return $this->db->insert('sb_hotel_users',$hotel_admin_data);
	}
	/* Method get Hotel Name
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function get_hotel_name($hotel_id)
	{
		$this->db->select('sb_hotel_name');
		$this->db->where('sb_hotel_id',$hotel_id);
		$query=$this->db->get('sb_hotels');
		return $query->result_array();
	}
	
	/* Method get Hotel Id from Hotel admin email
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function get_hotel_id($adminemail)
	{
		$this->db->select('sb_hotel_id');
		$this->db->where('sb_hotel_useremail',$adminemail);
		$query=$this->db->get('sb_hotel_users');
		$result= $query->result_array();
		return $result[0]['sb_hotel_id'];
	}
	
	/* Method set languages For Hotel
	 * inside system 
	 * @param @int,@array
	 * return @string on success and False on Fail
	 */
	function set_hotel_languages($hotel_id,$languages)
	{
	    $i=0;
		$data=array();
		while($i<count($languages))
		{
			$singleArray=array(
								'lang_id'=>$languages[$i],
								'sb_hotel_id'=>$hotel_id
							);
			array_push($data,$singleArray);
			$i++;
		}
		$this->db->insert_batch('sb_hotel_lang_map',$data);
		return true;
	}
	
	/* Method get listing of hotels
	 * inside system 
	 * @param 	 
	 * return @array on success and False on Fail
	 */
	
	function get_hotels($sTable, $sWhere, $sOrder, $sLimit, $aColumns,$sIndexColumn,$sEcho)
	{
	 
         $sQuery = "
         SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
         FROM   $sTable
         $sWhere
         $sOrder
         $sLimit
         ";
        
        $rResult = $this->db->query($sQuery);
        $rResult_array=$rResult->result_array();
        $iFilteredTotal = count($rResult_array);

        /* Total data set length */
        $sQuery_TR = "
        SELECT COUNT(".$sIndexColumn.") AS TotalRecords
        FROM   $sTable
        ";
        $rResult_TR = $this->db->query($sQuery_TR);
        $rResult_array_TR=$rResult_TR->result_array();
        $iTotal = $rResult_array_TR[0]['TotalRecords'];
        
        $output = array(
            "sEcho" => intval($sEcho),
            "iTotalRecords" => intval($iTotal),
            "iTotalDisplayRecords" => intval($iTotal), //$iFilteredTotal,
            "aaData" => array()
            );
        
        foreach($rResult_array as $aRow){

            $row = array();
             
            foreach($aColumns as $col)
            {
				$row[] = $aRow[$col];              
            }
           // array_push($row, '<a href="'.base_url().'admin/broker/edit_broker/'.$aRow['broker_id'].'" class="editRcords btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i> Edit</a> <a href="javascript:void(0)" id="brkr_'.$aRow['broker_id'].'" class="removeRcords btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i> Remove</a>');

            $output['aaData'][] = $row;
        }
      
        return $output;
  	
	}
	   /*  function broker_listing($sTable, $sWhere, $sOrder, $sLimit, $aColumns,$sIndexColumn,$sEcho) {
         
         $sQuery = "
         SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
         FROM   $sTable
         $sWhere
         $sOrder
         $sLimit
         ";
        
        $rResult = $this->db->query($sQuery);
        $rResult_array=$rResult->result_array();
        $iFilteredTotal = count($rResult_array);

       
        $sQuery_TR = "
        SELECT COUNT(".$sIndexColumn.") AS TotalRecords
        FROM   $sTable
        ";
        $rResult_TR = $this->db->query($sQuery_TR);
        $rResult_array_TR=$rResult_TR->result_array();
        $iTotal = $rResult_array_TR[0]['TotalRecords'];
        
        $output = array(
            "sEcho" => intval($sEcho),
            "iTotalRecords" => intval($iTotal),
            "iTotalDisplayRecords" => intval($iTotal), //$iFilteredTotal,
            "aaData" => array()
            );
        
        foreach($rResult_array as $aRow){

            $row = array();
             
            foreach($aColumns as $col)
            {
                
                if($aRow[$col]=='D'){
                    $row[] = 'Disable';    
                }else{
                      $row[] = $aRow[$col];    
                }          
            }
            array_push($row, '<a href="'.base_url().'admin/broker/edit_broker/'.$aRow['broker_id'].'" class="editRcords btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i> Edit</a> <a href="javascript:void(0)" id="brkr_'.$aRow['broker_id'].'" class="removeRcords btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i> Remove</a>');

            $output['aaData'][] = $row;
        }
        
        return $output;
    }*/

}