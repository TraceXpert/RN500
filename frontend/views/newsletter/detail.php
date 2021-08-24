<?php

use yii\widgets\LinkPager;

$searchInput = trim(Yii::$app->request->get('search'));
?>
<section class="inner-banner browse-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Newsletter</h1>
            </div>
        </div>
    </div>
</section>

<section class="contact-form">
    <div class="container">
        <div class="row blog-page blog-detail">
            <div class="col-lg-8">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- blog image -->
                            <div class="blog-img">
                                <img src="<?php echo $model->getCoverImageUrl() ?>" alt="Newsletter">
                                    <div class="option">
                                        <p> <?php echo date('d', $model->created_at) ?> <br> <?php echo date('M', $model->created_at) ?></p>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            By : 

                            <?php echo $model->getCreatedByName(); ?>  

                            <a href="mailto:<?php echo $model->getCreatedByEmail(); ?>">  (<?php echo $model->getCreatedByEmail(); ?> ) </a>


                            <!-- title -->
                            <h5> <?php echo $model->title; ?> </h5>

                            <!-- paragraph -->
                            <p><?php echo $model->short_description; ?></p>


                            <?php echo $model->description; ?>

                            <!-- share blog -->
                            <div class="share-blog d-flex justify-content-between">
                                <div class="left-part d-flex align-items-center">
                                    <span>share : </span>
                                    <div class="media-body">
                                        <ul class="list-inline social d-flex mb-0">
                                            <li>
                                                <a onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode($model->getCoverImageUrl()); ?>&amp;&t=<?php echo $model->title ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a onClick="window.open('https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($model->getCoverImageUrl()); ?>&text=<?php echo $model->title; ?>');" target="_parent" href="javascript: void(0)">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" class="svg-inline--fa fa-linkedin-in fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a onClick="window.open('https://twitter.com/share?hashtags=job,sharing&text=<?= $model->title ?>&url=<?= $model->getCoverImageUrl(); ?>');" target="_parent" href="javascript: void(0)">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" class="svg-inline--fa fa-twitter fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="blog-sidebar">

                    <div class="popular">
                        <div class="title">

                            <h5>Popular Newsletter</h5>
                        </div>

                        <ul class="small-item list-unstyled">
                            <?php foreach ($popularNewsletter as $news) { ?>

                                <li class="item d-flex align-items-center">
                                    <div class="image">
                                        <a href="<?php echo $news->getDetailUrl(); ?>">
                                            <img src="<?php echo $news->getCoverImageUrl(); ?>" alt="popular Blog Civer Image" width="90px" height="90px">
                                        </a>
                                    </div>
                                    <div class="item-body">
                                        <a href="<?php echo $news->getDetailUrl(); ?>">
                                            <h6><?php echo $news->title; ?></h6>
                                        </a>
                                        <p><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="calendar-alt" class="svg-inline--fa fa-calendar-alt fa-w-14 mr-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M148 288h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm108-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 96v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96-260v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48zm-48 346V160H48v298c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"></path></svg><?php echo date('M d, Y', $news->created_at) ?></p>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="title">
                        <h5>Tag</h5>
                    </div>

                    <div class="all-tag">
                        <!--                        <a href="#!">marketing</a>
                                                <a href="#!">design</a>
                                                <a href="#!">mobile</a>
                                                <a href="#!">IOS</a>
                                                <a href="#!">developemnt</a>
                                                <a href="#!">social</a>
                                                <a href="#!">android</a>
                                                <a href="#!">application</a>-->
                        <?php foreach ($model->getTagsList() as $tag) { ?>
                            <a href="javascript:void(0)"><?php echo $tag; ?></a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
