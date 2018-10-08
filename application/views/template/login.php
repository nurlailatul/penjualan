<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login | <?php echo isset($app_name) ? $app_name : ''; ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?php echo base_url("/public/image/favicon2.png") ?>">
        <link href="<?php echo base_url("/public/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/ionicons.min.css") ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/AdminLTE.min.css") ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/skin-red.min.css") ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("/public/css/yoohee.min.css") ?>" rel="stylesheet" type="text/css">
        <style>.login-page{background:url("<?php echo base_url("/public/image/GreyPolygons_1400x900.jpg") ?>");background-size:cover;}.powered{color:#fff;font-size:15px;text-shadow:0 0 4px #000;}</style>

        <script src="<?php echo base_url("/public/js/jQuery-2.1.4.min.js") ?>"></script>
    </head>
    <body class="login-page">
        {CONTENT}

        <div id="optionGroup">
        </div>

        <script src="<?php echo base_url("/public/js/bootstrap.min.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/jquery.slimscroll.min.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/fastclick.min.js") ?>"></script>
        <script src="<?php echo base_url("/public/js/app.min.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/yii.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/yii.validation.js") ?>" type="text/javascript"></script>
        <script src="<?php echo base_url("/public/js/yii.activeForm.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                <?php if (!empty($this->session->userdata("r_optionGroup")) && $this->session->flashdata('option')) { ?>
                $.post("<?php echo site_url("index/get_option") ?>", function (result) {
                    $("#optionGroup").html(result);
                    $('#view').modal('show');
                });
                <?php } ?>


                $('#login-form').yiiActiveForm([{"id":"user-username","name":"username","container":".field-user-username","input":"#user-username","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Username harus diisi."});yii.validation.string(value, messages, {"message":"Username  harus dalam format string.","max":255,"tooLong":"Username tidak boleh lebih dari 255 karakter.","skipOnEmpty":1});}},{"id":"user-password","name":"password","container":".field-user-password","input":"#user-password","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Password harus diisi."});yii.validation.string(value, messages, {"message":"Password  harus dalam format string.","max":255,"tooLong":"Password tidak boleh lebih dari 255 karakter.","skipOnEmpty":1});}}], []);
                $('#reset-form').yiiActiveForm([{"id":"email","name":"email","container":".field-email","input":"#email","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Email harus diisi."});yii.validation.string(value, messages, {"message":"Email  harus dalam format string.","max":255,"tooLong":"Email tidak boleh lebih dari 255 karakter.","skipOnEmpty":1});}},{"id":"password","name":"password","container":".field-password","input":"#password","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Password harus diisi."});yii.validation.string(value, messages, {"message":"Password  harus dalam format string.","max":255,"tooLong":"Password tidak boleh lebih dari 255 karakter.","skipOnEmpty":1});}},{"id":"confirm","name":"confirm","container":".field-confirm","input":"#confirm","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Konfirmasi Password harus diisi."});yii.validation.string(value, messages, {"message":"Konfirmasi Password harus dalam format string.","max":255,"tooLong":"Konfirmasi Password tidak boleh lebih dari 255 karakter.","skipOnEmpty":1});}}], []);
            });
        </script>
    <script type="text/javascript">document.write = "</bo" + "dy >";</script>
</html>