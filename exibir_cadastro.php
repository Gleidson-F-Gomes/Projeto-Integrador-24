<?php
$servername = "localhost";
$username = "root";
$password = ""; // Substitua pela senha do seu banco de dados
$dbname = "ClinicaSaude";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta para selecionar todos os registros da tabela Medicos
$sql = "SELECT id, nome, idade, email, especialidade FROM Medicos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastros de Médicos - Clínica Saúde</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 70%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        button {
            margin-top: 20px;
            background: #5cb85c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            display: block;
            width: 100%;
        }
        button:hover {
            background: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastros de Médicos</h1>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Idade</th><th>Email</th><th>Especialidade</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["nome"]."</td><td>".$row["idade"]."</td><td>".$row["email"]."</td><td>".$row["especialidade"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum cadastro encontrado</p>";
        }
        $conn->close();
        ?>
        <button onclick="voltarParaCadastro()">Voltar para Cadastro</button>
    </div>

    <script>
        function voltarParaCadastro() {
            window.location.href = 'index.html';
        }
    </script>
</body>
</html>
