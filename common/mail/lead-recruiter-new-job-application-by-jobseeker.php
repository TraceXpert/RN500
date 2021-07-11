<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
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


                    <div class="content" style="max-width: 700px;margin: 0 auto;display: block;" class="container" style="max-width: 700px;display: block !important;margin: 0 auto !important;clear: both !important;box-shadow: 0px 2px 7px 3px #dcdcdc;border-radius: 10px;">
                        <table style="background: #FFFFFF;box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.10);border-radius: 6px;" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 20px">
                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">

                                        <tr>
                                            <td style="padding: 10px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                Hello , 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 20px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">

                                                You received application for Job Reference NO.: <?php echo $lead->reference_no ?>, Job Title: <?php echo $lead->title ?>, Job Location: <?php echo $lead->getLocation() ?> from Job Seeker Profile: <?php echo $job_seeker->getFullName() ?>. Please click to view button to see Job Seekers profile. 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left" style="padding: 20px 20px;">
                                                <a href="<?= $urlToSend ?>" style="text-decoration: none;color: #FFF;padding: 16px 20px;background:#2470b3;font-weight: 500;text-align: center;cursor: pointer;display: inline-block;border-radius: 6px;font-family: 'Montserrat', sans-serif;">
                                                    View Job Seeker
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 20px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                It will be really helpful when action taken as application Received, Under Processing or Selected from selection options. You can always find action take responses in Reports tab. 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left" style="padding: 20px 20px 20px;display: flex;">
                                                <span style="color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;font-size: 16px;font-weight: 600;margin-right: 10px;display: flex;align-items: center;">Stay in touch</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding: 20px 20px 20px;display: flex;">
                                                <a href=""><img src="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/images/email/facebook.png']) ?>" alt="facebook" style="margin-right: 10px;"/></a>
                                                <a href=""><img src="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/images/email/instagram.png']) ?>" alt="Instagram" style="margin-right: 10px;"/></a>
                                                <a href=""><img src="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/images/email/twitter.png']) ?>" alt="Twitter"/></a>
                                            </td>
                                        </tr>



                                        <tr>
                                            <td align="left" style="padding: 20px 20px; color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;">
                                                Thank you,  <br/>
                                                Customer Service Team, <br/>
                                                RN500.com 
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
