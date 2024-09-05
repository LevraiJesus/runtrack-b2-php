<?php
class Room {
    private int $id;
    private int $floor_id;
    private string $name;
    private int $capacity;

    public function __construct(
        int $id = 0,
        int $floor_id = 0,
        string $name = "",
        int $capacity = 0
    ) {
        $this->id = $id;
        $this->floor_id = $floor_id;
        $this->name = $name;
        $this->capacity = $capacity;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): static {
        $this->id = $id;
        return $this;
    }

    public function getFloorId(): int {
        return $this->floor_id;
    }

    public function setFloorId(int $floor_id): static {
        $this->floor_id = $floor_id;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;
        return $this;
    }

    public function getCapacity(): int {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static {
        $this->capacity = $capacity;
        return $this;
    }
    public function getGrades(): ?array {
        $pdo = getPDOconnection(); 
        $query = $pdo->prepare("SELECT * FROM grade WHERE id IN (SELECT grade_id FROM student WHERE room_id = :room_id)");
        $query->execute(['room_id' => $this->id]);

        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $grades = [];

        if ($results) {
            foreach ($results as $result) {
                $grades[] = new Grade(
                    $result['id'],
                    $result['level'],
                    $result['name'],
                    new DateTime($result['startDate'])
                );
            }
        }

        return $grades;
    }
}
