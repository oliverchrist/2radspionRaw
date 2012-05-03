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
    protected $imagePath;
    protected $originalImagePath;
    protected $imageWidth;

    public function __construct($name, $extension) {
        $this->name      = $name;
        $this->extension = $extension;
    }

    public function getFullName() {
        return $this->name . '.' . $this->extension;
    }

    public function getName() {
        return $this->name;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    public function getOriginalImagePath() {
        return $this->originalImagePath;
    }

    public function getImageWidth() {
        return $this->imageWidth;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }

    public function setOriginalImagePath($originalImagePath) {
        $this->originalImagePath = $originalImagePath;
    }

    public function setImageWidth($imageWidth) {
        $this->imageWidth = $imageWidth;
    }
}

?>
