
                    
                    
                    
                    <!-- Main sidebar -->
				<div class="sidebar sidebar-main">
				<div class="sidebar-content">
					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content media-center ">
								<!--<a href="#"><img src="http://toa/PhoneTOA/IMG/emp/<?php echo $getuser->empid;?>.jpg" class="img-circle  " alt="" style="    width: 100px;
    height: 100px;"></a>
-->								<h6><?php echo $getuser->name;?></h6>
								
							</div>
														
							<div class="sidebar-user-material-menu disabled" >
								<a href="#user-nav" data-toggle="collapse" ><span>My account</span> <i class="caret"></i></a>
							</div>
						</div>
						
						<div class="navigation-wrapper collapse" id="user-nav">
							<ul class="navigation">
								<li class="disabled"><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
								
								
								
								
								<li><a href="./"><i class="icon-switch2"></i> <span>Logout</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li class=""><a href="<?php echo base_url(); ?>dashboard/wtc/"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                
                                
                                <?php
                                if($getuser->status == 1){
									?>
                                    <li class=""><a href="<?php echo base_url(); ?>dashboard/approvewallpaper"><i class="icon-cube4"></i> <span>Approve Wallpaper</span></a></li>
                                    <?php
									
									}
								?>
                                
<!--                               <li class=""><a href="<?php echo base_url(); ?>dashboard/wallpaper"><i class="icon-cube4"></i> <span>Add  Wallpaper</span></a></li>
-->                               
                               
                               
                               
                               
                               
                                
                              
                                
                               
                               
                               
                               
                          
                               
                           
                                
                                
                                
                                
                                </ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->