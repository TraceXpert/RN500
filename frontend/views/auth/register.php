<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="signin-form signup">
    <h1>Sign Up</h1>
    <p>Sign in on the RN500 platform</p>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Jobseeker</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Employee</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">Recruiter</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <div class="row jobseeker">
                <form class="w-100">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last Name">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email ID">
                    </div>

                    <div class="text-center">
                        <a href="" class="read-more contact-us d-block">Sign Up</a>

                        <p class="create-link mt-3 mb-3">Already a Member? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>">Login Here</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div id="menu1" class="container tab-pane fade employee mb-5 pb-5"><br>
            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Details</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email ID">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Mobile Number">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               placeholder="Employer Identification Number">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Website Link">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Street No.">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Street Address">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <select class="form-control" id="sel1">
                            <option>Suit/Apt</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <select class="form-control" id="sel2">
                            <option>Select a Province</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Select City">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ZIP Code">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Owner Details</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last Name">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Id">
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-lg-8 offset-lg-2 pl-3 pl-lg-0">
                    <div class="text-center">
                        <a href="" class="read-more contact-us d-block">Sign Up</a>

                        <p class="create-link mt-3 mb-3">Already a Member? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>">Login Here</a>
                        </p>
                    </div>
                </div>
            </div>


        </div>
        <div id="menu2" class="container tab-pane fade mb-5 pb-5"><br>
            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Details</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email ID">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Mobile Number">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               placeholder="Employer Identification Number">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Website Link">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Street No.">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Street Address">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <select class="form-control" id="sel1">
                            <option>Suit/Apt</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <select class="form-control" id="sel2">
                            <option>Select a Province</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Select City">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ZIP Code">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Owner Details</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name">
                    </div>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last Name">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Id">
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-lg-8 offset-lg-2 pl-3 pl-lg-0">
                    <div class="text-center">
                        <a href="" class="read-more contact-us d-block">Sign Up</a>

                        <p class="create-link mt-3 mb-3">Already a Member? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>">Login Here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>