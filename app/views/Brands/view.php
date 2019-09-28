<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href='<?=PATH;?>'>Главная</a></li>
                <li><a href='category/<?=$brands->alias;?>'><?=$brands->title;?></a></li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<!--<div class="single contact">-->
<!--    <div class="container">-->
<!--        <div class="single-main">-->
<!--            <div class="col-md-12 single-main-left">-->
<!--                <div class="sngl-top">-->
<!--                    <div class="col-md-4 single-top-left product-flex">-->
<!--                        --><?php //if ($gallery):?>
<!--                            <div class="flexslider">-->
<!--                                <ul class="slides">-->
<!--                                    --><?php //foreach ($gallery as $img):?>
<!--                                        <li data-thumb="images/--><?//=$img->img;?><!--">-->
<!--                                            <div class="thumb-image"> <img src="images/--><?//=$img->img;?><!--" data-imagezoom="true" class="img-responsive" alt="фотография часов"/> </div>-->
<!--                                        </li>-->
<!--                                    --><?//endforeach;?>
<!--                                </ul>-->
<!---->
<!--                            </div>-->
<!--                        --><?php //else:?>
<!--                            <div class="">-->
<!--                                <img src="images/--><?//=$brands->img;?><!--" class="img-responsive" alt="фотография часов"/>-->
<!--                            </div>-->
<!--                        --><?//endif;?>
<!--                    </div>-->
<!--                    <div class="col-md-7 single-top-right">-->
<!--                        <div class="single-para simpleCart_shelfItem">-->
<!--                            <h2>--><?//=$brands->title;?><!--</h2>-->
<!---->
<!--                            <p>--><?//=$brands->description;?><!--</p>-->
<!---->
<!--                        </div>-->
<!--                        <div class="panel-group accord-panel" id="accordion" role="tablist" aria-multiselectable="true">-->
<!--                            <div class="panel panel-primary">-->
<!--                                <div class="panel-heading" role="tab" id="heading1">-->
<!--                                    <h4 class="panel-title">-->
<!--                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">-->
<!--                                            Подробное описание-->
<!--                                        </a>-->
<!--                                    </h4>-->
<!--                                </div>-->
<!--                                <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">-->
<!--                                    <div class="panel-body">--><?//=$brands->content;?><!--</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="panel panel-primary">-->
<!--                                <div class="panel-heading" role="tab" id="heading2">-->
<!--                                    <h4 class="panel-title">-->
<!--                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">-->
<!--                                            <a class="all-product-brand" href="brands/--><?//=$brands->alias;?><!--/product-all">Все продукты</a>-->
<!--                                        </a>-->
<!--                                    </h4>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="clearfix"> </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="clearfix"> </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--end-single-->