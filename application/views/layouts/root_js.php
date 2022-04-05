
<script src="<?php echo base_url();?>assets/js/scripts.js?ver=2.2.0"></script>
<script src="<?php echo base_url();?>assets/js/backend/custom.js"></script>
<script type="text/javascript">
$(document.body).on('change', '.change-value input[type="checkbox"]', function(e){
    if($(this).is(":checked")) { $(this).val('1'); } else { $(this).val('0'); }
});
function chk(input){
    if($(input).is(":checked")) { $(input).val('1'); } else { $(input).val('0'); }
}
</script>
