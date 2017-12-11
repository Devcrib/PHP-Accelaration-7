<?php

class De_ES {
    public $element;
    public $error;
    public $new_value;

    public function __construct($element) {
        if(preg_match('/([a-zA-Z0-9])|[a-zA-Z0-9,?]+/', $element)) {
            $this->element = explode(',', $element);
        } else {
            $this->error = 'syntax error, should have format "value,value_with_numbers_787878, 68768" ';
            echo $this->error;
        }
    }


    /*
        filter_by will be a user defined function or an inbuilt function
    */
    public function filter($filter_by = null){
        if($filter_by === null) {
            return implode($this->element, ', ');
        } else {
            foreach ($this->element as $key => $value) {
                $filter_by($value, $key);
            }
        }
    }

    public function map ($map_by = NULL) {
         if($map_by === null) {
            return implode($this->element, ', ');
        } else {
            foreach ($this->element as $key => $value) {
                $map_by($value, $key);
            }
        }
    }



}


$x = new De_ES("key=>val,fsf,value_2,rere");

$funq = function($collect, $key){
           $collect;
        };

echo $x->filter($funq);

// echo ' => '.(('true' === null) || ('true' === false) || ('fdsd' === true)) ;

