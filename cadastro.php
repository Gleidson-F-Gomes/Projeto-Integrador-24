<?php
session_start();

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

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $especialidade = $_POST['especialidade'];

    // Prepara a instrução SQL para inserir os dados
    $stmt = $conn->prepare("INSERT INTO Medicos (nome, idade, email, especialidade) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $nome, $idade, $email, $especialidade);

    // Executa a instrução e verifica se deu certo
    if ($stmt->execute()) {
        // Fecha a instrução e a conexão
        $stmt->close();
        $conn->close();
        // Define a mensagem de sucesso na sessão
        $_SESSION['success_message'] = "Cadastro realizado com sucesso!";
        // Redireciona para a página inicial de cadastro
        header("Location: index.html");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fecha a instrução e a conexão
    $stmt->close();
    $conn->close();
}
?>
