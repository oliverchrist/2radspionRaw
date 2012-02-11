<?php
namespace de\zweiradspion;

/**
 * Description of Bild
 *
 * @author oliver
 */
class Bild {
    protected $name;
    protected $extension;
    
    public function __construct($name, $extension) {
        $this->name = $name;
        $this->extension = $extension;
    }
    
    public function getFullName(){
        return $this->name . '.' . $this->extension;
    }


    public function getName() {
        return $this->name;
    }
    
    public function getExtension() {
        return $this->extension;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setExtension($extension) {
        $this->extension = $extension;
    }
}

?>
