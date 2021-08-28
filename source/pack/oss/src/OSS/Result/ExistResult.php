<?php
namespace OSS\Result;
class ExistResult extends Result
{
protected function parseDataFromResponse()
{
return intval($this->rawResponse->status) === 200 ?true : false;
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