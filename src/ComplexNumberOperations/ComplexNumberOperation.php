<?php

namespace K1785\Complex\ComplexNumberOperations;
use  K1785\Complex\ComplexNumber;

/**
 * Class ComplexNumberOperation
 * @package K1785\Complex\ComplexNumberOperations
 * @property ComplexNumber $result
 * @property ComplexNumber $number
 * @property array $numbers
 */
class ComplexNumberOperation{

    protected $result = null;
    protected $number = null;
    protected $numbers = [];

    public function __construct(ComplexNumber $number = null, $numbers = null)
    {
        if(! $number){
            throw new \Exception('Not set number');
        }
        if(! $numbers){
            throw new \Exception('Not set numbers');
        }
        if(is_array($numbers)){
            $this->numbers = $numbers;
        }elseif($numbers instanceof ComplexNumber){
            $this->numbers[] = $numbers;
        }
        if(empty($this->numbers)){
            throw new \Exception('Not set numbers class');
        }
        $this->number = $number;
    }

    /**
     * @param null $operation
     * @param null $number
     * @param null $numbers
     * @return ComplexNumberOperation
     * @throws \Exception
     */
    public static function factory($operation = null, $number = null, $numbers = null){
        if(! $operation){
            throw new \Exception('Not set operations');
        }
        $factoryClass = 'K1785\Complex\ComplexNumberOperations\ComplexNumberOperation'.ucfirst($operation);
        if(! class_exists($factoryClass)){
            throw new \Exception('Not set operation '.$operation);
        }
        if($number instanceof ComplexNumber){
            return new $factoryClass($number, $numbers);
        }
        throw new \Exception('Not set operations');
    }


    /**
     * @return ComplexNumber
     */
    public function run()
    {
        if($this->number instanceof ComplexNumber){
            $this->result = $this->number;
            foreach ($this->numbers as $number){
                $this->operation($number);
            }
            return $this->result;
        }
        throw new \Exception('Not set number');
    }

    protected function operation(ComplexNumber $number){

    }
}