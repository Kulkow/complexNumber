<?php
namespace K1785\Complex;
use K1785\Complex\ComplexNumberOperations\ComplexNumberOperation;
class ComplexNumber{

    private $real = 0.0;
    private $imaginary = 0.0;
    private $suffix = 'i';

    public function __construct($real = null, $imaginary = null)
    {
        $this->real = $real;
        $this->imaginary = $imaginary;
    }

    /**
     * @param $operation
     * @param null $numbers
     * @return ComplexNumber
     * @throws \Exception
     */
    public function operation($operation, $numbers = null){
        $operation = ComplexNumberOperation::factory($operation, $this, $numbers);
        return $operation->run();
    }

    /**
     * @param ComplexNumber
     * @throws \Exception
     */
    public static function factory($string = null){
        if(! $string){
            throw new \Exception('Not set complex numbers');
        }
        $string = str_replace(
            ['+-', '-+', '++', '--'],
            ['-', '-', '+', '+'],
            $string
        );
        preg_match('` ^
            (                                   # Real part
                [-+]?(\d+\.?\d*|\d*\.?\d+)          # Real value (integer or float)
                ([Ee][-+]?[0-2]?\d{1,3})?           # Optional real exponent for scientific format
            )
            (                                   # Imaginary part
                [-+]?(\d+\.?\d*|\d*\.?\d+)          # Imaginary value (integer or float)
                ([Ee][-+]?[0-2]?\d{1,3})?           # Optional imaginary exponent for scientific format
            )?
            (                                   # Imaginary part is optional
                ([-+]?)                             # Imaginary (implicit 1 or -1) only
                ([ij]?)                             # Imaginary i or j - depending on whether mathematical or engineering
            )
        $`uix', $string, $match);
        if(empty($match)){
            throw new \Exception('Not set complex numbers');
        }
        $real = $imaginary = 0.0;
        if(! empty($match[1])){
            $real = $match[1];
        }
        if(! empty($match[4])){
            $imaginary = $match[4];
        }
        return new ComplexNumber($real, $imaginary);
    }

    public function getReal(){
        return $this->real;
    }

    public function getImaginary(){
        return $this->imaginary;
    }

    public function setReal($real){
        $this->real = $real;
    }

    public function setImaginary($imaginary){
        $this->imaginary = $imaginary;
    }

    public function isReal(){
        return empty($this->imaginary);
    }

    public function render(){
        return $this->__toString();
    }

    public function __toString()
    {
        if($this->isReal()){
            return $this->real;
        }
        $sign = $this->imaginary > 0 ? '+' : '-';
        $imaginary = abs($this->imaginary);
        return $this->real.' '.$sign.' '.$imaginary.$this->suffix;
    }
}