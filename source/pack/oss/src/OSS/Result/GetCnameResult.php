<?php
namespace OSS\Result;
use OSS\Model\CnameConfig;
class GetCnameResult extends Result
{
protected function parseDataFromResponse()
{
$content = $this->rawResponse->body;
$config = new CnameConfig();
$config->parseFromXml($content);
return $config;
}
}
?>