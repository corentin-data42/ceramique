<?php
namespace Domain\Common\Object;

class Collection 
{
    private $items = array();

    public function add(object $obj, int|null $key = null):static {
        if ($key == null) {
            $this->items[] = $obj;
        }
        else {
            if (isset($this->items[$key])) {
                //throw new Exception("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
            }
        }
        return $this;
    }

    public function contains(object $obj):bool{
        foreach($this->items as $k=>$item){
            if ($item == $obj){
                return true;
            }
        }
        return false;
    }

    public function remove(object $obj):static{
        foreach($this->items as $k=>$item){
            if ($item == $obj){
                $this->delete($k);
            }
        }
        return $this;
    }


    protected function delete($key) {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
        else {
            //throw new Exception("Invalid key $key.");
        }
    }

    public function get(int $key):static {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            //throw new Exception("Invalid key $key.");
        }
        return $this;
    }
    public function keys():array {
        return array_keys($this->items);
    }
    public function length():int {
        return count($this->items);
    }
    public function keyExists(int $key):bool {
        return isset($this->items[$key]);
    }
}