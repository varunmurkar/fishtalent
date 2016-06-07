<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Writing product model
 * This model is used to -
 * Fetch all information related to writing product.
 *
 * @package     CodeIgniter
 * @subpackage  Models
 * @category    Models
 * @author      Shivam
 * @since       Tue 31, May 2016
 * @version     1.0
 * @link        
 */
class Wr_product_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->library('product_form_element');
	}

	function aep_form_html($product_detail = array()){

		$file_format_option = array(".doc", ".docx", ".txt", ".pdf");
		$language_data = array(
			"1" => "English",
			"2" => "Hindi",
			"3" => "Marathi"
		);
		$prod_language = array();

		$industry_data = array(
			"1" => "IT",
			"2" => "Marketing",
			"3" => "Financial"
		);
		$prod_industry = array();
		$prod_revision = '';

		$compulsory_required_list = array('Well researched, formatted and structured content.','Content written will have a plagiarism free guarantee','Proofread: grammatically correct, with no spelling errors','100% copyrights passed to the buyer', 'Keep your client data confidential');
		$compulsory_section_html  = $this->product_form_element->compulsory_section($compulsory_required_list);

		$more_input_data = array(
			array(
				'type' 		=> 'checkbox',
				'name' 		=> 'more_quantity_flag',
				'value' 	=> array(),
				'attribute' => array('class' => 'more_quantity_flag'),
				'label' 	=> ''
			),
			array(
				'type' 		=> 'text',
				'name' 		=> 'more_quantity',
				'value' 	=> array(),
				'attribute' => array('class' => 'form-control more_quantity'),
				'label' 	=> 'words'
			),
			array(
				'type' 		=> 'text',
				'name' 		=> 'more_price',
				'value' 	=> array(),
				'attribute' => array('class' => 'form-control more_price'),
				'label' 	=> '<i class="fa fa-inr blackcolor"></i>Price for the order'
			),
			array(
				'type' 		=> 'text',
				'name' 		=> 'more_delivery',
				'value' 	=> array(),
				'attribute' => array('class' => 'form-control more_delivery'),
				'label' 	=> 'Delivery time in <span class="blackcolor">days</span>'
			)
		);

		$extra_more_input_data = array(
			array(
				'type' 		=> 'checkbox',
				'name' 		=> 'extra_quantity_flag',
				'value' 	=> array(),
				'attribute' => array('class' => 'extra_quantity_flag'),
				'label' 	=> ''
			),
			array(
				'type' 		=> 'text',
				'name' 		=> 'extra_quantity',
				'value' 	=> array(),
				'attribute' => array('class' => 'form-control extra_quantity'),
				'label' 	=> 'words'
			),
			array(
				'type' 		=> 'text',
				'name' 		=> 'extra_price',
				'value' 	=> array(),
				'attribute' => array('class' => 'form-control extra_price'),
				'label' 	=> '<i class="fa fa-inr blackcolor"></i>Price for the order'
			),
			array(
				'type' 		=> 'text',
				'name' 		=> 'extra_delivery',
				'value' 	=> array(),
				'attribute' => array('class' => 'form-control extra_delivery'),
				'label' 	=> 'Delivery time in <span class="blackcolor">days</span>'
			)
		);

		$file_format_html 	= '<div class="suggest-border formats"><div class="line-heading font16">Formats</div>';

		foreach ($file_format_option as $file_format_key => $file_format_value) {
			$file_format_html .= $this->product_form_element->product_checkbox_section('file_format[]', $file_format_value, FALSE, array('class' => 'file_format'), $file_format_value);
		}

		$file_format_html 	.= '<div class="clearfix"></div></div>';

	    $form_html = $compulsory_section_html.'
		<div class="white-box wb67">
			<div class="collpseTitle">Product Details</div>
			<div class="panel-body">
				<p>Deliverables</p>
				'.$this->product_form_element->product_input_section('main_quantity', '', array('class' => 'form-control main_quantity'), 'No of <span class="blackcolor">words</span>').
				$this->product_form_element->product_input_section('main_price', '', array('class' => 'form-control main_price'), '<i class="fa fa-inr blackcolor"></i>Price for the order').
				$this->product_form_element->product_input_section('main_delivery_time', '', array('class' => 'form-control main_delivery_time'), 'Delivery time in <span class="blackcolor">days</span>').'
				<div class="clearfix"></div>
				<div>
					<a class="add adjustPDC"><img src="'.$this->config->item('img_path').'/add.png"></a>
					'.$this->product_form_element->product_more_input_section($more_input_data).'
				</div>
				<div class="line-heading font16">Includes</div>
				'.$this->product_form_element->product_includes_input_section('input', 'prod_revision', $prod_revision, array('class' => 'form-control prod_revision'), 'Language', 'E.g.,3').'
				'.$this->product_form_element->product_includes_input_section('multiselect', 'prod_language', $language_data, array('class' => 'prod_language'), 'Language', '', $prod_language).'
				'.$this->product_form_element->product_includes_input_section('multiselect', 'prod_industry', $industry_data, array('class' => 'prod_industry'), 'Industries', '', $prod_industry).'
				<div class="clearfix"></div>
				'.$file_format_html.'
				<div class="clearfix"></div>
				<div class="suggest-border">
					<div class="font14 pb20 graycolor">Extras</div>
					<div class="block">
						'.$this->product_form_element->product_checkbox_section('extra_quantity_flag', '1', FALSE, array('class' => 'extra_quantity_flag')).
						$this->product_form_element->product_input_section('extra_quantity', '', array('class' => 'form-control main_quantity'), 'E.g. No of <span class="blackcolor">words</span>').
						$this->product_form_element->product_input_section('extra_price', '', array('class' => 'form-control main_price'), '<i class="fa fa-inr blackcolor"></i>Price for the order').
						$this->product_form_element->product_input_section('extra_delivery_time', '', array('class' => 'form-control main_delivery_time'), 'Delivery time in <span class="blackcolor">days</span>').'<div class="clearfix"></div>
					</div>
					<div class="row align-right pr30 graycolor">
						View Quantity options <i class="fa fa-angle-down"></i><br>
						<a class="add"><img src="'.$this->config->item('img_path').'/add.png"></a>
					</div>
					'.$this->product_form_element->product_more_input_section($extra_more_input_data).'
				</div>
			</div>
		</div>';

	    return $form_html;
	}
} // END CLASS

/* End of file Wr_product_model.php */
/* Location: ./application/controllers/Wr_product_model.php */