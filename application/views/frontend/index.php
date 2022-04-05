<!DOCTYPE html>
<html>
<?php $this->load->view('frontend/layouts/head');?>
<body>
    <div class="container-fluid">
        <?php $this->load->view('frontend/layouts/header');?>
    </div>
    <div class="container-fluid">
        <div class="tabNav">
            <?php if(isset($navbar)){echo $navbar;}?>
        </div>
        <?php echo $content;?>
    </div>
    </div>
    
<div class="modal fade" id="all_loc">
    <div class="modal-dialog modal-reginsList">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span id="sub-comp-name"></span></h5>
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <ul class="reginsList" id="provinces-ul"></ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalSurveyYear">
    <div class="modal-dialog modal-reginsList">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span id="sub-comp-name-year"></span></h5>
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <ul class="reginsList" id="survey-years"></ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="myModal2">
    <div class="modal-dialog warPop">
      <div class="modal-content ">        
        <!-- Modal body -->
        <div class="modal-body">
           <p>Sorry, This Modules is only
            available for Registered Users.</p>
            <div class="row text-center mt-3">
              <div class="d-flex mb-3 col-12">
                    <button class="btn btn-close btn-themed btn-block mt-0" type="button" data-dismiss="modal">
                        CANCLE
                    </button>
                    <button class="btn btn-secondary btn-themed btn-block mt-0 ml-3" id="loginBtn">
                        LOGIN
                    </button>
                </div>
            </div>
        </div>
         
        
      </div>
    </div>
  </div>


</body>
<?php $this->load->view('frontend/layouts/root_js');?>
</html>