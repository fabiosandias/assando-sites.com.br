<?php
/**
 * reCAPTCHA Helper
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * @link			http://www.google.com/recaptcha
 * 
 * @package			AssandoSites
 * @subpackage		Helper
 */
#App::uses('AppHelper', 'View/Helper');

/**
 * reCAPTCHA Helper
 */
class RecaptchaHelper extends AppHelper {

	public $helpers = array('Html');

	public function button($theme = 'red') {
		App::import('Vendor', 'recaptchalib');

		echo '<style>body.page .form #recaptcha_widget_div div { margin: 0 }</style>';
		echo $this->Html->scriptBlock("var RecaptchaOptions = { theme : '{$theme}', lang : 'pt' };");

		echo recaptcha_get_html(Configure::read('Recaptcha.public'));
	}
	
}