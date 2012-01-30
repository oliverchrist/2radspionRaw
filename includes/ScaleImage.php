<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScaleImage
 *
 * @author christ
 */
class ScaleImage {
    private $name;
    private $extension;
    private $directory;
    private $image;


    public function __construct($name, $extension, $directory){
        $this->name = $name;
        $this->extension = $extension;
        $this->directory = $this->checkPath($directory);
        $this->image = imagecreatefromstring($this->directory . $this->name . '.' . $this->extension);
    }
    
    private function checkPath($path) {
        if(substr($path, -1) != '/'){
            $path = $path . '/';
        }
        return $path;
    }
    
    public function getImagePath($width, $height){
        imagejpeg($this->image, $this->directory . $this->name . '_' . $width . '.jpg', 80);
        $path = $this->directory . $this->name . '.' . $this->extension;
        return $path;
    }
}

?>
