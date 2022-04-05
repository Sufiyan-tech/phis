<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit indicator</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                        <div class="col-lg-12">
                            <div class="card h-100">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">Indicator Info</h5>
                                    </div>
                                    <form action="<?php echo base_url();?>indicators/update/<?php echo $indicator['idindicator']; ?>" method="POST">
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="full-name">Indicator Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="label" name="label" value="<?php echo $indicator['name']; ?>">
                                                    <span class="text-danger"><?php echo form_error('label'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label" for="slug">Indicator Slug</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $indicator['slug']; ?>">
                                                    <span class="text-danger"><?php echo form_error('slug'); ?></span>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="value">Group</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="type" name="group">
                                                        <option value="">--select--</option>
                                                        <?php if($groups){
                                                            foreach ($groups as $key => $group) {?>
                                                                <option value="<?php echo $group['idgroup'];?>" <?php if($group['idgroup'] == $indicator['idgroup']){echo "selected";} ?>><?php echo $group['name'];?></option>
                                                            <?php }
                                                        }?>
                                                        
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('group'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label" for="type">Goal/Survey</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="type" name="goal">
                                                        <option value="">--select--</option>
                                                        <?php if($goals){
                                                            foreach ($goals as $key => $goal) {?>
                                                                <option value="<?php echo $goal['idgoal'];?>" <?php if($indicator['idgoal'] == $goal['idgoal']){echo "selected";} ?>><?php echo $goal['name'];?></option>
                                                            <?php }
                                                        }?>
                                                        
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('goal'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="form-label" for="readonly">Status</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control" id="type" name="status" placeholder="Select status">
                                                        <option value="">--select status--</option>
                                                        <option value="2" <?php if($indicator['status'] == 2){echo "selected";} ?>>Active</option>
                                                        <option value="1" <?php if($indicator['status'] == 1){echo "selected";} ?>>Inactive</option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('status'); ?></span>
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