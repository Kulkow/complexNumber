<?php

namespace K1785\Complex\ComplexNumberOperations;

use K1785\Complex\ComplexNumber;

class ComplexNumberOperationDivision extends ComplexNumberOperation{


    protected function operation(ComplexNumber $number){
        $a = $this->result->getReal();
        $b = $this->result->getImaginary();

        $c = $number->getReal();
        $d = $number->getImaginary();
        $realResult =  ($a * $c + $b * $d) / (pow($c,2) + pow($d,2));
        $imaginaryResult = ($b * $c - $a * $d) / (pow($c,2) + pow($d,2));
        $this->result->setReal($realResult);
        $this->result->setImaginary($imaginaryResult);
    }
}