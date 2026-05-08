<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gráfico</title>
</head>
<body>

<h1>Pedidos por Cliente</h1>

<div>
    {!! $chart->container() !!} 
</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}

</body>
</html>