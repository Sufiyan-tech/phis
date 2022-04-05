<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add new goal</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Goal Info</h5>
                                </div>
                                <form action="<?php echo base_url();?>goals/update/<?php echo $goal['idgoal'];?>" method="POST">
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="form-label" for="full-name">Goal Label</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="label" name="label" value="<?php echo $goal['name'];?>">
                                                <span class="text-danger"><?php echo form_error('label'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label" for="slug">Group Slug</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $goal['slug'];?>">
                                                <span class="text-danger"><?php echo form_error('slug'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="form-label" for="type">Options</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" data-placeholder="Select sub-component" name="subcomponents">
                                                    <option value="">--Select sub component--</option>
                                                    <?php if($subcomponents){
                                                        foreach ($subcomponents as $key => $subcomponent) {?>
                                                            <option value="<?php echo $subcomponent['idsubcomponent'];?>" <?php if($subcomponent['idsubcomponent'] == $goal['idsubcomponent']){echo "selected";}?>><?php echo $subcomponent['subcomponent_name'];?></option>
                                                        <?php }
                                                    }?>
                                                    
                                                </select>
                                                <span class="text-danger"><?php echo form_error('type'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label" for="type">Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" data-placeholder="Select status" name="status">
                                                    <option value="">--Select status--</option>
                                                    <option value="2" <?php if($goal['status'] == 2){echo "selected";}?>>Active</option>
                                                    <option value="1"<?php if($goal['status'] == 1){echo "selected";}?>>Inactive</option>
                                                    
                                                </select>
                                                <span class="text-danger"><?php echo form_error('type'); ?></span>
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