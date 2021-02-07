<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="">
   <div >
     <style>
         body{
            background:#fff;
         }
     </style>
  <div class="row justify-content-center mt-0" style =  "margin: auto;
  width: 60%;
  padding: 10px;">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Agent Signup</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Account</strong></li>
                                <li id="personal"><strong>Personal</strong></li>
                                <li id="address"><strong>Address</strong></li>
                                <li id="personal"><strong>Next of Kin</strong></li>
                                <li id="questions"><strong>General Questions</strong></li>
                                <li id="payment"><strong>Payment</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Account Credentials</h2>
                                     <input type="email" name="email" placeholder="Email" />
                                     <input type="password" name="password" placeholder="Password" />
                                     <input type="password" name="password_confirm" placeholder="Confirm Password" />
                                </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Personal Information</h2>
                                     <input type="text" name="idnumber" placeholder="Identity Number" /> 
                                    <input type="text" name="agent_name" placeholder="Name" /> 
                                    <input type="text" name="suname" placeholder="Surname" /> 
                                    <input type="number" name="agent_cellphone_number" placeholder="Cell Phone Number" /> 
                                    <input type="number" name="landline_number" placeholder="Landline Number (if available)" /> 
                                    <input type="email" name="email_address" placeholder="Email Address" /> 
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Postal Address</h2>
                                     <input type="text" name="address_line1" placeholder="Address Line1" /> 
                                    <input type="text" name="address_line2" placeholder="Address line 2 (Optional)" /> 
                                    <input type="text" name="city" placeholder="City/Town" /> 
                                    <input type="text" name="province" placeholder="Landline Number (if available)" /> 
                                    <input type="text" name="postal_code" placeholder="Postal Code" /> 
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Next Of Kin</h2>
                                    <input type="text" name="nok_name" placeholder="Name" /> 
                                    <input type="text" name="nok_surname" placeholder="Surname" /> 
                                    <input type="text" name="nok_cell_number" placeholder="Cell No." />
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                   <?php foreach($questions as $question){ ?>
                                    <?php  echo $question->question ?>
                                    <input type="text" name="question[$question->id]" /> 

                                   <?php } ?>
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Terms And Conditions</h2>
                                        <ul class = "agent-signup-terms">
                                            <li>Subject to the agreement to and compliance with the terms of this
                                            agreement ,we grant to you a non-exclusive ,non transferable ,non
                                            sharable ,revocable limited license to use the service (including the
                                            software in connection with the services )Solely for your commercial
                                            use to the services in accordance with this agreement.</li>
                                            <li>You hereby give us permission to deduct R149 per month from
                                            your debit card/or bank account.</li>
                                            <li>In the event of the monthly iGEN APP usage fee of R149 per
                                            month,not received by no later then the 7 th of the month,then your
                                            services will be suspended immediately .And you will be required to
                                            pay a fee of R99 as a reconnection FEE plus your prepaid amount of
                                            R149 for the month that you decide to sign up with.</li>

                                            <li>All personal information supplied will only be used for the purpose
                                            of the iGEN APP and we will not release your personal details to any
                                            third party.</li>
                                            <li>All client information that is gathered in any campaigns on the
                                            iGEN APP,will need to be kept private and confidential . </li>
                                            <li>You will not be allowed to lie to any client about the terms and
                                            conditions of any campaign and this could lead to your termination
                                            of using the iGEN APP. </li>
                                            <li>PLEASE NOTE EACH CAMPAIGN WILL HAVE ITS OWN TERMS AND
                                            CONDITIONS DEPENDING ON CAMPAIGN LAWS,</li>
                                            <li><input  style = "width: initial; position:relative; top:1px;" type="checkbox" id="vehicle3" name="vehicle3" value="Boat"> <label for="vehicle3">I accept terms & conditions</label> </li>
                                        </ul>
                                       
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> 
                                <input type="button" name="make_payment" class="next action-button" value="Confirm" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
$(document).ready(function(){

  
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    
    $(".next").click(function(){
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });
    
    $(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 600
    });
    });
    
    $('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
    });
    
    $(".submit").click(function(){
    return false;
    })
    
    });
</script>
</body>
</html>



