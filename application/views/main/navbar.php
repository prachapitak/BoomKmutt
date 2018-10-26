   <!-- Main navbar -->
	
    <div class="navbar navbar-default header-highlight" style="min-height: 70px !important; background-color:#0d4ea1 !important;">
		
        
           <div class="navbar-header" style="margin-bottom: 20px;background-color:#0d4ea1 !important;"">
			<a class="navbar-brand" href="<?php echo base_url(); ?>dashboard/"><img src="<?php echo base_url(); ?>assets/images/logo_light.png" alt="" style="min-height:45px;"></a>
			
            
            
            
			
			<ul class="nav navbar-nav pull-right visible-xs-block">
            
            <li><a class="sidebar-mobile-main-toggle" style="margin-top: 10px;"><i class="icon-paragraph-justify3"></i></a></li>
            
            		
			
                    
                    <li><a href="<?php echo base_url(); ?>logout/" style="margin-top: 10px;">
						<i class="icon-lock"></i> <span class=" position-right">  </span>
					</a></li>
             
            
            
                    
				
                    
			</ul>
            
            
		</div>




		<div class="navbar-collapse collapse" id="navbar-mobile">
       
        
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs" style="margin-top: 10px;"><i class="icon-paragraph-justify3" style=" color:#ffffff;"></i></a></li>



				
			</ul>
            
            

			<div class="navbar-right">
				<p class="navbar-text" style="margin-top: 10px;color:#ffffff;">Welcome, <?php echo $getuser->name;?></p>
				
				
				<ul class="nav navbar-nav">		
                
                
              
                
                
                <li>
					<a href="<?php echo base_url(); ?>logout/" style="margin-top: 10px;">
						<i class="icon-lock" style="color:#ffffff;"></i> <span class=" position-right" style="color:#ffffff;"> Logout </span>
					</a>
				</li>
                
                	<li>
					<a href="#" style="margin-top: 10px;">
						<i class="icon-help" style="color:#ffffff;"></i> <span class=" position-right">  </span>
					</a>
				</li>
                
                    		
								
				</ul>
			</div>
		</div>
        
        
        

		
        
        
	</div>
	<!-- /main navbar -->