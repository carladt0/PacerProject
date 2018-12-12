<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Pacer Home | Login Page';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");

 ?>

<!--BANNER IMAGE LEFT-->
<div class="container-fluid signup-container">
    <div class="row">
        <div class="col-md-7 nopadding">
            <div id="runners-support">
                <div class="centered-box-support"></div>
                <h1 class="connect-header">CONNECT</h1>
            </div><!-- #runners-signup -->
        </div><!-- .col-md-7 -->

<!-- SIGN-UP-->

        <div class="col-md-5">
            <div class="row">
                <div class="col-1 no-pad-right">
                    <div class="fa-user-support">
                        <i class="fas fa-user"></i>
                    </div><!-- .col-1 -->
                </div><!-- .col-md-1 -->
                <div class="col-11 no-pad-left">
                    <div class="signup-newsletter-group">
                        <h3 class="why-pacer free">FOR RUNNING TIPS + PACER NEWS</h3>
                        <h2 class="sign-up-heading">SIGN-UP FOR OUR NEWSLETTER</h2>
                    </div><!-- .sign-up-heading-->
                </div><!-- .col-md-11 -->
            </div><!-- .row -->

<!--Form PHP-->
            <?php
            $emailTyped = '';
            if ( !empty($_POST) ){
            $emailTyped = $_POST['email'];
            }

            echo '<div id="successMsg" class="text-small">';

                if (!empty($_POST['email'])){
                    require_once 'assets/files/html_email.php';
                    echo $msg;
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    mail('carla.dutoit@hotmail.com', 'Pacer - Newsletter Signup', $msg, $headers);
                }
                echo '</div>';
            ?>

<!--Form CONTENT-->
            <form id="newsletter-form" method="post">
                <p class="newsletter">Delivered to your inbox every Friday morning, PACER makes it easier for you to train smarter and stay connected to your local running community. Sign up today for the Weekly PACER Newsletter and receive 20% off your next PACER sponsored community run! </p>
                <div id="form-closer" class="form-group">
                    <input class="form-control form-red" type="email" value=" <?php echo $emailTyped; ?>" name="email" placeholder="EMAIL">
                </div><!--#form-closer-->

                <div id="policy-container" class="container-fluid">
                    <div class="policy-button">
                        <div class="policy">
                            <p>VIEW OUR <a href="https://www.strava.com/legal/terms">TERMS OF SERVICE</a> AND OUR <a href="https://www.strava.com/legal/privacy">PRIVACY POLICY</a> FOR MORE INFORMATION.</p>
                        </div>
                        <div class="submit-support">
                            <input class="btn btn-pacer btn-support" type="submit" value="Submit">
                        </div><!--.submit-support-->
                    </div><!--.policy-button-->
                </div><!--.policy-container-->
            </form><!--#newsletter-form-->

        </div><!--.col-md-5-->
    </div><!--.row-->
</div><!--.container-fluid-->

    <?php
    require_once("../elements/footer-shown.php");
    require_once("../elements/footer.php");
