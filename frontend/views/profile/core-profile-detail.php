<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<style>
    .detail-view th{
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <table id="user-summary-basic" class="table table-bordered detail-view">
            <tbody>
                <tr><th style="width: 50%">Name </th><td> <?php echo $model->first_name . ' ' . $model->last_name ?> </td></tr>
                <tr><th>Email </th><td> <?php echo (isset($model->user->email) && $model->user->email != '') ? $model->user->email : '' ?> </td></tr>
                <tr><th> <?php echo $model->getAttributeLabel('mobile_no') ?> </th><td> <?php echo (isset($model->mobile_no) && $model->mobile_no != '') ? $model->mobile_no : '' ?> </td></tr>
                <tr><th>looking For </th><td> <?php echo (isset($model->looking_for) && $model->looking_for != '') ? $model->looking_for : '' ?> </td></tr>
                <tr><th> <?php echo $model->getAttributeLabel('ssn') ?> </th><td> <?php echo (isset($model->ssn) && $model->ssn != '') ? $model->ssn : '' ?> </td></tr>
                <tr><th> <?php echo $model->getAttributeLabel('dob') ?> </th><td> <?php echo (isset($model->dob) && $model->dob != '') ? date('d-M-Y', strtotime($model->dob)) : '' ?> </td></tr>

            </tbody>
        </table>


        <br/><br/>


        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" data-toggle="tab" id="nav-tab-doc"   role="tab" aria-controls="nav-profile" aria-selected="false" href="#tab-documents">Resume</a>
                <a class="nav-item nav-link" data-toggle="tab" id="nav-tab-lic"  role="tab" aria-controls="nav-profile" aria-selected="false" href="#tab-licenses">Licenses</a>
                <a class="nav-item nav-link" data-toggle="tab" id="nav-tab-cer"  role="tab" aria-controls="nav-profile" aria-selected="false" href="#tab-certifications">Certifications</a>
                <a class="nav-item nav-link" data-toggle="tab"   id="nav-tab-we"  role="tab" aria-controls="nav-home" aria-selected="true" href="#tab-work-experience">Work Experience</a>
                <a class="nav-item nav-link" data-toggle="tab"  id="nav-tab-edu"  role="tab" aria-controls="nav-profile" aria-selected="false" href="#tab-education">Education</a>
                <a class="nav-item nav-link" data-toggle="tab" id="nav-tab-ref"  role="tab" aria-controls="nav-profile" aria-selected="false" href="#tab-references">References</a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade  show active" id="tab-documents" role="tabpanel">
                <div class="table-design table-responsive">
                    <?php if (!empty($documents)) { ?>
                        <table id="table-work-experience" class="table table-bordered detail-view">
                            <tr>
                                <th>Name </th>
                                <th>Particulars </th>
                            </tr>
                            <tbody>
                                <?php foreach ($documents as $model) { ?>
                                    <tr>
                                        <td> <?php echo $model->getDecumentTypeName() ?> </td>
                                        <td>  <?php
                                            if ($model->getDocumentUrl()) {
                                                echo Html::a($model->getDocumentUrl(), $model->getDocumentUrl(), ['target' => '_blank', 'download' => true]);
                                            }
                                            ?> 
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="alert alert-warning">No record found.</p>
                    <?php } ?>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-licenses" role="tabpanel">
                <div class="table-design table-responsive">
                    <?php if (!empty($licenses)) { ?>
                        <table id="table-work-experience" class="table table-bordered detail-view">
                            <tr>
                                <th>License Name </th>
                                <th>License Number </th>
                                <th>Expiry Date </th>
                                <th>Issuing State </th>
                                <th>Issue By </th>
                            </tr>
                            <tbody>
                                <?php foreach ($licenses as $model) { ?>
                                    <tr>
                                        <td> <?php echo (isset(Yii::$app->params['LICENSE_TYPE'][$model->license_name])) ? Yii::$app->params['LICENSE_TYPE'][$model->license_name] : '' ?> </td>
                                        <td> <?php echo (isset($model->license_number) && $model->license_number != '' ) ? $model->license_number : ''; ?> </td>
                                        <td> <?php echo (isset($model->expiry_date) && $model->expiry_date != '' && !in_array($model->expiry_date, ['1970-01-01', '0000-00-00'])) ? date('M-Y', strtotime($model->expiry_date)) : ''; ?> </td>
                                        <td> <?php echo $model->getCityStateName(); ?> </td>
                                        <td> <?php echo (isset($model->issue_by) && $model->issue_by != '' ) ? $model->issue_by : ''; ?> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="alert alert-warning">No record found.</p>
                    <?php } ?>
                </div>
            </div>


            <div class="tab-pane fade" id="tab-certifications" role="tabpanel">

                <div class="table-design table-responsive">
                    <?php if (!empty($certifications)) { ?>
                        <table id="table-work-experience" class="table table-bordered detail-view">
                            <tr>
                                <th>Certificate Name </th>
                                <th>Expiry Date </th>
                                <th>Issuing State </th>
                                <th>Issue By </th>
                            </tr>
                            <tbody>
                                <?php foreach ($certifications as $model) { ?>
                                    <tr>
                                        <td> <?php echo (isset(Yii::$app->params['CERTIFICATION_TYPE'][$model->certificate_name])) ? Yii::$app->params['LICENSE_TYPE'][$model->certificate_name] : '' ?> </td>
                                        <td> <?php echo (isset($model->expiry_date) && $model->expiry_date != '' && !in_array($model->expiry_date, ['1970-01-01', '0000-00-00'])) ? date('M-Y', strtotime($model->expiry_date)) : ''; ?> </td>
                                        <td> <?php echo $model->getCityStateName(); ?> </td>
                                        <td> <?php echo (isset($model->issue_by) && $model->issue_by != '' ) ? $model->issue_by : ''; ?> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="alert alert-warning">No record found.</p>
                    <?php } ?>
                </div>
            </div>


            <div class="tab-pane fade" id="tab-work-experience" role="tabpanel" >
                <div class="table-design table-responsive">
                    <?php if (!empty($workExperiences)) { ?>
                        <table id="table-work-experience" class="table table-bordered detail-view">
                            <tr>
                                <th>Title </th>
                                <th>Start Date </th>
                                <th>End Date </th>
                                <th>Organization Name </th>
                                <th>City </th>
                            </tr>
                            <tbody>

                                <?php foreach ($workExperiences as $model) { ?>

                                    <tr>
                                        <td> <?php echo (isset($model->title) && $model->title != '') ? $model->title : ''; ?> </td>
                                        <td> <?php echo (isset($model->start_date) && $model->start_date != '' && !in_array($model->start_date, ['1970-01-01', '0000-00-00'])) ? date('d-M-Y', strtotime($model->start_date)) : ''; ?> </td>
                                        <td> <?php echo (isset($model->end_date) && $model->end_date != '' && !in_array($model->end_date, ['1970-01-01', '0000-00-00'])) ? date('d-M-Y', strtotime($model->end_date)) : ''; ?> </td>
                                        <td> <?php echo (isset($model->organization_name) && $model->organization_name != '') ? $model->organization_name : ''; ?> </td>
                                        <td> <?php echo $model->getCityStateName(); ?> </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="alert alert-warning">No record found.</p>
                    <?php } ?>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-education" role="tabpanel">
                <div class="table-design table-responsive">
                    <?php if (!empty($educations)) { ?>
                        <table id="table-work-experience" class="table table-bordered detail-view">
                            <tr>
                                <th>Degree Name </th>
                                <th>Year Complete </th>
                                <th>Institution </th>
                                <th>Location </th>
                            </tr>
                            <tbody>
                                <?php foreach ($educations as $model) { ?>
                                    <tr>
                                        <td> <?php echo $model->getDegreeTypeName(); ?> </td>
                                        <td> <?php echo (isset($model->year_complete) && $model->year_complete != '' && !in_array($model->year_complete, ['1970-01-01', '0000-00-00'])) ? date('M-Y', strtotime($model->year_complete)) : ''; ?> </td>
                                        <td> <?php echo (isset($model->institution) && $model->institution != '' ) ? $model->institution : ''; ?> </td>

                                        <td> <?php echo $model->getCityStateName(); ?> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="alert alert-warning">No record found.</p>
                    <?php } ?>
                </div>
            </div>


            <div class="tab-pane fade" id="tab-references" role="tabpanel">
                <div class="table-design table-responsive">
                    <?php if (!empty($references)) { ?>
                        <table id="table-work-experience" class="table table-bordered detail-view">
                            <tr>
                                <th>Name </th>
                                <th>Title</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                            </tr>
                            <tbody>
                                <?php foreach ($references as $model) { ?>
                                    <tr>
                                        <td> <?php echo $model->getName(); ?> </td>
                                        <td> <?php echo $model->getTitleName(); ?> </td>
                                        <td> <?php echo (isset($model->mobile_no) && $model->mobile_no != '' ) ? $model->mobile_no : ''; ?> </td>
                                        <td> <?php echo (isset($model->email) && $model->email != '' ) ? $model->email : ''; ?> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="alert alert-warning">No record found.</p>
                    <?php } ?>
                </div>
            </div>
        </div>


    </div>
</div>