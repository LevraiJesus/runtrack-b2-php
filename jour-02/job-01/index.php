<?php
function getPDOConnection() {
    $host = 'localhost';
    $db = 'lp_official';
    $user = 'root';
    $pass = '';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}

function find_all_students() : array {
    $pdo = getPDOConnection();
    $stmt = $pdo->query("SELECT * FROM student");
    return $stmt->fetchAll();
}
$students = find_all_students();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
</head>
<body>
    <h1>Liste des étudiants</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>email</th>
                <th>Prenom-Nom</th>
                <th>Date de naissance</th>
                <th>Genre</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                    <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($student['birthdate']); ?></td>
                    <td><?php echo htmlspecialchars($student['gender']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
