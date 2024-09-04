<?php
function find_one_student(string $email): array {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("SELECT * FROM student WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}
function getPDOConnection() {
    $host = 'localhost';
    $db = 'lp_official';
    $user = 'root';
    $pass = '';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'étudiant</title>
</head>
<body>
    <h1>Rechercher un étudiant</h1>
    <form method="get">
        <input type="text" name="input-email-student">
        <button type="submit">Rechercher</button>
    </form>

    <?php
    if (isset($_GET['input-email-student'])) {
        $email = $_GET['input-email-student'];
        $student = find_one_student($email);
        
        if ($student) {
            echo '<h2>Informations de l\'étudiant</h2>';
            echo '<table border="3">';
            echo '<tr><th>ID</th><th>Nom</th><th>Email</th><th>Date de naissance</th><th>Genre</th></tr>';
            echo '<tr>';
            echo '<td>' . htmlspecialchars($student['id']) . '</td>';
            echo '<td>' . htmlspecialchars($student['fullname']) . '</td>';
            echo '<td>' . htmlspecialchars($student['email']) . '</td>';
            echo '<td>' . htmlspecialchars($student['birthdate']) . '</td>';
            echo '<td>' . htmlspecialchars($student['gender']) . '</td>';
            echo '</tr>';
            echo '</table>';
        }
        
    }
    ?>
</body>
</html>
