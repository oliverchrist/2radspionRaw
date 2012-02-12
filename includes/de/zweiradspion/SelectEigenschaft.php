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
    
    public function __construct($value){
        $this->value = $value;
    }
    
    public function getDropdown($className = ''){
        $html = '<select name="' . $this->name . '" class="' . $className . '">';
        foreach($this->text as $key => $option){
            $html .= '<option value="' . $key . '">' . $option . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}