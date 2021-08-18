<?php

use yii\widgets\LinkPager;

$searchInput = trim(Yii::$app->request->get('search'));
?>
<section class="inner-banner browse-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Blogs</h1>
            </div>
        </div>
    </div>
</section>

<section class="contact-form blog-list-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form role="search" method="get" class="search-form mb-5" action="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['blogs/list']) ?>">
                    <label class="d-block">                        
                        <input type="search" class="search-field" placeholder="Search …" value="<?php echo $searchInput; ?>" name="search" autocomplete="off">
                    </label>
                    <input type="submit" class="search-submit" value="Search">
                </form>
            </div>
        </div>
        <?php if (count($blogList)) { ?>

            <div class="row">
                <?php foreach ($blogList as $k => $blog) { ?>

                    <div class="col-lg-4 col-md-6">
                        <div class="blog-box">
                            <a href="<?php echo $blog->getDetailUrl() ?>">
                                <div class="image">
                                    <img src="<?php echo $blog->getCoverImageUrl() ?>" alt="Blog-Image">
                                </div>
                            </a>
                            <div class="content">
                                <a href="<?php echo $blog->getDetailUrl() ?>">
                                    <h6> <?php echo $blog->title; ?> </h6>
                                </a>
                                <ul class="d-flex align-item-center">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"> </path>
                                            </svg>
                                            <?php echo $blog->getCreatedByName(); ?> 

                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="comment" class="svg-inline--fa fa-comment fa-w-16" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32z"> </path>
                                            </svg>
                                            <?php echo date('M d, Y', $blog->created_at) ?>
                                        </a>
                                    </li>
                                </ul>
                                <p class="text-justify">
                                    <?php echo mb_strimwidth($blog->short_description, 0, 120, " ..."); ?>
                                </p>
                                <a href="<?php echo $blog->getDetailUrl() ?>" class="read-more">read more</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-lg-12 pagination-wrap mt-4">
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pages,
                        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'disabled-a']
                    ]);
                    ?>
                </div>

            <?php } else { ?>
                <div class="col-lg-12 col-md-12">
                    <div class="blog-box">
                        <?php if ($searchInput != '') { ?>
                            <p class="text text-primary"> Oops!  No blog was found with such searched : &nbsp; <b><?php echo $searchInput ?></b>. </p>
                        <?php } else { ?>
                            <p class="text text-primary"> There is not any blog was added yet. </p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>