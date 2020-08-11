<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <link  href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
</head>
<body>
    <section id="conteudo-view" class=login>

    <h1>Login</h1>

    {!! Form::open(['route'=> 'user.login','method' => 'post']) !!}
    <label>Usuário</label><br />
    <label>{!! Form::text('username',null)!!}</label><br />
    <label>Senha</label><br />
    <label>{!! Form::password('password')!!}</label><br/>
    
    {!! Form::submit('Entrar')!!}

    <a href="{{ url('/') }}">Esqueceu sua senha? </a> <br />

    <p> Não possui conta?<p>
    <a href="{{ url('/register') }}">Clique Aqui</a>
    
    {!! Form::close()!!}

    </section>
</body>
</html>