var URL = 'http://localhost/phis/';
$( document ).ready(function() {
  
    /* wasim if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
        URL = 'http://localhost/phis/';
    } else {
         URL = 'https://' + document.domain + '/phis/';
    } wasim */

    $(document.body).on('click', '#loginBtn', function(){
      //window.location = URL+"auth/login";
      window.location = URL+"auth/login";
    });

    $('#country').on('change', function() {
  		var selected_val = this.value;
      var data_key = $('option:selected', this).attr('data-key');
  		if(data_key == 'PK'){
  			$('#cnic_field').show();
  			$('#passport_field').hide();
  		}else{
  			if(selected_val == 0){
  				$('#cnic_field').show();
  				$('#passport_field').hide();	
  			}else{
  				$('#cnic_field').hide();
  				$('#passport_field').show();
  			}
  		}

	});
  $( "#component" ).change(function() {
    var comp_id = $(this).val();
    var type = $(this).find(':selected').attr('data-value');

    if (comp_id) {
        $.ajax({
          url :URL+"linkages/get_subcomponent",
          type:"POST",
          cache:false,
          data:{comp_id:comp_id},
          success:function(data){
            $("#subcomponent").html(data);
            $("#component_type").val(type);
          }
        });
      }else{

      }
  });


  

  $(document.body).on('change', '#permission-region', function(){
    const region = $(this).val();
    console.log(region);
    if(region == 2){
     $("#provinces-selection").css("display", "block");
    }else{
      $("#provinces-selection").css("display", "none");
    }
    
})

  $(document.body).on('click', '#r-password', function(){
    var randomPass = makeRandomPasswd();
    $("#password").val(randomPass);
    $("#confirm_password").val(randomPass);
    
})


  $("#uid").click(function(){
    $('.checkSingle').prop('checked', this.checked);
  });

  $(document.body).on('click', '#deleterecord', function(){
    var dlt_id = $(this).attr('deleteid');
    var colmnname = $(this).attr('colmnname');
    var tbl_name = $(this).attr('table');

    jQuery('#deleterecord').attr('disabled', true);
    $("#deleterecord").html("Processing");
    $.ajax({
          url :URL+"ajax/delete_record",
          type:"POST",
          cache:false,
          data:{dlt_id:dlt_id,tbl_name:tbl_name,colmnname:colmnname},
          success:function(returndata){
            if(returndata == 1){
              location.reload();
            }
          }
    });
    
})


});
function get_ind_popup(formobj){

  $.ajax({
    url :URL+"years/get_indicator_list",
    type:"POST",
    cache:false,
    data:{idsurveyform:formobj},
    success:function(data){
      $("#ul-list-indicators").html(data);
    }
  });

    $('#modalForm').modal('toggle');
}
function show_login_popup(subcompobj){
  $('#myModal2').modal('toggle');   
}
function get_loc_popup(subcompobj, is_provice, redilink){
  console.log(redilink);
  console.log(is_provice);
  if(is_provice == 0){
    window.open(redilink, '_blank');
    return false;
  }
  var urllink = URL+"main/get_comp_provinces";
  if (subcompobj) {
        $.ajax({
          url :URL+"main/get_comp_provinces",
          type:"POST",
          cache:false,
          data:{subcompobj:subcompobj},
          success:function(data){
            var returnedData = JSON.parse(data); 
            console.log(returnedData);
            $("#sub-comp-name").html(returnedData.sub_comp_name);
            $("#provinces-ul").html(returnedData.lipanel);
          }
        });
      }else{

      }
  $('#all_loc').modal('toggle');
}

function change_indicators(obj){
  idsubcomp = obj.value;
  console.log(idsubcomp);
  $.ajax({
    url :URL+"main/get_ind_by_subcomponent",
    type:"POST",
    cache:false,
    data:{subcompobj:idsubcomp},
    success:function(data){
      $("#indicators-by-subcomp").html(data);
    }
  });
}

function get_districts(proid){
  $("#district-div").css("display", "none");
  var idcampaign = $( "#idcampaign option:selected" ).val();
  var pro_id = proid.value;
  console.log(idcampaign +'---'+pro_id);
  $.ajax({
    url :URL+"main/get_district_by_subcom",
    type:"POST",
    cache:false,
    data:{idcampaign:idcampaign, pro_id:pro_id},
    success:function(data){
      var parseData = JSON.parse(data);
      console.log(parseData.is_district);
      if(parseData.is_district == 1){
        $("#district-div").css("display", "block");
        var allprovinces = parseData.provinces;
        $.each(allprovinces, function(key, value) {
        $('#district_code')
           .append($("<option></option>")
                      .attr("value", value.district_code)
                      .text(value.district_name)); 
        });
      }else{
        $("#district-div").css("display", "none");
      }
      
    }
  });
}
function makeRandomPasswd() {
  var passwd = '';
  var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  for (i=1;i<8;i++) {
    var c = Math.floor(Math.random()*chars.length + 1);
    passwd += chars.charAt(c)
  }

  return passwd;

}

function delete_data(table, msg, userid, colmnname){
  $('#msg-p').text(msg);
  $('#deleterecord').attr('deleteid', userid);
  $('#deleterecord').attr('colmnname', colmnname);
  $('#deleterecord').attr('table', table);
  $('#modalDelete').modal('toggle');
}

function showYears(idComp){
  console.log(idComp);
  $.ajax({
    url :URL+"front/survey/get_survey_years",
    type:"POST",
    cache:false,
    data:{subcompid:idComp},
    success:function(data){
      var returnedData = JSON.parse(data); 
        $("#sub-comp-name-year").html(returnedData.sub_comp_name);
        $("#survey-years").html(returnedData.lipanel);
    }
  });
    $('#modalSurveyYear').modal('toggle');
}

$(document.body).on('change', '#idcampaign', function(){
    const idcampaign = $(this).val();
    $.ajax({
        type: "GET",
        url: URL + "survey/getCampaignIndicators?idcampaign="+idcampaign,
        dataType: "json",
        success: function(data) {
            var result = '<option value="">Select Indicator</option>';
            $(data).each(function (index, obj) {
                result = result + `<option value='${obj.idindicator}' >${obj.name}</option>`;
            });
            $("#idindicator").html(result);
        }
    });
});

$(document.body).on('change', '#idindicator', function(){
    const idcampaign = $('#idcampaign').val();
    console.log(idcampaign);
    const idindicator = $(this).val();
    $.ajax({
        type: "GET",
        url: URL + `dashboard/getSurveyDashboard?idcampaign=${idcampaign}&idindicator=${idindicator}`,
        dataType: "text",
        success: function(response) {
            var data = $.parseJSON(response);
            console.log(data.current_data);
            $('.charts').html('');
            $('.charts').html(data.current_data);
            // $('#fac_chart').html('');
            // $('#fac_chart').html(data.fac_chart);
            // $(".charts").html(data);
        }
    });
});

  
