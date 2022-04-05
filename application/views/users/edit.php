<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit User Profile</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="row g-gs">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title"><em class="icon ni ni-eye"></em> User Info</h5>
                                </div>
                                <form action="<?php echo base_url('user/update/'.$user["iduser"]);?>" method="POST">
                                    <div class="form-group">
                                        <div class="form-control-wrap row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="access_duration">Full name</label>
                                                <input type="text" class="form-control" id="full-name" placeholder="Your full name" name="full_name" value="<?php echo $user['fullname'];?>">
                                                <span class="text-danger"><?php echo form_error('full_name'); ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label" for="email-address">Email</label>
                                                <input type="email" class="form-control" id="email-address" placeholder="Your email address" name="email" value="<?php echo $user['email'];?>" readonly>
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="country">Country</label>
                                            <select class="form-control" name="country" id="country">
                                                <option value="0">--select--</option>
                                                <?php foreach(get_all_counties() as $key => $c ){?>
                                                    <option value="<?php echo $c['countryid'];?>" data-key="<?php echo $c['key'];?>" <?php if($user['country'] == $c['countryid']){echo "selected";}?>><?php echo $c['value'];?></option>
                                                <?php }?>
                                                
                                            </select>
                                            <span class="text-danger"><?php echo form_error('country'); ?></span>
                                            </div>
                                            <?php 
                                            $cnic = '';
                                            $passport = '';
                                            $datavalPassport = '';
                                            $datavalCnic = '';
                                            if($selectedcountry == 'PK'){
                                                $passport = ' style="display: none;" ';
                                                $cnic = ' style="display: block;" ';
                                                $datavalCnic = $user['tel_no'];
                                            }else{
                                                $passport = ' style="display: block;" ';
                                                $cnic = ' style="display: none;" ';
                                                $datavalPassport = $user['tel_no'];
                                            }?>
                                            <div class="col-lg-6" id="cnic_field" <?php echo $cnic;?>>
                                                <label class="form-label" for="email-address">CNIC</label>
                                                <input type="text" class="form-control" id="cnic_no" name="cnic" placeholder="1101-1238791-0" value="<?php echo $datavalCnic;?>">
                                                <span class="text-danger"><?php echo form_error('cnic'); ?></span>
                                            </div>
                                            <div class="col-lg-6" id="passport_field" <?php echo $passport;?>>
                                                <label class="form-label" for="email-address">Passport</label>
                                                <input type="text" class="form-control" id="cnic" placeholder="pasport number" name="passport" value="<?php echo $datavalPassport;?>">
                                                <span class="text-danger"><?php echo form_error('passport'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="tel_no">Tel #</label>
                                            <input type="text" class="form-control" id="tel_no" placeholder="0123456789" name="tel_no" value="<?php echo $user['tel_no'];?>">
                                            <span class="text-danger"><?php echo form_error('tel_no'); ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label" for="org">Organization</label>
                                               <input type="text" class="form-control" id="organization" placeholder="Your organization name" name="organization_name" value="<?php echo $user['organization_name'];?>">
                                               <span class="text-danger"><?php echo form_error('tel_no'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap row">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="tel_no">Permission Regions</label>
                                                <select class="form-select" data-placeholder="Select options" id="permission-region" name="permission_region">
                                                    <option value="0">--Select--</option>
                                                    <option value="1" <?php if($user['permission_region'] == 1){echo 'selected';}?>>National</option>
                                                    <option value="2" <?php if($user['permission_region'] == 2){echo 'selected';}?>>Province</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('permission_region'); ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label" for="tel_no">Roles</label>
                                                <select class="form-select" data-placeholder="Select options" name="role">
                                                    <option value="">--Select--</option>
                                                    <?php foreach(get_all_roles() as $key => $c ){?>
                                                    <option value="<?php echo $c['idrole'];?>" <?php if($user['idrole'] == $c['idrole']){echo 'selected';}?>><?php echo $c['role_name'];?></option>
                                                <?php }?>
                                                    
                                                </select>
                                                <span class="text-danger"><?php echo form_error('role'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap row">
                                            <?php 
                                            $proDisplay = ' style="display: none;" ';
                                            if($user['permission_region'] == 2){
                                                $proDisplay = ' style="display: block;" ';
                                            }?>
                                            <div class="col-lg-12" id="provinces-selection" <?php echo $proDisplay;?>>
                                                <label class="form-label" for="tel_no">Provinces</label>
                                                <select class="form-select" multiple="multiple" data-placeholder="Select Multiple options" name="permission_provinces[]">
                                                    <?php foreach(get_all_province() as $key => $c ){?>
                                                    <option value="<?php echo $c['province_code'];?>"<?php if(in_array($c['province_code'], $allprovinces)){echo 'selected';}?>><?php echo $c['province_name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-control-wrap row">
                                            
                                            <div class="col-lg-12">
                                                <label class="form-label" for="tel_no">Status</label>
                                                <select class="form-select" data-placeholder="Select options" name="status">
                                                    <option>--Select--</option>
                                                    <option value="2" <?php if($user['status'] ==2){echo 'selected';}?>>Active</option>
                                                    <option value="1" <?php if($user['status'] ==1){echo 'selected';}?>>Inactive</option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('status'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
