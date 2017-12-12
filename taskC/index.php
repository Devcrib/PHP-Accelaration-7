<?php

class StudentResult {

    public $totalStudents;
    public $student;
    public $score = [];
    public $score_list = [];

    public $graded = [];


    public function __construct($file)
    {
        $handle = file_get_contents($file);
        //$this->student = json_decode($file);
        $this->student = json_decode($handle);
        $this->totalStudents = count($this->student);
    }

    public function getScore() {
        for($i = 0; $i < $this->totalStudents; $i++) {
            $this->score[ $this->student[$i]->name] = $this->grade($this->student[$i]->score);
            array_push($this->score_list, $this->student[$i]->score);
        }
        asort($this->score);
        sort($this->score_list);
    }


    /**
     * @param $id
     * @return stdClass
     */
    public function studentDetail($id) {
        $student = new stdClass;
        $newprop = 'grade';
        foreach ($this->student[$id] as $key => $value){
            $student->$key = $value;
            $student->$newprop = $this->grade($this->student[$id]->score);
        }
        return $student;
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

    /**
     * @return string
     */
    public function highest_grade() {
        $max = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0, 'F' => 0 ];
        foreach ($this->score as $grade) {
            if ($grade == 'A') $max['A'] += 1;
            if ($grade == 'B') $max['B'] += 1;
            if ($grade == 'C') $max['C'] += 1;
            if ($grade == 'D') $max['D'] += 1;
            if ($grade == 'E') $max['E'] += 1;
            if ($grade == 'F') $max['F'] += 1;
        }
        foreach ($max as $key => $max_grade_number) {
            if ($max_grade_number == max($max)) return $key .' is the grade with the highest number';
        }
    }

    public function quartile() {
        if($this->totalStudents % 2 == 0) {
            $Q1 = $this->median($this->score_list);
            $Q2 = $this->median(array_slice($this->score_list, 0, floor(count($this->score_list)/2)));
            $Q3 = $this->median(array_slice($this->score_list, floor(count($this->score_list)/2)));
            return ('Q1 = '.$Q1.' Q2 = '.$Q2.' $Q3 = '.$Q3 );
        }

        if($this->totalStudents % 2 != 0) {
            $Q1 = $this->median($this->score_list);
            $Q2 = $this->median(array_slice($this->score_list, 0, floor(count($this->score_list)/2)));
            $Q3 = $this->median(array_slice($this->score_list, floor(count($this->score_list)/2)));
        }
        return ('Q1 = '.$Q1.' Q2 = '.$Q2.' $Q3 = '.$Q3 );
    }

    public function median($array){
        if(count($array) % 2 != 0) {
            $q = $array[floor(count($array)/2)];
            return $q;
        }
        if(count($array) % 2 == 0) {
            $q = ($array[floor(count($array)/2)] + ($array[floor(count($array)/2)] + 1)) / 2;
            return $q;
        }
    }


}

//$studentData = new StudentResult($file);
$studentData = new StudentResult('data.json');

$studentData->getScore();
// var_dump($studentData->studentDetail(5));
//var_dump($studentData->highest_grade());
//var_dump($studentData->quartile());