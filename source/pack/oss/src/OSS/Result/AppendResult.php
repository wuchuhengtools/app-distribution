<?php
namespace OSS\Result;
use OSS\Core\OssException;
class AppendResult extends Result
{
protected function parseDataFromResponse()
{
$header = $this->rawResponse->header;
if (isset($header["x-oss-next-append-position"])) {
return intval($header["x-oss-next-append-position"]);
}
throw new OssException("cannot get next-append-position");
}
}
?>