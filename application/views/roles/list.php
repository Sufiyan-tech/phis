<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Roles</h3>
                        </div><!-- .nk-block-head-content -->
                        <?php $this->load->view('layouts/alerts.php');?>
                        <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt"><a href="<?php echo base_url();?>roles/create" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add new</span></a></li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-8">
                            <div class="card card-full">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Roles</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Sr No.</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Role Name</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Short Name</span></div>
                                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                                        <div class="nk-tb-col"><span>Action</span></div>
                                    </div>
                                    <?php if($roles){
                                        $sr_no = 1;
                                        foreach($roles as $role){?>
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><?php echo $sr_no++;?></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-name">
                                                    <span class="tb-lead"><?php echo $role['role_name'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-sub"><?php echo $role['short_name'];?></span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <?php echo get_labeled_status($role['status']);?>
                                        </div>
                                        <div class="nk-tb-col">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-expanded="false"><span>Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-auto">
                                                    <ul class="link-list-plain">
                                                        <li><a href="<?php echo base_url();?>roles/edit/<?php echo $role['idrole'];?>">Edit</a></li>
                                                        <li><a href="./">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div><!-- .card -->
                        </div>
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>