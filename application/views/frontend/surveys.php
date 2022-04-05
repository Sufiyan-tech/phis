<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

    <div class="d-flex flex-wrap">
        <?php if($surveys_dashboards){
            foreach($surveys_dashboards as $key => $survey){?>
                <div class="col-12 col-sm-6 col-lg-3 px-xl-4 mt-4">
                    <a href="#" onclick="showYears('<?php echo $survey["idsubcomponent"]?>');">
                        <div  class="surveylist" style="background: url('<?php echo $survey['icon'];?>') no-repeat 15px center;background-size: 34px;background-position: 11px 34px;">
                            <h3><?php echo $survey['subcomponent_name'];?></h3>
                            <p><?php echo $survey['desc'];?></p>
                        </div>
                    </a>
                    <a href="<?php echo base_url();?>survey/detail/<?php echo $survey['slug'];?>"><span class="more">[More About <?php echo $survey['subcomponent_name'];?>]</span></a>
                </div>
            <?php }
        }else{ ?>
            <div  class="surveylist">
                <h3><?php echo $survey['subcomponent_name'];?></h3>
                <p><?php echo $survey['desc'];?></p>
            </div>
        <?php } ?>
    </div>
</div>
