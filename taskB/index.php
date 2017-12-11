<?php
  //testing composition functional programming

  $target = function($text) {
      return strlen($text);
  };

  $new = function($target) {
      return str_repeat('-', $target);
  };

  $compose = function($a, $b) {
      return function() use ($a, $b) {
        $argument = func_get_args();
        return $b(call_user_func_array($a, $argument));
      };
  };

  $replace = $compose($target, $new);

  print_r($replace('HellNo'));


  $first = function($num) {
      return $num * $num;
  };
   $s = function ($text) {
       return $text - $text;
   };

   $last = function ($w, $c) {
       return function () use ($w, $c) {
           $id = func_get_args();
           return $c(call_user_func_array($w, $id));
       };
   };

   $test = $last($first,$s);
   var_dump($test(2,5));

  function compose($f, $g) {
      return function($x) use ($f, $g) {
          return $f($g($x));
      };
  }

  $test = compose('strlen', 'trim');
  $output = $test('Test','-');

 // echo $output. "\n";


/**
 * Examples for Currying and Partials
 */
function multiply($x,$y,$z) {
    return $x * $y * $z;
};

function curried($x){

    return function($y) use ($x){

        return function($z) use ($x,$y){
            return multiply($x, $y, $z);
        };
    };
}

$f1 = curried(2);
$f2 = $f1(3);
$result =$f2(1); //6

//print_r($result);

/*
 * *implementing for partial Application using the same multiply()
 */

function partial($func, $args)
{
    $args = func_get_args();
    $func = array_shift($args);

    return function() use($func, $args) {
        $full_args = array_merge($args, func_get_args());
        return call_user_func_array($func, $full_args);
    };
}

$f = partial('multiply', 3);
$f1 = $f(5,4);
print_r($f1);