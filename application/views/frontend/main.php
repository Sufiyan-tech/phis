<!DOCTYPE html>
<html lang="zxx" class="js">

    <?php $this->load->view('layouts/head');?>
    <body class="nk-body bg-lighter npc-default has-sidebar ">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="<?php echo base_url();?>assets/images/logo.png" srcset="<?php echo base_url();?>assets/images/logo2x.png 2x" alt="logo">
                    <img class="logo-dark logo-img" src="<?php echo base_url();?>assets/images/logo-dark.png" srcset="<?php echo base_url();?>assets/images/logo-dark2x.png 2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-search ml-3 ml-xl-0">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
            </div><!-- .nk-header-news -->
          </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->

    <ul class="nav justify-content-center">
      <?php if($components){
      foreach ($components as $key => $component) {
        $active = '';
        $pageS = '';
        if($key == 0){
          $active = 'active';
          $pageS = 'aria-current="page"';
        }?>
    <li class="nav-item">
      <a class="nav-link <?php echo $active;?>"  <?php echo $pageS;?> href="<?php echo base_url().'main/subcomponent?com_id='.$component['idcomponent'];?>&type=<?php echo $component['type'];?>"><?php echo $component['component_name'];?></a>
    </li>
   <?php }
      }?>
  </ul>
</div>

<?php if($com_id && $com_id !=''){?>
  <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Dashboard</h3>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="row g-gs">
                                            
                                            
                                            
                                            
                                            <?php if($subcomponents){
                                              foreach ($subcomponents as $key => $subcomponent) {
                                            if($type == 2){?>
                                            <div class="col-xxl-3 col-sm-6">
                                                <div class="card">
                                                    <div class="nk-ecwg nk-ecwg6">
                                                        <div class="card-inner">
                                                           
                                                            <div class="data">
                                                                <div class="info" onclick="get_loc_popup('<?php echo $subcomponent['idsubcomponent']?>');"><span> <?php echo $subcomponent['subcomponent_name'];?></span></div>
                                                            </div>
                                                        </div><!-- .card-inner -->
                                                    </div><!-- .nk-ecwg -->
                                                </div><!-- .card -->
                                            </div><!-- .col -->
                                        <?php }else{?>
                                            <div class="col-xxl-3 col-sm-6">
                                                <div class="card">
                                                    <div class="nk-ecwg nk-ecwg6">
                                                        <div class="card-inner">
                                                           
                                                            <div class="data">
                                                                <div class="info">
                                                                    <a href="<?php echo base_url();?>main/get_years?subcomp-id=<?php echo $subcomponent['idsubcomponent']?>"><span> <?php echo $subcomponent['subcomponent_name'];?></span></a>
                                                                </div>
                                                            </div>
                                                        </div><!-- .card-inner -->
                                                    </div><!-- .nk-ecwg -->
                                                </div><!-- .card -->
                                            </div><!-- .col -->
                                          <?php } }
                                            }else{?>
                                              <div class="col-xxl-3 col-sm-6">
                                                <div class="card">
                                                    <div class="nk-ecwg nk-ecwg6">
                                                        <div class="card-inner">
                                                            <div class="card-title-group">
                                                                <div class="card-title">
                                                                    <h6 class="title">No data found</h6>
                                                                </div>
                                                            </div>
                                                            
                                                        </div><!-- .card-inner -->
                                                    </div><!-- .nk-ecwg -->
                                                </div><!-- .card -->
                                            </div><!-- .col -->
                                            <?php }?>
                                        </div><!-- .row -->
                                    </div><!-- .nk-block -->
                                </div>
                            </div>
                        </div>
                    </div>
<?php }?>

                    
                    <!-- main header @e -->
                    <!-- content @s -->

                    <?php //echo $content;?>
                    <!-- content @e -->
                    <!-- footer @s -->
                <?php $this->load->view('layouts/footer');?>
                    
                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
            <?php $this->load->view('layouts/root_js');?>
    </body>

</html>

<div class="modal fade" tabindex="-1" id="all_loc">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="sub-comp-name"></span></h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-4">
    
                              <ul class="list-group" id="provinces-ul">
                                  
                                </ul>
                          
                          </div>
                        </div>
                        
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">
                        <button type="cance" class="btn btn-lg btn-primary">Close</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

