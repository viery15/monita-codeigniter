<?php
/**
 * Created by PhpStorm.
 * User: VIERY
 * Date: 2/14/2019
 * Time: 4:16 PM
 */
?>
<button data-backdrop="static" data-keyboard="false" style="display: none;" id="loading" type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#modal-loading">
    Medium
</button>

<div style="padding-top:15%;" class="modal fade" id="modal-loading" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Loading...</h4>
            </div>
            <div class="modal-body">
                <div class="progress mb-3">
                    <div class="progress-bar bg-primari progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>