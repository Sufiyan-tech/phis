<div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Add new Roles</h3>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="row g-gs">
                                            <div class="col-lg-12">
                                                <div class="card h-100">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <h5 class="card-title">Roles Info</h5>
                                                        </div>
                                                        <form action="<?php echo base_url();?>roles/update/<?php echo $role['idrole'];?>" method="POST">
                                                            <div class="form-group">
                                                                <label class="form-label" for="full-name">Role Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $role['role_name'];?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Role Short Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="shortname" name="slug" value="<?php echo $role['short_name'];?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <a href="<?php echo base_url();?>roles">
                                                                <button type="button" class="btn btn-lg btn-success">Back</button>
                                                            </a>
                                                                <button type="submit" class="btn btn-lg btn-primary">Update Informations</button>
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