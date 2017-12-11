<?php

//define our grade range

//include 'data.json';

class StudentResult {

    public $totalStudents;
    public $student;
    public $score = [];

    public $graded = [];


    public function __construct($file)
    {
        $handle = file_get_contents($file);
        $this->student = json_decode($handle);
        $this->totalStudents = count($this->student);
    }

    public function getScore() {
        for($i = 0; $i < $this->totalStudents; $i++) {
//            array_push($this->score, $this->student[$i]->score);
            echo $this->grade($this->student[$i]->score);
        }
    }

    /**
     * @param $score
     * @return bool|string
     */
    public function grade($score) {
        $grade = ($score > 0 && $score < 40) ?? 'F';
        $grade = ($score) ? ($score > 39 && $score < 45): 'E';
        $grade = ($score) ? ($score > 44 && $score < 50): 'D';
        $grade = ($score) ? ($score > 49 && $score < 60): 'C';
        $grade = ($score) ? ($score > 59 && $score < 70): 'B';
        $grade = ($score) ? ($score >= 70  && $score <= 100): 'A';
        return $grade;
    }
}

$studentData = new StudentResult('data.json');

$studentData->getScore();
var_dump($studentData->score);