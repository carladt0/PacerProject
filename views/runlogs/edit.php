<?php  require_once("../../core/includes.php");

if(!empty($_GET) ){ //check if URL has id in it

    $r = new Runlog; //going to the whole project.php in models folder and grabbing all the code from the project class and putting it into the variable $p. Create a function inside that is going to the database and getting info, get_by_id is the function, which we now have to create (this function takes a number as an id for the project and goes and gets the rest of the information)
    $runlog = $r->get_by_id($_GET['id']); //this pulls the number from the URL, and passes it into the function

        if(!empty($_POST)) { //check if form was submitted
            $r->edit($_GET['id']);
            header("Location: /");
            exit();
        }

    }else{
    header("Location:/"); //if nothing in URL, redirect to homepage
    exit();
    }



    // unique html head vars
    $title = 'Edit Runlog';
    require_once("../../elements/html_head.php");
    require_once("../../elements/nav.php");




?>

    <div class="container">

        <div class="row"> <!--to make a post feed and search bar now-->

            <div class="col-md-8"><!--now we are making bootstrap cards and putting a form inside the cards, so we have posts and then above we have a form to add new posts-->
                <div class="card edit-card mt-3">
                    <div class="card-header">
                        <h4>EDIT RUNLOG FOR <?=strtoupper(date('d-M-Y', $runlog['posted_date']) )?> </h4>
                        <div class="card-body">
                            <form method="post">
                                <div id="form-edit" class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="edit-form-label">DISTANCE RAN (IN KM):</label>
                                        </div><!--.col-md-6-->
                                        <div class="col-md-6">
                                            <input id="edit-run-distance" class="form-red" type="number" name="rundistance" value=<?=$runlog['rundistance']?> step=".01">
                                        </div><!--.col-md-6-->
                                    </div>
                                <div id="form-edit" class="form-group">
                                    <div id="form-row" class="row">
                                        <div class="col-md-6">
                                            <label class="edit-form-label">TIME RAN (HH:MM:SS):</label>
                                        </div><!--.col-md-6-->
                                        <div class="col-md-6">
                                            <input id="runtime-edit" class="form-red" type="number" name="runhours" value=<?=$runlog['runhours']?>>
                                            <input id="runtime-edit"  class="form-red" type="number" name="runminutes" value=<?=$runlog['runminutes']?>>
                                            <input id="runtime-edit"  class="form-red" type="number" name="runseconds" value=<?=$runlog['runseconds']?>>
                                        </div><!--.col-md-6-->
                                </div><!--.row-->
                                </div>
                                <input class="btn btn-add-run btn-edit-run float-right" type="submit" value="SUBMIT RUN">
                            </form>

                        </div><!--.card-body-->
                    </div><!--.card-header-->
                </div><!--.card-->


            </div><!--.col-md-8-->
        </div><!--.row-->

    </div><!-- .container -->

<?php require_once("../../elements/footer.php");
