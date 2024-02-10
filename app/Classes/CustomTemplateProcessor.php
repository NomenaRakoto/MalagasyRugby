<?php

namespace App\Classes;
use PhpOffice\PhpWord\TemplateProcessor;

class CustomTemplateProcessor extends TemplateProcessor
{
	public function gettempDocumentMainPart()
	{
	    return $this->tempDocumentMainPart;
	}

	public function settempDocumentMainPart($new)
	{
	    return $this->tempDocumentMainPart = $new;
	}
}