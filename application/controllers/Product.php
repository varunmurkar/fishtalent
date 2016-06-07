<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Product handles all requests related to product form
 * @author Shivam Sharma
 */
class Product extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('master_model');
		$this->load->library('javascript');
	}

	/**
	*
	*/
	function add_product(){

		$cat_id		= 0;
		$sub_cat_id = 0;
		$user_id 	= 1;

		$data['cat_opt_html'] 		= $this->master_model->get_category_opt($cat_id);
		$data['sub_cat_div']		= " style='display:none;'";
		$data['sub_cat_opt_html'] 	= "<option value='0'>Select A Sub Category</option>";

		if($cat_id != 0){
			$data['sub_cat_opt_html'] = $this->master_model->get_sub_category_opt($cat_id, $sub_cat_id);
			$data['sub_cat_div']	  = '';
		}
		$this->load->model("product/wr_product_model");
        $data['form_html'] 	= $this->wr_product_model->aep_form_html(array());

		$this->load->view("product/add_product", $data);
	}// END FUNCTION

	/**
	*
	*/
	function get_sub_category(){
		
		$cat_id 	 = $this->input->get('cat_id');
		$sub_cat_opt = $this->master_model->get_sub_category_opt($cat_id);

		if($sub_cat_opt != ''){
			$response_arr['res_flag'] = '1';
			$response_arr['res_msg']  = $sub_cat_opt;
		}else{
			$response_arr['res_flag'] = '-1';
		}

		echo $this->javascript->generate_json($response_arr);
		exit;
	}// END FUNCTION
	
	/**
	*
	*/
	function get_product_form(){

		$sub_cat_id 	= isset($_POST['sub_cat_id'])?$_POST['sub_cat_id']:"0";
		$sub_cat_detail	= $this->product_model->get_sub_cat_detail($sub_cat_id);

		$response_arr['res_flag'] = '0';
		$response_arr['res_msg']  = '';

		if(count($sub_cat_detail) < 1){
			$response_arr['res_flag'] = '-1';
		}else{
			$response_arr['res_flag'] = '1';

			$cat_code		= $sub_cat_detail[0]['cat_code'];
			$sub_cat_code	= $sub_cat_detail[0]['sub_cat_code'];
			$class_name		= $cat_code."_product_model";
			$func_name		= $sub_cat_code."_form_html";
			
			$this->load->model("product/".$class_name);
			$form_html = $this->$class_name->$func_name();
			$response_arr['res_msg'] = $form_html;
		}

		echo $this->javascript->generate_json(array_map('utf8_encode', $response_arr));
		exit;
	}// END FUNCTION
} // END CLASS

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */