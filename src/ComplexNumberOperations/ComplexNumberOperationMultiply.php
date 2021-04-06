<?php

namespace K1785\Complex\ComplexNumberOperations;

use K1785\Complex\ComplexNumber;

class ComplexNumberOperationMultiply extends ComplexNumberOperation{


    protected function operation(ComplexNumber $number){
        $real = $this->result->getReal();
        $imaginary = $this->result->getImaginary();

        $realAdd = $number->getReal();
        $imaginaryAdd = $number->getImaginary();
        $realResult =  $real * $realAdd - $imaginary * $imaginaryAdd;
        $imaginaryResult = $imaginary * $realAdd + $real * $imaginaryAdd;
        $this->result->setReal($realResult);
        $this->result->setImaginary($imaginaryResult);
    }
}