<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RWG Profiles</title>
    <style>
        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .inline{
            display: inline-block;
        }
        .profile{
            box-shadow: 1px 1px;
            margin: 10px 0px;
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container col-5">
        @foreach($profiles as $profile)
            <section class="row profile">
                <div>
                    <img src="{{$profile['avatar']}}" style="height: 64px; width: 64px;" class="avatar">
                    <p class="inline">{{$profile['name']}},</p>
                    <p class="inline">{{$profile['title']}}</p>
                    <p>{{$profile['company']}}</p>
                </div>
                <p>{{$profile['bio']}}</p>

            </section>

        @endforeach
    </div>

</body>
</html>