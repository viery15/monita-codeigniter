<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/26/2019
 * Time: 3:59 PM
 */
?>
<div class="row">
    <div class="col-md-6">
        <div class="au-card recent-report" style=" padding-top: 1%;padding-bottom: 9%;margin-bottom: 20px">
            <div class="au-card-inner">
                From :<b> <?= $task->user_from ?> </b>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="au-card recent-report" style=" padding-top: 1%;padding-bottom: 9%;margin-bottom: 20px">
            <div class="au-card-inner">
                To : <b> <?= $task->user_to ?> </b>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="au-card recent-report" style=" padding-top: 1%;padding-bottom: 9%;margin-bottom: 20px">
            <div class="au-card-inner">
                Title : <?= ucfirst($task->remark) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="au-card recent-report" style=" padding-top: 1%;padding-bottom: 9%;margin-bottom: 20px">
            <div class="au-card-inner">
                Status : <?= ucfirst($task->status) ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="au-card recent-report" style="padding-top: 2%;margin-bottom: 3%">
            <div class="au-card-inner">
                Description :<br>
                <?= ucfirst($task->description) ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="au-card recent-report" style=" padding-top: 1%;padding-bottom: 9%;margin-bottom: 20px">
            <div class="au-card-inner">
                Date From : <?= date('d M Y',strtotime($task->date_from)) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="au-card recent-report" style=" padding-top: 1%;padding-bottom: 9%;margin-bottom: 20px">
            <div class="au-card-inner">
                Date To : <?= date('d M Y',strtotime($task->date_to)) ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="au-card recent-report" style=" padding-top: 1%;padding-bottom: 9%;margin-bottom: 20px">
            <div class="au-card-inner">
                Last Update : <?= date('d M Y H:i:s',strtotime($task->updated_at)) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <button id="<?= $task->id ?>" type="button" class="manage btn btn-primary" style="width: 49%"><i class="fa fa-cogs"></i> Manage</button>
        <button type="button" class="btn btn-danger" style="width: 49%"><i class="fa fa-close"></i> Close</button>
    </div>
</div>
