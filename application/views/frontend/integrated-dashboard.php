<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="row justify-content-center">
            <?php if($integrated_dashboards){
                $item_count=1;
                $items_block=2;
                foreach ($integrated_dashboards as $key => $val) {
                    $imgURL = $val['icon'];

                    $onClickLnk = "get_loc_popup('".$val['idsubcomponent']."','".$val['is_province']."','".get_link($val['idsubcomponent'])."');return false;";
                    ?>
            <div class="col-12 col-md-4 col-sm-6 col-lg-3 mb-5">
                <a href="" onclick="<?php echo $onClickLnk;?>">
                <div class="media-idashh bg1 d-flex align-items-center">
                    <img class="mr-3" src="<?php echo $imgURL;?>" alt="<?php echo $val['subcomponent_name'];?>">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo substr($val['subcomponent_name'],0,20);?></h5>
                        <h5>Pakistan</h5>
                    </div>
                </div>
            </a>
            </div>
            <?php if($item_count % $items_block==0){ ?>
                    </div>
                    <div class="row justify-content-center">
                <?php 
                } 
                $item_count++;
                ?>
                    <?php } }?>

        </div>

        </div>