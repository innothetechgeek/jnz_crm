<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="">
   <div >
     <style>
         body{
            background: #eee !important;
         }
     </style>

<style>

/* FontAwesome for working BootSnippet :> */
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    #team {
        background: #eee !important;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #108d6f;
        border-color: #108d6f;
        box-shadow: none;
        outline: none;
    }

    .btn-primary {
        color: #fff;
        background-color: #415165;
        border-color: #415165;
    }

    section {
        padding: 60px 0;
    }

    section .section-title {
        text-align: center;
        color: #415165;
        margin-bottom: 50px;
        text-transform: uppercase;
    }

    #team .card {
        border: none;
        background: #ffffff;
    }

    .image-flip:hover .backside,
    .image-flip.hover .backside {
        -webkit-transform: rotateY(0deg);
        -moz-transform: rotateY(0deg);
        -o-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        transform: rotateY(0deg);
        border-radius: .25rem;
    }

    .image-flip:hover .frontside,
    .image-flip.hover .frontside {
        -webkit-transform: rotateY(180deg);
        -moz-transform: rotateY(180deg);
        -o-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }

    .mainflip {
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -ms-transition: 1s;
        -moz-transition: 1s;
        -moz-transform: perspective(1000px);
        -moz-transform-style: preserve-3d;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
        position: relative;
    }

    .frontside {
        position: relative;
        -webkit-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        z-index: 2;
        margin-bottom: 30px;
    }

    .backside {
        position: absolute;
        top: 0;
        left: 0;
        background: white;
        -webkit-transform: rotateY(-180deg);
        -moz-transform: rotateY(-180deg);
        -o-transform: rotateY(-180deg);
        -ms-transform: rotateY(-180deg);
        transform: rotateY(-180deg);
        -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    }

    .frontside,
    .backside {
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -moz-transition: 1s;
        -moz-transform-style: preserve-3d;
        -o-transition: 1s;
        -o-transform-style: preserve-3d;
        -ms-transition: 1s;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
    }

    .frontside .card,
    .backside .card {
        min-height: 312px;
    }

    .backside .card a {
        font-size: 18px;
        color: #415165 !important;
    }

    .frontside .card .card-title,
    .backside .card .card-title {
        color: #415165 !important;
    }

    .frontside .card .card-body img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
    }

</style>

<?php

    $campaigns = [
            'EARN R50 when you sign a client for' => [
                'Vehicle tracking system-lead only not sale',
                'Motorplan-refer lead for vehicle owner for motorplan',
                'Extended Vehicle warranty-refer vehicle owner',
                'Funeral Cover-lead only',
                'School Online Tutor System'
            ],

            'EARN R100' => [
                'Refer a funeral policy client',
                'Refer a credit card client',
                'Refer a credit card client',
                'Refer a client for Loyality Program',
            ],
            'EARN R350' => [
                'Refer a client looking for insurance',
                'Medical Aid or Gap Covers',
            ],
            'EARN R500' => [
                'refer a client that needs an ADT alarm system',
                'Mefer a client for cellphone contract'
            ],
            'EARN R1000' => [
                'Refer a client that is looking to buy a new car.'
            ],
            'EARN R3000' => [
                'Mefer a client that wants to buy a house'
            ]
        ];
?>
<section id="team" class="pb-5">
<div class="container">
    <h5 class="section-title h1">OUR CAMPAINS</h5>
    <div class="row">
        <?php foreach($campaigns as $campaigns_title => $campaign_types) { ?>
        <!-- Campain -->
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip" >
                <div class="mainflip flip-0">
                    <div class="frontside">
                        <div class="card">
                            <div class="card-body text-center">
                                <p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_01.png" alt="card image"></p>
                                <h4 class="card-title"><?php echo $campaigns_title ?></h4>
                                 <ul>
                                    <?php foreach($campaign_types as $key => $campaign_type) { ?>
                                        
                                        <li> <?= $campaign_type ?> </li>

                                    <?php } ?>
                                </li>
                                <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="backside">
                        <div class="card">
                            <div class="card-body text-center mt-4">
                                <h4 class="card-title">Sunlimetech</h4>
                                <p class="card-text">This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                            <i class="fa fa-skype"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                            <i class="fa fa-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>
</div>
</section>
<!-- Team -->

</body>
</html>