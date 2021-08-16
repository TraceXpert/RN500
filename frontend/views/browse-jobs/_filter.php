<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$shift_prams = isset($_GET['shift']) ? $_GET['shift'] : [];
?>
<div class="filter-accordion">
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                    Emergency
                </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
                <div class="card-body" id="emergency">
                    <form method="GET">
                        <div id="options"></div>
                        <div class='view-more'></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    Discipline
                </a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion">
                <div class="card-body" id="discipline">
                    <form method="GET">
                        <div id="options"></div>
                        <div class='view-more'></div>
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
                <div class="card-body" id="speciality">
                    <form method="GET">
                        <div id="options"></div>
                        <div class='view-more'></div>
                    </form>
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
                <div class="card-body" id="benefit">
                    <form>
                        <div id="options"></div>
                        <div class='view-more'></div>
                    </form>
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
                <div class="card-body" id="shift">
                    <form>
                        <div id="options">
                            <?php if (in_array(1, $shift_prams)) { ?>
                                <div class="form-group"><input type="checkbox" value="1" name="shift[]" id="shift-1" checked><label for="shift-1">Morning</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="1" name="shift[]" id="shift-1"><label for="shift-1">Morning</label></div>

                            <?php } ?>
                            <?php if (in_array(2, $shift_prams)) { ?>
                                <div class="form-group"><input type="checkbox" value="2" name="shift[]" id="shift-2" checked><label for="shift-2">Evening</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="2" name="shift[]" id="shift-2"><label for="shift-2">Evening</label></div>
                            <?php } ?>
                            <?php if (in_array(3, $shift_prams)) { ?>
                                <div class="form-group"><input type="checkbox" value="3" name="shift[]" id="shift-3" checked><label for="shift-3">Night</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="3" name="shift[]" id="shift-3"><label for="shift-3">Night</label></div>
                            <?php } ?>
                            <?php if (in_array(4, $shift_prams)) { ?>
                                <div class="form-group"><input type="checkbox" value="4" name="shift[]" id="shift-4" checked><label for="shift-4">Flexible</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="4" name="shift[]" id="shift-4"><label for="shift-4">Flexible</label></div>
                            <?php } ?>
                        </div>
                        <div class='view-more'></div>
                    </form>
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
                <div class="card-body" id="salary">
                    <form>
                        <div id="options">
                            <?php if (isset($_GET['salary']) && in_array(1, $_GET['salary'])) { ?>
                                <div class="form-group"><input type="checkbox" value="1" name="salary[]" id="salary-1" checked><label for="shift-1">0 to $100</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="1" name="salary[]" id="salary-1"><label for="shift-1">0 to $100</label></div>

                            <?php } ?>
                            <?php if (isset($_GET['salary']) && in_array(2, $_GET['salary'])) { ?>
                                <div class="form-group"><input type="checkbox" value="2" name="salary[]" id="salary-2" checked><label for="shift-2">$100 to $199</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="2" name="salary[]" id="salary-2"><label for="shift-2">$100 to $199</label></div>
                            <?php } ?>
                            <?php if (isset($_GET['salary']) && in_array(3, $_GET['salary'])) { ?>
                                <div class="form-group"><input type="checkbox" value="3" name="salary[]" id="salary-3" checked><label for="shift-3">$199 to $499</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="3" name="salary[]" id="salary-3"><label for="shift-3">$199 to $499</label></div>
                            <?php } ?>
                            <?php if (isset($_GET['salary']) && in_array(4, $_GET['salary'])) { ?>
                                <div class="form-group"><input type="checkbox" value="4" name="salary[]" id="salary-4" checked><label for="shift-4">$499 to $999</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="4" name="salary[]" id="salary-4"><label for="shift-4">$499 to $999</label></div>
                            <?php } ?>
                            <?php if (isset($_GET['salary']) && in_array(5, $_GET['salary'])) { ?>
                                <div class="form-group"><input type="checkbox" value="5" name="salary[]" id="salary-5" checked><label for="shift-4">$999 to $4999</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="5" name="salary[]" id="salary-5"><label for="shift-4">$999 to $4999</label></div>
                            <?php } ?>
                            <?php if (isset($_GET['salary']) && in_array(6, $_GET['salary'])) { ?>
                                <div class="form-group"><input type="checkbox" value="6" name="salary[]" id="salary-6" checked><label for="shift-4">Above $4999</label></div>
                            <?php } else { ?>
                                <div class="form-group"><input type="checkbox" value="6" name="salary[]" id="salary-6"><label for="shift-4">Above $4999</label></div>
                            <?php } ?>
                        </div>
                        <div class='view-more'></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$discipline_prams = isset($_GET['discipline']) ? implode(',', $_GET['discipline']) : '';
