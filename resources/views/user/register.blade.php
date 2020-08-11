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

    {!! Form::open(['route'=> 'user.register','method' => 'post']) !!}
    <label>Nome</label><br />
    <label>{!! Form::text('name',null)!!}</label><br />
    <label>Email</label><br />
    <label>{!! Form::text('email',null)!!}</label><br />
    <label>Telefone</label><br />
    <label>{!! Form::text('phone',null)!!}</label><br />
    <label>Senha</label><br />
    <label>{!! Form::password('password')!!}</label><br/>
    <label>Repetir Senha</label><br />
    <label>{!! Form::password('password')!!}</label><br/>
    
    {!! Form::submit('Cadastrar')!!}
    
    {!! Form::close()!!}

    </section>
</body>
</html>