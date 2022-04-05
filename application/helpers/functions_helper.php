<?php
//================ Date formating function starts==================//
$CI = &get_instance();
function dateformatesformysql($dates) {
    if($dates!='00/00/0000'){
        $convertdate = $dates; //receives date like 08/27/2015
        $return = date('Y-m-d', strtotime($convertdate));
        return $return;
    }
}

function dateformateforreport($dates) {
    if($dates!='00/00/0000'){
        $convertdate = $dates; //receives date like 08/27/2015
        $return = date('Y-m-d', strtotime($convertdate));
        return $return;
    }
}

function dateformates($dates) {
    if($dates!='0000-00-00' && $dates!=''){
        $convertdate = $dates; //receives date like 0000-00-00
        $return = date('M d,Y',strtotime($convertdate));
        if(strstr($return,'1969')){
            return 'N/A';
        }else{
            return $return; //returns date formated MONTH 00, 0000
        }
    }else{
        return 'N/A';
    }
}

//format conversion to store date
function cnvrt_date($date){
    if($date!='' && $date!='00-00-0000'){
        $date1=explode("-",$date);
        $date= $date1[2].'-'.$date1[1].'-'.$date1[0];
        return $date;
    }
}

//format conversion to display date
function display_date($date){
    if($date!='0000-00-00' && $date!=''){
        $date1=explode("-",$date);
        $date = $date1[2].'-'.$date1[1].'-'.$date1[0];
        return $date;
    }
}


function calendar_date($dates) {
    $convertdate = $dates; //receives date like 0000-00-00
    $return = str_replace(",0",",",date('Y,m,d',strtotime($convertdate)));
    return $return; //returns date formated MONTH 00, 0000
}
function calendar_date_project($dates) {
    $convertdate = $dates; //receives date like 0000-00-00
    $return = str_replace(",0",",",date('d-m-Y',strtotime($convertdate)));
    return $return; //returns date formated 00-00-0000
}

function get_MONTHyear($dates) {
    $convertdate = $dates; //receives date like 0000-00-00
    $return = date('M, Y',strtotime($convertdate));
    return $return; //returns date formated MONTH 0000
}


function get_fullMONTHyear($dates){
    if($dates!=''){
        $convertdate = $dates; //receives date like 0000-00-00
        $return = date('d M,Y',strtotime($convertdate));
    }else{ $return = "N/A";}
    return $return; //returns date formated MONTH 0000
}

function get_year($dates) {
    $convertdate = $dates; //receives date like 0000-00-00
    $return = date('Y',strtotime($convertdate));
    return $return; //returns date formated MONTH 0000
}
function get_bdp_date($dates) {
    $convertdate = $dates; //receives date like 0000-00-00
    $return = date('m-d-Y',strtotime($convertdate));
    return $return; //returns date formated MONTH 0000
}


//================ Date formating function ends==================//

//================get age from dob==============//

function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}

//===============End=========//




//================ User validation function starts==================//
function validate(){
    $CI =& get_instance();

    if(!($CI->session->userdata('admin_validated')) )
    {
        redirect('login/index/Error');
    }else{
        return true;
    }

}

function is_admin(){
    $CI =& get_instance();
    if(!($CI->session->userdata('admin_validated')) )
    {
        redirect('admin');
    }else{
        return true;
    }

}
function is_user(){
    $CI =& get_instance();
    if(!($CI->session->userdata('user_validated')) )
    {
        redirect('auth/login');
    }else{
        return true;
    }

}
//================ User validation function Ends==================//

//print array
function print_array($arr,$flag = NULL){
    echo '<pre>';
    print_r($arr);
    if(!$flag){
        exit;
    }
}


function get_labeled_status($status)
{
    global $CI;
    $CI->load->model('listing_model');
    $status_array = $CI->listing_model->get_info('status',$status);

    switch ($status_array['id']) {
        case 1: // inactive
        case 6: // closed
        case 11: // rejected
        case 14: // cancelled
        $label_color = 'danger';
        break;

        case 2: // active
        case 5: // dispatch
        case 7: // completed
        case 13: // confirmed
        $label_color = 'success';
        break;

        case 3: // pending
        case 8: // pending payment
        case 9: // on the way
        case 20: // created shipment
        $label_color = 'warning';
        break;

        case 4: // processing
        case 12: // draft
        $label_color = 'info';
        break;
        case 21: // processing
        $label_color = 'warning';
        break;
        case 22: // processing
        $label_color = 'success';
        break;

        default:
        # code...
        break;
    }
    return '<span class="badge badge-dot badge-dot-xs badge-'.$label_color . '">' .$status_array['name'] . '</span>';
}

