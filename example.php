<?php

require_once __DIR__ . "/Union.php";

class Example extends Union
{

    protected function firstMethod(){
        print_r(__FUNCTION__);
        if($this->comesFrom('test')){
            $this->next(3);
        }
        $this->next();

    }

    protected function helloWorld(){
        print_r(__FUNCTION__);
        $this->next();
    }
    protected function test(){
        print_r(__FUNCTION__);
        $this->previous(2);
    }

    protected function here(){
        print_r(__FUNCTION__);
        $this->next();
    }
}

$process = new Example();
$process->start();
