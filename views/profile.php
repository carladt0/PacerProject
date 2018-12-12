<?php  require_once("../core/includes.php");
    $title = 'Runners Social Network | Pacer Profile';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");


if (!empty($_SESSION['user_logged_in']) ){ //user logged in

    if(!empty($_GET['id']) ){
        $user=$u->get_by_id($_GET['id']);
    }
    ?>

<!--BANNER IMAGE LEFT-->
    <div class="container-fluid profile-container">
        <div class="row">
            <div class="col-sm-7 nopadding">
                <div id="runners-profile" class="row">
                    <div class="col-sm-6">
                        <div class="centered-box-profile"></div>
                        <h1 class="centered-header-profile">PROFILE</h1>
                    </div><!--.col-md-6-->
                    <div id="profile-image-col" class="col-sm-6">
                    <?php
                    $profile_picture="user-placeholder.png";
                    if (!empty($user['profile_picture'])   ){
                        $profile_picture= $user['profile_picture'];
                    }
                    ?>
                        <img class="profile-picture-image img-fluid" src="/assets/files/<?=$profile_picture?>" alt="User Profile Picture">
                    </div><!--.col-md-6-->
                </div><!-- #runners-profile .row -->

                <div id="recent-runs" class="container">
                    <h4 class="recent-runs-header">RECENT RUNS</h4>
                    <?php
                    $r = new Runlog;
                    $runlogs = $r->get_by_user_id($user['id']);
                    foreach($runlogs as $runlog){
                    ?>
                    <div class="row">
                        <div class="col-1 nopadding">
                            <?php
                            if( $runlog['user_id'] == $_SESSION['user_logged_in'] ){  //only runs for that post if owner user is logged in at the time
                            ?>
                            <a href="/runlogs/edit-profile-runlogs.php?id=<?=$runlog['id']?>"> <img class="edit-icon" src="/assets/files/pen-lg.png" alt="edit post icon"> </a>
                            <?php
                            }
                             ?>
                            <?php
                            if( $runlog['user_id'] == $_SESSION['user_logged_in'] ){  //only runs for that post if owner user is logged in at the time
                            ?>
                            <a href="/runlogs/delete-profile-runlogs.php?id=<?=$runlog['id']?>"><img class="delete-icon" src="/assets/files/x-lg.png" alt="delete post icon"> </a>
                            <?php
                            }
                            ?>
                        </div><!--.col-md-2-->
                        <div class="col-1 nopadding">
                            <p class="run-likes">18<i class="fas fa-heart"></i></p>
                        </div><!--.col-md-1-->
                        <div class="col-2">
                            <p class="run-post-date"><?= date('d:m:Y', $runlog['posted_date'] )?></p>
                        </div><!--.col-md-3-->
                        <div class="col-8">
                            <p class="run-profile-post-stats">RAN <?= ($runlog['rundistance'])?> KM IN <?= ($runlog['runhours'])?>:<?= ($runlog['runminutes'])?>:<?=($runlog['runseconds'])?> </p>
                        </div><!--.col-md-8-->
                    </div><!--.row-->
                        <?php } //end foreach ?>
                </div><!-- .container-->
            </div><!-- .col-sm-7-->

            <div id="heading-logout" class="col-sm-5 no-pad">
                <div class="row">
                    <div class="col-1">
                        <i class="fas fa-user fa-user-profile"></i>
                    </div><!-- .col-md-1 -->
                    <div class="col-sm-8 no-pad user-heading-profile">
                        <h3 class="why-pacer free">WELCOME BACK</h3>
                        <h2 class="create-account"><?= strtoupper($user['firstname'])?> <?= strtoupper($user['lastname'])?></h2>
                    </div><!-- .col-md-8-->
                    <div class="col-sm-3 no-pad user-heading-profile">
                        <?php if(empty($_GET['id']) || $_SESSION['user_logged_in'] == $_GET['id'] ){ ?>
                        <a class="btn btn-pacer btn-logout-profile" href="/editprofile.php">EDIT  &nbsp;PROFILE</a>
                        <?php } ?>
                    </div><!-- .col-md-3-->
                </div><!-- .row -->

                <div class="row">
                    <div class="centered-box-profile-right">
                        <h1 id="thismonth" class="since-joining-runlog">
                        <?php
                        $total_run_distance = $r->get_total_run_distance($_SESSION['user_logged_in']);
                        echo $total_run_distance ?>
                        KM SINCE JOINING</h1>
                    </div><!-- .centered-box-profile-right -->
                </div><!-- .row -->
                <div id="user-profile" class="container no-pad">
                    <div id="user-profile-row" class="row">
                            <i class="fas fa-user"></i>
                            <h4 id="first-last-profile"><?= strtoupper($user['firstname'])?> <?= strtoupper($user['lastname'])?></h4>
                            &nbsp;&nbsp;
                            <?php if(empty($_GET['id']) || $_SESSION['user_logged_in'] == $_GET['id'] ){ ?>
                            <a class="profile-edit" href="/editprofile.php">[EDIT]</a>
                            <?php } ?>
                    </div><!-- .row-->
                    <div id="user-profile-row"  class="row">
                        <i class="fas fa-map-marker-alt"></i>
                        <h4>LOCATED IN <?= strtoupper($user['location'])?></h4>
                        &nbsp;&nbsp;
                        <?php if(empty($_GET['id']) || $_SESSION['user_logged_in'] == $_GET['id'] ){ ?>
                        <a class="profile-edit" href="/editprofile.php">[EDIT]</a>
                        <?php } ?>
                    </div><!-- .row-->
                    <div id="user-profile-row"  class="row">
                        <i class="fas fa-calendar-alt"></i>
                        <h4>MEMBER SINCE <?= date('F Y', $user['created_time'] )?></h4>
                    </div><!-- .row-->
                    <div>
                        <h2 id="nice-profile">NICE!</h2>
                    </div>
                </div><!-- .container #user-profile-->

            </div><!-- .col-sm-5-->
        </div><!-- .row -->
    </div><!-- .container-fluid -->


    <?php

    }else{ //else show login page

        require_once("../elements/signup-login-forms.php");
    }
    require_once("../elements/footer.php");
