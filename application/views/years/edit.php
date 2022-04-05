<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Update Year</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-inner">
                                <form action="<?php echo base_url();?>years/update/<?php echo $campaign['idcampaign']; ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="full-name">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="full-name" placeholder="name" name="name" value="<?php echo $campaign['name']; ?>">
                                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="email-address">Survey Form</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" data-placeholder="Select Survey Form" name="idsurveyform" required>
                                                        <option value="default_option">Default Option</option>
                                                        <?php foreach ($forms as $k => $v): ?>
                                                            <option value="<?php echo $v['idsurveyform'] ?>" <?php echo $v['idsurveyform'] == $campaign['idsurveyform'] ? 'selected': ''; ?>><?php echo $v['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox mt-3 mb-3 change-value">
                                                    <input type="checkbox" class="custom-control-input" id="national" name='national' value="<?php echo $campaign['national'] ?>" <?php echo $campaign['national'] == 1 ? 'checked': ''; ?>>
                                                    <label class="custom-control-label" for="national">National</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox mt-3 mb-3 change-value">
                                                    <input type="checkbox" class="custom-control-input" id="province" name='province' value="<?php echo $campaign['province'] ?>" <?php echo $campaign['province'] == 1 ? 'checked': ''; ?>>
                                                    <label class="custom-control-label" for="province">Province</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox mt-3 mb-3 change-value">
                                                    <input type="checkbox" class="custom-control-input" id="district" name='district' value="<?php echo $campaign['district'] ?>" <?php echo $campaign['district'] == 1 ? 'checked': ''; ?>>
                                                    <label class="custom-control-label" for="district">District</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <h6>Locations</h6>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="custom-control custom-control-sm custom-checkbox notext" title="select all">
                                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                                <label class="custom-control-label" for="uid"></label>
                                                            </div>
                                                        </th>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($provinces as $k => $v): ?>
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input checkSingle" name="province_code[]" value="<?php echo $v['province_code']; ?>" id="uid<?php echo $k;?>" <?php echo in_array($v['province_code'], array_column($campaign_locations, 'province_code')) ? 'checked': ''; ?>>
                                                                    <label class="custom-control-label" for="uid<?php echo $k;?>"></label>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $v['province_name']; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary pull-right">Save</button>
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
