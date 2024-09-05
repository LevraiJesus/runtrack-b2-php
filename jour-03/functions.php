<?php
function getPDOConnection() {
    $host = 'localhost';
    $db = 'lp_official';
    $user = 'root';
    $pass = '';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}
function findOneStudent(int $id): ?Student {
    $pdo = getPDOconnection();
    $query = $pdo->prepare("SELECT * FROM student WHERE id = :id");
    $query->execute(['id' => $id]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Student(
            $result['id'],
            $result['grade_id'],
            $result['email'],
            $result['fullname'],
            new DateTime($result['birthdate']),
            $result['gender']
        );
    }
    return null;
}
function findOneGrade(int $id): ?Grade {
    $pdo = getPDOconnection();
    $query = $pdo->prepare("SELECT * FROM grade WHERE id = :id");
    $query->execute(['id' => $id]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Grade(
            $result['id'],
            $result['level'],
            $result['name'],
            new DateTime($result['startDate'])
        );
    }
    return null;
}
function findOneRoom(int $id): ?Room {
    $pdo = getPDOconnection();
    $query = $pdo->prepare("SELECT * FROM room WHERE id = :id");
    $query->execute(['id' => $id]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Room(
            $result['id'],
            $result['floor_id'],
            $result['name'],
            $result['capacity']
        );
    }
    return null;
}
function findOneFloor(int $id): ?Floor {
    $pdo = getPDOconnection();
    $query = $pdo->prepare("SELECT * FROM floor WHERE id = :id");
    $query->execute(['id' => $id]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return new Floor(
            $result['id'],
            $result['name'],
            $result['level']
        );
    }
    return null;
}

