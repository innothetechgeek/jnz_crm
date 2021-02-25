<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="">
   <div >
     <style>
         body{
            background:#fff;
         }

         #signupreason{
            padding: 0px 8px 4px 8px;
            border: none;
            border-bottom: 1px solid #ccc;  
            border-radius: 0px; 
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;             
            font-family: montserrat;
            color: #2C3E50;
            font-size: 16px;
            letter-spacing: 1px;
         }

     </style>
  <div class="row justify-content-center mt-0" id ="mainRow" style =  "margin: auto;
  width: 60%;
  padding: 10px;">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Signup</strong></h2>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action = "lead_signup" method = "POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <fieldset id = "step2" class="tab">
                                <div class="form-card">
                                    <h2 class="fs-title">Personal Information</h2>
                                    <input type="text" name="idnumber" placeholder="Identity Number" /> 
                                    <input type="text" name="name" placeholder="Name" /> 
                                    <select type ="select" id = "signupreason"> 
                                        <option value="volvo">What are you signin up for?</option>
                                        <option value="volvo">Vehicle tracking system</option>
                                        <option value="volvo">Mtorplan</option>
                                        <option value="volvo">Extended Vehicle warranty-refer vehicle owner</option>
                                        <option value="volvo">Funeral Cover-lead only</option>
                                        <option value="volvo">Online Tutor System</option>
                                        <option value="volvo">Funeral policy</option>
                                        <option value="volvo">Credit card</option>
                                        <option value="volvo">Credit card</option>
                                        <option value="volvo">Loyality Program</option>
                                        <option value="volvo">Insurance</option>
                                        <option value="volvo"> Medical Aid or Gap Covers</option>
                                        <option value="volvo"> ADT alarm system</option>
                                        <option value="volvo">Cellphone contract</option>
                                        <option value="volvo">Buy a house</option>
                                    </select>
                                    <input type="number" name="phonenumber" placeholder="Cell Phone Number" /> 
                                    <input type="email"  data-not-required = "true" name="Email" placeholder="email" /> 
                                </div> 
                                <input type="submit" class="next action-button" value="Signup" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>



