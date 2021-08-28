<section class="inner-banner browse-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Subscription Plan</h1>
            </div>
        </div>
    </div>
</section>



<section class="about-us about-inner-block contact-form">
    <div class="container">
        <div class="row">
            <?php foreach ($model as $value) { ?>
                <div class="col-lg-4 col-md-6"> 
                    <div class="subscription-plan main-title text-center">
                        <h2 class="mb-4 pb-4"><?= $value->title ?></h2>

                        <div class="plan_price mb-4">
                            <sup class="plan_currency_s">$</sup>
                            <p><?= $value->price ?></p>
                            <sub class="plan_period">/mo</sup>
                        </div>

                        <p class="text-justify">
                            <?= $value->description ?>
                        </p>
                        
                        <div class="post-job mt-4">
                            <a href="view-profile.html" class="read-more contact-us mb-0">Read More</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
