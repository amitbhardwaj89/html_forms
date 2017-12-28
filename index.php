<!Doctype html>
<html>
<head>
<title>CMS</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
     <script src="js/bootstrap.js"></script>
    <style>
        .error-name,.error-email,.error-phone,.error-branch{color:#ff0000;}
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 form-section-wrapper">
            <h4 class="text-center custom_white">Register Here!!!</h4>
            <form action="#" method="post">
                <div class="form-group">
                    <input type="text" class="form-control name" id="name" name="name" placeholder="Your Name*">
                    <span class="error-name"></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control phone" name="mobile" id="Phone" placeholder="Enter 10 Digit Mobile No.*">
                    <span class="error-phone"></span>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control email" name="email" id="Email" placeholder="Your Email*">
                    <span class="error-email"></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control country" name="country" id="New Zealand" placeholder="New Zealand" value="New Zealand">
                </div>
                <div class="form-group">
                    <label for="SIEC" class="custom_white">Nearest SIEC Office</label>
                    <select class="form-control branch" id="sel1" name="branch">
                        <option>----</option>
                        <option>Hyderabad</option>
                        <option>Bangalore</option>
                        <option>Chandigarh</option>
                        <option>Ludhiana</option>
                        <option>New Delhi</option>
                        <option>Pune</option>
                        <option>Mumbai</option>
                    </select>
                    <span class="error-branch"></span>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit" name="save">
            </form>
        </div>
    </div>
</div>
<?php
include_once 'config.php';
$email_to = 'enquiry@siecindia.com,amit@siecindia.com,seo@siecindia.com,dataentry1@siecindia.com';
$subject = 'Study in New Zealand';
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $branch = $_POST['branch'];

    $country = $_POST['country'];
    $email = $_POST['email'];
    $sql = $con->query("select * from html_forms where (mobile='$mobile' or email='$email')");
    $j = $sql->num_rows;
    if($j>0){
        echo "You have already submitted.";
    }else{
        echo "No Result found";
        $message = 'Name: '.' '.$name."\n\n";
        $message.= 'Contact No: '.' '.$mobile."\n\n";
        $message.= 'Email: '." ".$email."\n\n";
        $message.= 'Country: '.' '.$country."\n\n";
        $message.= 'Branch: '.' '.$branch."\n\n";
        $headers = 'From: enquiry@siecindia.com'."\r\n";
        //$headers.= 'Cc: seo@siecindia.com'."\r\n";
        mail($email_to,$subject,$message,$headers);
        $stmt = $con->prepare("INSERT INTO html_forms(name,mobile,email,country,branch) 
VALUES(?,?,?,?,?)");
        $stmt->bind_param('sssss',$name,$mobile,$email,$country,$branch);
        $i = $stmt->execute();
        if($i>0){
            echo "Thank you for your message. It has been sent.";
            echo "<script>location.href = 'http://siecindia.com/development/design/thanks-germany.php'</script>";

        }else{
            echo "You have already submitted the query.";
        }
              }        }?>
<script>

    jQuery(function(){
        jQuery('.error-name').hide();
        jQuery('.error-phone').hide();
        jQuery('.error-email').hide();
        jQuery('.error-branch').hide();
        var error_name = false;
        var error_phone = false;
        var error_email = false;
        var error_branch = false;
        jQuery('.name').focusout(function(){
            //debugger;
            check_name();
        });
        jQuery('.phone').focusout(function(){
            check_phone();
        });
        jQuery('.email').focusout(function(){
            //console.log('we are in email focusout');
            check_email();
        });
        jQuery('.branch').focusout(function(){
            //console.log('we are in email focusout');
            check_branch();
        });

        function check_name(){
            var name = jQuery(".name").val();
            if(name==''){
                jQuery('.error-name').html("Please enter your name");
                jQuery('.error-name').show();
                error_name = true;
            }else{
                jQuery('.error-name').hide();
            }
        }
        function check_phone(){
            var phone = jQuery(".phone").val().length;
            if(phone!=10){

                jQuery('.error-phone').html("Please enter your 10 digit mobile number");
                jQuery('.error-phone').show();
                error_phone = true;
            }else{
                jQuery('.error-phone').hide();
            }
        }

        function check_email(){
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            /*console.log(pattern);*/
            var email = jQuery('[name="email"]').val();
            if(pattern.test(email)){
                //debugger;
                jQuery('.error-email').hide();
                error_email = false;
            }else{
                jQuery('.error-email').html("Invalid Email Address");
                jQuery('.error-email').show();
                error_email = true;
            }
        }
        function check_branch(){
            var branch = jQuery(".branch").val();
            if(branch==''){
                jQuery('.error-branch').html("Please select branch");
                jQuery('.error-branch').show();
                error_branch = true;
            }else{
                jQuery('.error-branch').hide();
            }
        }
        jQuery('#enquiry_form').submit(function(){
            error_name = false;
            error_phone = false;
            error_email = false;
            error_branch = false;
            check_name();
            check_phone();
            check_email();
            check_branch();
            if(error_name == false && error_phone == false &&	error_email == false && error_branch ==  false){
                return true;
            }else{
                return false;}
        });
    });
    /*
     $('#enquiry-form').submit(function(){
     var name = $(".name").val();
     if(name==""){
     console.log($('.name').parent());
     }
     });
     */
</script>

</body>
</html>