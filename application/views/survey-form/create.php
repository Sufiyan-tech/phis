<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add new Survey form</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Survey form Info</h5>
                                </div>
                                <form action="<?php echo base_url();?>survey/add" method="POST" class="form-validate is-alter">

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="form-label" for="full-name">Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="label" name="label" required>
                                                <span class="text-danger"><?php echo form_error('label'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label" for="slug">Slug</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="slug" name="slug" required>
                                                <span class="text-danger"><?php echo form_error('slug'); ?></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="form-label" for="status">Sub Components</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select" data-placeholder="Select Sub Component" name="subcomponent" required onchange="change_indicators(this);">
                                                        <option value="">Default Option</option>
                                                        <?php
                                                        foreach ($subcomponents as $k => $v): ?>
                                                            <option value="<?php echo $v['idsubcomponent'] ?>"><?php echo $v['subcomponent_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <span class="text-danger"><?php echo form_error('subcomponent'); ?></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label" for="status">Status</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" id="status" name="status" placeholder="Select status" required>
                                                    <option value="">--select status--</option>
                                                    <option value="2">Active</option>
                                                    <option value="1">Inactive</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('status'); ?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <!-- content @s -->
                                    <div class="nk-content ">
                                        <div class="container-fluid">
                                            <div class="nk-content-inner">
                                                <div class="nk-content-body">
                                                    <div class="nk-block-head nk-block-head-sm">
                                                        <div class="nk-block-between">
                                                            <div class="nk-block-head-content">
                                                                <h3 class="nk-block-title page-title">Indicator Lists</h3>
                                                                <div class="nk-block-des text-soft">
                                                                </div>
                                                            </div><!-- .nk-block-head-content -->
                                                        </div><!-- .nk-block-between -->
                                                    </div><!-- .nk-block-head -->
                                                    <div class="nk-block">
                                                        <div class="nk-tb-list is-separate mb-3">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext" title="select all">
                                                                        <input type="checkbox" class="custom-control-input" id="uid">
                                                                        <label class="custom-control-label" for="uid"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col"><span class="sub-text">Indicator name</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                                            </div><!-- .nk-tb-item -->
                                                            <div id="indicators-by-subcomp" style="display: table-footer-group;
">
                                                            <?php if($indicators){
                                                                foreach ($indicators as $key => $indicator) {?>
                                                                    <div class="nk-tb-item">
                                                                        <div class="nk-tb-col nk-tb-col-check">
                                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                                <input type="checkbox" class="custom-control-input checkSingle" name="ind_id[]" value="<?php echo $indicator['idindicator']; ?>" id="uid<?php echo $key;?>">
                                                                                <label class="custom-control-label" for="uid<?php echo $key;?>"></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="nk-tb-col tb-col-mb">
                                                                            <span class="tb-amount"><?php echo $indicator['ind_name']; ?><span class="currency"> (<?php echo $indicator['subcompname'];?>) </span></span>
                                                                        </div>
                                                                        <div class="nk-tb-col tb-col-md">
                                                                            <span class="tb-status text-success">Active</span>
                                                                        </div>
                                                                    </div><!-- .nk-tb-item -->
                                                                <?php }
                                                            }?>
                                                        </div>
                                                        </div><!-- .nk-tb-list -->

                                                    </div><!-- .nk-block -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- content @e -->
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
