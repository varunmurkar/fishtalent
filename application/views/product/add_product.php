<!DOCTYPE html>
<html lang="en">
	<head>
		<?php 
		$this->load->view("includes/meta_tag"); 
		$this->load->view("includes/stylesheet");
		?>
	</head>
	<body class="bg">
		<?php $this->load->view("includes/header"); ?>
		<div class="container2 mb30">
			<?php $this->load->view("product/product_nav"); ?>
			<div class="white-box wb67 mb30 p37 ">
				<div class="wbTitle">Select product type</div>
				<div class="material">
					<div class="col-sm-4">
						<select name="cat_id" class="prod_cat" placeholder="Select A Category">
							<?php echo $cat_opt_html; ?>
						</select>
					</div>
					<div class="col-sm-4">
						<select name="sub_cat_id" class="prod_sub_cat" placeholder="Select A Sub Category">
							<?php echo $sub_cat_opt_html; ?>
						</select>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="tooltips">
					Explainer or error/ warning tooltip/ message.
				</div>
			</div>
			<?php echo $form_html; ?>
		</div>
		<div class="save-footer">
			<div class="container2">
				<div class="wb67">
					<div class="save-footer-left">
						<p>Editing Screencast</P>
						<p class="graycolor">3 products added</P>
						<div class="clearfix"></div>
					</div>
					<div class="save-footer-right">
						<button class="btn btnblue">Save and Continue</button><br>
						<p class="graycolor">You can edit this later</p>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("includes/javascript.php"); ?>
		<script type="text/javascript">
			var BASE_URL = '<?php echo $this->config->item("base_url"); ?>';

			$("body").on("change", ".prod_cat", function(){

				var return_data = false;
				var cat_id 		= $(this).val();
				
				$.ajax({
		    		type: "GET",
		    		url: BASE_URL+"/product/get_sub_category",
		    		data: "cat_id="+cat_id,
		        	async: false,
		        	success: function(msg){
		        		var response_msg = $.parseJSON(msg);
		        		if(response_msg['res_flag'] == '1'){
				        	$(".prod_sub_cat").html(response_msg['res_msg']);
				        	return_data = true;
				        }else{
				        	alert("Please select a category.");
				        	return_data = false;
				        }
		        	},
		        	error: function(xhr,status,error){
			            alert("Oops! some error occurred while processing.");
			            return_data = false;
			        }
		    	});

		    	return return_data;
			});

			$("body").on("change", ".prod_sub_cat", function(){

				var return_data = false;
				var sub_cat_id	= $(this).val();

				$.ajax({
		    		type: "POST",
		    		url: BASE_URL+"/product/get_product_form",
		    		data: "sub_cat_id="+sub_cat_id,
		        	async: false,
		        	success: function(msg){
		        		var response_msg = $.parseJSON(msg);
		        		if(response_msg['res_flag'] == '1'){
				        	$(".form_pr_div").html(response_msg['res_msg']);
				        	$('input').iCheck({
							  	checkboxClass: 'icheckbox_minimal',
							  	radioClass: 'iradio_minimal'   
						  	});
						  	$('.multiselect').SumoSelect();
						  	if($(".newSelectBox").length > 0){
						  		$('.newSelectBox').selectBoxIt({autoWidth: false});
						  		$('.newSelectBox').removeClass('newSelectBox');
						  	}
				        	return_data = true;
				        }else{
				        	alert("Please select a sub category.");
				        	return_data = false;
				        }
		        	},
		        	error: function(xhr,status,error){
			            alert("Oops! some error occurred while processing.");
			            return_data = false;
			        }
		    	});

		    	return return_data;
			});
		</script>
	</body>
</html>