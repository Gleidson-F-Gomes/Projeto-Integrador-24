<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ClinicaSaude";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Insere dados no banco de dados quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $especialidade = $_POST['especialidade'];

    $sql = "INSERT INTO Medicos (nome, idade, email, especialidade)
    VALUES ('$nome', $idade, '$email', '$especialidade')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo cadastro criado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Exibe os cadastros
$sql = "SELECT id, nome, idade, email, especialidade FROM Medicos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Cadastros de Médicos</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Nome</th><th>Idade</th><th>Email</th><th>Especialidade</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["nome"]."</td><td>".$row["idade"]."</td><td>".$row["email"]."</td><td>".$row["especialidade"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum cadastro encontrado";
}

$conn->close();
?>
