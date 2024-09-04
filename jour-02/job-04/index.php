<?php
function getPDOConnection() {
    $host = 'localhost';
    $db = 'lp_official';
    $user = 'root';
    $pass = '';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}

function find_all_students_grades(): array {
    $pdo = getPDOConnection();
    $query = "
        SELECT email, fullname, name AS grade_name 
        FROM student 
        JOIN grade ON student.grade_id = grade.id
    ";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$studentsGrades = find_all_students_grades();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants et promotions</title>
</head>
<body>
    <h1>Liste des étudiants et de leurs promotions</h1>
    <table border="3">
        <thead>
            <tr>
                <th>Email</th>
                <th>Nom complet</th>
                <th>Etude</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studentsGrades as $student): ?>
                <tr>
                    <td><?= $student['email'] ?></td>
                    <td><?= $student['fullname'] ?></td>
                    <td><?= $student['grade_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
