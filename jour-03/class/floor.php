<?php
class Floor {
    private int $id;
    private string $name;
    private int $level;

    public function __construct(
        int $id = 0,
        string $name = "",
        int $level = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->level = $level;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): static {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;
        return $this;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function setLevel(int $level): static {
        $this->level = $level;
        return $this;
    }
    public function getRooms(): ?array {
        $pdo = getPDOconnection();
        $query = $pdo->prepare("SELECT * FROM room WHERE floor_id = :floor_id");
        $query->execute(['floor_id' => $this->id]);

        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $rooms = [];

        if ($results) {
            foreach ($results as $result) {
                $rooms[] = new Room(
                    $result['id'],
                    $result['floor_id'],
                    $result['name'],
                    $result['capacity']
                );
            }
        }

        return $rooms;
    }
}