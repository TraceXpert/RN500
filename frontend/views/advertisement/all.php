
<section class="main-banner align-items-end d-flex">
    <div class="container">
        <div class="row text-center">
            <div class="col-xl-12">
                <h1 class="mb-4">
                    Advertisements
                </h1>
            </div>
        </div>
    </div>
</section>


<section class="marquee-text p-0 d-flex align-items-center">
    <marquee width="100%" direction="left">
        COVID-19 affects different people in different ways. Most infected people will develop mild to moderate
        illness and recover without hospitalization.
    </marquee>
</section>



<section class="">
    <div class="container">

        <div class="row mb-5 pb-5" id="loads-ads">

        </div>

        <div class="col-md-12 text-center">
            <a href="javascript:void(0)" class="read-more load-more" >Load More</a>
        </div>


    </div>
</section>



<?php

$url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['advertisement/load']);
$location = Yii::$app->request->get('location');

$script_new = <<<JS
    let total_page = "$total_pages";
    let page =1;
    $(document).on('click','.load-more',function(e){
        
            page = parseInt(page) +1;
            loadAds(page);
    });
    function loadAds(page=0){
        let location ="$location" ;
        $('#overlay').removeClass("hide").addClass("show");
        
        if(page == total_page){
            $(".load-more").hide();
        }
        if(page <= total_page){
            setTimeout(()=>{
                $.ajax({
                        url: "$url",
                        method: "GET",
                        data: {page,location},
                        async :false
                    }).done(function( result ) {
                        $("#loads-ads").append(result);
                    });
            },1000)
        } 
        
    }
    loadAds(page);
JS;
$this->registerJS($script_new, 3);
?>