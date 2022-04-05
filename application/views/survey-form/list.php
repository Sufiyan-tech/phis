<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Surveys</h3>
                        </div><!-- .nk-block-head-content -->
                        <?php $this->load->view('layouts/alerts.php');?>
                        <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt"><a href="<?php echo base_url('survey/addsurveyform');?>" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Survey Data Entry</span></a></li>
                                    <li class="nk-block-tools-opt"><a href="<?php echo base_url('survey/create');?>" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add new</span></a></li>
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
                                            <h6 class="title">Survey forms</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Sr No.</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Form Name</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Total Indicators</span></div>

                                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                                        <div class="nk-tb-col"><span>Action</span></div>
                                    </div>
                                    <?php if($surveyforms){
                                        $sr_no = 1;
                                        foreach($surveyforms as $surveyform){?>
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><?php echo $sr_no++;?></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-name">
                                                    <span class="tb-lead"><?php echo $surveyform['name'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-name" title="Click to view Total Indicators ">
                                                    <span class="tb-lead" onclick="get_ind_popup('<?php echo $surveyform['idsurveyform']?>');" ><?php echo get_total_ind($surveyform['idsurveyform']);?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <?php echo get_labeled_status($surveyform['status']);?>
                                        </div>
                                        <div class="nk-tb-col">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-expanded="false"><span>Action</span><em class="icon ni ni-chevron-down"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-auto">
                                                    <ul class="link-list-plain">
                                                        <li><a href="<?php echo base_url();?>survey/edit/<?php echo $surveyform['idsurveyform'];?>">Edit</a></li>
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
<div class="modal fade" tabindex="-1" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Indicators List</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div id="ul-list-indicators"></div>

                      
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modal Footer Text</span>
                </div>
            </div>
        </div>
    </div>
