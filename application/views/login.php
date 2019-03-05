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
            <div class="login-wrap" style="max-width: 400px;padding-top: 10%">
                <div class="login-content">
                    <div class="login-logo">
                        <H3>MONITA</H3>
                        (Monitoring Task Application)
                    </div>
                    <div class="login-form">
                        <form id="form-login" method="post">
                            <div class="form-group">
                                <label>NIK:</label>
                                <input style="padding: 0.5%" class="form-control" type="text" name="nik" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input style="padding: 0.5%" class="form-control" type="password" name="password">
                            </div>
                            <button id="btn-login" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
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
    $("#form-login").submit(function(){
        event.preventDefault();
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
