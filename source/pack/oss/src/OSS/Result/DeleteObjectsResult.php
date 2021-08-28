<?php
namespace OSS\Result;
class DeleteObjectsResult extends Result
{
protected function parseDataFromResponse()
{
$body = $this->rawResponse->body;
$xml = simplexml_load_string($body);
$objects = array();
if (isset($xml->Deleted)) {
foreach($xml->Deleted as $deleteKey)
$objects[] = $deleteKey->Key;
}
return $objects;
}
}
?>