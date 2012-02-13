<?php
namespace de\zweiradspion;

/**
 * Das Rad
 *
 * @author christ
 */
class SelectEigenschaft  {
    protected $value;
    protected $name;
    protected $text;
    
    public function __construct($value = 0){
        $this->value = $value;
    }
    
    public function getDropdown($className = ''){
        $html = '<select name="' . $this->name . '" class="selectEigenschaft ' . $className . '">';
        foreach($this->text as $key => $option){
            $html .= '<option value="' . $key . '"';
            if($key == $this->value){
                $html .= ' selected="selected"';
            }
            $html .= '>' . $option . '</option>';
        }
        $html .= '<option value="-1">sonstige</option>';
        $html .= '</select>';
        $html .= '<input type="text" name="' . $this->name . 'Sonstige" class="hidden">';
        return $html;
    }
    
    public function getValue(){
        return $this->value;
    }
    
    public function __toString(){
        if(isset($this->text[$this->value])) return $this->text[$this->value];
        return 'ungültig';
    }
}