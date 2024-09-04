<?php
function getPDOConnection() {
    $host = 'localhost';
    $db = 'lp_official';
    $user = 'root';
    $pass = '';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}

function find_full_rooms() {
    $pdo = getPDOConnection();

    $query = "
    SELECT room.name, 
           room.capacity, 
           (SELECT COUNT(*) FROM student) AS student_count,
           CASE 
               WHEN (SELECT COUNT(*) FROM student) >= room.capacity THEN 'oui'
               ELSE 'non'
           END AS is_full
    FROM room;
    ";

    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$rooms = find_full_rooms();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Salles</title>
</head>
<body>
    <h1>Liste des Salles</h1>
    <table border="3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Capacité</th>
                <th>Est pleine ?</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= $room['name'] ?></td>
                    <td><?= $room['capacity'] ?></td>
                    <td><?= $room['is_full'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>