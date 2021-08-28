<?php
namespace OSS\Result;
use OSS\Core\OssException;
class UploadPartResult extends Result
{
protected function parseDataFromResponse()
{
$header = $this->rawResponse->header;
if (isset($header["etag"])) {
return $header["etag"];
}
throw new OssException("cannot get ETag");
}
}
?>