<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Update linkage</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                        <div class="col-lg-12">
                            <div class="card h-100">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">linkage Info</h5>
                                    </div>
                                    <form action="<?php echo base_url();?>linkages/update/<?php echo $linkage['idintegration'];?>" method="POST" class="form-validate is-alter">
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="full-name">Component Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="hidden" name="component_type" id="component_type" value="">
                                                    <select class="form-control" id="component" name="component" required>
                                                        <option value="">--select--</option>
                                                        <?php if($components){
                                                            foreach ($components as $key => $component) {?>
                                                                <option data-value="<?php echo $component['type'];?>" value="<?php echo $component['idcomponent'];?>" <?php if($component['idcomponent'] == $linkage['idcomponent']){echo "selected";}?>><?php echo $component['component_name'];?></option>
                                                            <?php }
                                                        }?>
                                                        
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('subcomponent'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label" for="full-name">Sub Component Name</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="subcomponent" name="subcomponent" required>
                                                        <option value="">--select--</option>
                                                        <?php if($subcomponents){
                                                            foreach ($subcomponents as $key => $subcomponent) {?>
                                                                <option value="<?php echo $subcomponent['idsubcomponent'];?>" <?php if($subcomponent['idsubcomponent'] == $linkage['idsubcomponent']){echo "selected";}?>><?php echo $subcomponent['subcomponent_name'];?></option>
                                                            <?php }
                                                        }?>
                                                        </select>
                                                    <span class="text-danger"><?php echo form_error('subcomponent'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label" for="slug">Province</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="province" name="province">
                                                        <option value="">--select--</option>
                                                        <?php if(get_all_propups()){
                                                            foreach (get_all_propups() as $key => $province) {?>
                                                                <option value="<?php echo $province['id'];?>" <?php if($province['id'] == $linkage['province_code']){echo "selected";}?>><?php echo $province['name'];?></option>
                                                            <?php }
                                                        }?>
                                                        
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('province'); ?></span>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="value">Link</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="link" name="link" placeholder="https://google.com" value="<?php if($linkage['link']){echo $linkage['link'];}?>">
                                                    <span class="text-danger"><?php echo form_error('link'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label" for="readonly">API Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="code" name="code" value="<?php if($linkage['link']){echo $linkage['code'];}?>">
                                                    <span class="text-danger"><?php echo form_error('code'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label" for="readonly">Status</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="type" name="status" placeholder="Select status" required>
                                                        <option value="">--select status--</option>
                                                        <option value="2" <?php if($linkage['status'] == 2){echo "selected";}?>>Active</option>
                                                        <option value="1" <?php if($linkage['status'] == 1){echo "selected";}?>>Inactive</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('status'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="form-label" for="readonly">Type</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="type" name="type" placeholder="Select status">
                                                        <option value="">--select type--</option>
                                                        <option value="1">Type 1</option>
                                                        <option value="2">Type 2</option>
                                                        <option value="3">Type 3</option>
                                                        <option value="4">Type 4</option>
                                                        <option value="5">Type 5</option>
                                                        <option value="6">Type 6</option>
                                                        <option value="7">Type 7</option>
                                                        <option value="8">Type 8</option>
                                                        <option value="9">Type 9</option>
                                                        <option value="10">Type 10</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('type'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label" for="readonly">Assign Role</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="roles" name="roles" value="<?php if($linkage['roles']){echo $linkage['roles'];}?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>