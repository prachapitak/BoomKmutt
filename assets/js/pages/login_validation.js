/* ------------------------------------------------------------------------------
*
*  # Login form with validation
*
*  Specific JS code additions for login_validation.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */



$(function() {
	



	// Style checkboxes and radios
	$('.styled').uniform();
	

    // Setup validation
    $("#form-validate").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
			
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            password: {
                minlength: 5
            }
        },
        messages: {
            username: "Enter your username",
            password: {
            	required: "Enter your password",
            	minlength: jQuery.validator.format("At least {0} characters required")
            }
        },
		submitHandler: function (form) {
	
			
			
		
		
			var tmpuser = $('#username').val();	
			
			if(tmpuser == 'admin' || tmpuser == 'purchase' || tmpuser == 'mpurchase'){
				
			$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <p style="font-size: 17px;"> Please Wait System being Processing | กรุณารอซักครู่ระบบกำลังตรวจข้อมูล </p>',
			timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            },
			onUnblock: function() { 
               // alert('Page is now unblocked. FadeOut completed.'); 
			   
			   	
			 
			 		$.ajax({
					
			url: "checklogin.php",        // Url to which the request is send
			type: "POST",
			
			
             data: { 
					
					username	: 	$('#username').val(),
					
					},
			 success: function(data)   // A function to be called if request succeeds
			{
				
			
				
				
				
				
				//alert();
				
				
				

				$.blockUI({ 
            message: '<i class="icon-shield-check " style="font-size: 60px;color: green;"></i> <p style="font-size: 17px;"> Login Successful  </p>',
           timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent',
				onUnblock: function() { 
				
				 setTimeout( function(){ 
    // Do something after 1 second 
	$("#displayerror").html(data);
	//window.location='./';
  }  , 1000 );
				
				
				}
            }
        });
        	
				
					
		
			
				
		
				
			}
		});	
		
			   
			   
            } 
        });
			
		
			 
				
			//	alert(tmpuser);
			//	setTimeout($.unblockUI, 2000);
				//window.location='dashboard.php';
				
				
				} else if(tmpuser  == 'vendor' ) {
					
					$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <p style="font-size: 17px;"> Please Wait System being Processing | กรุณารอซักครู่ระบบกำลังตรวจข้อมูล </p>',
			timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            },
			onUnblock: function() { 
               // alert('Page is now unblocked. FadeOut completed.'); 
			   
			   	
			 
			 		$.ajax({
					
			url: "checklogin.php",        // Url to which the request is send
			type: "POST",
			
			
             data: { 
					
					username	: 	$('#username').val(),
					
					},
			 success: function(data)   // A function to be called if request succeeds
			{
				
			
				
				
				
				
				//alert();
				
				
				

				$.blockUI({ 
            message: '<i class="icon-shield-check " style="font-size: 60px;color: green;"></i> <p style="font-size: 17px;"> Login Successful  </p>',
           timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent',
				onUnblock: function() { 
				
				 setTimeout( function(){ 
    // Do something after 1 second 
	//$("#displayerror").html(data);
	window.location='vendordashboard.php';
  }  , 1000 );
				
				
				}
            }
        });
        	
				
					
		
			
				
		
				
			}
		});	
		
			   
			   
            } 
        });
		
					} else {
					
					$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <p style="font-size: 17px;"> Please Wait System being Processing | กรุณารอซักครู่ระบบกำลังตรวจข้อมูล </p>',
			timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            },
			onUnblock: function() { 
               // alert('Page is now unblocked. FadeOut completed.'); 
			   
			  
			   
			   		$.blockUI({ 
            message: '<i class="icon-shield-notice " style="font-size: 60px;color: red;"></i> <p style="font-size: 17px;"> Login Fail Try Again  </p>',
           timeout: 3000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent',
            }
        });
				
			 
			 
			 		
		 setTimeout( function(){ 
    // Do something after 1 second 
	window.location='./';
  }  , 3000 );
			   
			   
            } 
        });
					
					 
		//document.getElementById("contactForm").reset();
					//$('#contactForm').reset();
					
					
					
					
					
					}
			
			
			
			
			
			
		
			
			
				
		
				
			
			
					
					
				//	setTimeout($.unblockUI, 2000);
	
			/*	$.ajax({
					
					
					url: "index.php",       
					type: "POST",
                    data: { 
					
					
					
							
							username	: 	$('#username').val(),
							
		
						
					
					},
					success: function(data) { setTimeout($.unblockUI, 2000);} 
		}); */
		
					//alert(username);
		
            }
		

		
		
    });
	
	 $("#form-token").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
			
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            password: {
                minlength: 5
            }
        },
        messages: {
            username: "Enter your username",
            password: {
            	required: "Enter your password",
            	minlength: jQuery.validator.format("At least {0} characters required")
            }
        },
		submitHandler: function (form) {
	
			
			
		
		
			var tmpuser = $('#token').val();	
			
			if(tmpuser == 'token'){
				
			$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <p style="font-size: 17px;"> Please Wait System being Processing | กรุณารอซักครู่ระบบกำลังตรวจข้อมูล </p>',
			timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            },
			onUnblock: function() { 
               // alert('Page is now unblocked. FadeOut completed.'); 
			   
			   	
			 
			 		$.ajax({
					
			url: "checklogin.php",        // Url to which the request is send
			type: "POST",
			
			
             data: { 
					
					token	: 	$('#token').val(),
					
					},
			 success: function(data)   // A function to be called if request succeeds
			{
				
			
					$.blockUI({ 
            message: '<i class="icon-shield-check " style="font-size: 60px; color: green;"></i> <p style="font-size: 17px;"> Token Correct  </p>',
           timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent',
				onUnblock: function() { 
				
				 setTimeout( function(){ 
    // Do something after 1 second 
	//$("#displayerror").html(data);
	window.location='vendoragreement.php';
  }  , 1000 );
				
				
				}
            }
        });
				
				
				
				//alert();
				
				
				

			
        	
				
					
		
			
				
		
				
			}
		});	
		
			   
			   
            } 
        });
			
		
			 
				
			//	alert(tmpuser);
			//	setTimeout($.unblockUI, 2000);
				//window.location='dashboard.php';
				
				
				} else {
					
					$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <p style="font-size: 17px;"> Please Wait System being Processing | กรุณารอซักครู่ระบบกำลังตรวจข้อมูล </p>',
			timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            },
			onUnblock: function() { 
               // alert('Page is now unblocked. FadeOut completed.'); 
			   
			  
			   
			   		$.blockUI({ 
            message: '<i class="icon-shield-notice " style="font-size: 60px;color: red;"></i> <p style="font-size: 17px;"> Token Incorrect Please Contact Purchase department . </p>',
           timeout: 3000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent',
            }
        });
				
			 
			 
			 		
		 setTimeout( function(){ 
    // Do something after 1 second 
	window.location='./';
  }  , 2000 );
			   
			   
            } 
        });
					
					 
		//document.getElementById("contactForm").reset();
					//$('#contactForm').reset();
					
					
					
					
					
					}
			
			
			
			
			
			
		
			
			
				
		
				
			
			
					
					
				//	setTimeout($.unblockUI, 2000);
	
			/*	$.ajax({
					
					
					url: "index.php",       
					type: "POST",
                    data: { 
					
					
					
							
							username	: 	$('#username').val(),
							
		
						
					
					},
					success: function(data) { setTimeout($.unblockUI, 2000);} 
		}); */
		
					//alert(username);
		
            }
		

		
		
    });
	
	$("#form-agreememt").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
			
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            password: {
                minlength: 5
            }
        },
        messages: {
            username: "Enter your username",
            password: {
            	required: "Enter your password",
            	minlength: jQuery.validator.format("At least {0} characters required")
            }
        },
		submitHandler: function (form) {
	
			
			$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <p style="font-size: 17px;"> Please Wait System being Processing | กรุณารอซักครู่ระบบกำลังตรวจข้อมูล </p>',
			timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            },
			onUnblock: function() { 
               // alert('Page is now unblocked. FadeOut completed.'); 
			   
			   	
			 
			 		$.ajax({
					
			url: "checklogin.php",        // Url to which the request is send
			type: "POST",
			
			
             data: { 
					
					token	: 	$('#token').val(),
					
					},
			 success: function(data)   // A function to be called if request succeeds
			{
				
			
					$.blockUI({ 
            message: '<i class="icon-shield-check " style="font-size: 60px; color: green;"></i> <p style="font-size: 17px;"> บันทึกข้อมูลสำเร็จ   </p>',
           timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent',
				onUnblock: function() { 
				
				 setTimeout( function(){ 
    // Do something after 1 second 
	//$("#displayerror").html(data);
	window.location='vendorcreateacc.php';
  }  , 1000 );
				
				
				}
            }
        });
				
				
				
				//alert();
				
				
				

			
        	
				
					
		
			
				
		
				
			}
		});	
		
			   
			   
            } 
        });
		
		
			
			
			
			
			
		
			
			
				
		
				
			
			
					
					
				//	setTimeout($.unblockUI, 2000);
	
			/*	$.ajax({
					
					
					url: "index.php",       
					type: "POST",
                    data: { 
					
					
					
							
							username	: 	$('#username').val(),
							
		
						
					
					},
					success: function(data) { setTimeout($.unblockUI, 2000);} 
		}); */
		
					//alert(username);
		
            }
		

		
		
    });
	
	$("#form-createacc").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
			
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            password: {
                minlength: 5
            }
        },
        messages: {
            username: "Enter your username",
            password: {
            	required: "Enter your password",
            	minlength: jQuery.validator.format("At least {0} characters required")
            }
        },
		submitHandler: function (form) {
	
			
			$.blockUI({ 
            message: '<i class="icon-spinner4 spinner"></i> <p style="font-size: 17px;"> Please Wait System being Processing | กรุณารอซักครู่ระบบกำลังตรวจข้อมูล </p>',
			timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent'
            },
			onUnblock: function() { 
               // alert('Page is now unblocked. FadeOut completed.'); 
			   
			   	
			 
			 		$.ajax({
					
			url: "checklogin.php",        // Url to which the request is send
			type: "POST",
			
			
             data: { 
					
					token	: 	$('#token').val(),
					
					},
			 success: function(data)   // A function to be called if request succeeds
			{
				
			
					$.blockUI({ 
            message: '<i class="icon-shield-check " style="font-size: 60px; color: green;"></i> <p style="font-size: 17px;"> บันทึกข้อมูลสำเร็จ   </p>',
           timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#1b2024',
                opacity: 0.8,
                zIndex: 1200,
                cursor: 'wait'
            },
            css: {
                border: 0,
                color: '#fff',
                padding: 0,
                zIndex: 1201,
                backgroundColor: 'transparent',
				onUnblock: function() { 
				
				 setTimeout( function(){ 
    // Do something after 1 second 
	//$("#displayerror").html(data);
	window.location='vendorregister.php';
  }  , 1000 );
				
				
				}
            }
        });
				
				
				
				//alert();
				
				
				

			
        	
				
					
		
			
				
		
				
			}
		});	
		
			   
			   
            } 
        });
		
		
			
			
			
			
			
		
			
			
				
		
				
			
			
					
					
				//	setTimeout($.unblockUI, 2000);
	
			/*	$.ajax({
					
					
					url: "index.php",       
					type: "POST",
                    data: { 
					
					
					
							
							username	: 	$('#username').val(),
							
		
						
					
					},
					success: function(data) { setTimeout($.unblockUI, 2000);} 
		}); */
		
					//alert(username);
		
            }
		

		
		
    });
	
	


});
