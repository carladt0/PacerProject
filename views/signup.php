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
            <div id="runners-signup">
                    <div class="centered-box-signup"></div>
                    <h1 class="centered-header-signup">SIGN-UP</h1>
            </div><!-- #runners-signup -->
        </div><!-- .col-md-7 -->

<!-- SIGN-UP-->

        <div class="col-md-5">
            <div class="row">
                <div class="col-1 no-pad">
                    <i class="fas fa-user fa-user-signup no-pad-right"></i>
                </div><!-- .col-md-1 -->
                <div class="col-11 no-pad">
                    <div class="create-account-group">
                        <h3 class="free">FREE FOR RUNNERS (YES, YOU!)</h3>
                        <h2 class="create-account">CREATE YOUR ACCOUNT</h2>
                    </div><!-- .create-account-group -->
                </div><!-- .col-md-11 -->
            </div><!-- .row -->

            <?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' ?>

            <form id="sign-up-form" action="/users/add.php" method="post">
                <div id="form-closer" class="form-group">
                    <input class="form-control form-red" type="username" name="username" placeholder="USERNAME"required>
                </div>
                <div id="form-closer" class="form-group">
                    <input class="form-control form-red" type="password" name="password" placeholder="PASSWORD"required>
                </div>
                <div id="form-closer" class="form-group">
                    <input class="form-control form-red" type="text" name="firstname" placeholder="FIRST NAME"required>
                </div>
                <div class="form-group">
                    <input class="form-control form-red" type="text" name="lastname" placeholder="LAST NAME"required>
                </div>
                <div id="form-closer" class="form-group">
                    <input class="form-control form-red" type="email" name="email" placeholder="EMAIL"required>
                </div>
                <div id="form-closer" class="form-group">
                    <input class="form-control form-red" type="text" name="location" placeholder="LOCATION"required>
                </div>

                <div id="policy-container" class="container-fluid">
                    <div class="row policy-button">
                        <div class="col-md-9  policy">
                            <p>BY SIGNING UP WITH PACER, YOU AGREE TO OUR <a href="https://www.strava.com/legal/terms">TERMS OF SERVICE</a>. <br>VIEW OUR <a href="https://www.strava.com/legal/privacy">PRIVACY POLICY</a>.</p>
                        </div>
                        <div class="col-md-3 submit-signup">
                            <input class="btn btn-pacer" type="submit" value="Submit">
                        </div><!--.col-md-3-->
                    </div><!--.row .policy-button-->
                </div><!--.container-fluid #policy-container-->
                </form>
            </div><!--.col-sm-5-->
        </div><!-- .row -->



    <div class="row">
        <div id="why-pacer-signup">
            <h3 class="why-pacer-header">WHY PACER?</h3>
            <p>YOU, FELLOW RUNNER, ARE A SOCIAL ANIMAL. <br>YOUR BODY WAS ALSO DESIGNED TO MOVE.
            <br>SOMETIMES WE LIKE TO BE SOCIAL AND MOVE AT THE SAME TIME.<br>OTHER TIMES, WE LIKE TO MOVE AND THEN BE SOCIAL AFTERWARDS.
            <br>SHARING IS KEY IN CREATING A HAPPY, HEALTHY RUNNING REGIME.</p>
            <h3 class="join-our-community-signup">JOIN OUR COMMUNITY OF FELLOW RUNNERS, </h3>
        </div>
        <h2 class="lets-move">LETS MOVE AND BE SOCIAL TOGETHER!</h2>
    </div><!-- .row -->
</div><!-- .container-fluid -->
<?php
    require_once("../elements/footer.php");
