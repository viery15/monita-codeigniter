<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/8/2019
 * Time: 8:14 AM
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task Detail</title>
    <?php $this->load->view("_partials/head.php") ?>
    <?php $this->load->view("_partials/js.php") ?>
    <style type="text/css">
        /* CSS Test begin */
        .image-upload > input
        {
            display: none;
        }

        .image-upload img
        {
            width: 80px;
            cursor: pointer;
        }
        .comment-box {
            margin-top: 30px !important;
        }
        /* CSS Test end */

        .comment-box img {
            width: 50px;
            height: 50px;
        }
        .comment-box .media-left {
            padding-right: 10px;
            width: 65px;
        }
        .comment-box .media-body p {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .comment-box .media-body .media p {
            margin-bottom: 0;
        }
        .comment-box .media-heading {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 7px 10px;
            position: relative;
            margin-bottom: -1px;
        }
        .comment-box .media-heading:before {
            content: "";
            width: 12px;
            height: 12px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-width: 1px 0 0 1px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            position: absolute;
            top: 10px;
            left: -6px;
        }

        body{ background: #fafafa;}
        .widget-area.blank {
            background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            -ms-box-shadow: none;
            -o-box-shadow: none;
            box-shadow: none;
        }
        body .no-padding {
            padding: 0;
        }
        .widget-area {
            background-color: #fff;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
            -ms-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
            -o-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
            box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
            float: left;
            margin-top: 30px;
            padding: 25px 30px;
            position: relative;
            width: 100%;
        }
        .status-upload {
            background: none repeat scroll 0 0 #f5f5f5;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            float: left;
            width: 100%;
        }
        .status-upload form {
            float: left;
            width: 100%;
        }
        .status-upload form textarea {
            background: none repeat scroll 0 0 #fff;
            border: medium none;
            -webkit-border-radius: 4px 4px 0 0;
            -moz-border-radius: 4px 4px 0 0;
            -ms-border-radius: 4px 4px 0 0;
            -o-border-radius: 4px 4px 0 0;
            border-radius: 4px 4px 0 0;
            color: #777777;
            float: left;
            font-family: Lato;
            font-size: 14px;
            height: 142px;
            letter-spacing: 0.3px;
            padding: 20px;
            width: 100%;
            resize:vertical;
            outline:none;
            border: 1px solid #F2F2F2;
        }

        .status-upload ul {
            float: left;
            list-style: none outside none;
            margin: 0;
            padding: 0 0 0 15px;
            width: auto;
        }
        .status-upload ul > li {
            float: left;
        }
        .status-upload ul > li > a {
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            color: #777777;
            float: left;
            font-size: 14px;
            height: 30px;
            line-height: 30px;
            margin: 10px 0 10px 10px;
            text-align: center;
            -webkit-transition: all 0.4s ease 0s;
            -moz-transition: all 0.4s ease 0s;
            -ms-transition: all 0.4s ease 0s;
            -o-transition: all 0.4s ease 0s;
            transition: all 0.4s ease 0s;
            width: 30px;
            cursor: pointer;
        }
        .status-upload ul > li > a:hover {
            background: none repeat scroll 0 0 #606060;
            color: #fff;
        }
        .status-upload form button {
            border: medium none;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -ms-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            color: #fff;
            float: right;
            font-family: Lato;
            font-size: 14px;
            letter-spacing: 0.3px;
            margin-right: 9px;
            margin-top: 9px;
            padding: 6px 15px;
        }
        .dropdown > a > span.green:before {
            border-left-color: #2dcb73;
        }
        .status-upload form button > i {
            margin-right: 7px;
        }
    </style>
</head>

<body>
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <?php $this->load->view("_partials/navbar.php") ?>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <?php $this->load->view("_partials/sidebar.php") ?>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <?php $this->load->view("_partials/nav_desktop.php") ?>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content" style="padding-bottom: 100px;">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">
                                    <?php
                                    if ($task == NULL) {
                                        echo "Task Not Found";
                                    } else {
                                    ?>
                                    <?php
                                        if ($this->session->nik == $task->user_from){
                                    ?>
                                    My Request
                                    <?php } ?>
                                    <?php
                                    if ($this->session->nik != $task->user_from){
                                        ?>
                                        My Task
                                    <?php } ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <div id="task-content">
                            <?php $this->load->view("task_page_content.php") ?>
                            </div>
                        </div>
                    </div>
                    <h4>Comments</h4>

                    <div id="comment-section" >
                        <?php $this->load->view("comment_page.php") ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
</div>
<?php } ?>
<div id="modal-request" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div id="content-modal"></div>

        </div>

    </div>
</div>
<!-- Jquery JS-->
<script src="<?php echo base_url('js/main.js') ?>"></script>
</body>

</html>
<!-- end document-->


