<?php 

namespace Aku\Core\Model\Form;

use Aku\Core\Model\Form\Field;

class DateField extends Field
{

	function __construct($name)
	{
		parent::__construct($name);
		$this->value = new \DateTime();
	}

	public static function getType()
	{
		return "s";
	}

	public function get()
	{
		return $this->value;
	}

	public function set($value)
	{
		$error = null;
		$this->value = new \DateTime($value);
		return $error;
	}

	public function raw()
	{
		return $this->value->format('Y-m-d H:i:s');
	}
}