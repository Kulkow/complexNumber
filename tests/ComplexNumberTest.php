<?php

use PHPUnit\Framework\TestCase;

use K1785\Complex\ComplexNumber;

class ComplexNumberTest extends TestCase
{

    public function testRender()
    {
        $ComplexNumber = new ComplexNumber(4, 5);
        $this->assertEquals($ComplexNumber->render(), '4 + 5i');

        $ComplexNumber = new ComplexNumber(4, -5);
        $this->assertEquals($ComplexNumber->render(), '4 - 5i');

        $ComplexNumber = new ComplexNumber(72);
        $this->assertEquals($ComplexNumber->render(), 72);
    }

    public function testParse()
    {
        $ComplexNumber = ComplexNumber::factory('4+7i');
        $this->assertEquals($ComplexNumber->getReal(), 4);
        $this->assertEquals($ComplexNumber->getImaginary(), 7);

        $ComplexNumber = ComplexNumber::factory('4-7i');
        $this->assertEquals($ComplexNumber->getReal(), 4);
        $this->assertEquals($ComplexNumber->getImaginary(), -7);

        $ComplexNumber = ComplexNumber::factory('-4-7i');
        $this->assertEquals($ComplexNumber->getReal(), -4);
        $this->assertEquals($ComplexNumber->getImaginary(), -7);
    }

    public function testOperation()
    {
        $ComplexNumber = new ComplexNumber(4, 5);
        $ComplexNumberSecond = new ComplexNumber(4, 5);
        $result = $ComplexNumber->operation('add', $ComplexNumberSecond);
        $this->assertEquals($result->getReal(), 8);
        $this->assertEquals($result->getImaginary(), 10);


        $ComplexNumber = new ComplexNumber(-9, -8);
        $ComplexNumberSecond = new ComplexNumber(4, -5);
        $result = $ComplexNumber->operation('add', $ComplexNumberSecond);
        $this->assertEquals($result->getReal(), -5);
        $this->assertEquals($result->getImaginary(), -13);

    }

    public function testOperationMinus()
    {
        $ComplexNumber = new ComplexNumber(4, 5);
        $ComplexNumberSecond = new ComplexNumber(4, 6);
        $result = $ComplexNumber->operation('minus', $ComplexNumberSecond);
        $this->assertEquals($result->getReal(), 0);
        $this->assertEquals($result->getImaginary(), -1);


        $ComplexNumber = new ComplexNumber(-9, -8);
        $ComplexNumberSecond = new ComplexNumber(4, -5);
        $result = $ComplexNumber->operation('minus', $ComplexNumberSecond);
        $this->assertEquals($result->getReal(), -13);
        $this->assertEquals($result->getImaginary(), -3);

    }

    public function testOperationMultiply()
    {
        $ComplexNumber = new ComplexNumber(4, 5);
        $ComplexNumberSecond = new ComplexNumber(4, 6);
        $result = $ComplexNumber->operation('multiply', $ComplexNumberSecond);
        $this->assertEquals($result->getReal(), -14);//ac -bdi
        $this->assertEquals($result->getImaginary(), 44); //bc+ad 24+20


        $ComplexNumber = new ComplexNumber(-9, -8);
        $ComplexNumberSecond = new ComplexNumber(4, -5);
        $result = $ComplexNumber->operation('multiply', $ComplexNumberSecond);
        $this->assertEquals($result->getReal(), -76);
        $this->assertEquals($result->getImaginary(), 13);
    }

    public function testOperationDivision()
    {
        $ComplexNumber = new ComplexNumber(4, 5);
        $ComplexNumberSecond = new ComplexNumber(4, 6);
        $result = $ComplexNumber->operation('division', $ComplexNumberSecond);

        $realResult =  (4 * 4 + 5 * 6) / (pow(4,2) + pow(6,2));

        $this->assertEquals($result->getReal(), $realResult);//ac -bdi
        $imaginaryResult = (5 * 4 - 4 * 6) / (pow(4,2) + pow(6,2));
        $this->assertEquals($result->getImaginary(), $imaginaryResult); //bc+ad 24+20


    }
}