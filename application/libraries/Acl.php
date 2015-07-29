<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Access control level class for checking user roles
 * user persmission
 */
Class Acl 
{
	public $perms 		= array();
	public $userID;
	public $userRoles	= array();
	public $ci;

	function __construct($config=array())
	{
		$this->ci = &get_instance();
		$this->userID = floatval($config['userID']);
        $this->userRoles = $this->getUserRoles();
        $this->buildACL();
	}

	/* Method checks if user has any
	 * roles assigned 
	 * @pram void
	 * return array
	 */
	function getUserRoles()
	{
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_roles` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";
 
        $this->ci->db->where(array('sb_hotel_user_id'=>floatval($this->userID)));
        $this->ci->db->order_by('sb_role_added_on','asc');
        $sql = $this->ci->db->get('sb_user_roles');
        $data = $sql->result();
 
        $resp = array();
        foreach( $data as $row )
        {
            $resp[] = $row->sb_roleid;
        }
        return $resp;
	}

	/* Methods create permission array
	 * for the roles assigned to user
	 * @param void
	 * return array
	 */
	function buildACL() 
	{
        //first, get the rules for the user's role
        if (count($this->userRoles) > 0)
        {
            $this->perms = array_merge($this->perms,$this->getRolePerms($this->userRoles));
        }

        //then, get the individual user permissions
        $this->perms = array_merge($this->perms,$this->getUserMods($this->userID));
    }

    /* Method returns all permissions
     * specific to a role
     * @param array or int
     * return array
     */
    function getRolePerms($role) 
    {
        if (is_array($role))
        {
            //$roleSQL = "SELECT * FROM `".DB_PREFIX."role_perms` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
            $this->ci->db->where_in('sb_roleid',$role);
        } else {
            //$roleSQL = "SELECT * FROM `".DB_PREFIX."role_perms` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
            $this->ci->db->where(array('sb_roleid'=>floatval($role)));
        }


 
        $this->ci->db->order_by('sb_role_mod_id','asc');
        $sql = $this->ci->db->get('sb_roles_mod'); //$this->db->select($roleSQL);
        $data = $sql->result();

        $assigned_mods = array();
        foreach( $data as $row )
        {
            $pK = strtolower($this->getPermKeyFromID($row->sb_mod_id));
            if ($pK == '') { continue; }
            if ($row->sb_role_mod_val === '1') {
                $hP = true;
            } else {
                $hP = false;
            }
            $assigned_mods[$pK] = array('module_key' => $pK,'inheritted' => true,'value' => $hP,'name' => $this->getPermNameFromID($row->sb_mod_id),'id' => $row->sb_mod_id,'is_parent' => $this->getPermParentFlag($row->sb_mod_id),'parent_id'=> $this->getPermParentId($row->sb_mod_id));
        }
        return $assigned_mods;
    }

    /* Method returns permission key
     * @param int
     * return string
     */
    function getPermKeyFromID($permID) 
    {
        //$strSQL = "SELECT `permKey` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
        $this->ci->db->select('sb_mod_key');
        $this->ci->db->where('sb_mod_id',floatval($permID));
        $sql = $this->ci->db->get('sb_modules',1);
        $data = $sql->result();
        return $data[0]->sb_mod_key;
    }

    /* Method returns permission name
     * @param int
     * return string
     */

    function getPermNameFromID($permID) 
    {
        //$strSQL = "SELECT `permName` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
        $this->ci->db->select('sb_mod_name');
        $this->ci->db->where('sb_mod_id',floatval($permID));
        $sql = $this->ci->db->get('sb_modules',1);
        $data = $sql->result();
        return $data[0]->sb_mod_name;
    }

    /* Method returns modules associated
     * with user
     * @param int
     * return array
     */
    function getUserMods($userID) {
        //$strSQL = "SELECT * FROM `".DB_PREFIX."user_perms` WHERE `userID` = " . floatval($userID) . " ORDER BY `addDate` ASC";
 
        $this->ci->db->where('sb_hotel_user_id',floatval($userID));
        $this->ci->db->order_by('sb_user_mod_added_on','asc');
        $sql = $this->ci->db->get('sb_user_modules');
        $data = $sql->result();
 
        $assigned_mods = array();
        foreach( $data as $row )
        {
            $pK = strtolower($this->getPermKeyFromID($row->sb_mod_id));
            if ($pK == '') { continue; }
            if ($row->sb_user_mod_val == '1') {
                $hP = true;
            } else {
                $hP = false;
            }
            $assigned_mods[$pK] = array('module_key' => $pK,'inheritted' => false,'value' => $hP,'name' => $this->getPermNameFromID($row->sb_mod_id),'id' => $row->sb_mod_id,'is_parent' => $this->getPermParentFlag($row->sb_mod_id),'parent_id'=> $this->getPermParentId($row->sb_mod_id));
        }
        return $assigned_mods;
    }

    /* Method return parent flag for 
     * module @pram int
     * return string
     */
    function getPermParentFlag($permID)
    {
        $this->ci->db->select('sb_mod_is_parent');
        $this->ci->db->where('sb_mod_id',$permID);
        $sql = $this->ci->db->get('sb_modules',1);
        $data = $sql->result();
        return $data[0]->sb_mod_is_parent;
    }

    /* Method return parent id of any module
     * if exist
     * @param void
     * return int
     */
    function getPermParentId($permID)
    {
        $this->ci->db->select('sb_mod_parent_id');
        $this->ci->db->where('sb_mod_id',$permID);
        $sql = $this->ci->db->get('sb_modules',1);
        $data = $sql->result();
        return $data[0]->sb_mod_parent_id;
    }


    /* Method return parent modules and their sub modules
     * accessible to user permission
     * @param void
     * return array
     */
    function getPermittedParentChildMods()
    {
        foreach($this->perms as $key => $value)
        {

            if($value['is_parent']!== 'y' && $value['parent_id'] !== 0)
            {
                continue;
            }

            $subModules = $this->getSubModules($value['parent_id']);


            if($subModules)
            {
                $value['subMods']   = $subModules;
            }
        }

        //echo '<pre>';
        //print_r();
        //exit;

        return $value;
    }

    /* Method return submodules for any
     * respective parent id by checking $perms array
     * @param void
     * return array
     */
    public function getSubModules($parentId)
    {

        $Modules    = array();
        foreach($this->perms as $key=>$value)
        {
            if($value['parent_id'] !== $parentId)
            {
                //$Modules[] = $value;
                continue;
            }

            $Modules[] = $value;
        }

        if(!empty($Modules))
            return $Modules;
        else
            return FALSE;  
    }

    /* Method will check if user has rights to access
     * this module
     * @param int
     * return TRUE/FALSE
     */
    function hasPermission($permKey) 
    {
        $permKey = strtolower($permKey);
        if (array_key_exists($permKey,$this->perms))
        {
            if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true)
            {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}