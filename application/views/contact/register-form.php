<!-- content @s -->
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">User Profile</h3>
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
                                                        <form action="<?php echo base_url();?>user/add" method="POST">
                                                            <div class="form-group">
                                                                <label class="form-label" for="full-name">Name (of requesting individual)</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name (of requesting individual)">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">CNIC No (in case of request from Pakistan) Passport No/ Drive License (in case of overseas request)</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="cnic" name="cnic_no" placeholder="CNIC No (in case of request from Pakistan) Passport No/ Drive License (in case of overseas request)">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Country</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-control" name="country">
                                                                        <option>Pakistan</option>
                                                                        <option>UK</option>
                                                                        <option>France</option>
                                                                        <option>UAE</option>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Email-address (of requesting individual)</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="email-address" name="email" placeholder="Email-address (of requesting individual)">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Telephone No</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="tel_no" name="tel_no" placeholder="Telephone No">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Affiliated Organization</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="affiliated_org" name="affiliated_org" placeholder="Affiliated Organization">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Complete postal address</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="postal-address" name="postal_address" placeholder="Complete postal address">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Purpose of the Data Use</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose of the Data Use">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                
                                                                <div class="form-control-wrap row">
                                                                    <div class="col-lg-6">
                                                                        <label class="form-label" for="email-address">Access duration From</label>
                                                                        <input type="text" class="form-control date-picker" id="email-address" placeholder="Access duration From">    
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <label class="form-label" for="email-address">Access duration To</label>
                                                                        <input type="text" class="form-control date-picker" id="email-address" placeholder="Access duration to">    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address">Extent of Using the Data</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="email-address" placeholder="Extent of Using the Data">
                                                                </div>
                                                            </div> 
                                                            <h6>Terms and Conditions</h6>
                                                            <li>I acknowledge that I have read, understood, and agree to be bound by the conditions in the event that my request is approved.</li>
                                                            <li>I declare that the information I have given on this form is true and correct in all regards.</li>
                                                            <li>Any data received will be used only for the purpose for which it was disclosed and will be accessed only by those authorized to use it. I will be fully responsible for breach of declaration, and Ministry of National Health Services Regulation &amp; Coordination has the right to take legal actions in the event of a breach of these conditions.</li>
                                                            <br/>
                                                            <h6>Undertaking</h6>
                                                            <p><input type="checkbox" name="agree" value="1"> I undertake not to disclose or publish the data (in any medium) without providing prior notification to the M/o NHSR&amp;C. I acknowledge that a breach of this undertaking may result in the rejection of future data requests submitted by me or by the organization I represent.</p>
                                                            <h6>Date of submission</h6>
                                                            <p><?php echo date('M-d-Y');?></p>
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