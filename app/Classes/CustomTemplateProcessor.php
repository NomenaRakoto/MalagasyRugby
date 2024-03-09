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

	/**
     * @param mixed $search
     * @param mixed $replace Path to image, or array("path" => xx, "width" => yy, "height" => zz)
     * @param int $limit
     */

    public function setTransparentImageValue($search, $replace, $limit = self::MAXIMUM_REPLACEMENTS_DEFAULT): void
    {
        // prepare $search_replace
        if (!is_array($search)) {
            $search = [$search];
        }

        $replacesList = [];
        if (!is_array($replace) || isset($replace['path'])) {
            $replacesList[] = $replace;
        } else {
            $replacesList = array_values($replace);
        }

        $searchReplace = [];
        foreach ($search as $searchIdx => $searchString) {
            $searchReplace[$searchString] = $replacesList[$searchIdx] ?? $replacesList[0];
        }

        // collect document parts
        $searchParts = [
            $this->getMainPartName() => &$this->tempDocumentMainPart,
        ];
        foreach (array_keys($this->tempDocumentHeaders) as $headerIndex) {
            $searchParts[$this->getHeaderName($headerIndex)] = &$this->tempDocumentHeaders[$headerIndex];
        }
        foreach (array_keys($this->tempDocumentFooters) as $headerIndex) {
            $searchParts[$this->getFooterName($headerIndex)] = &$this->tempDocumentFooters[$headerIndex];
        }

        // define templates
        // result can be verified via "Open XML SDK 2.5 Productivity Tool" (http://www.microsoft.com/en-us/download/details.aspx?id=30425)
        /*$imgTpl = '<w:pict><v:shape type="#_x0000_t75" style="width:{WIDTH};height:{HEIGHT}" stroked="f"><v:imagedata r:id="{RID}" o:title=""/></v:shape></w:pict>';*/
        $imgTpl = '<v:rect w14:anchorId="517365D5" id="Rectangle 1" o:spid="_x0000_s1026" alt="arielletest" style="width:{WIDTH};height:{HEIGHT};" o:gfxdata="" stroked="f" strokeweight="1pt"><v:fill r:id="{RID}" o:title="arielletest" opacity="20972f" recolor="t" rotate="t" type="frame"/></v:rect>';

        $i = 0;
        foreach ($searchParts as $partFileName => &$partContent) {
            $partVariables = $this->getVariablesForPart($partContent);

            foreach ($searchReplace as $searchString => $replaceImage) {
                $varsToReplace = array_filter($partVariables, function ($partVar) use ($searchString) {
                    return ($partVar == $searchString) || preg_match('/^' . preg_quote($searchString) . ':/', $partVar);
                });

                foreach ($varsToReplace as $varNameWithArgs) {
                    $varInlineArgs = $this->getImageArgs($varNameWithArgs);
                    $preparedImageAttrs = $this->prepareImageAttrs($replaceImage, $varInlineArgs);
                    $imgPath = $preparedImageAttrs['src'];

                    // get image index
                    $imgIndex = $this->getNextRelationsIndex($partFileName);
                    $rid = 'rId' . $imgIndex;

                    // replace preparations
                    $this->addImageToRelations($partFileName, $rid, $imgPath, $preparedImageAttrs['mime']);
                    $xmlImage = str_replace(['{RID}', '{WIDTH}', '{HEIGHT}'], [$rid, $preparedImageAttrs['width'], $preparedImageAttrs['height']], $imgTpl);

                    // replace variable
                    $varNameWithArgsFixed = static::ensureMacroCompleted($varNameWithArgs);
                    $matches = [];
                    if (preg_match('/(<[^<]+>)([^<]*)(' . preg_quote($varNameWithArgsFixed) . ')([^>]*)(<[^>]+>)/Uu', $partContent, $matches)) {
                        $wholeTag = $matches[0];
                        array_shift($matches);
                        [$openTag, $prefix, , $postfix, $closeTag] = $matches;
                        $replaceXml = $openTag . $prefix . $closeTag . $xmlImage . $openTag . $postfix . $closeTag;

                        $pos = strpos($partContent, 'o:title="arielletest"');
                        $pos2 = $this->search_rid($partContent, $pos);
                        $rid_to_replace = substr($partContent, $pos2, $pos - $pos2 - 1);

                        // replace on each iteration, because in one tag we can have 2+ inline variables => before proceed next variable we need to change $partContent
                        $partContent = $this->setValueForPart($rid_to_replace, 'r:id="'. $rid .'"', $partContent, $limit);
                    }

                    if (++$i >= $limit) {
                        break;
                    }
                }
            }
        }
    }

    /*public function setTransparentImageValue($search, $replace, $limit = self::MAXIMUM_REPLACEMENTS_DEFAULT): void
    {
        // prepare $search_replace
        if (!is_array($search)) {
            $search = [$search];
        }

        $replacesList = [];
        if (!is_array($replace) || isset($replace['path'])) {
            $replacesList[] = $replace;
        } else {
            $replacesList = array_values($replace);
        }

        $searchReplace = [];
        foreach ($search as $searchIdx => $searchString) {
            $searchReplace[$searchString] = $replacesList[$searchIdx] ?? $replacesList[0];
        }

        // collect document parts
        $searchParts = [
            $this->getMainPartName() => &$this->tempDocumentMainPart,
        ];
        foreach (array_keys($this->tempDocumentHeaders) as $headerIndex) {
            $searchParts[$this->getHeaderName($headerIndex)] = &$this->tempDocumentHeaders[$headerIndex];
        }
        foreach (array_keys($this->tempDocumentFooters) as $headerIndex) {
            $searchParts[$this->getFooterName($headerIndex)] = &$this->tempDocumentFooters[$headerIndex];
        }

        // define templates
        // result can be verified via "Open XML SDK 2.5 Productivity Tool" (http://www.microsoft.com/en-us/download/details.aspx?id=30425)
        $imgTpl = '<w:pict><v:shape type="#_x0000_t75" style="width:{WIDTH};height:{HEIGHT}" stroked="f"><v:imagedata r:id="{RID}" o:title=""/></v:shape></w:pict>';

        $ridTpl = 'r:id="{RID}"';

        $i = 0;
        foreach ($searchParts as $partFileName => &$partContent) {
            $partVariables = $this->getVariablesForPart($partContent);

            foreach ($searchReplace as $searchString => $replaceImage) {
                $varsToReplace = array_filter($partVariables, function ($partVar) use ($searchString) {
                    return ($partVar == $searchString) || preg_match('/^' . preg_quote($searchString) . ':/', $partVar);
                });

                foreach ($varsToReplace as $varNameWithArgs) {
                    $varInlineArgs = $this->getImageArgs($varNameWithArgs);
                    $preparedImageAttrs = $this->prepareImageAttrs($replaceImage, $varInlineArgs);
                    $imgPath = $preparedImageAttrs['src'];

                    // get image index
                    $imgIndex = $this->getNextRelationsIndex($partFileName);
                    $rid = 'rId' . $imgIndex;

                    // replace preparations
                    $this->addImageToRelations($partFileName, $rid, $imgPath, $preparedImageAttrs['mime']);
                    $xmlImage = str_replace(['{RID}', '{WIDTH}', '{HEIGHT}'], [$rid, $preparedImageAttrs['width'], $preparedImageAttrs['height']], $imgTpl);

                    // replace variable
                    $varNameWithArgsFixed = static::ensureMacroCompleted($varNameWithArgs);
                    $matches = [];
                    if (preg_match('/(<[^<]+>)([^<]*)(' . preg_quote($varNameWithArgsFixed) . ')([^>]*)(<[^>]+>)/Uu', $partContent, $matches)) {
                        $wholeTag = $matches[0];
                        array_shift($matches);
                        [$openTag, $prefix, , $postfix, $closeTag] = $matches;
                        $replaceXml = $openTag . $prefix . $closeTag . $xmlImage . $openTag . $postfix . $closeTag;

                        $pos = strpos($partContent, 'o:title="arielletest"');
                        $pos2 = $this->search_rid($partContent, $pos);
                        $ridImage = str_replace(['{RID}'], [$rid], $ridTpl);
                        $rid_to_replace = substr($partContent, $pos2, $pos - $pos2 - 1);
                        // replace on each iteration, because in one tag we can have 2+ inline variables => before proceed next variable we need to change $partContent
                        $partContent = $this->setValueForPart($rid_to_replace, $ridImage, $partContent, $limit);
                    }

                    if (++$i >= $limit) {
                        break;
                    }
                }
            }
        }
    }*/


    protected function setValueForPartCustom($search, $replace, $documentPartXML, $limit)
    {
        // Note: we can't use the same function for both cases here, because of performance considerations.
        if (self::MAXIMUM_REPLACEMENTS_DEFAULT === $limit) {
            return str_replace($search, $replace, $documentPartXML);
        }
        $regExpEscaper = new RegExp();

        return preg_replace($regExpEscaper->escape($search), $replace, $documentPartXML, $limit);
    }

    function search_rid($str, $pos)
    {
        for ($i=$pos-2; $i >0 ; $i--) { 
            if($str[$i] == ' ') return $i+1;
        }
        return $pos;
    }

    /*
        public function setTransparentImageValue($search, $replace, $limit = self::MAXIMUM_REPLACEMENTS_DEFAULT): void
        {
            $partFileName = $this->getMainPartName();
            $imgIndex = $this->getNextRelationsIndex($partFileName);
            $rid = 'rId' . $imgIndex;
            $partContent = &$this->tempDocumentMainPart;
            $pos = strpos($partContent, 'o:title="arielletest"');
            $pos2 = $this->search_rid($partContent, $pos);
            $partContent = substr_replace($partContent, 'r:id="'. $rid .'"', $pos2, $pos - $pos2);
        }

        function search_rid($str, $pos)
        {
            for ($i=$pos-2; $i >0 ; $i--) { 
                if($str[$i] == ' ') return $i+1;
            }
            return $pos;
        }
    */

    //$pos = strpos($partContent, 'o:title="arielletest"');
    //$pos2 = $this->search_rid($partContent, $pos);
    //$partContent = substr_replace($partContent, 'r:id="'. $rid .'"', $pos2, $pos - $pos2);

    private function getImageArgs($varNameWithArgs)
    {
        $varElements = explode(':', $varNameWithArgs);
        array_shift($varElements); // first element is name of variable => remove it

        $varInlineArgs = [];
        // size format documentation: https://msdn.microsoft.com/en-us/library/documentformat.openxml.vml.shape%28v=office.14%29.aspx?f=255&MSPPError=-2147217396
        foreach ($varElements as $argIdx => $varArg) {
            if (strpos($varArg, '=')) { // arg=value
                [$argName, $argValue] = explode('=', $varArg, 2);
                $argName = strtolower($argName);
                if ($argName == 'size') {
                    [$varInlineArgs['width'], $varInlineArgs['height']] = explode('x', $argValue, 2);
                } else {
                    $varInlineArgs[strtolower($argName)] = $argValue;
                }
            } elseif (preg_match('/^([0-9]*[a-z%]{0,2}|auto)x([0-9]*[a-z%]{0,2}|auto)$/i', $varArg)) { // 60x40
                [$varInlineArgs['width'], $varInlineArgs['height']] = explode('x', $varArg, 2);
            } else { // :60:40:f
                switch ($argIdx) {
                    case 0:
                        $varInlineArgs['width'] = $varArg;

                        break;
                    case 1:
                        $varInlineArgs['height'] = $varArg;

                        break;
                    case 2:
                        $varInlineArgs['ratio'] = $varArg;

                        break;
                }
            }
        }

        return $varInlineArgs;
    }

    private function chooseImageDimension($baseValue, $inlineValue, $defaultValue)
    {
        $value = $baseValue;
        if (null === $value && isset($inlineValue)) {
            $value = $inlineValue;
        }
        if (!preg_match('/^([0-9\.]*(cm|mm|in|pt|pc|px|%|em|ex|)|auto)$/i', $value ?? '')) {
            $value = null;
        }
        if (null === $value) {
            $value = $defaultValue;
        }
        if (is_numeric($value)) {
            $value .= 'px';
        }

        return $value;
    }

    private function fixImageWidthHeightRatio(&$width, &$height, $actualWidth, $actualHeight): void
    {
        $imageRatio = $actualWidth / $actualHeight;

        if (($width === '') && ($height === '')) { // defined size are empty
            $width = $actualWidth . 'px';
            $height = $actualHeight . 'px';
        } elseif ($width === '') { // defined width is empty
            $heightFloat = (float) $height;
            $widthFloat = $heightFloat * $imageRatio;
            $matches = [];
            preg_match('/\\d([a-z%]+)$/', $height, $matches);
            $width = $widthFloat . $matches[1];
        } elseif ($height === '') { // defined height is empty
            $widthFloat = (float) $width;
            $heightFloat = $widthFloat / $imageRatio;
            $matches = [];
            preg_match('/\\d([a-z%]+)$/', $width, $matches);
            $height = $heightFloat . $matches[1];
        } else { // we have defined size, but we need also check it aspect ratio
            $widthMatches = [];
            preg_match('/\\d([a-z%]+)$/', $width, $widthMatches);
            $heightMatches = [];
            preg_match('/\\d([a-z%]+)$/', $height, $heightMatches);
            // try to fix only if dimensions are same
            if ($widthMatches[1] == $heightMatches[1]) {
                $dimention = $widthMatches[1];
                $widthFloat = (float) $width;
                $heightFloat = (float) $height;
                $definedRatio = $widthFloat / $heightFloat;

                if ($imageRatio > $definedRatio) { // image wider than defined box
                    $height = ($widthFloat / $imageRatio) . $dimention;
                } elseif ($imageRatio < $definedRatio) { // image higher than defined box
                    $width = ($heightFloat * $imageRatio) . $dimention;
                }
            }
        }
    }

    private function prepareImageAttrs($replaceImage, $varInlineArgs)
    {
        // get image path and size
        $width = null;
        $height = null;
        $ratio = null;

        // a closure can be passed as replacement value which after resolving, can contain the replacement info for the image
        // use case: only when a image if found, the replacement tags can be generated
        if (is_callable($replaceImage)) {
            $replaceImage = $replaceImage();
        }

        if (is_array($replaceImage) && isset($replaceImage['path'])) {
            $imgPath = $replaceImage['path'];
            if (isset($replaceImage['width'])) {
                $width = $replaceImage['width'];
            }
            if (isset($replaceImage['height'])) {
                $height = $replaceImage['height'];
            }
            if (isset($replaceImage['ratio'])) {
                $ratio = $replaceImage['ratio'];
            }
        } else {
            $imgPath = $replaceImage;
        }

        $width = $this->chooseImageDimension($width, $varInlineArgs['width'] ?? null, 115);
        $height = $this->chooseImageDimension($height, $varInlineArgs['height'] ?? null, 70);

        $imageData = @getimagesize($imgPath);
        if (!is_array($imageData)) {
            throw new Exception(sprintf('Invalid image: %s', $imgPath));
        }
        [$actualWidth, $actualHeight, $imageType] = $imageData;

        // fix aspect ratio (by default)
        if (null === $ratio && isset($varInlineArgs['ratio'])) {
            $ratio = $varInlineArgs['ratio'];
        }
        if (null === $ratio || !in_array(strtolower($ratio), ['', '-', 'f', 'false'])) {
            $this->fixImageWidthHeightRatio($width, $height, $actualWidth, $actualHeight);
        }

        $imageAttrs = [
            'src' => $imgPath,
            'mime' => image_type_to_mime_type($imageType),
            'width' => $width,
            'height' => $height,
        ];

        return $imageAttrs;
    }

    private function addImageToRelations($partFileName, $rid, $imgPath, $imageMimeType): void
    {
        // define templates
        $typeTpl = '<Override PartName="/word/media/{IMG}" ContentType="image/{EXT}"/>';
        $relationTpl = '<Relationship Id="{RID}" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/{IMG}"/>';
        $newRelationsTpl = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n" . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"></Relationships>';
        $newRelationsTypeTpl = '<Override PartName="/{RELS}" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>';
        $extTransform = [
            'image/jpeg' => 'jpeg',
            'image/png' => 'png',
            'image/bmp' => 'bmp',
            'image/gif' => 'gif',
        ];

        // get image embed name
        if (isset($this->tempDocumentNewImages[$imgPath])) {
            $imgName = $this->tempDocumentNewImages[$imgPath];
        } else {
            // transform extension
            if (isset($extTransform[$imageMimeType])) {
                $imgExt = $extTransform[$imageMimeType];
            } else {
                throw new Exception("Unsupported image type $imageMimeType");
            }

            // add image to document
            $imgName = 'image_' . $rid . '_' . pathinfo($partFileName, PATHINFO_FILENAME) . '.' . $imgExt;
            $this->zipClass->pclzipAddFile($imgPath, 'word/media/' . $imgName);
            $this->tempDocumentNewImages[$imgPath] = $imgName;

            // setup type for image
            $xmlImageType = str_replace(['{IMG}', '{EXT}'], [$imgName, $imgExt], $typeTpl);
            $this->tempDocumentContentTypes = str_replace('</Types>', $xmlImageType, $this->tempDocumentContentTypes) . '</Types>';
        }

        $xmlImageRelation = str_replace(['{RID}', '{IMG}'], [$rid, $imgName], $relationTpl);

        if (!isset($this->tempDocumentRelations[$partFileName])) {
            // create new relations file
            $this->tempDocumentRelations[$partFileName] = $newRelationsTpl;
            // and add it to content types
            $xmlRelationsType = str_replace('{RELS}', $this->getRelationsName($partFileName), $newRelationsTypeTpl);
            $this->tempDocumentContentTypes = str_replace('</Types>', $xmlRelationsType, $this->tempDocumentContentTypes) . '</Types>';
        }

        // add image to relations
        $this->tempDocumentRelations[$partFileName] = str_replace('</Relationships>', $xmlImageRelation, $this->tempDocumentRelations[$partFileName]) . '</Relationships>';
    }
}