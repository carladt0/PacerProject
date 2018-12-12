<?php  require_once("../core/includes.php");


    $u= new User; //getting users information

    if(!empty($_POST) ){ //form was submitted
        $u->edit();
        header('Location:/profile.php');
        exit();
    }

    $user = $u->get_by_id($_SESSION['user_logged_in']); //pass the user number into the function
    $title = 'Runners Social Network | Pacer Edit Profile';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");
?>

    <!--BANNER IMAGE LEFT-->
    <div class="container-fluid profile-container">
        <form enctype="multipart/form-data" method="post">
            <div class="row">
                <div class="col-md-7 nopadding">
                    <div id="runners-profile-edit" class="row">
                        <div class="col-md-6">
                            <div class="centered-box-edit-profile"></div>
                            <h1 class="centered-header-editprofile">EDIT</h1>
                        </div><!--.col-md-6-->
                        <div id="profile-image-col" class="col-md-6">

                            <?php
                            $profile_picture="user-placeholder.png";
                            if (!empty($user['profile_picture'])   ){
                                $profile_picture= $user['profile_picture'];
                            }


                             ?>

                            <img id="profile-picture-edit-image" class="img-fluid" src="/assets/files/<?=$profile_picture?>" alt="User Profile Picture">
                            <label for='file-with-preview' class="edit-profile-image img-fluid">[EDIT IMAGE]</label>
                            <input class="d-none" onchange="previewFile()" id="file-with-preview" type="file" name="fileToUpload">
                        </div><!--.col-md-6-->
                    </div><!-- #runners-signup .row -->
                    <div id="why-pacer-edit">
                        <h3 class="why-pacer-header">WHY PACER?</h3>
                        <p>YOU, FELLOW RUNNER, ARE A SOCIAL ANIMAL. <br>YOUR BODY WAS ALSO DESIGNED TO MOVE.
                        <br>SOMETIMES WE LIKE TO BE SOCIAL AND MOVE AT THE SAME TIME.<br>OTHER TIMES, WE LIKE TO MOVE AND THEN BE SOCIAL AFTERWARDS.
                        <br>SHARING IS KEY IN CREATING A HAPPY, HEALTHY RUNNING REGIME.</p>
                        <h3 class="join-our-community-edit">WELCOME TO OUR COMMUNITY OF RUNNERS! </h3>
                    </div><!-- #why-pacer-->
                </div><!-- .col-md-7 -->

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-1 no-pad">
                        <i class="fas fa-user fa-user-profile-edit"></i>
                    </div><!-- .col-md-1 -->
                    <div class="col-md-11 user-heading-edit no-pad">
                        <h3 class="why-pacer free">LET'S MAKE SOME CHANGES</h3>
                        <h2 class="create-account">EDIT YOUR ACCOUNT</h2>
                    </div><!-- .col-md-11 -->
                </div><!-- .row -->


                <div id="sign-up-form">
                    <div id="form-closer" class="form-group">
                        <input class="form-control form-red" type="text" name="username" value="<?=strtoupper($user['username'])?>">
                    </div>
                    <div id="form-closer" class="form-group">
                        <input class="form-control form-red" type="password" name="password" value="" placeholder="LEAVE EMPTY TO KEEP YOUR SAME PASSWORD">
                    </div>
                    <div id="form-closer" class="form-group">
                        <input class="form-control form-red" type="text" name="firstname" value="<?=strtoupper($user['firstname'])?>" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-red" type="text" name="lastname" value="<?=strtoupper($user['lastname'])?>" required>
                    </div>
                    <div id="form-closer" class="form-group">
                        <input class="form-control form-red" type="email" name="email" value="<?=strtoupper($user['email'])?>" required>
                    </div>
                    <div id="form-closer" class="form-group">
                        <input class="form-control form-red" type="text" name="location" value="<?=strtoupper($user['location'])?>" required>
                    </div>

                    <div id="policy-container" class="container-fluid">
                        <div class="row policy-button">
                            <div class="col-md-9  policy">
                                <p class="edit-policy">NEED A REFRESHER? CHECK OUT OUR <a href="https://www.strava.com/legal/terms">TERMS OF SERVICE</a>. <br>VIEW OUR <a href="https://www.strava.com/legal/privacy">PRIVACY POLICY</a>.</p>
                            </div>
                            <div class="col-md-3 submit-edit">
                                <input class="btn btn-pacer btn-edit" type="submit" value="Submit">
                            </div><!--.col-md-3-->
                        </div><!--.row .policy-button-->
                    </div><!--.container-fluid #policy-container-->
                </div><!-- #sign-up-form -->
                <div>
                    <h2 id="nice-edit">NICE!</h2>
                </div>
            </div><!--.col-md-5-->
        </div><!-- .row -->
        </form>
    </div><!-- .container-fluid -->

<?php
    require_once("../elements/footer.php");
