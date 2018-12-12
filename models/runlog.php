<?php

class Runlog extends Db {

    function get_all(){

        if(!empty($_GET['search']) ){

            $search = $this->params['search'];

            $sql = "SELECT runlogs.*, users.username, users.firstname, users.lastname, users.profile_picture FROM runlogs LEFT JOIN users ON runlogs.user_id = users.id WHERE CONCAT(users.firstname, ' ', users.lastname) LIKE '%$search%' ORDER BY runlogs.posted_date DESC LIMIT 9";

        }else{ //they are not searching anything
            $sql = "SELECT runlogs.*, users.username, users.firstname, users.lastname, users.profile_picture FROM runlogs LEFT JOIN users ON runlogs.user_id = users.id ORDER BY runlogs.posted_date DESC LIMIT 9"; //this posted_time makes sure the posts are in order - the projects. tells it which table it is coming from, seeing as we are referencing two tables. individually reference columns you want to avoid columns overlapping and override.
        }

        $runlogs = $this->select($sql);

        return $runlogs; //

    }



    function add(){

        $rundistance = $this->data['rundistance'];
        $runhours = $this->data['runhours']; //projects and users have a one to many relationship (therefore we need one more column in our table to reflect this, to keep track of who uploaded that project- put user_id as another column in table)
        $runminutes = $this->data['runminutes'];
        $runseconds = $this->data['runseconds'];
        $user_id = (int)$_SESSION['user_logged_in']; //this user_logged_in holds the id of the person logged in (its they key) - int makes sure its a numeric number (integer) -allows us to not use the $this->data because there are no weird characters in integers, so we dont need to protect from injection (works the same, just the lazy way)
        $current_time = time();  //spits out unix timestamp of current time

        $sql = "INSERT INTO runlogs (rundistance, runhours, runminutes, runseconds, posted_date, user_id) VALUES ('$rundistance', '$runhours', '$runminutes', '$runseconds', '$current_time', '$user_id')"; //first set is the column titles, second set is the values set above- make sure order matches order in db

        $this->execute($sql);

    }

    function get_total_run_distance($id){

        $id = (int)$id;
        $sql = "SELECT rundistance FROM runlogs WHERE user_id='$id'";

        $runlogs = $this->select($sql);

        $total_run_distance = 0;
        foreach ($runlogs as $runlog){

            $total_run_distance = $total_run_distance+$runlog['rundistance'];

        }
        return $total_run_distance;

    }

    function get_total_run_hours($id){

        $id = (int)$id;
        $sql = "SELECT runhours FROM runlogs WHERE user_id='$id'";

        $runlogs = $this->select($sql);

        $total_run_hours = 0;
        foreach ($runlogs as $runlog){

            $total_run_hours = $total_run_hours + $runlog['runhours'] + intdiv($runlog['runminutes'],60);

        }
        return $total_run_hours;

    }

    function get_by_id($id){ //this function grabs users information
        $id = (int)$id; //this is typecasting - if on the off chance a string got in here instead of a number, it will force it to be a number (SQL injection prevention), stored in $id
        $sql = "SELECT * FROM runlogs WHERE id = '$id'"; //change from users to projects for this case if copied from users

        $runlog = $this->select($sql)[0]; //sql only brings back one from database, so we need to put a number

        return $runlog; //brings it back
    }

    function get_by_user_id($id){ //this function grabs users information
        $id = (int)$id; //this is typecasting - if on the off chance a string got in here instead of a number, it will force it to be a number (SQL injection prevention), stored in $id
        $sql = "SELECT * FROM runlogs WHERE user_id = '$id'"; //change from users to projects for this case if copied from users

        $runlogs = $this->select($sql); //sql only brings back one from database, so we need to put a number

        return $runlogs; //brings it back
    }





function edit($id){

    $id = (int)$id;
    $this->check_ownership($id); //this runs the ownership function (making sure that the user owns the post thats being edited)

    $rundistance = $this->data['rundistance']; //we are grabing the data from the form and storing each in its own variable
    $runhours = $this->data['runhours'];
    $runminutes = $this->data['runminutes'];
    $runseconds = $this->data['runseconds'];
    $current_user_id = (int)$_SESSION['user_logged_in'];


    $sql = "UPDATE runlogs SET rundistance='$rundistance', runhours='$runhours', runminutes='$runminutes', runseconds='$runseconds' WHERE id='$id' AND user_id='$current_user_id'";
    $this->execute($sql);

    }




function delete(){

    $current_user_id = (int)$_SESSION['user_logged_in'];
    $id=(int)$_GET['id'];
    $this->check_ownership($id);


    $sql ="DELETE FROM runlogs WHERE id='$id' AND user_id='$current_user_id'";
    $this->execute($sql);
}





function check_ownership($id){

    $id = (int)$id;

    $sql = "SELECT * FROM runlogs WHERE id = '$id'";

    $runlog = $this->select($sql)[0];//send it off

    if($runlog['user_id'] == $_SESSION['user_logged_in'] ){//user is editing project they own
        return true;
    }else{
        header("Location: /");
        exit();
    }

}
}
