<?php
namespace OSS\Result;
use OSS\Core\OssException;
class InitiateMultipartUploadResult extends Result
{
protected function parseDataFromResponse()
{
$content = $this->rawResponse->body;
$xml = simplexml_load_string($content);
if (isset($xml->UploadId)) {
return strval($xml->UploadId);
}
throw new OssException("cannot get UploadId");
}
}
?>