<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit group</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Groups Info</h5>
                                </div>
                                <form action="<?php echo base_url();?>groups/update/<?php echo $group['idgroup'];?>" method="POST">
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="form-label" for="full-name">Group Label</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="label" name="label" value="<?php echo $group['name'];?>">
                                                <span class="text-danger"><?php echo form_error('label'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label" for="slug">Group Slug</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $group['slug'];?>">
                                                <span class="text-danger"><?php echo form_error('slug'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label class="form-label" for="type">Options</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" multiple="multiple" data-placeholder="Select Multiple options" name="options[]">
                                                    <option value="">--Select--</option>
                                                    <?php if($options){
                                                        foreach ($options as $key => $option) {
                                                            $allOptionGroup = $options_groups;?>
                                                            <option value="<?php echo $option['idoption'];?>" <?php if(in_array($option['idoption'], $allOptionGroup)){echo "selected";}?>><?php echo $option['name'];?></option>
                                                        <?php }
                                                    }?>
                                                    
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