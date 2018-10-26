
<?php

if($this->session->userdata('lang') == ''){
	$this->Lang_Model->lang('th');

	} else {
		
if(!empty($_GET['lang'])){
	$this->Lang_Model->lang($this->input->get('lang'));

	} 
		
		
		}
		

// echo $this->session->userdata('lang').'<br>';		



?>

<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->