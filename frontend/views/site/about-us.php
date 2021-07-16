<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
?>

<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>About Us</h1>
            </div>
        </div>

    </div>
</section>

<section class="about-us about-inner-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 main-title">
                <h2 class="mb-4">About Us</h2>

                <p class="text-justify">
                    RN500 is founded by the people who believed they could change the travel nursing industry for
                    better than before with huge revolutionary technology options. This vision, along with culture
                    of honesty, transparency and great customer services, continues to guide our growth. Simplify
                    the Process: Use your unique skill to make the complex easy. Own Your Relationships: Engage with
                    others clarity, transparency and care. Obsess Over the Experience: Distinguish yourself by
                    providing the best possible experience every time.
                </p>

                <p class="text-justify">
                    Defend Our Culture: Embrace and encourage the principles that define our company. RN500 is one
                    of the leading fastest growing healthcare staffing company. We are inviting you to apply for
                    open positions throughout the United States of America. We make difference your path of success
                    with using our talented, dedicated employees who take care of everything needed from searching
                    of new jobs to closing positions and follow with directional services which every candidate
                    required to settle down in new place. The dedication, honesty and personal service we provide to
                    each of our open positions and client facilities solidifies our commitment to be the best at
                    what we do. Please go through the RN500 Benefits page to review our strategies, plans for each
                    open positions connected with in benefits of every applicant. Equal Employment Opportunity
                    Policy Statement RN500 is an Equal Opportunity Employer and prohibits discrimination and
                    harassment of any kind.
                </p>

            </div>

            <div class="col-lg-6">
                <img src="<?= $assetDir ?>/img/about-us-inner.png" alt="about-us-inner" class="img-fluid mx-auto d-block mt-4">
            </div>
        </div>



        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="<?= $assetDir ?>/img/about-us-inner-1.png" alt="about-us-inner" class="img-fluid mx-auto d-block mt-4">
            </div>

            <div class="col-lg-6">
                <p class="text-justify">
                    RN500 is committed to the principal of equal opportunity for all employees and to providing
                    employees with work environment free of discrimination and harassment. It is RN500 policy to
                    provide
                    equal employment opportunities without regard to race, color, religion, or belief, national,
                    social,
                    or ethnic origin, sex (including pregnancy), age, physical, mental or sensory disability, HIV
                    status, sexual orientation, gender identity and/or expression, marital, civil union or domestic
                    partnership status, past or present military services, family medical history or genetic
                    information, family or parental status, or any other status protected by applicable laws. RN500
                    will
                    not tolerate discrimination or harassment on any of these characteristics. All employment
                    decisions
                    are based on business needs, job requirements and individual qualifications.
                </p>

                <p class="highlight">If you have any questions, contact us on: <a href="mailto:info@RN500.com">info@RN500.com</a></p>
            </div>
        </div>


    </div>
</section>

<section class="cta">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 main-title">
                <h2 class="mb-0">
                    Let’s build something <br>new with RN500
                </h2>
            </div>

            <div class="col-md-6 text-right">
                <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/contact-us']) ?>" class="read-more contact-us mr-3">Contact Us</a>
                <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/index']) ?>" class="read-more find-job">Find Job
                    <svg class="ml-2" width="14" height="14" viewBox="0 0 14 14" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.9375 1.09375C5.625 1.40625 5.65625 1.875 5.9375 2.1875L9.71875 5.75H0.75C0.3125 5.75 0 6.09375 0 6.5V7.5C0 7.9375 0.3125 8.25 0.75 8.25H9.71875L5.9375 11.8438C5.65625 12.1562 5.65625 12.625 5.9375 12.9375L6.625 13.625C6.9375 13.9062 7.40625 13.9062 7.6875 13.625L13.7812 7.53125C14.0625 7.25 14.0625 6.78125 13.7812 6.46875L7.6875 0.40625C7.40625 0.125 6.9375 0.125 6.625 0.40625L5.9375 1.09375Z"
                        fill="white" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
