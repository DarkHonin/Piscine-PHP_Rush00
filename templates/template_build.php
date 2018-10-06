<?php

class	Template{
	static public $templates = [
		"main" => "html/main.php",
		"navbar" => "html/navbar.php"
	];

	static function get_part($alias){
		return Template::$templates[$alias];
	}

	static function render_part($part, $data){
		$path = Template::get_part($part);
		ob_start();
		$ENV = $data;
		include $path;
		$result = ob_get_contents();
		ob_end_clean();
		return $result;
	}
}

?>