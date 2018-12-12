<?php require_once '../../core/includes.php';



if ( is_numeric($_POST['rundistance']) && is_numeric($_POST['runhours']) && is_numeric($_POST['runminutes']) && is_numeric($_POST['runseconds'])   ){ //form was submitted


    // Add new project to SQLiteDatabase
    $r = new Runlog;
    $r->add();


}

header("Location: /"); //to redirect user back to homepage after creating a new project in db (otherwise would stay on blank screen)
