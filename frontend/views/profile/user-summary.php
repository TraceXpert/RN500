<?php

use yii\helpers\Html;
?>
<!-- Page Title start -->
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Job Seeker Summary</h1>
            </div>
        </div>

    </div>
</section>
<!-- Page Title End -->

<div class="well-lg"></div>
<section class="about-us about-inner-block leads-tab">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?= $this->render('core-profile-detail', ['model' => $model, 'workExperiences' => $workExperiences, 'certifications' => $certifications, 'documents' => $documents, 'licenses' => $licenses, 'educations' => $educations, 'references' => $references]); ?>
            </div>
        </div>
    </div>
</section>