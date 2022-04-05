<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add new Integration</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                        <div class="col-lg-12">
                            <div class="card h-100">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">Integration Info</h5>
                                    </div>
                                    <form action="<?php echo base_url();?>integration/add" method="POST" class="form-validate is-alter" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="full-name" placeholder="name" name="name">
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Short desc</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="desc" placeholder="short desc" name="desc" required>
                                                <span class="text-danger"><?php echo form_error('desc'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Long description</label>
                                            <div class="form-control-wrap">
                                                <textarea rows="5" cols="5" class="form-control" name="long_desc"></textarea>
                                                <span class="text-danger"><?php echo form_error('long_desc'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Component</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="components" required>
                                                    <option value="">--Select--</option>
                                                    <?php if($components){
                                                        foreach ($components as $key => $component) {?>
                                                                <option value="<?php echo $component['idcomponent'];?>"><?php echo $component['component_name'];?></option>
                                                        <?php }
                                                    }?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('components'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Image</label>
                                            <div class="form-control-wrap">
                                                <input type="file" name="image" class="form-control">
                                                <span class="text-danger"><?php echo form_error('image'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="status" required>
                                                    <option value="">--Select--</option>
                                                    <option value="2">Active</option>
                                                    <option value="1">Inactive</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('status'); ?></span>
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