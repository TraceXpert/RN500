<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="signin-form text-center">
    <h1>Sign in</h1>
    <p>Sign in on the RN500 platform</p>

    <form class="w-100">
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email address">
        </div>

        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password">
        </div>

        <div class="text-left">
            <div class="row">
                <div class="col-md-8">
                    <p class="otp-text">We have sent an OTP to your registered email. </p>
                </div>
                <div class="col-md-4">
                    <a href="" class="float-right">Resend OTP</a>
                </div>
            </div>
        </div>


        <div class="form-group otp mt-2">
            <input type="text" class="form-control">
            <input type="text" class="form-control">
            <input type="text" class="form-control">
            <input type="text" class="form-control">
            <input type="text" class="form-control">
            <input type="text" class="form-control">
        </div>

        <a href="forgotpassword.html" class="text-right d-block mb-3">Fogot Password?</a>

        <a href="" class="read-more contact-us d-block">Sign In</a>

        <p class="create-link mt-3 mb-3">New User? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/register"); ?>">Create an Account</a></p>
    </form>
</div>