<?php
class Grade {
    private int $id;
    private int $level;
    private string $name;
    private DateTime $startDate;
    public function __construct(
        int $id = 0,
        int $level = 0,
        string $name = "",
        DateTime $startDate = null
    ) {
        $this->id = $id;
        $this->level = $level;
        $this->name = $name;
        $this->startDate = $startDate ?: new DateTime();
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): static {
        $this->id = $id;
        return $this;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function setLevel(int $level): static {
        $this->level = $level;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;
        return $this;
    }

    public function getStartDate(): DateTime {
        return $this->startDate;
    }

    public function setStartDate(DateTime $startDate): static {
        $this->startDate = $startDate;
        return $this;
    }

    public function getStudent(): ?array {
        $pdo = getPDOconnection();
        $query = $pdo->prepare("SELECT * FROM student WHERE grade_id = :grade_id");
        $query->execute(['grade_id' => $this->id]);

        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $students = [];

        if ($results) {
            foreach ($results as $result) {
                $students[] = new Student(
                    $result['id'],
                    $result['grade_id'],
                    $result['email'],
                    $result['fullname'],
                    new DateTime($result['birthdate']),
                    $result['gender']
                );
            }
        }

        return $students;
    }
}
