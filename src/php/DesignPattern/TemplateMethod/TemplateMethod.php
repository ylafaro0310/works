<?php

abstract class Cooking {
    private $dishName = "";

    public function allAction(){
        $this->preAction();
        $this->mainAction();
        $this->completed();
    }

    // protected は継承先でも参照可能
    abstract protected function preAction();

    abstract protected function mainAction();

    private function completed(){
        printf($this->getDishName()."完成!\n\n");
    }

    protected function getDishName(){
        return $this->dishName;
    }

    protected function setDishName(string $dishName){
        $this->dishName = $dishName;
    }
}

class Curry extends Cooking {
    protected function preAction(){
        $this->setDishName("カレー");
        printf($this->getDishName()."の材料を揃える\n");
        printf("材料を切る\n");
    }

    protected function mainAction(){
        printf("材料を焼く\n");
        printf("煮込む\n");
        printf("ルーを溶かす\n");
    }
}

class Tonkatsu extends Cooking {
    protected function preAction(){
        $this->setDishName("豚カツ");
        printf($this->getDishName()."の材料を揃える\n");
        printf("肉に小麦粉、溶き卵、パン粉をまぶす\n");
    }
    
    protected function mainAction(){
        printf("揚げる\n");
    }
}

$curry = new Curry;
$tonkatsu = new Tonkatsu;

$curry->allAction();
$tonkatsu->allAction();