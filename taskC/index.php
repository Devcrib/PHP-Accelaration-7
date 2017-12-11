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
            $this->score[ $this->student[$i]->name] = $this->grade($this->student[$i]->score);
        }
    }

    public function studentDetail($id) {
        $this->student[$id]->$newprop;
        return $this->student[$id];
    }

    /**
     * @param $score
     * @return bool|string
     */
    public function grade($score) {
        if($score >= 0 && $score < 40) return 'F';
        if($score > 39 && $score < 45) return 'E';
        if($score > 44 && $score < 50) return'D';
        if($score > 49 && $score < 60)return 'C';
        if($score > 59 && $score < 70)return 'B';
        if($score >= 70  && $score <= 100)return 'A';
    }
}

$studentData = new StudentResult('data.json');

 print_r($studentData->studentDetail(20));
//var_dump($studentData->score);