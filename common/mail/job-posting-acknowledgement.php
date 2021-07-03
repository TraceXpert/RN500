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


                    <div class="content" style="max-width: 700px;margin: 0 auto;display: block;" class="container" style="max-width: 700px;display: block !important;margin: 0 auto !important;clear: both !important;box-shadow: 0px 2px 7px 3px #dcdcdc;border-radius: 10px;">
                        <table style="background: #FFFFFF;box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.10);border-radius: 6px;" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 20px">
                                    <table cellpadding="0" cellspacing="0" style="width: 100%;">

                                        <tr>
                                            <td style="padding: 40px 20px 20px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                To <br/>
                                                <?php echo $postingCompany->company_name ?><br/>
                                                <?php echo $postingCompany->getCompanyLocation() ?><br/>

                                            </td>
                                        </tr>


                                        <tr>
                                            <td style="padding: 10px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                Your Job Reference No.: <?php echo $lead->reference_no ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 10px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                Dear Sir/Madam, 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 10px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                Thank you for posting job on RN500.com. We would like to confirm that job has been posted successfully. You will hear back from our trusted recruiters, job seekers very soon. 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 20px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                Posting new jobs are always free for Employers and Recruiters. Please keep in mind, we will promote your business FREE for 1 month when you post at least 4 jobs in a month OR receive surprise gift cards from RN500.com.
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding: 20px 20px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                Please find attached copy of your posted job. 
                                            </td>
                                        </tr>






<!--                                        <tr>
                                            <td align="left" style="padding: 0px 20px 20px;display: flex;">
                                                <span style="color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;font-size: 16px;font-weight: 600;margin-right: 10px;display: flex;align-items: center;">Stay in touch</span>
                                                <a href=""><img src="<?php // echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/images/email/facebook.png'])   ?>" alt="facebook" style="margin-right: 10px;"/></a>
                                                <a href=""><img src="<?php // echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/images/email/instagram.png'])   ?>" alt="Instagram" style="margin-right: 10px;"/></a>
                                                <a href=""><img src="<?php // echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/images/email/twitter.png'])   ?>" alt="Twitter"/></a>
                                            </td>
                                        </tr>-->

                                        <tr>
                                            <td align="left" style="padding: 0px 20px 20px; color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;">
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