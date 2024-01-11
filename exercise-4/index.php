<?php

class Student {
    public string $name;
    public float $grade;

    public function __construct(string $name, float $grade) {
        $this->name = $name;
        $this->grade = $grade;
    }
}

class Group {
    private array $students = [];

    public function addStudent(Student $student): void {
        $this->students[] = $student;
    }

    public function getAverageScore(): float {
        $totalScore = array_sum(array_map(fn($student) => $student->grade, $this->students));
        return count($this->students) ? $totalScore / count($this->students) : 0;
    }

    public function getStudents(): array {
        return $this->students;
    }

    public function removeStudent(Student $student): void {
        $this->students = array_filter($this->students, fn($s) => $s !== $student);
    }
}

function moveStudent(Student $student, Group $fromGroup, Group $toGroup): void {
    $fromGroup->removeStudent($student);
    $toGroup->addStudent($student);
}

// Create students for Group 1
$group1 = new Group();
$group1->addStudent(new Student("Thierry", 85));
$group1->addStudent(new Student("Jonasi", 90));
$group1->addStudent(new Student("Silvie", 92));
$group1->addStudent(new Student("Alec", 96));
$group1->addStudent(new Student("Luis", 851));
$group1->addStudent(new Student("Danté", 79));
$group1->addStudent(new Student("Kilian", 75));
$group1->addStudent(new Student("Jana", 89));
$group1->addStudent(new Student("Eduarda", 85));
$group1->addStudent(new Student("Pieter", 93));

// Create students for Group 2
$group2 = new Group();
$group2->addStudent(new Student("Monday", 75));
$group2->addStudent(new Student("Alex", 80));
$group2->addStudent(new Student("Lucas", 95));
$group2->addStudent(new Student("Becca", 76));
$group2->addStudent(new Student("Severin", 79));
$group2->addStudent(new Student("Funda", 88));
$group2->addStudent(new Student("Anaïs", 85));
$group2->addStudent(new Student("Tibault", 80));
$group2->addStudent(new Student("Alessandro", 96));
$group2->addStudent(new Student("Kelsey", 89));

// Show initial averages
echo "Initial Average of Group 1: " . $group1->getAverageScore() . "\n" . "<br>" . "<br>";
echo "Initial Average of Group 2: " . $group2->getAverageScore() . "\n";
