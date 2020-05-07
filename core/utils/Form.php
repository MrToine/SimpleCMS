<?php
/**
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Anthony VIOLET
 * @version     SimpleFM 1.0 - 02/05/2020
 * @since       SimpleFM 1.1 - 07/05/2020
 * @contributor
 * @page        Utilitaire qui gère les formulaires
*/

class Form extends Helpers {

    public function input($name, $label, $options=array()){
        $html = '';
        if(!isset($this->controller->request->data->$name)) {
            $value = "";
        }else{
            $value = $this->controller->request->data->$name;
        }
        if($label == "hidden") {
            if($name == "antispam"){
                $label = "";
                $nobot = time().'_'.rand(50000, 60000);

                $html .= '<input type="checkbox" name="nobotc" value="'.sha1($nobot).'"> Je confirme être un humain';
                $html .= '<input type="hidden" name="try" value="send"><input type="hidden" name="nobotv" value="'.$nobot.'"><input type="hidden" name="'.$name.'" value="'.sha1($nobot).'">';
                $html .= '<div style="position: absolute; visibility: hidden; left: -5000; top : -5000">
		<br><input type="checkbox" name="nobots" value="'.time().'" />I\'m a Stupid Spam-Robot
	</div>';
            }else{
                $html .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
            }
        }
        $html .= '<p><label for="input'.$name.'">'.$label.'</label><p>';
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
