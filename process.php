<?php

$dbPath = "sqlite.db";
$conn = new SQLite3($dbPath);

// Verificar a conexão
// if (!$conn) {
//     die("Conexão falhou");
// } else {
//     echo "Conexão bem-sucedida";
// }

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obter dados do formulário
    $exp = $_POST["exp"];
    $difficulty = $_POST["difficulty"];
    $visual_appeal = $_POST["visual-appeal"];
    $site_objective = $_POST["site-objective"];
    $recommendation = $_POST["recommendation"];
    $most_useful = $_POST["most-useful"];
    $suggestions = $_POST["suggestions"];

    // Preparar e executar a declaração SQL para inserir dados no banco de dados
    $stmt = $conn->prepare("INSERT INTO feedback_CdS (exp, difficulty, visual_appeal, site_objective, recommendation, most_useful, suggestions) VALUES (:exp, :difficulty, :visual_appeal, :site_objective, :recommendation, :most_useful, :suggestions)");
    

    // Vincular parâmetros
    $stmt->bindParam(':exp', $exp, SQLITE3_INTEGER);
    $stmt->bindParam(':difficulty', $difficulty, SQLITE3_TEXT);
    $stmt->bindParam(':visual_appeal', $visual_appeal, SQLITE3_INTEGER);
    $stmt->bindParam(':site_objective', $site_objective, SQLITE3_TEXT);
    $stmt->bindParam(':recommendation', $recommendation, SQLITE3_TEXT);
    $stmt->bindParam(':most_useful', $most_useful, SQLITE3_TEXT);
    $stmt->bindParam(':suggestions', $suggestions, SQLITE3_TEXT);

    // Executar a declaração
    $result = $stmt->execute();

    // if (!$result) {
    //     die("Erro ao executar a declaração: " . $stmt->lastErrorMsg());
    // }

    if ($result) {
        header('location: /fin.html');
    } else {
        echo "Erro ao enviar feedback";
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
