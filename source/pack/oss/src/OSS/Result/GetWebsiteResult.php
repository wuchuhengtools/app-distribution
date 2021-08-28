<?php


namespace OSS\Result;
use OSS\Model\WebsiteConfig;
class GetWebsiteResult extends Result
{
protected function parseDataFromResponse()
{
$content = $this->rawResponse->body;
$config = new WebsiteConfig();
$config->parseFromXml($content);
return $config;
}
protected function isResponseOk()
{
$status = $this->rawResponse->status;
if ((int)(intval($status) / 100) == 2 ||(int)(intval($status)) === 404) {
return true;
}
return false;
}
}
?>