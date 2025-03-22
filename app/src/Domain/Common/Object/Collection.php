<?php
namespace Domain\Common\Object;

class Collection 
{
    private array $items = [];
    private int $currentKey = 0;


    public function __construct()
    {

    } 
    /**
     * @obj object
     * @key int
     * @unshift bool
     * return Static
     */
    public function add(object|string $obj, int|null $key = null, bool $unshift = false):static {
        if ($key == null) {
            if($unshift){
                array_unshift($this->items,$obj);

            }else{
                $this->items[] = $obj;
            }
        }
        else {
            if (isset($this->items[$key])) {
                throw new \Exception("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
            }
        }
        return $this;
    }
    /**
     * @obj object
     * return bool
     */
    public function contains(object $obj):bool{
        foreach($this->items as $k=>$item){
            if ($item == $obj){
                return true;
            }
        }
        return false;
    }
    /**
     * @obj object
     * return Static
     */
    public function remove(object $obj):static{
        foreach($this->items as $k=>$item){
            if ($item == $obj){
                $this->delete($k);
            }
        }
        return $this;
    }

    /**
     * @key int
     * return Static
     */
    protected function delete(int $key) {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
        else {
            //throw new Exception("Invalid key $key.");
        }
    }
    /**
     *
     */
    public function  getCurrent(){
        return $this->get($this->currentKey);
    }
    /**
     * @key int
     *
     */
    public function get(int $key){
        
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            return false;
        }
    }
    /**
     * return void
     */
    public function next():void {
        $this->currentKey++;
    }
    /**
     * return array
     */
    public function toArray():array {
        return $this->items;
    }
    /**
     * return array
     */
    public function keys():array {
        return array_keys($this->items);
    }
    /**
     * return int
     */
    public function length():int {
        return count($this->items);
    }
    /**
     * @key int
     * return bool
     */
    public function keyExists(int $key):bool {
        return isset($this->items[$key]);
    }
}