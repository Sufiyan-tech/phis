<div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Add new option</h3>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="row g-gs">
                                            <div class="col-lg-12">
                                                <div class="card h-100">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <h5 class="card-title">Options Info</h5>
                                                        </div>
                                                        <form action="<?php echo base_url();?>options/add" method="POST" class="form-validate is-alter">
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-lg-3">
                                                                    <label class="form-label" for="full-name">Options Label</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="label" name="label" required>
                                                                        <span class="text-danger"><?php echo form_error('label'); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label class="form-label" for="slug">Options Slug</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="slug" name="slug" required>
                                                                        <span class="text-danger"><?php echo form_error('slug'); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label class="form-label" for="value">Options Value</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="value" name="value" required>
                                                                        <span class="text-danger"><?php echo form_error('value'); ?></span>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-6">
                                                                    <label class="form-label" for="type">Options Type</label>
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-control" id="type" name="type" required>
                                                                            <option>--select--</option>
                                                                            <option value="number">Number</option>
                                                                        </select>
                                                                        <span class="text-danger"><?php echo form_error('type'); ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label class="form-label" for="readonly">Readonly</label>
                                                                    <div class="form-control-wrap">
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="pay-card" name="readonlybox" value="readonly">
                                                                            <label class="custom-control-label" for="pay-card"></label>
                                                                        </div></div>
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