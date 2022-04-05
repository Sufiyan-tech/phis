<div class="example-alert">
    <?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-icon">
        <em class="icon ni ni-check-circle"></em> <strong>Success!</strong><?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger alert-icon">
        <em class="icon ni ni-cross-circle"></em> <strong>Error!</strong><?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php } ?>
</div>