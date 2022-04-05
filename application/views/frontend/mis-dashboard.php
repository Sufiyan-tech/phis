<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="d-flex flex-wrap">
        <?php if($hmis_dashboards){
            $notLogedInData = array('nutrition','polio');
            foreach ($hmis_dashboards as $key => $hmis) {
                $imageURL = base_url().$hmis['icon'];
                if($this->session->userdata('user_validated')){
                    $onClickLnk = "get_loc_popup('".$hmis['idsubcomponent']."','".$hmis['is_province']."','".get_link($hmis['idsubcomponent'])."');return false;";
                    if($hmis['slug'] == 'contraceptive-lmis'){
                        $csalt="jboFHjeQK5mc1K0cdSz5";
                        $ctoken=sha1(md5($csalt.date("Y-m-d")));
                        $rdLink = "http://c.lmis.gov.pk/clmis.php?token=".$ctoken;
                        $onClickLnk = "get_loc_popup('".$hmis['idsubcomponent']."','0','".$rdLink."'); return false";
                    }
                    if($hmis['slug'] == 'vaccine-lmis'){
                        $csalt="159jboFHjeQK5mc1K0cdSz5";
                        $ctoken=sha1(md5($csalt.date("Y-m-d")));
                        $rdLink = "http://v.lmis.gov.pk/dashboard/vlmis?office=2&token=".$ctoken;
                        $onClickLnk = "get_loc_popup('".$hmis['idsubcomponent']."','0','".$rdLink."'); return false";
                    }
                }else{
                    $onClickLnk = "show_login_popup('".$hmis['idsubcomponent']."');return false;";
                    if(in_array($hmis['slug'], $notLogedInData)){
                        $onClickLnk = "get_loc_popup('".$hmis['idsubcomponent']."','".$hmis['is_province']."','".get_link($hmis['idsubcomponent'])."');return false;";
                    }
                } ?>
                <div class="col-12 col-sm-6 col-lg-3 px-xl-4 mt-4">
                    <a href="#" onclick="<?php echo $onClickLnk;?>">
                        <div style="background-image:url('<?php echo $imageURL;?>');" class="dashb-sarvice d-flex align-items-center justify-content-center">
                            <h3><?php echo $hmis['subcomponent_name'];?></h3>
                        </div>
                    </a>
                </div>
            <?php }
        } ?>
    </div>
</div>
