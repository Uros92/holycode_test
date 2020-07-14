<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        hr {
            margin: 20px 0;
            border: 3px solid #f00;
        }
    </style>
</head>
<body>


<div class="row">
    <div class="col-12 text-center" id="wrapper">

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>
    $.get("/countries", function (data) {
        $.each(data, function (i, item) {
            $('#wrapper').append('<div class="form-group">Country: ' + item.name + '</div>');
            $('#wrapper').append('<div class="form-group">Country description: <br><br>' + item.country_description + '</div>');

            $('#wrapper').append('<p>Trending Videos (clickable):</p>');
            $.each(item.videos, function (i, item) {
                $('#wrapper').append('<a href="' + item.video_url + '" target="_blank"><img src="' + item.thumbnails_medium.url + '"></img></a>');
            });

            $('#wrapper').append('<hr>');
        })
    });
</script>
</body>
</html>
