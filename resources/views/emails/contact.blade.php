<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webhub</title>
    <style>

        .header{
            width: 100%;
            padding: 10px;
        }

        .header img{
            width: 40px;
            height: 56px;
            display: block;
            margin: auto
        }

        .header p{
            text-align: left;
            color: #444
        }

        .body{
            margin: 10px;
            width: 100%;
        }

        .body div{
            padding: 10px
        }

        .title{
            padding: 10px;
            width: 100%;
            background-color: #7209B7;
            color: #fff
        }

        .content{
            padding: 10px;
            text-align: left;
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="https://api.webhubmm.com/logo.png" alt="LOGO"> <br>
        <p>Received an email from webhub contact form Webhub</p>
    </div>
    <div class="body">
        <div>
            <p class="title">Name</p>
            <p class="content">
                {{ $data['name'] }}
            </p>
        </div>
        <div>
            <p class="title">Email</p>
            <p class="content">
                {{ $data['email'] }}
            </p>
        </div>
        <div>
            <p class="title">Phone</p>
            <p class="content">
                {{ $data['phone'] }}
            </p>
        </div>
        <div>
            <p class="title">Message</p>
            <p class="content">
                {{ $data['message'] }}
            </p>
        </div>
    </div>
</body>
</html>
