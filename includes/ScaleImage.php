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


    public function __construct($name, $extension, $directory) {
        $this->name      = $name;
        $this->extension = $extension;
        $this->directory = $this->checkPath($directory);
        $this->path      = $this->directory . $this->name . '.' . $this->extension;
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


    public function getImagePath($width, $height) {
        $path = 'images_cache/' . $this->name . '_' . $width . '.jpg';
        #echo $path . ', ' . file_exists($path);
        if(!file_exists($path)){
            list($this->width, $this->height) = getimagesize($this->path);
            if($height == 'auto'){
                $height = ceil($this->height * $width / $this->width);
            }
            $scaledImage = imagecreatetruecolor($width, $height);
            $this->image = imagecreatefromstring(file_get_contents($this->path));
            imagecopyresampled($scaledImage, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
            imagejpeg($scaledImage, $path, 80);
        }
        return $path;
    }
}

?>
