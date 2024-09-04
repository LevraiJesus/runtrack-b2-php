<?php
function getPDOConnection() {
    $host = 'localhost';
    $db = 'lp_official';
    $user = 'root';
    $pass = '';

    return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
}

function find_ordered_students() {
    $pdo = getPDOConnection();

    $query = "
    SELECT 
        grade.name AS grade_name, 
        student.fullname, 
        student.birthdate, 
        student.email
    FROM grade
    LEFT JOIN student ON student.grade_id = grade.id
    ORDER BY grade.name;
    ";

    $stmt = $pdo->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $grades = [];

    foreach ($results as $row) {
        $gradeName = $row['grade_name'];

        $grades[$gradeName][] = [
            "fullname" => $row['fullname'],
            "birthdate" => $row['birthdate'],
            "email" => $row['email']
        ];
    }

    uasort($grades, function($a, $b) {
        return count($b) - count($a);
    });

    $output ='';
    foreach ($grades as $gradename => $students) {
        $output .= "<h3>$gradename</h3>";
        foreach ($students as $student) {
            $output .= "full Name: " . ($student ['fullname']) . "<br>";
            $output .= "birthdate: " . ($student ['birthdate']) . "<br>";
            $output .= "email: " . ($student ['email']) . "<br><br>";
        }
    }

    return $output;
}
$grades = find_ordered_students();
echo $grades;
