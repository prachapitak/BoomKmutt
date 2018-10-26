<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title><?php echo $title;?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>logo.ico">
  <?php $this->load->view('main/allcss');?>
  <?php $this->load->view('main/alljs3');?>
  
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
 
 
  	<link href="https://fonts.googleapis.com/css?family=Prompt:400,300,100,500,700,900" rel="stylesheet" type="text/css">
  

<style>
      
      
      @import url("https://fonts.googleapis.com/css?family=Comfortaa");
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  height: 100vh;
  background: linear-gradient(50deg, #ec7334, lightsalmon);
   font-family: 'Comfortaa', sans-serif;
}

.container {
  width: 100%;
  margin: 40vh auto;
  text-align: center;
}

.textnew {
  font-family: 'Comfortaa', sans-serif;
  font-size: 14em;
  text-align: center;
  background: transparent;
  border: none;
  outline: none;
  color: white;
  width: 100%;
}

input[type=button], input[type=reset] {
  width: 525px;
  height: 50px;
  margin: 10px;
  background-color: rgba(255, 255, 255, 0.5);
  outline: none;
  border: none;
  font-family: 'Comfortaa', sans-serif;
  font-size: 12em;
  color: #111;
  border-radius: 5px;
  transition: all 0.3s ease;
  cursor: pointer;
}
input[type=button]:hover, input[type=reset]:hover {
  background-color: rgba(255, 255, 255, 0.8);
}

      </style>
  </head>

  <body class=""  style="font-family:Prompt; background-color:rgba(0, 0, 0, 0) !important; margin-bottom:0px !important;" >




<!-- Page container -->
<div class="page-container"> 
    
    <!-- Page content -->
    <div class="page-content"> 
    
    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content-group" style="margin-bottom: 0px !important;">
         <br><br>
          <form action="#">
  <h1 class="text-center" style="font-size:50px;" ><?php echo $getperson->title; ?></h1>
  
 
  <h1 class="text-center textnew"  id="counterText"> <?php echo $getperson->val; ?> </h1>
   
    <!--<input type="button" value="Add One" id="counterButton" onclick="counterButton_onclick()">-->
   <!-- <input type="reset">-->
   

<h1 class="text-center" style="font-size:20px;" id="maxperson" >TOTAL : <?php echo $getperson->maxval; ?></h1>


<style> 
.progress{
	        height: 40px;
			   
	}
	.progress-bar{
		 font-size: 25px;
		 line-height: 37px;
		
		}
</style>

	
								<div class="progress progress-rounded text-center" style="max-width:80%;    margin: 0 auto;">
									<div class="progress-bar progress-bar-striped active" style="width: 0%" id="process">
										<span id="completed">0% Complete</span>
									</div>
								</div>	
								
								
   
   <h1 class="text-center" style="font-size:20px;"><?php echo $getperson->footer; ?></h1><br>
   
   <h1 class="text-center">
   
   <a href="#nogo"  class="btn btn-primary btn-sm legitRipple"  onClick="settitle('settitle','<?php echo $getperson->title;?>');" >SET TITLE</a> 
   <a href="#nogo"  class="btn btn-primary btn-sm legitRipple"  onClick="settitle('setfooter','<?php echo $getperson->footer;?>');" >SET Footer</a>  
   <a href="#nogo"  class="btn btn-primary btn-sm legitRipple"  onClick="settitle('setmaxperson','<?php echo $getperson->maxval;?>');" >SET MAX Total</a> 
   
   <a href="#nogo"  class="btn btn-primary btn-sm legitRipple"  onClick="settitle('setperson','<?php echo $getperson->val;?>');" >SET Total</a>
   
   <a href="#nogo"  class="btn btn-primary btn-sm legitRipple"  onClick="settitle('resetperson','0');" >RESET TOTAL</a> 
   
  
   
   
   </h1>
  </form>
        
      </div>
      </div>
  </div>
    <!-- /main content --> 
    
  </div>
<!-- /page content -->


<!-- /page container -->

<script type="text/javascript">
    
  

	function ajaxcalldata() {
	
	
	 $.ajax({ 
					
					 
					 url:'<?php echo base_url(); ?>addperson/checknow',
                   
                     method:"POST",  
                    // data: formData,  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     success:function(data)  
                     {  
			//alert (data);
			
			 var resultAjax = JSON.parse(data);
			 if(resultAjax.status == '200'){
				 
				  document.getElementById("counterText").innerHTML = resultAjax.total ;
				  document.getElementById("completed").innerHTML = resultAjax.total2+'% Complete';
				  document.getElementById("process").setAttribute("style", "width: "+resultAjax.total2+"%");
				  
				  
				   
				   document.getElementById("maxperson").innerHTML = 'TOTAL : ' + resultAjax.total3;
				  
				  
				  
				  
				  
				
				
				 } else {
					
					//alert resultAjax.message;
										
					 }
					 
					 
				//console.log(resultAjax.message);
					 
		
						 
                     }  
                }); 	
	
	
	
	}
	
	
	function settitle(title,valtitle){
		
		//alert(title + valtitle );
		//return false
		
			
			 swal({
            title: '',
            text: '',
			inputValue : valtitle,
            type: "input",
            showCancelButton: true,
            confirmButtonColor: "#2196F3",
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Settitle."
        },
        function(inputValue){
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("");
                return false
            }
			
			
				
				
			$.ajax({
			
			
			 url:"<?php echo base_url(); ?>addperson/"+title+"/"+inputValue,    		
			 
			type: "POST",
			
			
             data: { 
					
					//ObjNo	: 	inputValue,
					//MenuList	: 	title,
					
					
					},
			 success: function(data)   
			{
				
	
				var resultAjax = JSON.parse(data);
				
				if(resultAjax.status == '200'){
				 
				 
				  swal({
                title: " ",
                text: "Please wait",
                type: "success",
                confirmButtonColor: "#2196F3"
            });
			
			 setTimeout( function(){ 
			// window.location='<?php echo base_url(); ?>'+req+'/'+detail+'/'+inputValue;
    window.location.reload(1);
  }  , 3000 );
				 
				
				  
				 
				 } 
				 else {
					 
					 //alert('fail');
					 swal({
            title: ""  + inputValue + " Incorrect",
            text: "",
            confirmButtonColor: "#EF5350",
            type: "error"
        });
					 }
	
			
				
        		
			},error: function(){
				
				
				swal({
                    title: "ส่งข้อมูลไม่สำเร็จ",
                    text: "Error Send Data Please Check your Network connection | ไม่สามารถส่งข้อมูลไปยังระบบได้โปรดตรวจสอบการเชื่อมต่อ ระบบ Network  ของท่าน",
                    confirmButtonColor: "#2196F3",
                    type: "error",
					
                });
				
				 setTimeout( function(){ 
    window.location.reload(1);
  }  , 2000 );
   
				//alert('Error Send Data Please Check your Wifi connection | ไม่สามารถส่งข้อมูลไปยังระบบได้โปรดตรวจสอบการเชื่อมต่อ wifi ของท่าน ');
				}
		});	
			
          
			
			
        });
			
			}
	
	
	window.onload = function () {
	
	
	 setInterval(ajaxcalldata, 500);
	 
	// setInterval(ajaxcalldataeventnow, 5000);
	 
	 
	 
    
};

    </script>
</body>
</html>