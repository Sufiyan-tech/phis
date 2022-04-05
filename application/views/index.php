<!DOCTYPE html>
<html lang="zxx" class="js">

    <?php $this->load->view('layouts/head');?>

    <body class="nk-body bg-lighter npc-default has-sidebar ">
        <div class="nk-app-root">
            <!-- main @s -->
            <?php $this->load->view('layouts/delete-popup');?>
            <div class="nk-main ">
                <!-- sidebar @s -->
                <?php if (isset($nosidebar) && $nosidebar === true) {
                    // code...
                }  else {
                    $this->load->view('layouts/sidebar');
                }?>
                <!-- sidebar @e -->
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                <?php $this->load->view('layouts/header');?>
                


                    <!-- main header @e -->
                    <!-- content @s -->
                    <?php echo $content;?>
                    <!-- content @e -->
                    <!-- footer @s -->
                <?php $this->load->view('layouts/footer');?>

                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
            <?php $this->load->view('layouts/root_js');?>
    </body>

</html>
