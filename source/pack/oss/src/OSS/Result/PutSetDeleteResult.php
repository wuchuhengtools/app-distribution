<?php
namespace OSS\Result;
class PutSetDeleteResult extends Result
{
protected function parseDataFromResponse()
{
$body = array('body'=>$this->rawResponse->body);
return array_merge($this->rawResponse->header,$body);
}
}

?>