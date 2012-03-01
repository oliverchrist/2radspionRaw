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

    public function __construct($value = '-') {
        $this->value = $value;
    }

    public function getDropdown($className = '') {
        $html     = '<select name="' . $this->name . '" class="selectEigenschaft ' . $className . '">';
        $sonstige = TRUE;
        foreach($this->text as $key => $option) {
            $html .= '<option value="' . $key . '"';
            if($key === $this->value){
                $html    .= ' selected="selected"';
                $sonstige = FALSE;
            }
            $html .= '>' . $option . '</option>';
        }
        $html .= '<option value="-1"';
        if($sonstige) {
            $html .= ' selected="selected"';
        }
        $html .= '>sonstige</option>';
        $html .= '</select>';
        $html .= '<input type="text" name="' . $this->name . 'Sonstige"';
        if(!$sonstige){
            $html .= ' class="hidden"';
        }else{
            $html .= ' value="' . $this->value . '"';
        }
        $html .= '>';
        return $html;
    }

    public function getValue() {
        return $this->value;
    }

    public function getText() {
        if(isset($this->text[$this->value])) {
            return $this->text[$this->value];
        }
        return 'ungültig';
    }
}