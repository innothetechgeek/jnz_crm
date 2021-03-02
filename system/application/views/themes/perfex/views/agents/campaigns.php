<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('agents/includes/head.php'); ?>
<body class="">
   <div >
     <style>
         body{
            background: #eee !important;
         }

         #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #495B71;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 5000;
            left: 50%;
            bottom: 60px;
            font-size: 17px;
        }

        .btn-disabled{
            background:#7d868e !important;
            border: none;
        }

        #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;} 
        to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;} 
        to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
        }

        .campain-disabled{
            color: grey !important;
        }
     </style>

<style>

/* FontAwesome for working BootSnippet :> */
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    #team {
        background: #eee !important;
    }
    .btn-primary {
        color: #fff;
        background-color: #415165;
        border-color: #415165;
    }

    .btn-primary:active:focus{
        background:initial;
    }

    .mg-top-5{
        margin-top:5px;
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
/* 
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
    } */

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

     .card-body ul > li{
        line-height: 1.9;
     }


    .frontside {
        position: relative;
        -webkit-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        z-index: 2;
        margin-bottom: 30px;
    }

    .card-body{
        padding: 1.25rem;
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
        height: 347px;
    }

    .backside .card a {
        font-size: 18px;
        color: #415165;
    }

    .frontside .card .card-title,
    .backside .card .card-title {
        color: #415165'
    }

    .frontside .card .card-body img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
    }

</style>

<?php

    $campaigns = [
            'EARN R50 when you sign a client for:' => [
                'referal_types' => [
                'Loan Application',
                'Vehicle tracking system-lead only not sale',
                'Motorplan-refer lead for vehicle owner for motorplan',
                'Extended Vehicle warranty-refer vehicle owner',
                'Funeral Cover-lead only',
                'School Online Tutor System'],
                'image'=> 'data:image/jpeg;base64,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'
            ],

            'EARN R100' => [
                'referal_types' => [
                    'Refer a funeral policy client',
                    'Refer a credit card client',
                    'Refer a credit card client',
                    'Refer a client for Loyality Program'
                ],
                'image' => "data:image/jpeg;base64,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"
            ],
            'EARN R350' => [
                'referal_types' =>
                    [
                        'Refer a client looking for insurance',
                        'Medical Aid or Gap Covers'
                    ],
                 'image' => 'https://thumbs.dreamstime.com/z/south-african-money-notes-20915489.jpg'
            ],
            'EARN R500' => [
                'referal_types' =>
                    [
                    'refer a client that needs an ADT alarm system',
                    'Mefer a client for cellphone contract'
                ],
                'image'=> 'https://us.123rf.com/450wm/lcswart/lcswart1605/lcswart160500004/56493842-stack-spread-selection-of-used-south-african-bank-notes.jpg?ver=6',
            ],
            'EARN R1000' => [
                'referal_types' =>
                    [ 
                        'Refer a client that is looking to buy a new car.'
                    ],
                 'image' => 'https://thumbs.dreamstime.com/z/pile-south-african-rand-notes-money-isolated-white-surface-space-text-featuring-nelson-mandela-pile-south-152084743.jpg'
            ],
            'EARN R3000' => [
                'referal_types' =>
                    [   
                        'Mefer a client that wants to buy a house'
                    ],
               'image' =>'https://i.pinimg.com/originals/52/0f/bd/520fbdea80b7fd772967a046013ab25f.jpg'
            ]
        ];
