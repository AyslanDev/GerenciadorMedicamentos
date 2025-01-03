<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Medicamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2 style="margin-bottom: 20px">Relatório geral</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Entradas</th>
                <th>Saídas</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($query as $medicamento)
                <tr>
                    <td>{{ $medicamento->nome }}</td>
                    <td>{{ $medicamento->entradas }}</td>
                    <td>{{ $medicamento->saidas }}</td>
                    <td>{{ $medicamento->entradas - $medicamento->saidas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2>Relatório detalhado</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Entradas</th>
                <th>Saídas</th>
                <th>Data</th>
                <th>UBS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($queryDetail as $medicamento)
                <tr>
                    <td>{{ $medicamento->nome }}</td>
                    <td>{{ $medicamento->entradas }}</td>
                    <td>{{ $medicamento->saidas }}</td>
                    <td>{{ \Carbon\Carbon::parse($medicamento->created_at)->format('d/m/Y') }}</td>
                    <td>{{ $medicamento->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
