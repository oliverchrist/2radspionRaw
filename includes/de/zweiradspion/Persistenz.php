<?php
namespace de\zweiradspion;

/**
 * Das Rad
 *
 * @author christ
 */
class Persistenz {
    protected $uid;
    protected $erstellt;
    protected $geaendert;
    protected $variable;

    public function getUid() { return $this->uid; }
    public function getErstellt() { return $this->erstellt; }
    public function getGeaendert() { return $this->geaendert; }

    public function setUid($uid) { $this->uid = $uid; }
    public function setErstellt($erstellt) { $this->erstellt = $erstellt; }
    public function setGeaendert($geaendert) { $this->geaendert = $geaendert; }

    public function __call($method, $args){
        $functionType = substr($method, 0, 3);
        $name     = lcfirst(substr($method, 3));
        #echo $functionType . ': '. $name . ', ' . implode(', ', $args);

        if($functionType == 'get'){
            #echo $name . ': ' . $this->$name;
            return $this->$name;
        }elseif($functionType == 'set'){
            $this->$name = $args[0];
        }
    }

    public function __get($property){
        #echo $property;

        if(isset($this->variable[$property])) {
            return $this->variable[$property];
        }
        return NULL;
    }

    public function __set($property, $value){
        return $this->variable[$property] = $value;
    }
}
?>