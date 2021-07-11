<?php

use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900" rel="stylesheet" />
    </head>

    <body>

        <table style="width: 100%;">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" style="width: 100%;max-width: 700px;margin: 0 auto !important;">
                        <tr>
                            <td align="center">
                                <table class="container" align="center" cellspacing="0" cellpadding="0" style="width: 100%;">
                                    <tr style="background: #ffffff;padding: 20px 0px;display: block">
                                        <td align="left">
                                            <img src="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/images/email/logo.png']) ?>" alt="log" style="width: 160px;margin-right: 20px;" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>


                    <div class="content" style="max-width: 700px;margin: 0 auto;display: block;" class="container"
                         style="max-width: 700px;display: block !important;margin: 0 auto !important;clear: both !important;box-shadow: 0px 2px 7px 3px #dcdcdc;border-radius: 10px;">
                        <table style="background: #FFFFFF;box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.10);border-radius: 6px;"
                               width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 20px">
                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">

                                        <tr style="background: #2470b3;border-radius: 6px;padding: 20px;display: grid;">
                                            <td align="left">                            
                                                <div
                                                    style="display:inline-block; max-width:600px; border-radius: 6px;vertical-align:top; width:100%;margin: 10px 20px;">
                                                    <table class="container" align="center" cellspacing="0" cellpadding="0"
                                                           style="width: 100%;">
                                                        <tr>
                                                            <td align="left">
                                                                <p
                                                                    style="color: #fff;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 20px;line-height: 26px;">
                                                                    Hello <?= $name ?>,<br />
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>



                                        <tr>
                                            <td
                                                style="padding: 40px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                Follow the link below to reset your password:
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left" style="padding: 0px 20px;">
                                                <a href="<?= $resetLink ?>" style="text-decoration: none;color: #FFF;padding: 16px 20px;background:#2470b3;font-weight: 500;text-align: center;cursor: pointer;display: inline-block;border-radius: 6px;font-family: 'Montserrat', sans-serif;">
                                                    Set Password
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td
                                                style="padding: 40px 20px;;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                If you have any issues, please contact customer service team of RN500 at:
                                                <a href="mailto:<?php echo Yii::$app->params['senderEmail'] ?>" style="margin:0;padding: 0 0 20px 0;text-decoration: none;color: #2470b3;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 22px;"> <?php echo Yii::$app->params['senderEmail'] ?> </a>
                                            </td>
                                        </tr>


                                        <?php echo $this->render('_social_links') ?>


                                        <tr>
                                            <td align="left" style="padding: 0px 20px 20px; color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;">
                                                Regards,<br/> 
                                                RN500, LLC.<br/>
                                                www.RN500.com <br/>
                                            </td>

                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>


                    </div>

                </td>
            </tr>
        </table>

    </body>

</html>