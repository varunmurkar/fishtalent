<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Library for product form elements
 */
class Product_form_element {

	function __construct(){
		
	}

	/**
	*
	*/
	function compulsory_section($required_list, $main_title = 'Compulsory Requirements'){

		$required_list_html = '';

		if(count($required_list) > 0){
			$required_list_html = '<ol>';
            foreach ($required_list as $required_list_key => $required_list_value) {
                $required_list_html .= '<li>'.$required_list_value.'</li>';
            }
            $required_list_html .= '</ol>';
        }

		$compulsory_section_html = '<div class="white-box wb67 mb30 p37">
			<div class="wbTitle">'.$main_title.'</div>
			'.$required_list_html.'
			<div class="clearfix"></div>
		</div>';

		return $compulsory_section_html;
	}// END FUNCTION

	/**
	*
	*/
	function product_input_section($input_name, $input_value, $input_attribute, $label, $parent_class = "PDcolumn"){

		$input_section_html = '<div class="'.$parent_class.'">
			<div class="form-group label-floating">
			    <label class="control-label">'.$label.'</label>
			    '.form_input($input_name, $input_value, $input_attribute).'
			</div>
		</div>';

		return $input_section_html;
	}// END FUNCTION

	/**
	*
	*/
	function product_checkbox_section($input_name, $input_value, $input_checked = FALSE, $input_attribute = array(), $input_label = '', $parent_class = "extraCheck"){

		$checkbox_section_html = '<div class="checkbox '.$parent_class.'">
			    <label>'.form_checkbox($input_name, $input_value, $input_checked, $input_attribute).' '.$input_label.'</label>
		</div>';

		return $checkbox_section_html;
	}// END FUNCTION

	/**
	*
	*/
	function product_more_input_section($input_data, $block_count = 10){

		$more_input_section = '';

		if(count($input_data) > 0){

			$more_input_section = '<div class="more" style="display:block;">';

			for($i=1; $i<$block_count; $i++){
				foreach ($input_data as $input_data_key => $input_data_value) {

					$element_type 		 = $input_data_value['type'];
					$element_name 		 = $input_data_value['name'].'['.$i.']';
					$element_value_info	 = $input_data_value['value'];
					$element_label  	 = $input_data_value['label'];
					$element_attribute	 = is_array($input_data_value['attribute'])?$input_data_value['attribute']:array();
					
					if($element_type == 'checkbox'){

						$element_checked 	= isset($element_value_info[$i])?$element_value_info[$i]:FALSE;
						$more_input_section .= $this->product_checkbox_section($element_name, '1', $element_checked, $element_attribute, '');
					}else{
						$element_value 		= isset($element_value_info[$i])?$element_value_info[$i]:'';
						$more_input_section .= $this->product_input_section($element_name, $element_value, $element_attribute, $element_label);
					}
				}
				$more_input_section .= '<div class="clearfix"></div>';
			}
			$more_input_section .= '</div>';
		}

		return $more_input_section;
	}// END FUNCTION

	/**
	*
	*/
	function product_includes_input_section($input_type, $input_name, $input_value, $input_attribute, $parent_label, $input_label = '', $input_selected = array(), $parent_class = "PDcolumn material"){

		$element_html = '';
		if($input_type == 'select'){
			$element_html = form_dropdown($input_name, $input_value, $input_selected, $input_attribute);
		}else if($input_type == 'multiselect'){
			$element_html = form_multiselect($input_name, $input_value, $input_selected, $input_attribute);
		}else{
			$element_html = '<label class="control-label">'.$input_label.'</label>'.form_input($input_name, $input_value, $input_attribute);
		}

		$includes_input_section_html = '<div class="block">
			<div class="labels">'.$parent_label.'</div>
			<div class="'.$parent_class.'">
				<div class="form-group label-floating">
					'.$element_html.'
				</div>
			</div>
			<div class="clearfix"></div>
		</div>';

		return $includes_input_section_html;
	}// END FUNCTION

} // END CLASS

/* End of file Product_form_element.php */
/* Location: ./application/libraries/Product_form_element.php */