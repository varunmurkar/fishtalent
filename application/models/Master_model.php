<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Master model
 * This model is used to -
 * Fetch all the general information like category, sub category etc.
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @category    Models
 * @author      Shivam
 * @since       Tue 31, May 2016
 * @version     1.0
 * @link        
 */
class Master_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    /**
    *
    */
	function get_category_opt($sel_cat_id = 0){

		$cat_opt_html 		= "";

        $this->db->order_by("cat_name", "asc");
    	$cat_master_query 	= $this->db->get_where("category_master", array("status" => "1"));

    	if($cat_master_query->num_rows() > 0){

    		$cat_opt_html 	= "<option value='0'>Select A Category</option>";
    		$cat_master_row = $cat_master_query->result_array();

    		foreach ($cat_master_row as $cat_master_key => $cat_master_value) {

    			$cat_id 		= $cat_master_value['cat_id'];
    			$cat_name 		= $cat_master_value['cat_name'];
                $cat_sel        = $sel_cat_id==$cat_id?" SELECTED":"";
    			$cat_opt_html 	.= "<option value='".$cat_id."'".$cat_sel.">".$cat_name."</option>";
    		}
    	}

    	return $cat_opt_html;
	}// END FUNCTION

    /**
    *
    */
	function get_sub_category_opt($cat_id, $sel_sub_cat_id = 0){

    	$sub_cat_opt_html     = "<option value='0'>Select A Sub Category</option>";

        $this->db->order_by("sub_cat_name", "asc");
    	$sub_cat_master_query = $this->db->get_where("sub_category_master", array("cat_id" => $cat_id, "status" => "1"));
    	
    	if($sub_cat_master_query->num_rows() > 0){

    		$sub_cat_master   = $sub_cat_master_query->result_array();

    		foreach ($sub_cat_master as $sub_cat_master_key => $sub_cat_master_value) {

    			$sub_cat_id 		= $sub_cat_master_value['sub_cat_id'];
    			$sub_cat_name 		= $sub_cat_master_value['sub_cat_name'];
                $sub_cat_sel    	= $sel_sub_cat_id==$sub_cat_id?" SELECTED":"";
    			$sub_cat_opt_html 	.= "<option value='".$sub_cat_id."'".$sub_cat_sel.">".$sub_cat_name."</option>";
    		}
    	}

    	return $sub_cat_opt_html;
    }// END FUNCTION

}// END CLASS

/* End of file Master_model.php */
/* Location: ./application/models/Master_model.php */