$(document).ready(function(){

    // $(function () {
    //     $('#timepicker').datetimepicker();
    // });
    //

    $('.delete-btn').click(function(){
        if( !confirm('Are you sure that you want to delete this?') ){
            return false;
        }


    });





}); // END DOCUMENT READY


function previewFile() {

    var preview = document.getElementById('profile-picture-edit-image'); //this is the raw javascript way to select and element by its ID , this is the image tag above input
    var file = document.getElementById ('file-with-preview').files[0]; //this is our file input


    var reader = new FileReader(); //this is an object that has a property in it called onloadend- this is taking the result of this reader and storing it into the preview.src

    reader.onloadend = function(){
        preview.src = reader.result;
    }

    if(file) {
        reader.readAsDataURL(file);
    }else{
        preview.src ="";
    }
}
