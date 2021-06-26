<?php

use yii\helpers\Html;
?>
<thead>
    <tr>
        <th> Sr. No </th>
        <th> Job Seeker Name </th>
        <th> Job Seeker Email </th>
        <th> Lead </th>
        <th> Joining Date </th>
        <th> Recruiter </th>
    </tr>
</thead>
<tbody>
    <?php foreach ($data as $sr => $model) { ?>
        <tr>
            <td> <?php echo ++$sr ?></td>
            <td> <?php echo isset($model['job_seeker_name']) ? $model['job_seeker_name'] : '' ?></td>
            <td> <?php echo isset($model['job_seeker_email']) ? $model['job_seeker_email'] : '' ?></td>
            <td> <?php echo isset($model['lead_title']) ? Html::a($model['lead_title'], Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/view', 'id' => $model['lead_reference_no']]), ['target' => '_blank']) : '' ?></td>
            <td> <?php echo isset($model['joining_date']) ? $model['joining_date'] : '' ?></td>
            <td> <?php echo isset($model['recruiter']) ? $model['recruiter'] : '' ?></td>
        </tr>
    <?php } ?>
</tbody>

