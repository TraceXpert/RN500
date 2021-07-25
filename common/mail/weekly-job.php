<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>This Week's top jobs</title>

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900" rel="stylesheet" />
    </head>
    <body>
        <table style="width: 100%;">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" style="width: 100%;max-width: 700px;margin: 0 auto !important;">
                        <tr>
                            <td align="center">
                                <table class="container" align="center" cellspacing="0" cellpadding="0"
                                       style="width: 100%;">
                                    <tr style="background: #ffffff;padding: 20px 0px;display: block">
                                        <td align="left">
                                            <img src="http://rn500.com/images/email/logo.png" alt="log" style="width: 160px;margin-right: 20px;" />
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

                                        <?php foreach ($models as $model) { ?>
                                            <tr>
                                                <td
                                                    style="padding: 10px 20px 6px;color: #000000;font-weight: 800;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                        <?= $model->title ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    style="padding: 0px 20px 6px;color: #000000;font-weight: 600;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                    <img src="http://rn500.com/images/email/location.png" alt="Location" style="height: 16px;width: 16px;color: #2470b3;margin-right: 6px;" /> <?= $model->citiesName ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    style="padding: 0px 20px 16px;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">                                            
                                                        <?= $model->description ?> 
                                                </td>
                                            </tr>

                                            <tr>
                                                <td align="left" style="padding: 0px 20px 6px;">
                                                    <a href="http://rn500.com/browse-jobs/view?id=<?= $model->reference_no ?>" style="text-decoration: none;color: #FFF;padding: 16px 20px;background:#2470b3;
                                                       font-weight: 500;text-align: center;cursor: pointer;display: inline-block;
                                                       border-radius: 0px;font-family: 'Montserrat', sans-serif;">I'am interested</a>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px 26px;border-bottom: 1px solid grey;margin: 0 20px;display: block;"></td>
                                            </tr>

                                        <?php } ?>

                                        <tr>
                                            <td
                                                style="padding: 40px 20px;;color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 26px;">
                                                If you have any issues in your account we will be happy to help you.
                                                You can
                                                contact us on
                                                <a href="mailto:info@RN500.com"
                                                   style="margin:0;padding: 0 0 20px 0;text-decoration: none;color: #2470b3;font-weight: 500;font-family: 'Montserrat', sans-serif;text-align: justify;font-size: 16px;line-height: 22px;">
                                                    info@RN500.com.</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td align="left" style="padding: 20px 20px 20px;display: flex;">
                                                <span style="color: #000000;font-weight: 500;font-family: 'Montserrat', sans-serif;font-size: 16px;font-weight: 600;margin-right: 10px;display: flex;align-items: center;">Follow us on:</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="padding: 20px 20px 20px;display: flex;">
                                                <a href=""><img src="http://rn500.com/images/email/facebook.png" alt="facebook" style="margin-right: 10px;"/></a>
                                                <a href=""><img src="http://rn500.com/images/email/instagram.png" alt="Instagram" style="margin-right: 10px;"/></a>
                                                <a href=""><img src="http://rn500.com/images/email/twitter.png" alt="Twitter"/></a>
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