<?php

//use Yii;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use common\CommonFunction;
use yii\helpers\Url;
use yii\web\JsExpression;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$assetDir = Yii::$app->assetManager->getPublishedUrl('@themes/rn500-theme');
?>
<section class="inner-banner browse-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Find Your Jobs</h1>
            </div>
        </div>
    </div>
</section>



<section class="about-us browse-search pb-5">
    <div class="container">

        <div class="row filter-block">
            <div class="col-xl-12 col-lg-12">
                <form class="d-flex">
                    <div class="col-md-4 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/search-icon.png" alt="search-icon"><input type="text"
                                                                                                     class="form-control br-1" id="joblist" placeholder="Search Open Jobs">
                        </div>
                    </div>
                    <div class="col-md-3 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/location-icon-dropdown.png" alt="location-icon-dropdown">
                            <select id="choose-city" class="form-control select2-hidden-accessible"
                                    data-select2-id="City Name" tabindex="-1" aria-hidden="true">
                                <option data-select2-id="2">City Name</option>
                                <option data-select2-id="5">Chandigarh</option>
                                <option data-select2-id="6">London</option>
                                <option data-select2-id="7">England</option>
                                <option data-select2-id="8">Pratapcity</option>
                                <option data-select2-id="9">Ukrain</option>
                                <option data-select2-id="10">Wilangana</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 p-0">
                        <div class="form-group">
                            <img src="<?= $assetDir ?>/img/location-icon-dropdown.png" alt="location-icon-dropdown">
                            <select id="choose-city" class="form-control select2-hidden-accessible border-right-0"
                                    data-select2-id="New York, USA" tabindex="-1" aria-hidden="true">
                                <option data-select2-id="2">New York, USA</option>
                                <option data-select2-id="5">Chandigarh</option>
                                <option data-select2-id="6">London</option>
                                <option data-select2-id="7">England</option>
                                <option data-select2-id="8">Pratapcity</option>
                                <option data-select2-id="9">Ukrain</option>
                                <option data-select2-id="10">Wilangana</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 p-0">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary full-width">Search Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<section class="most-popular-jobs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="filter-accordion">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                    Discipline
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <input type="checkbox" id="one" checked>
                                            <label for="one">RN</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="two" checked>
                                            <label for="two">Allied Health Professional</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Therapy</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">School Services</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">LPN / LVN</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Social Work</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">CNA</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Advance Practice</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">CMA</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                    Specialty
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <input type="checkbox" id="one" checked>
                                            <label for="one">Med Surg</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="two" checked>
                                            <label for="two">OR - Operating Room</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Med Surg / Telemetry</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">ICU - Intensive Care unit</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Medical Lab Tech</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Speech Language </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">Pathologist</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">ED - Emergency </label>
                                        </div>

                                        <div class="form-group">
                                            <input type="checkbox" id="three">
                                            <label for="three">DepartmentTelemetry</label>
                                        </div>

                                        <div class="view-more">View More</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                    Emergency
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                                    Shift
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                                    Benefits
                                </a>
                            </div>
                            <div id="collapseFive" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                                    Salary Range
                                </a>
                            </div>
                            <div id="collapseSix" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="job-details">
                    <div class="title-location">
                        <div class="row m-0 job-d">
                            <div class="col-md-6 p-0">
                                <p class="job-title mb-0">Med Surg / Telemetry</p>
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2">
                                    <div class="media-body">
                                        Mooreville, Canada
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-2 mt-sm-0">
                                <span class="badge badge-warning">Urgent</span>
                                <span class="badge badge-success">Permanent</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 job-d">
                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Shift :</p>
                                <p>Morning</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Estimated Pay</p>
                                <p>$51/Weekly</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Response Time:</p>
                                <p>within a day</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Posted by</p>
                                <p>Today</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Starting Date :</p>
                                <p>06-23-2021</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Benefits starts from</p>
                                <p>Day 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rating">

                        <div class="row m-0 job-d">
                            <div class="col-sm-6 p-0">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                    <div class="media-body">
                                        <p class="mb-0">Rattings</p>

                                        <div class="star-rating">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847ZM8.46109 13.175C8.81125 13.175 9.12249 13.251 9.43374 13.4029L11.9626 14.6938C12.2739 14.8457 12.6629 14.8457 12.9353 14.6178C13.2465 14.428 13.3632 14.0863 13.3243 13.7446L12.8575 10.9729C12.7407 10.2894 12.9742 9.64398 13.48 9.15039L15.542 7.17603C15.8143 6.91026 15.8921 6.56854 15.7754 6.22682C15.6587 5.88511 15.3864 5.6573 15.0362 5.61933L12.1961 5.20168C11.4958 5.08777 10.9122 4.67012 10.6009 4.06263L9.31703 1.55671C9.1614 1.25296 8.85015 1.06312 8.46109 1.06312C8.07203 1.06312 7.79969 1.25296 7.60516 1.55671L6.32126 4.06263C6.01001 4.67012 5.42642 5.08777 4.72611 5.20168L1.88598 5.61933C1.53583 5.6573 1.26349 5.88511 1.14677 6.22682C1.03005 6.56854 1.10785 6.91026 1.38019 7.17603L3.44222 9.15039C3.948 9.60601 4.18144 10.2894 4.06472 10.9729L3.59784 13.7446C3.52003 14.0863 3.67565 14.428 3.9869 14.6178C4.29815 14.8077 4.6483 14.8457 4.95955 14.6938L7.48844 13.4029C7.79969 13.251 8.14984 13.175 8.46109 13.175Z"
                                                fill="#2E2842"></path>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-0 text-right">
                                <a href="" class="read-more contact-us mb-0">View Profile</a>
                            </div>


                        </div>

                    </div>
                </div>


                <div class="job-details">
                    <div class="title-location">
                        <div class="row m-0 job-d">
                            <div class="col-md-6 p-0">
                                <p class="job-title mb-0">Med Surg / Telemetry</p>
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2">
                                    <div class="media-body">
                                        Mooreville, Canada
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-2 mt-sm-0">
                                <span class="badge badge-warning">Urgent</span>
                                <span class="badge badge-success">Permanent</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 job-d">
                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Shift :</p>
                                <p>Morning</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Estimated Pay</p>
                                <p>$51/Weekly</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Response Time:</p>
                                <p>within a day</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Posted by</p>
                                <p>Today</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Starting Date :</p>
                                <p>06-23-2021</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Benefits starts from</p>
                                <p>Day 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rating">

                        <div class="row m-0 job-d">
                            <div class="col-sm-6 p-0">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                    <div class="media-body">
                                        <p class="mb-0">Rattings</p>

                                        <div class="star-rating">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847ZM8.46109 13.175C8.81125 13.175 9.12249 13.251 9.43374 13.4029L11.9626 14.6938C12.2739 14.8457 12.6629 14.8457 12.9353 14.6178C13.2465 14.428 13.3632 14.0863 13.3243 13.7446L12.8575 10.9729C12.7407 10.2894 12.9742 9.64398 13.48 9.15039L15.542 7.17603C15.8143 6.91026 15.8921 6.56854 15.7754 6.22682C15.6587 5.88511 15.3864 5.6573 15.0362 5.61933L12.1961 5.20168C11.4958 5.08777 10.9122 4.67012 10.6009 4.06263L9.31703 1.55671C9.1614 1.25296 8.85015 1.06312 8.46109 1.06312C8.07203 1.06312 7.79969 1.25296 7.60516 1.55671L6.32126 4.06263C6.01001 4.67012 5.42642 5.08777 4.72611 5.20168L1.88598 5.61933C1.53583 5.6573 1.26349 5.88511 1.14677 6.22682C1.03005 6.56854 1.10785 6.91026 1.38019 7.17603L3.44222 9.15039C3.948 9.60601 4.18144 10.2894 4.06472 10.9729L3.59784 13.7446C3.52003 14.0863 3.67565 14.428 3.9869 14.6178C4.29815 14.8077 4.6483 14.8457 4.95955 14.6938L7.48844 13.4029C7.79969 13.251 8.14984 13.175 8.46109 13.175Z"
                                                fill="#2E2842"></path>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-0 text-right">
                                <a href="" class="read-more contact-us mb-0">View Profile</a>
                            </div>


                        </div>

                    </div>
                </div>


                <div class="job-details">
                    <div class="title-location">
                        <div class="row m-0 job-d">
                            <div class="col-md-6 p-0">
                                <p class="job-title mb-0">Med Surg / Telemetry</p>
                                <div class="media">
                                    <img src="img/location.png" alt="location" class="mr-2">
                                    <div class="media-body">
                                        Mooreville, Canada
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-2 mt-sm-0">
                                <span class="badge badge-warning">Urgent</span>
                                <span class="badge badge-success">Permanent</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 job-d">
                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Shift :</p>
                                <p>Morning</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Estimated Pay</p>
                                <p>$51/Weekly</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Response Time:</p>
                                <p>within a day</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Posted by</p>
                                <p>Today</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Starting Date :</p>
                                <p>06-23-2021</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Benefits starts from</p>
                                <p>Day 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rating">

                        <div class="row m-0 job-d">
                            <div class="col-sm-6 p-0">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                    <div class="media-body">
                                        <p class="mb-0">Rattings</p>

                                        <div class="star-rating">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847ZM8.46109 13.175C8.81125 13.175 9.12249 13.251 9.43374 13.4029L11.9626 14.6938C12.2739 14.8457 12.6629 14.8457 12.9353 14.6178C13.2465 14.428 13.3632 14.0863 13.3243 13.7446L12.8575 10.9729C12.7407 10.2894 12.9742 9.64398 13.48 9.15039L15.542 7.17603C15.8143 6.91026 15.8921 6.56854 15.7754 6.22682C15.6587 5.88511 15.3864 5.6573 15.0362 5.61933L12.1961 5.20168C11.4958 5.08777 10.9122 4.67012 10.6009 4.06263L9.31703 1.55671C9.1614 1.25296 8.85015 1.06312 8.46109 1.06312C8.07203 1.06312 7.79969 1.25296 7.60516 1.55671L6.32126 4.06263C6.01001 4.67012 5.42642 5.08777 4.72611 5.20168L1.88598 5.61933C1.53583 5.6573 1.26349 5.88511 1.14677 6.22682C1.03005 6.56854 1.10785 6.91026 1.38019 7.17603L3.44222 9.15039C3.948 9.60601 4.18144 10.2894 4.06472 10.9729L3.59784 13.7446C3.52003 14.0863 3.67565 14.428 3.9869 14.6178C4.29815 14.8077 4.6483 14.8457 4.95955 14.6938L7.48844 13.4029C7.79969 13.251 8.14984 13.175 8.46109 13.175Z"
                                                fill="#2E2842"></path>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-0 text-right">
                                <a href="" class="read-more contact-us mb-0">View Profile</a>
                            </div>


                        </div>

                    </div>

                </div>


                <div class="job-details">
                    <div class="title-location">
                        <div class="row m-0 job-d">
                            <div class="col-md-6 p-0">
                                <p class="job-title mb-0">Med Surg / Telemetry</p>
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2">
                                    <div class="media-body">
                                        Mooreville, Canada
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-2 mt-sm-0">
                                <span class="badge badge-warning">Urgent</span>
                                <span class="badge badge-success">Permanent</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 job-d">
                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Shift :</p>
                                <p>Morning</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Estimated Pay</p>
                                <p>$51/Weekly</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Response Time:</p>
                                <p>within a day</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Posted by</p>
                                <p>Today</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Starting Date :</p>
                                <p>06-23-2021</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Benefits starts from</p>
                                <p>Day 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rating">

                        <div class="row m-0 job-d">
                            <div class="col-sm-6 p-0">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                    <div class="media-body">
                                        <p class="mb-0">Rattings</p>

                                        <div class="star-rating">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847ZM8.46109 13.175C8.81125 13.175 9.12249 13.251 9.43374 13.4029L11.9626 14.6938C12.2739 14.8457 12.6629 14.8457 12.9353 14.6178C13.2465 14.428 13.3632 14.0863 13.3243 13.7446L12.8575 10.9729C12.7407 10.2894 12.9742 9.64398 13.48 9.15039L15.542 7.17603C15.8143 6.91026 15.8921 6.56854 15.7754 6.22682C15.6587 5.88511 15.3864 5.6573 15.0362 5.61933L12.1961 5.20168C11.4958 5.08777 10.9122 4.67012 10.6009 4.06263L9.31703 1.55671C9.1614 1.25296 8.85015 1.06312 8.46109 1.06312C8.07203 1.06312 7.79969 1.25296 7.60516 1.55671L6.32126 4.06263C6.01001 4.67012 5.42642 5.08777 4.72611 5.20168L1.88598 5.61933C1.53583 5.6573 1.26349 5.88511 1.14677 6.22682C1.03005 6.56854 1.10785 6.91026 1.38019 7.17603L3.44222 9.15039C3.948 9.60601 4.18144 10.2894 4.06472 10.9729L3.59784 13.7446C3.52003 14.0863 3.67565 14.428 3.9869 14.6178C4.29815 14.8077 4.6483 14.8457 4.95955 14.6938L7.48844 13.4029C7.79969 13.251 8.14984 13.175 8.46109 13.175Z"
                                                fill="#2E2842"></path>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-0 text-right">
                                <a href="" class="read-more contact-us mb-0">View Profile</a>
                            </div>


                        </div>

                    </div>
                </div>


                <div class="job-details">
                    <div class="title-location">
                        <div class="row m-0 job-d">
                            <div class="col-md-6 p-0">
                                <p class="job-title mb-0">Med Surg / Telemetry</p>
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2">
                                    <div class="media-body">
                                        Mooreville, Canada
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-2 mt-sm-0">
                                <span class="badge badge-warning">Urgent</span>
                                <span class="badge badge-success">Permanent</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 job-d">
                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Shift :</p>
                                <p>Morning</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Estimated Pay</p>
                                <p>$51/Weekly</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Response Time:</p>
                                <p>within a day</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Posted by</p>
                                <p>Today</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Starting Date :</p>
                                <p>06-23-2021</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Benefits starts from</p>
                                <p>Day 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rating">

                        <div class="row m-0 job-d">
                            <div class="col-sm-6 p-0">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                    <div class="media-body">
                                        <p class="mb-0">Rattings</p>

                                        <div class="star-rating">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847ZM8.46109 13.175C8.81125 13.175 9.12249 13.251 9.43374 13.4029L11.9626 14.6938C12.2739 14.8457 12.6629 14.8457 12.9353 14.6178C13.2465 14.428 13.3632 14.0863 13.3243 13.7446L12.8575 10.9729C12.7407 10.2894 12.9742 9.64398 13.48 9.15039L15.542 7.17603C15.8143 6.91026 15.8921 6.56854 15.7754 6.22682C15.6587 5.88511 15.3864 5.6573 15.0362 5.61933L12.1961 5.20168C11.4958 5.08777 10.9122 4.67012 10.6009 4.06263L9.31703 1.55671C9.1614 1.25296 8.85015 1.06312 8.46109 1.06312C8.07203 1.06312 7.79969 1.25296 7.60516 1.55671L6.32126 4.06263C6.01001 4.67012 5.42642 5.08777 4.72611 5.20168L1.88598 5.61933C1.53583 5.6573 1.26349 5.88511 1.14677 6.22682C1.03005 6.56854 1.10785 6.91026 1.38019 7.17603L3.44222 9.15039C3.948 9.60601 4.18144 10.2894 4.06472 10.9729L3.59784 13.7446C3.52003 14.0863 3.67565 14.428 3.9869 14.6178C4.29815 14.8077 4.6483 14.8457 4.95955 14.6938L7.48844 13.4029C7.79969 13.251 8.14984 13.175 8.46109 13.175Z"
                                                fill="#2E2842"></path>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-0 text-right">
                                <a href="" class="read-more contact-us mb-0">View Profile</a>
                            </div>


                        </div>

                    </div>
                </div>


                <div class="job-details">
                    <div class="title-location">
                        <div class="row m-0 job-d">
                            <div class="col-md-6 p-0">
                                <p class="job-title mb-0">Med Surg / Telemetry</p>
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2">
                                    <div class="media-body">
                                        Mooreville, Canada
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-2 mt-sm-0">
                                <span class="badge badge-warning">Urgent</span>
                                <span class="badge badge-success">Permanent</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 job-d">
                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Shift :</p>
                                <p>Morning</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Estimated Pay</p>
                                <p>$51/Weekly</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Response Time:</p>
                                <p>within a day</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Posted by</p>
                                <p>Today</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Starting Date :</p>
                                <p>06-23-2021</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Benefits starts from</p>
                                <p>Day 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rating">

                        <div class="row m-0 job-d">
                            <div class="col-sm-6 p-0">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                    <div class="media-body">
                                        <p class="mb-0">Rattings</p>

                                        <div class="star-rating">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847ZM8.46109 13.175C8.81125 13.175 9.12249 13.251 9.43374 13.4029L11.9626 14.6938C12.2739 14.8457 12.6629 14.8457 12.9353 14.6178C13.2465 14.428 13.3632 14.0863 13.3243 13.7446L12.8575 10.9729C12.7407 10.2894 12.9742 9.64398 13.48 9.15039L15.542 7.17603C15.8143 6.91026 15.8921 6.56854 15.7754 6.22682C15.6587 5.88511 15.3864 5.6573 15.0362 5.61933L12.1961 5.20168C11.4958 5.08777 10.9122 4.67012 10.6009 4.06263L9.31703 1.55671C9.1614 1.25296 8.85015 1.06312 8.46109 1.06312C8.07203 1.06312 7.79969 1.25296 7.60516 1.55671L6.32126 4.06263C6.01001 4.67012 5.42642 5.08777 4.72611 5.20168L1.88598 5.61933C1.53583 5.6573 1.26349 5.88511 1.14677 6.22682C1.03005 6.56854 1.10785 6.91026 1.38019 7.17603L3.44222 9.15039C3.948 9.60601 4.18144 10.2894 4.06472 10.9729L3.59784 13.7446C3.52003 14.0863 3.67565 14.428 3.9869 14.6178C4.29815 14.8077 4.6483 14.8457 4.95955 14.6938L7.48844 13.4029C7.79969 13.251 8.14984 13.175 8.46109 13.175Z"
                                                fill="#2E2842"></path>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-0 text-right">
                                <a href="" class="read-more contact-us mb-0">View Profile</a>
                            </div>


                        </div>

                    </div>

                </div>


                <div class="job-details">
                    <div class="title-location">
                        <div class="row m-0 job-d">
                            <div class="col-md-6 p-0">
                                <p class="job-title mb-0">Med Surg / Telemetry</p>
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/location.png" alt="location" class="mr-2">
                                    <div class="media-body">
                                        Mooreville, Canada
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-2 mt-sm-0">
                                <span class="badge badge-warning">Urgent</span>
                                <span class="badge badge-success">Permanent</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 job-d">
                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Shift :</p>
                                <p>Morning</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Estimated Pay</p>
                                <p>$51/Weekly</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Response Time:</p>
                                <p>within a day</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Posted by</p>
                                <p>Today</p>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div>
                                <p class="mb-0 small-text">Starting Date :</p>
                                <p>06-23-2021</p>
                            </div>
                            <div>
                                <p class="mb-0 small-text">Benefits starts from</p>
                                <p>Day 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="rating">

                        <div class="row m-0 job-d">
                            <div class="col-sm-6 p-0">
                                <div class="media">
                                    <img src="<?= $assetDir ?>/img/job-icon.png" alt="job-icon" class="mr-2">
                                    <div class="media-body">
                                        <p class="mb-0">Rattings</p>

                                        <div class="star-rating">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847Z"
                                                fill="#F6A123"></path>
                                            </svg>

                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.4295 15.9847C12.0794 15.9847 11.7681 15.9088 11.4569 15.7569L8.92797 14.466C8.65563 14.3141 8.34437 14.3141 8.07203 14.466L5.54314 15.7569C4.84283 16.1366 3.9869 16.0606 3.3255 15.605C2.66409 15.1494 2.35285 14.39 2.50848 13.5927L2.97534 10.821C3.01425 10.5173 2.93644 10.2135 2.70301 10.0237L0.640983 8.04931C0.0573929 7.51775 -0.137135 6.68245 0.0963013 5.96105C0.329737 5.20168 0.991137 4.67012 1.80816 4.55621L4.64831 4.13856C4.95956 4.10059 5.23189 3.91075 5.34861 3.64497L6.6325 1.13905C6.98266 0.417653 7.72188 0 8.5 0C9.31703 0 10.0173 0.455621 10.3675 1.13905L11.6514 3.64497C11.7681 3.91075 12.0404 4.10059 12.3517 4.13856L15.1918 4.55621C15.9699 4.67012 16.6314 5.20168 16.9037 5.96105C17.1371 6.72042 16.9426 7.51775 16.359 8.04931L14.297 10.0237C14.0636 10.2515 13.9857 10.5173 14.0246 10.821L14.4915 13.5927C14.6082 14.3521 14.297 15.1494 13.6745 15.605C13.2854 15.8328 12.8575 15.9847 12.4295 15.9847ZM8.46109 13.175C8.81125 13.175 9.12249 13.251 9.43374 13.4029L11.9626 14.6938C12.2739 14.8457 12.6629 14.8457 12.9353 14.6178C13.2465 14.428 13.3632 14.0863 13.3243 13.7446L12.8575 10.9729C12.7407 10.2894 12.9742 9.64398 13.48 9.15039L15.542 7.17603C15.8143 6.91026 15.8921 6.56854 15.7754 6.22682C15.6587 5.88511 15.3864 5.6573 15.0362 5.61933L12.1961 5.20168C11.4958 5.08777 10.9122 4.67012 10.6009 4.06263L9.31703 1.55671C9.1614 1.25296 8.85015 1.06312 8.46109 1.06312C8.07203 1.06312 7.79969 1.25296 7.60516 1.55671L6.32126 4.06263C6.01001 4.67012 5.42642 5.08777 4.72611 5.20168L1.88598 5.61933C1.53583 5.6573 1.26349 5.88511 1.14677 6.22682C1.03005 6.56854 1.10785 6.91026 1.38019 7.17603L3.44222 9.15039C3.948 9.60601 4.18144 10.2894 4.06472 10.9729L3.59784 13.7446C3.52003 14.0863 3.67565 14.428 3.9869 14.6178C4.29815 14.8077 4.6483 14.8457 4.95955 14.6938L7.48844 13.4029C7.79969 13.251 8.14984 13.175 8.46109 13.175Z"
                                                fill="#2E2842"></path>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p-0 text-right">
                                <a href="" class="read-more contact-us mb-0">View Profile</a>
                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>