$specialty_prams = isset($_GET['speciality']) ? implode(',', $_GET['speciality']) : '';
$benefits_prams = isset($_GET['benefit']) ? implode(',', $_GET['benefit']) : '';
$emergency_prams = isset($_GET['emergency']) ? implode(',', $_GET['emergency']) : '';
$get_discipline_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-discipline']);
$get_specialty_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-specialty']);
$get_benefits_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-benefits']);
$get_emergency_url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/get-emergency']);
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();
$script_new = <<<JS
getDisciplineRecords();
getSpecialtyRecords();
getBenefitsRecords();
getEmergencyRecords();
        
    function getDisciplineRecords(pageno=0) {
        let params='$discipline_prams';
        let availabel=pageno;
        $.post("$get_discipline_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
            let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#discipline form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#discipline form .view-more").append("<a href='javascript:void(0)' id='discipline-viewmore' onClick='getDisciplineRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#discipline  form #options").append(data.options);
               $("#discipline-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#discipline form .view-more").append("<a href='javascript:void(0)' id='discipline-viewmore' onClick='getDisciplineRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
        
    function getSpecialtyRecords(pageno=0) {
        let params='$specialty_prams';
        let availabel=pageno;
        $.post("$get_specialty_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
             let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#speciality form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#speciality form .view-more").append("<a href='javascript:void(0)' id='speciality-viewmore' onClick='getSpecialtyRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#speciality form #options").append(data.options);
               $("#speciality-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#speciality form .view-more").append("<a href='javascript:void(0)' id='speciality-viewmore' onClick='getSpecialtyRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
        
    function getEmergencyRecords(pageno=0) {
        let params='$emergency_prams';
        let availabel=pageno;
        $.post("$get_emergency_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
             let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#emergency form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#emergency form .view-more").append("<a href='javascript:void(0)' id='emergency-viewmore' onClick='getEmergencyRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#emergency form #options").append(data.options);
               $("#emergency-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#emergency form .view-more").append("<a href='javascript:void(0)' id='emergency-viewmore' onClick='getEmergencyRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
        
    function getBenefitsRecords(pageno=0) {
        let params='$benefits_prams';
        let availabel=pageno;
        $.post("$get_benefits_url", {"$csrfParam":"$csrfToken",page: pageno,filter:params}, function(result){
             let data=JSON.parse(result);
            availabel+=data.offset;
            if(data.offset==0){
                $("#benefit form #options").html(data.options)
                let nextPage=parseInt(data.offset);
                if(data.options != ''){
                    $("#benefit form .view-more").append("<a href='javascript:void(0)' id='benefit-viewmore' onClick='getBenefitsRecords("+nextPage+")'>View More</a>")
                }
            }else{
               $("#benefit form #options").append(data.options);
               $("#benefit-viewmore").remove();
               if(availabel<data.totalPage){
                    let nextPage=parseInt(data.offset);
                    if(data.options != ''){
                        $("#benefit form .view-more").append("<a href='javascript:void(0)' id='benefit-viewmore' onClick='getBenefitsRecords("+availabel+")'>View More</a>") 
                    }
               }
            }
        });
    }
JS;
$this->registerJS($script_new, 3);
?>