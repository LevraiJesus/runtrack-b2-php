<?php
function getPDOConnection() {
    $host = 'localhost';
    $db = 'lp_official';
    $user = 'root';
    $pass = '';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}
function insert_students(string $email, string $fullname, string $gender, DateTime $birthdate, int $grade_Id): void {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("INSERT INTO student (email, fullname, gender, birthdate, grade_Id) VALUES (:email, :fullname, :gender, :birthdate, :grade_id)");

    try {
        $stmt->execute([
            ':email' => $email,
            ':fullname' => $fullname,
            ':gender' => $gender,
            ':birthdate' => $birthdate->format('Y-m-d'),
            ':grade_id' => $grade_Id
        ]);
        echo "L'étudiant a été ajouter avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'étudiant";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['input-email'];
    $fullname = $_POST['input-fullname'];
    $gender = $_POST['input-gender'];
    $birthdate = $_POST['input-birthdate'];
    $gradeId = $_POST['input-grade_id'];

    $birthdateFormat = DateTime::createFromFormat('Y-m-d', $birthdate);

    if ($email && $fullname && $gender && $birthdateFormat && $gradeId !== false) {
        insert_students($email, $fullname, $gender, $birthdateFormat, $gradeId);
    } else {
        echo "Veuillez remplir correctement tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer un étudiant</title>
</head>
<body>
    <h1>Ajouter un étudiant</h1>
    <form method="post" action="index.php">
        <label for="input-email">Email :</label>
        <input type="email" name="input-email" id="input-email" required>
        <label for="input-fullname">Prénom-Nom :</label>
        <input type="text" name="input-fullname" id="input-fullname" required>
        <label for="input-gender">Sexe :</label>
        <select name="input-gender" id="input-gender" required>
            <option value="male">Homme</option>
            <option value="female">Femme</option>
        </select>
        <label for="input-birthdate">Date de naissance :</label>
        <input type="date" name="input-birthdate" id="input-birthdate" required>
        <label for="input-grade_id">Étude :</label>
        <input type="number" name="input-grade_id" id="input-grade_id" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
