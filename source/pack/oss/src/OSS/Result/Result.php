<?php
namespace OSS\Result;
use OSS\Core\OssException;
use OSS\Http\ResponseCore;
abstract class Result
{
public function __construct($response)
{
if ($response === null) {
throw new OssException("raw response is null");
}
$this->rawResponse = $response;
$this->parseResponse();
}
public function getRequestId()
{
if (isset($this->rawResponse) &&
isset($this->rawResponse->header) &&
isset($this->rawResponse->header['x-oss-request-id'])
) {
return $this->rawResponse->header['x-oss-request-id'];
}else {
return '';
}
}
public function getData()
{
return $this->parsedData;
}
abstract protected function parseDataFromResponse();
public function isOK()
{
return $this->isOk;
}
public function parseResponse()
{
$this->isOk = $this->isResponseOk();
if ($this->isOk) {
$this->parsedData = $this->parseDataFromResponse();
}else {
$httpStatus = strval($this->rawResponse->status);
$requestId = strval($this->getRequestId());
$code = $this->retrieveErrorCode($this->rawResponse->body);
$message = $this->retrieveErrorMessage($this->rawResponse->body);
$body = $this->rawResponse->body;
$details = array(
'status'=>$httpStatus,
'request-id'=>$requestId,
'code'=>$code,
'message'=>$message,
'body'=>$body
);
throw new OssException($details);
}
}
private function retrieveErrorMessage($body)
{
if (empty($body) ||false === strpos($body,'<?xml')) {
return '';
}
$xml = simplexml_load_string($body);
if (isset($xml->Message)) {
return strval($xml->Message);
}
return '';
}
private function retrieveErrorCode($body)
{
if (empty($body) ||false === strpos($body,'<?xml')) {
return '';
}
$xml = simplexml_load_string($body);
if (isset($xml->Code)) {
return strval($xml->Code);
}
return '';
}
protected function isResponseOk()
{
$status = $this->rawResponse->status;
if ((int)(intval($status) / 100) == 2) {
return true;
}
return false;
}
public function getRawResponse()
{
return $this->rawResponse;
}
protected $isOk = false;
protected $parsedData = null;
protected $rawResponse;
}
?>