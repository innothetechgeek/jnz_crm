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
                <h2><strong>Sign Up Sucessful </strong></h2>
                <p>We'll get back to you shortly</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action = "agent_signup" method = "POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <fieldset class="tab active" >
                                <div class="form-card">
                                    <h2 class="fs-title text-center" style = "text-align:center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"  style = "text-align:center"> 
                                         <img height = "160" src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> 
                                        </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Signed Up, We will be in contact with you shortly</h5>
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
</body>
</html>



