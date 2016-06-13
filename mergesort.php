<?php

class Biro
{
    public $student_scores; //array of student scores
    private $top_ten_scores; //array of top ten student scores
    private $number_of_students; //number of students that have scores
    private $high_score; //highest possible score for contest

    //-----Initialization -------
    public function __construct()
    {
        $this->number_of_students = 100;
        $this->high_score = 100;

        //initialize student_scores array to NULL
        $this->student_scores = array_fill(0, $this->number_of_students, NULL);

        //assign randome scores to students
        for ($i = 0; $i < $this->number_of_students; $i += 1) {
            $this->student_scores[$i] = rand(0, $this->high_score);
        }
    }

    /**
     * This function to sort the student_scores array from largest to smallest number
     * @return array
     */
    public function sortScores()
    {
        //Divide all elements into arrays each containing 1 element.
        $newArray = array_chunk($this->student_scores, 1);

        $lengthOfNewArray = sizeof($newArray);
        $iterator = 0;
        $iteratorCount = $lengthOfNewArray -1;
        $a = $newArray[0];

        //While they are more elements merge all arrays and sort all arrays in progression.
        while($iterator < $iteratorCount){
            $a = $this->merge($a, $newArray[$iterator+1], 1, sizeof($a));
            $iterator++;
        }

        $finalResult = array();
        $arraySize = sizeof($a);

        //Re-order Result in Descending Order.
        for($i =  $arraySize-1; $i > 0; $i--) {
            $finalResult[] = $a[$i];
        }
        
        return $this->student_scores = $finalResult;
    }

    /**
     * THis function sorts and merge two input arrays and return the merged array.
     * @param array $A
     * @param array $B
     * @param $firstIndex
     * @param $lastIndex
     * @return array
     */
    private function merge(array $A, array $B, $firstIndex, $lastIndex){

        //Check if the itme in this index  is greater and push the other item to merge behind, return the maerged array.
        if ($A[$firstIndex - 1] >= $B[0]) {
            array_splice($A, $firstIndex - 1, 0, $B[0]);
            return $A;
        }

        //Check if this index is less and push the other item to the front, return the merged array.
        if ($A[$lastIndex - 1] <= $B[0]) {
            array_splice($A, $lastIndex, 0, $B[0]);
            return $A;
        }

        //If only one item is remaining check for the bigger or smaller and push as appropriate, return the merged array
        if($lastIndex - $firstIndex == 0) {
            if ($A[$firstIndex - 1] <= $B[0])
                array_splice($A, $firstIndex-1, 0, $B[0]);
            else array_splice($A, $firstIndex, 0, $B[0]);
            return $A;
        }

        //If any of the above condition fails, recursively check for other items while changing the search indexes to the next itme
        return $this->merge($A, $B, $firstIndex+1, $lastIndex-1);
    }

    //gets the first 10 scores from the student_scores array and puts them in the top_ten_scores array
    public function getTopTenScores()
    {
        $this->top_ten_scores;
        for ($i = 0; $i < 10; $i += 1) {
            $this->top_ten_scores[$i] = $this->student_scores[$i];
        }
    }

    //displays the top ten ranked scores
    public function showTopScores()
    {
        for ($i = 0; $i < 10; $i += 1) {
            echo sprintf("Top score %d. The student scored %d <br>", $i, $this->top_ten_scores[$i]);
        }
    }

    //runs and times the application: sorting, top ten scores, displaying the top ten scores
    public function runAll()
    {
        $time_start = microtime(true);
        $this->sortScores();
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        echo "Sorting took: $time seconds<br>\n";
        $this->getTopTenScores();
        $this->showTopScores();
    }
}

/*
$test = new Biro();
foreach($test->student_scores as $s) {
    echo $s. "</br>";
}

echo "***************************************************";
echo "***************************************************";
echo "***************************************************";

$b = $test->sortScores();

foreach($b as $s) {
    echo $s. "</br>";
}

$test = new Biro();
$test->runAll();*/
