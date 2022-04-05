<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">
    <!-- Page Title  -->
    <title>Login | PHIS</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashlite.css?ver=2.2.0">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.css?ver=2.2.0">
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="<?php echo base_url();?>" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?php echo base_url();?>assets/images/nhsrc.png" srcset="./images/nhsrc.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?php echo base_url();?>assets/images/nhsrc.png" srcset="<?php echo base_url();?>assets/images/nhsrc.png 2x" alt="logo-dark">
                            </a>
                            <h3 style="color: #709681;font-weight: bold;font-size:21px;">Ministry of National Health Services<br>
        Regulations and Coordination<br>
        Government of Pakistan 
         </h3>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        <div class="nk-block-des">
                                            <p>Access the <b>PHIS</b> Admin panel using your email and password</p>
                                        </div>
                                        <?php 
                                          if(isset($msg)){
                                            if($msg==base64_encode('Logout Successfully!')){
                                              echo "<p class='text-green'>".base64_decode($msg)."</p>";
                                            }else{?>
                                                <div class="example-alert">
                                                            <div class="alert alert-danger alert-icon alert-dismissible">
                                                                <em class="icon ni ni-cross-circle"></em><?php echo base64_decode($msg);?>. <button class="close" data-dismiss="alert"></button>
                                                            </div>
                                                        </div>
                                            <?php }
                                            
                                          } 
                                        ?>
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>login/login_process" method="POST">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <input type="email" class="form-control form-control-lg" id="email" placeholder="Enter your email address" name="email">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Password</a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your passcode">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-success btn-block">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; <?php echo date('Y')?> NHSRC. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=2.2.0"></script>
    <script src="./assets/js/scripts.js?ver=2.2.0"></script>

</html>