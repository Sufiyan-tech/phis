<div class="header">
            <div class="row justify-content-between align-items-center mx-0">
                <div class="col-12 col-md-6 d-flex align-items-end pl-0 flex-wrap">
                    <div class="logo col-12 col-sm-7 pl-0" style="border-right: 1px solid #827f7f;">
                            <img src="<?php echo base_url();?>front-files/images/nhsrc.png" class="mr-3" alt="...">
                    </div>
                    <div class="logo col-12 col-sm-5">
                        <img src="<?php echo base_url();?>front-files/images/logo-2.v1.png" class="" alt="..."> 
                    </div>
                </div>

                <div class="userLink">
                    <?php if($this->session->userdata('user_validated')){?>
                        <a href="<?php echo base_url();?>auth/logout" class="d-flex align-items-center">
                        <span class="d-inline-block user">
                            <img src="<?php echo base_url();?>front-files/images/icon.png">
                        </span>
                        <span class="d-inline-block px-2"><?php echo $this->session->userdata('name');?></span> <i class="fa fa-sign-out" aria-hidden="true"></i>
                        
                    </a>
                <?php }else{ ?>
                    <a href="<?php echo base_url();?>auth/login" class="d-flex align-items-center">
                        <span class="d-inline-block user">
                            <img src="<?php echo base_url();?>front-files/images/icon.png">
                        </span>
                        <span class="d-inline-block px-2">Login</span> <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                <?php } ?>
                </div>
               
            </div>
        </div>
