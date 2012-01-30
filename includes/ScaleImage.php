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
    private $path;
    private $width;
    private $height;


    public function __construct($name, $extension, $directory){
        $this->name = $name;
        $this->extension = $extension;
        $this->directory = $this->checkPath($directory);
        $this->path = $this->directory . $this->name . '.' . $this->extension;
        list($this->width, $this->height) = getimagesize($this->path);
        $this->image = imagecreatefromstring(file_get_contents($this->path));
    }
    
    private function checkPath($path) {
        if(substr($path, -1) != '/'){
            $path = $path . '/';
        }
        return $path;
    }
    
    public function getOriginalImagePath() {
        return $this->path;
    }


    public function getImagePath($width, $height){
        $path = $this->directory . $this->name . '_' . $width . '.jpg';
        echo $path . ', ' . file_exists($path);
        if(!file_exists($path)){
            if($height == 'auto'){
                $height = ceil($this->height * $width / $this->width);
            }
            $scaledImage = imagecreatetruecolor($width, $height);
            imagecopyresampled($scaledImage, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
            imagejpeg($scaledImage, $path, 80);
            echo $path . ' erzeugt<br>';
        }
        return $path;
    }
}

?>
