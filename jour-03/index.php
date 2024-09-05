<?php
require_once 'functions.php';
require_once 'class/Student.php';
require_once 'class/Grade.php';
require_once 'class/Room.php';
require_once 'class/Floor.php';

$student1 = new Student(1, 1, "email@email.com", "Terry Cristinelli", new DateTime("1990-01-18"), "male");
$student2 = new Student();

echo "Student 1 ID: " . $student1->getId() . "<br>";
echo "Student 1 Email: " . $student1->getEmail() . "<br>";
echo "Student 1 Fullname: " . $student1->getFullname() . "<br>";
echo "Student 1 Birthdate: " . $student1->getBirthdate()->format('Y-m-d') . "<br>";
echo "Student 1 Gender: " . $student1->getGender() . "<br><br>";

echo "Student 2 ID: " . $student2->getId() . "<br>";
echo "Student 2 Email: " . $student2->getEmail() . "<br>";
echo "Student 2 Fullname: " . $student2->getFullname() . "<br>";
echo "Student 2 Birthdate: " . $student2->getBirthdate()->format('Y-m-d') . "<br>";
echo "Student 2 Gender: " . $student2->getGender() . "<br><br>";

$grade1 = new Grade(1, 8, "Bachelor 1", new DateTime("2023-01-09"));
$grade2 = new Grade();

echo "Grade 1 ID: " . $grade1->getId() . "<br>";
echo "Grade 1 Level: " . $grade1->getLevel() . "<br>";
echo "Grade 1 Name: " . $grade1->getName() . "<br>";
echo "Grade 1 Start Date: " . $grade1->getStartDate()->format('Y-m-d') . "<br><br>";

echo "Grade 2 ID: " . $grade2->getId() . "<br>";
echo "Grade 2 Level: " . $grade2->getLevel() . "<br>";
echo "Grade 2 Name: " . $grade2->getName() . "<br>";
echo "Grade 2 Start Date: " . $grade2->getStartDate()->format('Y-m-d') . "<br><br>";

$room1 = new Room(1, 1, "RDC Food and Drinks", 90);
$room2 = new Room();

echo "Room 1 ID: " . $room1->getId() . "<br>";
echo "Room 1 Floor ID: " . $room1->getFloorId() . "<br>";
echo "Room 1 Name: " . $room1->getName() . "<br>";
echo "Room 1 Capacity: " . $room1->getCapacity() . "<br><br>";

echo "Room 2 ID: " . $room2->getId() . "<br>";
echo "Room 2 Floor ID: " . $room2->getFloorId() . "<br>";
echo "Room 2 Name: " . $room2->getName() . "<br>";
echo "Room 2 Capacity: " . $room2->getCapacity() . "<br><br>";

$floor1 = new Floor(1, "Rez-de-chaussée", 0);
$floor2 = new Floor();

echo "Floor 1 ID: " . $floor1->getId() . "<br>";
echo "Floor 1 Name: " . $floor1->getName() . "<br>";
echo "Floor 1 Level: " . $floor1->getLevel() . "<br><br>";

echo "Floor 2 ID: " . $floor2->getId() . "<br>";
echo "Floor 2 Name: " . $floor2->getName() . "<br>";
echo "Floor 2 Level: " . $floor2->getLevel() . "<br>";


$room = findOneRoom(1); 
if ($room) {
    $grades = $room->getGrades();
    echo "Grades associés à la salle " . $room->getName() . " :<br>";
    if (!empty($grades)) {
        foreach ($grades as $grade) {
            echo "Nom : " . $grade->getName() . "<br>";
        }
    } else {
        echo "Aucune promotion trouvée pour cette salle.";
    }
}

$floor = findOneFloor(1); 
if ($floor) {
    $rooms = $floor->getRooms();
    echo "Salles associées à l'étage " . $floor->getName() . " :<br>";
    if (!empty($rooms)) {
        foreach ($rooms as $room) {
            echo "Nom de la salle : " . $room->getName() . "<br>";
        }
    } else {
        echo "Aucune salle trouvée pour cet étage.";
    }
}
