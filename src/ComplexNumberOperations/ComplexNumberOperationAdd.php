<?php

namespace K1785\Complex\ComplexNumberOperations;

use K1785\Complex\ComplexNumber;

class ComplexNumberOperationAdd extends ComplexNumberOperation{


    protected function operation(ComplexNumber $number){
        $real = $this->result->getReal();
        $imaginary = $this->result->getImaginary();

        $realAdd = $number->getReal();
        $imaginaryAdd = $number->getImaginary();
        $this->result->setReal($real + $realAdd);
        $this->result->setImaginary($imaginary + $imaginaryAdd);
    }
}