$(document).ready(function () {

$('#file').change(function () {
    $('#movie_input_warapper').css('display' , 'none');
    $('#movie_property').css('display' , 'block');

    var movie=this.files[0];
    var movieName=movie.name.split('.').slice(0 , -1).join('.');

    console.log(movieName)

    $('#movie_name').val(movieName)


})


});