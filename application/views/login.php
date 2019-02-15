<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 1/31/2019
 * Time: 3:05 PM
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php $this->load->view("_partials/head.php") ?>

</head>

<body class="animsition">
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <H2>MONITA</H2><br>
                        (Monitoring Task Application)
                    </div>
                    <div class="login-form">
                        <form id="form-login" method="post">
                            <div class="form-group">
                                <label>NIK</label>
                                <input class="au-input au-input--full" type="text" name="nik" autocomplete="off" placeholder="NIK">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                            </div>
                            <br>
                            <button id="btn-login" class="au-btn au-btn--block au-btn--green m-b-20" type="button">sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("_partials/copyright.php") ?>
    </div>

</div>


<!-- Jquery JS-->
<?php $this->load->view("_partials/js.php") ?>
</body>
</html>
<!-- end document-->

<script type="text/javascript" language="JavaScript">
    $("#btn-login").click(function(){
        $.ajax({
            url : "<?php echo base_url(); ?>/Site/login",
            type : "post",
            data : $("#form-login").serialize(),
            dataType: 'json',
            success : function(a) {
                if (a.failed == 'true') {
                    alert('Invalid credentials');
                }
                else if(a.failed == 'false') {
                    window.location.href = "<?php echo base_url(); ?>dashboard";
                }
            },
        });
    });
</script>