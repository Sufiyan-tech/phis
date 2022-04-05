<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit-no" />
     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front-files/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>front-files/css/styles.css">
</head>
<body class="fixed_bg"> 
    <div class="container">
        <div class="row main align-items-center pt-5">
            <div class="col-12 col-md-7 text-center">
                <div class="title-heading">
                    <h1>WELCOME</h1>
                </div>
                <div class="image-logo-sign my-5">
                    <a href="<?php echo base_url();?>">
                        <img src="<?php echo base_url();?>front-files/images/logo-2.png" alt="" />
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
                <div class="mb-3 text-themed">
                    <h1>
                        Sign Up
                    </h1>
                </div>
                <div class="inputs">
                    <div class="box">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" placeholder="Name" name="" />
                    </div>
                    <div class="box">
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                        <input type="text" placeholder="Phone Number" name="" />
                    </div>
                    <div class="box">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="text" placeholder="Email" name="" type='email' />
                    </div>
                    <div class="box">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input placeholder="Password" name="" type='password' />
                    </div>
                    <div class="box">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input placeholder="Confirm Password" name="" type='password' />
                    </div>
                </div>
                <div class="row text-center justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="button-login mb-3">
                            <button class="btn btn-themed btn-secondary btn-block">
                                SIGN UP <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-right align-self-center">
                        <a href="<?php echo base_url();?>auth/login">
                            <span class='text-themed text-small font-weight-bold font-italic'>
                                Back to Login
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.col-md-4 -->
        </div>
    </div>
    <div class="text-small text-center py-3">Copyright @ 2021 - All Rights Reserved - M/o NHSR&C</div>
</body>
</html>