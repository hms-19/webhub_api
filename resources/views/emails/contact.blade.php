<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webhub Myanmar</title>
</head>
<body>


    @component('mail::header')
    <h2>Hello WHM,</h2>
    <p>
        There is an email getting from <a href="webhubmm.com">webhubmm.com</a>
    </p>
    @endcomponent

    @component('mail::message')
    <p>
        <strong>$data['name']</strong> are sent from <a href="mailto:{{ $data['email'] }}">webhubmm.com</a>
        <p>Phone - {{ $data['phone'] }}</p>
    </p>
    @endcomponent

    <br>

    @component('mail::message')


        <p>
           {{ $data['message']}}
        </p>

    @endcomponent

    @component('mail::footer')
        <small>Webhub Myanmar</small>
    @endcomponent
</body>
</html>
