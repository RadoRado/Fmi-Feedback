<?php

class FormValidator {
	private $fields = array();
	private $ErrorMessage;
	public $UseFormKey, $FormKeyName, $FormKeyErrorMessage;
	private $FormKey = '', $FormKeyOld = '';

	public function FormValidator($WithFormKey = false, $FormKeyName = 'formkey', $FormKeyErrorMessage = '') {
		$this -> UseFormKey = $WithFormKey;

		$this -> FormKeyName = $FormKeyName;

		if (isset($_SESSION[$FormKeyName])) {
			$this -> FormKeyOld = $_SESSION[$FormKeyName];
			$_SESSION[$FormKeyName] = null;
			unset($_SESSION[$FormKeyName]);
		}

		$this -> FormKeyErrorMessage = $FormKeyErrorMessage;
	}

	public function AddRequiredField($name, $options) {
		if (isset($options['isArray']) && $options['isArray'] && empty($options['notAllRequired'])) {
			$options['notAllRequired'] = true;
		}

		$this -> fields[$name] = $options;
	}

	public function SetRequiredFields($array) {
		$this -> fields = $array;
	}

	/**
	 * Similar to json_encode, turns PHP aray to JavaScript Object
	 */
	private function ArrayToJSOptions($array) {
		$o = '{';
		$i = 0;
		$max = count($array);

		foreach ($array as $k => $v) {
			$o .= ' ' . $k . ': ';

			if (is_array($v)) {
				$o .= $this -> ArrayToJSOptions($v);
			} elseif ($v === true) {
				$o .= 'true';
			} elseif ($v === false) {
				$o .= 'false';
			} elseif (is_int($v) || $k == "regex") {
				$o .= $v;
			} else {
				$o .= '"' . $v . '"';
			}

			if ($i + 1 < $max) {
				$o .= ',';
			}

			$i++;
		}

		$o .= '}';

		return $o;
	}

	public function GetMetaJS($FormID, $ErrorElement = '#error') {
		$output = '';
		/*$output = '<script type="text/javascript">
		 $(document).bind("ready", function() {
		 ';*/

		$ar = array_reverse($this -> fields, true);

		foreach ($ar as $name => &$options) {
			if (isset($options['serveronly']) && $options['serveronly']) {
				unset($ar[$name]);
				continue;
			}

			$options['name'] = $name;

			if (isset($options['isArray']) && $options['isArray'])
				$options['name'] .= '[]';

			if (isset($options['regex']))
				$options['regex'] = preg_replace("/\/(.*)?u(.*)?$/", "/$1$2", $options['regex']);
		}

		$output = "$('" . $FormID . "').FormValidator($('" . $ErrorElement . "'), " . $this -> ArrayToJSOptions($ar) . ");\n";

		/*$output .= '
		 })</script>';*/

		return $output;
	}

	public function GetFormKey($WithHiddenField = true) {
		if (empty($this -> FormKey))
			$this -> GenerateFormKey();

		if ($WithHiddenField)
			return '<input type="hidden" name="' . $this -> FormKeyName . '" value="' . $this -> FormKey . '" />';
		else
			return $this -> FormKey;
	}

	private function GenerateFormKey() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$rand = mt_rand(1, 1000000);

		$this -> FormKey = hash('sha256', $ip . microtime() . $rand . $this -> FormKeyName);
		$_SESSION[$this -> FormKeyName] = $this -> FormKey;
	}

	public function IsValid(&$array) {
		if ($this -> UseFormKey && (empty($this -> FormKeyOld) || empty($array[$this -> FormKeyName]) || $this -> FormKeyOld != $array[$this -> FormKeyName])) {
			$this -> ErrorMessage = $this -> FormKeyErrorMessage;

			return false;
		}

		foreach ($this->fields as $name => $options) {
			if (!isset($options['regex']) || empty($options['regex'])) {
				$options['regex'] = "/^(.+)$/i";
			}

			if (isset($options['isArray']) && $options['isArray'] && (!isset($options['isArray']) || empty($options['notAllRequired']))) {
				$options['notAllRequired'] = true;
			}

			//$array[$name] = trim($array[$name]);

			if (isset($options['isArray']) && $options['isArray']) {
				if (!is_array($array[$name])) {
					return false;
				}

				$numElements = 0;
				foreach ($array[$name] as $key => $val) {
					if (empty($val) && $options['notAllRequired']) {
						continue;
					}

					//$array[$name][$key] = trim($val);

					if (!(bool)preg_match($options['regex'], $val)) {
						$this -> ErrorMessage = $options['message'];
						return false;
					}

					$numElements += 1;
				}

				if (!empty($options['min']) && $options['min'] >= 0 && $options['max'] > 0 && ($numElements < $options['min'] || $numElements > $options['max'])) {
					$this -> ErrorMessage = $options['message'];
					return false;
				}
			} else if (($array[$name] == '' && (!isset($options['dependson']) || isset($array[$options['dependson']]) || !empty($array[$options['dependson']])) && (!isset($options['required']) || $options['required'] == true)) || (!empty($array[$name]) && !(bool)preg_match($options['regex'], $array[$name]))) {
				$this -> ErrorMessage = $options['message'];
				return false;
			}
		}

		return true;
	}

	public function GetErrorMessage() {
		return $this -> ErrorMessage;
	}

}
