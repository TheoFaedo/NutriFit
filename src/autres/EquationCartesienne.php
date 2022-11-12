<?php
namespace app\autres;

class EquationCartesienne{
    private $expression;

    public function __construct($expression){
        $this->expression = $expression;
    }

    public function getValeur($value){
        return $this->expression[0]*$value+$this->expression[1];
    }

    public function getExpression(){
        return $this->expression;
    }
}

