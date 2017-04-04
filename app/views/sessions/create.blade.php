<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8"/>


    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/login.css"/>
    <style>
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</head>
<body>
<div class="login-page">
    <div class="form">
        {{ Form::open(['route'=> 'sessions.store','class' => 'login-form']) }}
        {{ Form::email('email', Input::old('email'), array('placeholder' => 'Correo','id' => 'mail','required','autofocus')) }}
        {{ Form::password('password',array('placeholder' => 'Contraseña', 'id' => 'pass' ,'required')) }}
        <button>login</button>
        @if(Session::has('error'))
            <p class="message">{{Session::get('error')}}</p>
        @endif
        {{ Form::close() }}
    </div>
</div>
    <script>
        $('.message a').click(function () {
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
    </script>
</body>
</html>
