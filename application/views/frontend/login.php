<!DOCTYPE html>
<html>
<?php $this->load->view('frontend/layouts/head');?>
<body class="fixed_bg"> 
    <div class="container">
        <div class="row main align-items-center pt-5">
            <div class="col-12 col-md-7 text-center">
                <div class="title-heading">
                    <h1>WELCOME</h1>
                </div>
                <div class="image-logo-sign my-5">
                    <a href="<?php echo base_url();?>">
                        <img src="<?php echo base_url();?>front-files/images/logo-2.png" alt="PHIS Logo" />
                    </a>
                </div>
                <div class="heading-three" style="color: #555758;font-weight: bold;">
                    <h1>PAKISTAN HEALTH INFORMATION SYSTEM</h1>
                </div>
                <div class="col-12 text-center my-5 IJ-govp-logo">
                    <img src="<?php echo base_url();?>front-files/images/nhsrc.png" class="" alt="...">
                </div>

                
            </div>
            <!-- /.col-md-7 -->

            <div class="col-12 col-md-5 second-section">
                <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
                <div class="mb-3 text-themed">
                    <h1>
                        Sign In
                    </h1>
                </div>
                <form action="<?php echo base_url();?>auth/process" method="POST">
                <div class="inputs">
                    <div class="box">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" placeholder="Email" name="email" required />
                    </div>
                    <div class="box">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" placeholder="Password" name="password" required />
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12 col-md-6">
                        <div class="remember">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <span class='text-small ml-1'>Remember me</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <a href="javascript:void">
                            <span class='text-themed text-small font-weight-normal font-italic'>Forgot Password?</span>
                        </a>
                    </div>
                </div>
                <div class="row text-center mt-3">
                    <div class="col-12 col-md-7 col-lg-6">
                        <div class="button-login mb-3">
                            <button class="btn btn-themed btn-secondary btn-block">
                                LOGIN <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class='text-themed' style="font-size: 24px; font-weight: 100;">
                            <p>OR</p>
                        </div>

                        <div class="button-login mt-3 mb-3">
                            <button class="btn btn-secondary btn-themed btn-block">
                                LOGIN AS GUEST
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-lg-6 login-second text-right">
                        <div class='text-themed d-inline-block text-left'>
                            <span>
                                Don’t have an Account?
                            </span>
                            <br />
                            <div class="signup">
                                <a href="<?php echo base_url();?>auth/signup" class='text-themed font-weight-bold'>
                                    Sign up
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <!-- /.col-md-4 -->
        </div>
    </div>
    <div class="text-small text-center py-3">Copyright @ 2021 - All Rights Reserved - M/o NHSR&C</div>
</body>
</html>