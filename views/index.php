<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Pacer Home | Login Page';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");

// echo '<pre>'.print_r($_SESSION, 1).'</pre>';
// die();
if (!empty($_SESSION['user_logged_in']) ){ //user logged in ?>




<!--HEADER-->
    <div class="yourfeed-runners">
        <div class="centered-box-feed"></div>
        <h1 class="centered-header-feed">YOUR FEED</h1>
    </div><!--.yourfeed-runners-->


<!--MAIN BODY CONTAINER-->
    <div id="add-run-container" class="container-fluid">
        <div id="feed-row" class="row">

<!--AD RUN RED PANEL-->
            <div id="add-run-panel"  class="col-md-3">
                <?php
                $profile_picture="user-placeholder.png";
                if (!empty($user['profile_picture'])   ){
                    $profile_picture= $user['profile_picture'];
                } //we also updated javascript for this to work and 'fileToUpload' in user.php

                 ?>
                <img class="profile-img img-fluid" src="/assets/files/<?=$profile_picture?>" alt="current profile picture for user">

                <form action="/runlogs/add.php" method="post">
                    <div class="form-group">
                        <input class="form-control form-red" type="number" name="rundistance" placeholder="RUN DISTANCE (KM)" step=".01" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <label class="runtime-label">RUNTIME:</label>
                        <input id="runtime" class="form-red" type="number" name="runhours" placeholder="HH" required>
                        <input id="runtime"  class="form-red" type="number" name="runminutes" placeholder="MM"required>
                        <input id="runtime"  class="form-red" type="number" name="runseconds" placeholder="SS"required>
                        </div><!--.row-->
                    </div>
                    <input class="btn btn-add-run float-right" type="submit" value="ADD RUN">
                </form> <!--FORM ADDING RUN BY USER-->

                <div id="km-tally" class="row">
                    <div id="since-joining">
                        <h2>
                        <?php
                        $r = new Runlog;
                        $total_run_distance = $r->get_total_run_distance($_SESSION['user_logged_in']);
                        echo $total_run_distance .'KM';
                         ?>
                        </h2>
                        <p>SINCE JOINING</p>
                    </div><!--.since-joining-->
                    <div id="this-month">
                        <h2>22KM</h2>
                        <p>THIS MONTH</p>
                    </div><!--.this-month-->
                </div><!--#km-tally .row-->
                    <div id="hours-since-joining">
                        <h2>YOU'VE SPENT
                        <span class="hours-running-large">
                        <?php
                        $r = new Runlog;
                        $total_run_hours = $r->get_total_run_hours($_SESSION['user_logged_in']);
                        echo $total_run_hours?></span>
                        HOURS RUNNING SINCE JOINING PACER
                        </h2>
                    </div>
                <div class="insp-quote">
                    <blockquote cite="http://atulnene.com/quotelist.html#.W_yzXpNKhao">
                        <span class="insp-large">"SUCCESS</span><br> IS NO ACCIDENT.<br> IT'S <span class="insp-md">HARD WORK,</span><br> <span class="insp-sm">PERSEVERANCE</span>,<br> <span class="insp-md-large">LEARNING,</span><br> <span class="insp-sm">STUDYING,</span><br>
                        <span class="insp-md">SACRIFICE</span> &,<br> MOST OF ALL,<br><span class="insp-large">LOVE</span><br> OF WHAT YOU<br> ARE DOING.”<br> – PELE
                    </blockquote>
                </div><!--.insp-quote-->
            </div><!--.col-md-3 ADD RUN-->



<!--USER POSTS PANEL-->
            <div id="user-posts-panel" class="col-md-9">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="recent">RECENT RUNS IN YOUR AREA</h2>
                        <h3 class="see-near-you">SEE WHO'S RUNNING NEAR YOU</h3>
                    </div><!--.col-md-8-->
<!--SEARCHBAR-->
                    <?php //search bar ?>
                    <div class="col-md-4 no-pad">
                        <div class="right-inner-addon">
                            <form action="/" method="get">
                                <i class="icon-search fas fa-search"></i>
                                <input id="search-bar" class="form-control form-red"  type="text" name="search" placeholder="SEARCH" />
                            </form>
                        </div><!--.right-inner-addon-->
                        <p class="click-profile">*OR CLICK RUNNER TO VIEW PROFILE</p>
                    </div><!--.col-md-4-->
                </div><!--.row-->

                <div id="posts-feed" class="container-fluid">
                    <div class="row">

                        <?php
                        $r = new Runlog;
                        $runlogs = $r->get_all();


                        foreach($runlogs as $runlog){
                        ?>
<!--POSTS-->
                        <div class="col-sm-4">
<!--EDIT POST-->
                            <div class="red-circle img-fluid">
                            <?php
                            $profile_picture="user-placeholder.png";
                            if (!empty($runlog['profile_picture'])   ){
                                $profile_picture= $runlog['profile_picture'];
                            }
                             ?>
                                <a href="http://pacer.carlabardwell.com/profile.php?id=<?=$runlog['user_id']?>">
                                <img class="circle-image img-fluid" src="/assets/files/<?=$profile_picture?>" alt="user-profile-picture">
                                </a>
                            </div><!--.red-circle-->
                            <div class="run-post-stats">
                                <h3><?=$runlog['firstname']. ' ' . $runlog['lastname']?></h3>
                                <h5>RAN <?= ($runlog['rundistance'])?> KM IN <?= ($runlog['runhours'])?>:<?= ($runlog['runminutes'])?>:<?= ($runlog['runseconds'])?></h5>
                                <h4>
                                    <?php
                                    if( $runlog['user_id'] == $_SESSION['user_logged_in'] ){  //only runs for that post if owner user is logged in at the time
                                    ?>
                                    <span class="user-post-controls">
                                       <a class="btn delete-btn text-danger" href="/runlogs/delete.php?id=<?=$runlog['id']?>">
                                           <img class="x-icon img-responsive" src="/assets/files/x-lg.png" alt="delete-icon">
                                       </a>
                                    </span>
                                    <?php
                                    }
                                    ?>
                                         <span class="post-run-date-heart">
                                             <i class="fas fa-heart"></i><?=date('d-m-Y', $runlog['posted_date'] )?>
                                        </span>
                                    <?php
                                    if( $runlog['user_id'] == $_SESSION['user_logged_in'] ){  //only runs for that post if owner user is logged in at the time
                                    ?>
                                <span class="user-post-controls">
                                    <a href="/runlogs/edit.php?id=<?=$runlog['id']?>">
                                        <img class="pencil-icon img-responsive" src="/assets/files/pen-lg.png" alt="edit-icon">
                                    </a>
                                </span>
                                <?php
                                }
                                 ?>
                                </h4>
                            </div><!--.run-post-stats-->
                        </div><!--.col-md-4-->
                            <?php } //end foreach ?>
                    </div><!--.row-->
                    <div>
                        <h2 id="nice-profile">NICE!</h2>
                    </div>
                </div><!--.container-fluid #posts-feed-->
            </div><!--.col-md-9 ADD POSTS-->
        </div><!--#feed-row .row-->
    </div><!--.container-fluid #add-run-container-->


<?php
}else{ //else show login page

    require_once("../elements/signup-login-forms.php");

}
    require_once("../elements/footer.php");
