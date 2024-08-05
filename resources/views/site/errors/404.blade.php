<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f8f9fa;
            text-align: center;
            color: white;
            background-color: CornflowerBlue;
        }
        .error-container .error-content {
            max-width: 500px;
        }
        .btn btn-primary {
            background-color: RebeccaPurple	;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <h1 class="display-4">404</h1>
            <p class="lead">Desculpe, a página que você está procurando não foi encontrada.</p>
            <a href="{{ url('/') }}" class="btn btn-primary" style="background-color: MediumBlue;">Voltar para a página incial</a>
        </div>
    </div>
</body>
</html>