?>
<section id="team" class="pb-5">
<div class="container">
    <h5 class="section-title h1">OUR CAMPAINS</h5>
    <div class="row">
        <?php 
        
         $i = 1;
        foreach($campaigns as $earning => $earning_details) { ?>
        <!-- Campain -->
        <div class="col-xs-12 col-sm-6 col-md-4">
          <?php $is_disabled =  $i != 1 ?  "campain-disabled" : ""; ?>
            <div class="image-flip" >
                <div class="mainflip flip-0">
                    <div class="frontside">
                        <div class="card <?= $is_disabled ?>">
                            <div class="card-body text-center">
                                <p><img class=" img-fluid" src="<?= $earning_details['image'] ?>" alt="card image"></p>
                                <h4 class="card-title  <?= $is_disabled ?>"><?php echo $earning ?></h4>
                                 <ul>
                                   
                                      <?php  foreach($earning_details['referal_types'] as $key => $referal_type) { ?>
                                        
                                        <li> <?= $referal_type ?> </li>
                                        
                                    <?php    
                                     } 
                                    ?>
                                </li>
                                <?php 
                                    $is_btn_disabled = $i != 1 ? "btn-disabled" : "";
                                    $btn_text =  $i != 1 ? "Coming soon" : "GET REFERAL LINK";
                                ?>
                                <input class="btn btn-primary <?=$is_btn_disabled?>" data-toggle="modal" data-target="#exampleModal" data-referal-link = "test.com" class="btn btn-primary btn-sm mg-top-5" value = "<?=  $btn_text ?>">
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

        <?php 
            $i++; 
            } 
        ?>

    </div>
    <div id="snackbar">Referal Link copied to clipboard</div>
         
         <?php   
         
         /* The campaign we'll launch with, please note that I'll move these campains to a database later on
              it looks like the client isn't 100% sure how the project should work at this point, so chances are I might have
              to change a couple of things..it's easy to change data and array structure than to change data in the database and table structures
         */
         $launch_campaign_referal_types =   [
                        'EARN R50 when you sign a client for:' => [
                            'referal_types' => [
                            'Loan Application',
                            'Vehicle tracking system-lead only not sale  (coming soon)',
                            'Motorplan-refer lead for vehicle owner for motorplan (coming soon)',
                            'Extended Vehicle warranty-refer vehicle owner  (coming soon)',
                            'Funeral Cover-lead only  (coming soon)',
                            'School Online Tutor System  (coming soon)'],]
                            ];  ?>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose a campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select name="campains" id="campains">
            <?php 
                $i = 1;
                foreach($launch_campaign_referal_types as $earning => $earning_details) { ?>
                    <?php foreach($earning_details['referal_types'] as $key => $referal_type) { ?>

                        <?php $is_disabled = $i != 1 ? "disabled" : '' ?>
                        <option value="" <?= $is_disabled ?> > <?= $referal_type ?></option>
                    <?php
                     $i++;
                } ?>
            <?php } 
            
            ?>
        </select>
           <h1>Terms and Conditions</h1>
         <ul style = "list-style-type: circle; margin-left:15px">
            <li>You can charge your client a minimum of R50 upto R100 cash to do a loan application for your client.</li>
            <li>We recommend R50 but it is your Business and you can charge what you see fit.</li>
            <li>This cash goes in your pocket.<li>
            <li>Please make your client aware that your charge has nothing to do with the loan being approved or not,it is an admin charge that you charge as this covers your time and internet cost..</li>
            <li>When you fill the details on the form and submit (next),client will also get a free credit report and the client is prompted to see if he needs other financial services as well.</li>
            <li>The client will then be client immediately by Bank call centre to finalise his loan(this call is not for his account so he benefits with a free call to process his application.</li>
            <li>A BUSINESS Partner can do as many as he wishes.</li>
            <li>Please note this service must be done between 8 am and 4.30 pm as this is in line with banking call centres.</li>   
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type = "hidden" id = "campain_1" value = "https://sa.formstack.com/forms/igen_personal_loan_capture_form" />
        <button  onclick="copyRereralLink('#campain_1')"  type="button" class="btn btn-primary">Copy Referal Link</button>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<!-- Team -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    function copyRereralLink(element) {

        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($('#campain_1').val()).select();
        document.execCommand("copy");
        $temp.remove();

        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }


</script>
</body>
</html>