<?php

namespace Aku\Core\Model;

use Aku\Core\Model\ContainerAware;

class Request extends ContainerAware
{
	function __construct()
	{
		$this->container = new Container();
	}

	public function getFromPost($key)
	{
		$post = $this->get("post");
		if (!is_array($post)) return null;
		if (!array_key_exists($key, $post)) return null;
		return $post[$key];
	}

	public static function createFromGlobals()
	{
		$request = new Request();

		$request->set("method", strtolower($_SERVER["REQUEST_METHOD"]));
		$request->set("post", array_key_exists("form", $_POST) ? $_POST["form"] : array());
		$path = $_SERVER["REQUEST_URI"];
		$base = $_SERVER["BASE"];
		while ($base[0] == $path[0]) {
			$path = substr($path, 1);
			$base = substr($base, 1);
		}
		$path = str_replace("?", "", $path);
		$request->set("path", $path);
		return $request;
	}

}