function uuid(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function todayDateTime(){
    return date('Y-m-d H:i:s');
}

function get_total_ind($surveyFormId){
    global $CI;
    $CI->load->model('listing_model');
    $where="idsurveyform = '".$surveyFormId."'";
    $totalRecords = $CI->listing_model->getCounts('surveyformindicators',$where);
    return $totalRecords;
}
function get_all_province(){
    global $CI;
    $CI->load->model('listing_model');
    $order = array('id' => 'province_code', 'order' => 'ASC');
    $provinces=$CI->listing_model->fetchall('provinces','','','','', $order);
    return $provinces;
}
function get_all_propups(){
    global $CI;
    $CI->load->model('listing_model');
    $order = array('id' => 'id', 'order' => 'ASC');
    $popups=$CI->listing_model->fetchall('popups','','','','', $order);
    return $popups;
}
function auth(){
    $CI =& get_instance();

    if(!($CI->session->userdata('nimda_validated')) )
    {
        $return = 'no';
    }else{
        $return = 'yes';
    }
    return $return;
}

function echo_query($val = 1){
    $CI = & get_instance();
    printer($CI->db->last_query(),$val);
}

function printer($value,$val = 1){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    if($val == 1){
        exit;
    }
}

function e_q($val = 1){
    $CI = & get_instance();
    p($CI->db->last_query(),$val);
}

function p($value,$val = 1){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    if($val == 1){
        exit;
    }
}

function e_qc($val = 1){
    $CI = & get_instance();
    pc($CI->db->last_query(),$val);
}

function pc($value,$val = 1){
    echo '<!--';
    print_r($value);
    echo '-->';
    if($val == 1){
        exit;
    }
}

function get_subcomponent_name($subcomp){
    global $CI;
    $CI->load->model('listing_model');

    $where=" idsubcomponent = '".$subcomp."'  ";
    $subcomp = $CI->listing_model->get_info('subcomponents',$subcomp, 'idsubcomponent', $where);
    return $subcomp['subcomponent_name'];
}

function get_surveyform_name($formId){
    global $CI;
    $CI->load->model('listing_model');

    $where=" idsurveyform = '".$formId."'  ";
    $subcomp = $CI->listing_model->get_info('surveyforms',$formId, 'idsurveyform', $where);
    return $subcomp['name'];
}
function get_all_counties(){
    global $CI;
    $CI->load->model('listing_model');
    $countries=$CI->listing_model->fetchall('country');
    return $countries;
}

function get_all_roles(){
    global $CI;
    $CI->load->model('listing_model');
    $roles=$CI->listing_model->fetchall('roles');
    return $roles;
}
function upload_file($FILES,$file_element_name,$upload_path,$dbPath){
    $expensions = array("gif","jpg","png","jpeg","doc","docx","xls","xlsx","pdf","ppt","pptx");
    $errors= array();
    $file_name = $FILES[$file_element_name]['name'];
    $file_size =$FILES[$file_element_name]['size'];
    $file_tmp =$FILES[$file_element_name]['tmp_name'];
    $file_type=$FILES[$file_element_name]['type'];
    $tmp = explode('.', $file_name);
    $ext = end($tmp);
    $file_ext=strtolower($ext);
    if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if(empty($errors)==true){
        $newfilename = time() .'__'.$file_name;
        move_uploaded_file($file_tmp,$upload_path.'/'.$newfilename);
        $imagesUrl  = $dbPath . $newfilename;
        return $imagesUrl;
    } else {
        //print_r($errors);
        return '';
    }
}
function create_slug($string){
    $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return strtolower($slug);
}
function createLink($type = NULL, $code = NULL, $roleS = NULL){
    if($type != NULL){
        if($type == 1){
            return $code.date("Y-m-d");
        }else if($type == 2){
            return sha1(md5($code.date("Y-n-d").$roleS));
        }elseif ($type == 3) {
            return md5(date("Y-n-d"));
        }elseif ($type == 4) {
            return md5(date("Y-n-d"))."&procode=1";
        }elseif ($type == 5) {
            return md5(date("Y-n-d"))."&procode=2";
        }elseif ($type == 6) {
            return md5(date("Y-n-d"))."&procode=3";
        }elseif ($type == 7) {
            return md5(date("Y-n-d"))."&procode=4";
        }elseif ($type == 8) {
            return md5(date("Y-n-d"))."&procode=5";
        }elseif ($type == 9) {
            return md5(date("Y-n-d"))."&procode=6";
        }else if($type == 10){
            return sha1(md5($code.date("Y-m-d").$roleS));
        }else{
            return '';
        }
    }else{
        return '';
    }
}
function get_link($subcomp){
    global $CI;
    $CI->load->model('listing_model');

    $where=" idsubcomponent = '".$subcomp."'  ";
    $subcomp = $CI->listing_model->get_info('integrations',$subcomp, 'idsubcomponent', $where);
    return $subcomp['link'];
}


function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function file_get_url_data($url) {
    $jsondata = file_get_contents($url);
    return (array) json_decode($jsondata, true);

}

function renameIndicator($value){
    $v = $value;
    if ($value === 'maternalcompl_admissions') {
        $v = 'maternaldeaths_admissions';
    } elseif ($value === 'maternalcompl_deaths') {
        $v = 'maternaldeaths_deaths';
    }
    return $v;
}

?>
