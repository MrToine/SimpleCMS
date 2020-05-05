<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 02/05/2020
 * @contributor
 * @page        Utilitaire qui gère les formulaires
*/

class Form extends Helpers {

    public function input($name, $label, $options=array()){
        if(!isset($this->controller->request->data->$name)) {
            $value = "";
        }else{
            $value = $this->controller->request->data->$name;
        }
        if($label == "hidden") {
            return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
        }
        $html = '<p><label for="input'.$name.'">'.$label.'</label><p>';
        $attr = ' ';
        foreach ($options as $key => $v) {
            if($key != 'type'){
                $attr .= "$key=\"$v\" ";
            }
        }
        if(!isset($options['type'])){
            $html .= ' <input type="text" id="input'.$name.'" name="'.$name.'" value="'.$value.'" placeholder="'.$label.'" '.$attr.'>';
        }elseif($options['type'] == 'textarea') {
            $html .= ' <textarea id="input'.$name.'" name="'.$name.'" '.$attr.'>'.$value.'</textarea>';
        }elseif($options['type'] == 'checkbox') {
            $html .= ' <input type="hidden" class="checkbox" name="'.$name.'" value="0"><input type="checkbox" name="'.$name.'" value="1"'.(empty($value)?'':'checked').'>';
        }elseif($options['type'] == 'file') {
            $html .= ' <input type="file" id="input'.$name.'" name="'.$name.'" value="'.$value.'" placeholder="'.$label.'" '.$attr.'>';
        }elseif($options['type'] == 'password') {
            $html .= ' <input type="password" id="input'.$name.'" name="'.$name.'" value="'.$value.'" placeholder="'.$label.'" '.$attr.'>';
        }

        return $html;
    }
}
