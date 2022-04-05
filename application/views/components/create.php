<div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Add new Component</h3>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="row g-gs">
                                            <div class="col-lg-12">
                                                <div class="card h-100">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <h5 class="card-title">Component Info</h5>
                                                        </div>
                                                        <form action="<?php echo base_url();?>components/add" method="POST">
                                                            <div class="form-group">
                                                                <label class="form-label" for="full-name">Component Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="full-name" name="name">
                                                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Status</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-control" name="status">
                                                                        <option value="">--Select--</option>
                                                                        <option value="2">Active</option>
                                                                        <option value="1">In Active</option>
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