<?php
	namespace core;

	/*
		
	*/

	class View
	{
		private $parameters;
		
		function __construct(array $params)
		{
			$this->parameters = $params;
		}

		public function render(array $data)
		{
			extract($data);
			$path_to_content_page = "content/{$this->parameters['template']}/{$this->parameters['page']}.php";
			if(file_exists($path_to_content_page)){
				ob_start();
				require_once $path_to_content_page;
				$content = ob_get_clean();
				require_once "layouts/{$this->parameters['template']}_layout.php";
			}
			else echo 'View does not exist!';
		}
	}