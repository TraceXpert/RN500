<?php

use common\models\Advertisement;
use common\CommonFunction;

$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
?>
<?php foreach ($advertisments as $key => $ads) { ?> 
    <?php $adsName = (strlen($ads->name) > 30) ? substr($ads->name, 0, 30) . ' ...' : $ads->name ?> 
    <div class="col-md-4">
        <div class="featured-img-block position-relative mb-4">
            <?php if ($ads->file_type == Advertisement::FILE_TYPE_YOUTUBE_LINK) { ?>
                <iframe width="100%"  height="195" src="<?php echo $ads->getYoutubeEmbedUrl() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="max-height-ads-home"></iframe>
                <div class="ads-title">
                    <p class="mb-0"><?php echo $adsName ?> <a href="<?php echo $ads->link_url ?>" target="_blank"> <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"> </a></p>                             
                </div>

            <?php } else { ?>

                <?php if ($ads != '' && file_exists(CommonFunction::getAdvertisementBasePath() . DIRECTORY_SEPARATOR . $ads->icon)) { ?>
                    <img src="<?= CommonFunction::getAdvertisementBaseUrl() . DIRECTORY_SEPARATOR . $ads->icon ?>" alt="<?php echo $ads->icon ?>" class="img-fluid mx-auto d-block max-height-ads-home w-100">
                <?php } else { ?>
                    <img src="<?= $assetDir ?>/img/featured-video-2.png" alt="featured-video" class="img-fluid mx-auto d-block max-height-ads-home">
                <?php } ?>
                <div class="ads-title">
                    <p class="mb-0"> <?php echo $adsName ?> <a href="<?php echo $ads->link_url ?>" target="_blank"> <img src="<?= $assetDir ?>/img/right-arrow.png" alt="right-arrow" class="img-fluid float-right"> </a></p>                             
                </div>

            <?php } ?>
        </div>
    </div>
<?php } ?>