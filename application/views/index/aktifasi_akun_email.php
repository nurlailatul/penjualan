<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',

    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>
<?php if(strpos(base_url(), 'localhost') !== false) {$logo = "http://i.imgur.com/xGotEey.png";} else {$logo = base_url("/public/image/logonew-hrz.png");}?>

<body style="<?php echo $style['body']; ?>">
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="<?php echo $style['email-wrapper']; ?>" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="<?php echo $style['email-masthead']; ?>">
                        <a style="<?php echo $fontFamily . " " . $style['email-masthead_name'];?>" href="<?php echo site_url();?>" target="_blank">
                            <table style="margin:auto;">
                                <tr>
                                    <td><img height="40" src="<?php echo $logo;?>"></td><td style="vertical-align:middle;">Si Mia Cerdas</td>
                                </tr>
                            </table>
                        </a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td style="<?php echo $style['email-body']; ?>" width="100%">
                        <table style="<?php echo $style['email-body_inner']; ?>" align="center" width="570" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="<?php echo $fontFamily . " " . $style['email-body_cell']; ?>">
                                    <p style="<?php echo $style['paragraph']; ?>">
                                        Yth.<br>
                                        <?php echo $nama_dosen; ?>,
                                    </p>
                                    <p style="<?php echo $style['paragraph']; ?>">
                                        Alamat email Anda telah terdaftar di Aplikasi Si Mia Cerdas. Berikut adalah detail username dan password untuk melakukan login pada Aplikasi Si Mia Cerdas.</p>

                                    <p style="<?php echo $style['paragraph']; ?>">

                                    <table style="<?php echo $style['paragraph']; ?>" align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td width="17%">Username </td>
                                            <td width="3%"> : </td>
                                            <td><?php echo $username; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Password </td>
                                            <td> : </td>
                                            <td><?php echo $password; ?></td>
                                        </tr>
                                    </table>
                                    </p>

                                    <p style="<?php echo $style['paragraph']; ?>">
                                        Anda dapat melakukan perubahan password pada menu <b>My Account<b/>. Untuk login ke Aplikasi Si Mia Cerdas, silahkan tekan button di bawah ini.</p>

                                    <table style="<?php echo $style['body_action']; ?>" align="center" width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center">
                                                <?php $actionColor = 'button--blue'; ?>

                                                <a href="<?php echo site_url(); ?>"
                                                   style="<?php echo $fontFamily . " " . $style['button'] . " " . $style[$actionColor]; ?>"
                                                   class="button"
                                                   target="_blank">
                                                    Login
                                                </a>
                                            </td>
                                        </tr>
                                    </table>

                                    <br><br>
                                    <p style="<?php echo $style['paragraph']; ?>">
                                        Jika Anda mengalami permasalahan dengan button di atas, silahkan copy-paste link di bawah ini pada browser Anda :</p>

                                    <p style="<?php echo $style['paragraph']; ?>">
                                        <a href="<?php echo site_url(); ?>" target="_blank"><?php echo site_url(); ?></a>
                                    </p>

                                    <br><br><hr/>
                                    <p style="<?php echo $style['paragraph']; ?>">
                                        <small>Untuk pertanyaan lain, silahkan hubungi <a href="mailto:admin.simkinerja@gmail.com">Admin Si Mia Cerdas</a>.</small></p>
                                    <br><br>
                                    <p style="<?php echo $style['paragraph']; ?>">
                                        Hormat Kami,<br><br><br><b>Admin Aplikasi Si Mia Cerdas</b>
                                    </p>
                                    <br><br><hr>
                                    <p style="<?php echo $style['paragraph']; ?>"><small><b>*This email was auto generated by the system. Please dont reply this email. If you want to reply this email, contact to <a href="mailto:admin.simkinerja@gmail.com">Admin Si Mia Cerdas</a>.</b></small></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td>
                        <table style="<?php echo $style['email-footer']; ?>" align="center" width="570" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="<?php echo $fontFamily . " " . $style['email-footer_cell']; ?>">
                                    <p style="<?php echo $style['paragraph-sub']; ?>">
                                        &copy; <?php echo date('Y');?>
                                        <a style="<?php echo $style['anchor']; ?>" href="<?php echo site_url();?>" target="_blank">Aplikasi Si Mia Cerdas</a>.
                                        All rights reserved.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
