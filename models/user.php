<?php
class User extends Db {

    // function get_all(){
    //
    //     $sql = "SELECT * FROM `users`";
    //
    //     $users = $this->select($sql);
    //
    //     return $users;
    //
    // }

    function get_by_id($id){ //this function grabs users information
        $id = (int)$id; //this is typecasting - if on the off chance a string got in here instead of a number, it will force it to be a number (SQL injection prevention)
        $sql = "SELECT * FROM users WHERE id = '$id'";

        $user = $this->select($sql)[0]; //only bringing back one, so we need to put a number

        return $user;
    }


    function add(){
        $username = trim($this->data['username']); //makes it so we dont have to use the mysqli_real_escape_string just by using $this->data
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); //to create a hashed version of what the user typed, dont need to prevent injection because the hashed password cant be understood through injection
        $firstname = trim($this->data['firstname']); //same value as name=
        $lastname= trim($this->data['lastname']);
        $email = trim($this->data['email']);
        $location = trim($this->data['location']);
        $created_time = time();



        $sql = "INSERT INTO users (username, password, firstname, lastname, email, location, created_time) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$location', '$created_time')";


        //$this->execute($sql); //this function takes whatever is in the form and submits it on the database (there is another version of the execute function baked into the mini framework, in core, db.php- execute_return_id - exactly the same, but after its done running it takes the last ID inserted into the db and brings it back from the record in the database and enters this in- exchanged below) -run execute function for add, delete and create. there is a function called select that is specifically for select.
        $new_user_id = $this->execute_return_id($sql);

        return $new_user_id;

    }

    function exists(  ){
        $username = $this->data['username'];

        $sql="SELECT * FROM users WHERE username = '$username'";

        $user = $this->select($sql);

        return $user; //this is a function to check if the user exists

    }

    function login(){
        $_SESSION = array(); //Empty session to start fresh.

        //Get the user's details from the db and store it in a variable

        $username = $this->data['username'];
        $sql = "SELECT * FROM users WHERE username = '$username'";

        $user = $this->select($sql)[0];


        //check if the password from the form matches the password from //

        if(password_verify($_POST['password'], $user['password'])  ){
            $_SESSION['user_logged_in'] = $user['id'];


        }else{ //login attempt failed.
            $_SESSION['login_attempt_msg'] = '<p class="text-danger">*Incorrect username and/or password</p>';


        }
    }
    function edit(){

        $id = (int)$_SESSION['user_logged_in'];
        $username = trim($this->data['username']);
        $password = password_hash(trim($this->data['password']), PASSWORD_DEFAULT);
        $firstname = trim($this->data['firstname']);
        $lastname = trim($this->data['lastname']);
        $email = trim($this->data['email']);
        $location = trim($this->data['location']);

        $file_query = '';

        if(!empty($_FILES['fileToUpload']['name']) ){ //$_FILES is similar to post, created when a form is submitted with a file - checking to see if there is a filename that is associated - ***this section is checking if there is a new file submitted
            //in order to upload an image, we need to delete the old image and information - needs to be overrided
            $util = new Util; //upload the file that is in this array (function file_upload detects if there's something in the $_FILES array, if there is it will upload it. Key fileToUpload. Returns what filename was.)
            $filename = $util->file_upload(); //$filename holds name of file as a string

            $file_query=", profile_picture='$filename'";

        }


        if (!empty(trim($_POST['password'])) ){ //trim gets rid of space infront and behind - here starts the NEW password entered, this only happens if they put in a new password, here we create and sql statement
            $sql ="UPDATE users SET username='$username', password='$password', firstname='$firstname', lastname='$lastname', email='$email', location='$location' $file_query WHERE id='$id'";
        }else{ //if no new password is entered
            $sql ="UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email', location='$location' $file_query WHERE id='$id'";
        }
        $this->execute($sql);

    }


}
