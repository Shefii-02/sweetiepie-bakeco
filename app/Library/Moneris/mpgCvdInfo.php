<?php
namespace App\Library\Moneris;

class mpgCvdInfo
{

	var $params;
	var $cvdTemplate ;

	function mpgCvdInfo($params)
	{
		$this->params = $params;
	}

	function toXML()
	{
		foreach($this->cvdTemplate as $tag)
		{
			$xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
		}

		return "<cvd_info>$xmlString</cvd_info>";
	}

}//end class