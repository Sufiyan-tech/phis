<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="surveysTab">
                <?php if($surveys_dashboards){
                foreach($surveys_dashboards as $key => $survey){?>
                    <a href="<?php echo base_url();?>main/get_years?subcomp-id=<?php echo $survey['idsubcomponent']?>">
                <div  class="surveylist" style="background: url('<?php echo $survey['icon'];?>') no-repeat 15px center;background-size: 34px;background-position: 11px 34px;">
                    <h3><?php echo $survey['subcomponent_name'];?></h3>
                    <p><?php echo $survey['desc'];?></p>
                </div>
            </a>
            <?php } }else{ ?>
                    <div  class="surveylist">
                    <h3><?php echo $survey['subcomponent_name'];?></h3>
                    <p><?php echo $survey['desc'];?></p>
                </div>
            <?php } ?>
            </div>
        </div>