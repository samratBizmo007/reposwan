<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Swan Industries | Login</title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>assets/fa/css/font-awesome.min.css" rel="stylesheet">



  <!-- Custom Theme Style -->
  <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/build/css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/build/css/w3.css" rel="stylesheet">
</head>

<body class="login" style="background-image: url(<?php echo base_url(); ?>assets/images/swanbg.jpg);background-position: center;">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper ">
      <div class="animate form login_form w3-padding">
        <section class="login_content w3-padding w3-white w3-text-grey w3-card-2">
          <form>
            <h1>Login Form</h1>
            <div>
              <input type="text" class="form-control w3-small" placeholder="Enter email-ID here..." required>
            </div>
            <div>
              <input type="password" class="form-control w3-small" placeholder="Enter password here..." required>
            </div>
            <div>
              <button class="btn btn-primary btn-block" type="submit">Log in as Administrator</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">
                <a href="#signup" class="to_register" >Lost your password?</a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-circle-o w3-orange w3-padding-tiny w3-text-white" style="text-shadow: 2px 2px #ff0000;"></i> Swan Industries</h1>
                <p>©2018 All Rights Reserved | Powered by <a target="_blank" href="https://bizmo-tech.com">Bizmo Technologies</a></p>
              </div>
            </div>
          </form>
        </section>
      </div>

      <div id="forgotpassword" class="animate form registration_form w3-padding">
        <section class="login_content w3-padding w3-white w3-text-grey w3-card-2">
          <form >
            <h1>Get Password</h1>
            <h6>Don't remember your password? Please enter valid email-id to get your password!</h6>
            <div>
              <input type="email" class="form-control" placeholder="Enter email-ID here..." required>
            </div>              
            <div>
              <button class="btn btn-primary btn-block" type="submit">Submit</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">I have a password ?
                <a href="#signin" class="to_register"> Log in </a>
              </p>

              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-circle-o w3-orange w3-padding-tiny w3-text-white" style="text-shadow: 2px 2px #ff0000;"></i> Swan Industries</h1>
                <p>©2018 All Rights Reserved | Powered by <a target="_blank" href="https://bizmo-tech.com">Bizmo Technologies</a></p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>
</html>
