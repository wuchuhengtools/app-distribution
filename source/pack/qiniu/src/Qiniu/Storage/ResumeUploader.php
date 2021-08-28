<?php
namespace Qiniu\Storage;
use Qiniu\Config;
use Qiniu\Http\Client;
use Qiniu\Http\Error;
final class ResumeUploader
{
private $upToken;
private $key;
private $inputStream;
private $size;
private $params;
private $mime;
private $contexts;
private $host;
private $currentUrl;
private $config;
public function __construct(
$upToken,
$key,
$inputStream,
$size,
$params,
$mime,
$config
) {
$this->upToken = $upToken;
$this->key = $key;
$this->inputStream = $inputStream;
$this->size = $size;
$this->params = $params;
$this->mime = $mime;
$this->contexts = array();
$this->config = $config;
list($upHost,$err) = $config->zone->getUpHostByToken($upToken);
if ($err != null) {
throw new \Exception($err,1);
}
$this->host = $upHost;
}
public function upload()
{
$uploaded = 0;
while ($uploaded <$this->size) {
$blockSize = $this->blockSize($uploaded);
$data = fread($this->inputStream,$blockSize);
if ($data === false) {
throw new \Exception("file read failed",1);
}
$crc = \Qiniu\crc32_data($data);
$response = $this->makeBlock($data,$blockSize);
$ret = null;
if ($response->ok() &&$response->json() != null) {
$ret = $response->json();
}
if ($response->statusCode <0) {
list($bakHost,$err) = $this->config->zone->getBackupUpHostByToken($this->upToken);
if ($err != null) {
return array(null,$err);
}
$this->host = $bakHost;
}
if ($response->needRetry() ||!isset($ret['crc32']) ||$crc != $ret['crc32']) {
$response = $this->makeBlock($data,$blockSize);
$ret = $response->json();
}
if (!$response->ok() ||!isset($ret['crc32'])||$crc != $ret['crc32']) {
return array(null,new Error($this->currentUrl,$response));
}
array_push($this->contexts,$ret['ctx']);
$uploaded += $blockSize;
}
return $this->makeFile();
}
private function makeBlock($block,$blockSize)
{
$url = $this->host .'/mkblk/'.$blockSize;
return $this->post($url,$block);
}
private function fileUrl()
{
$url = $this->host .'/mkfile/'.$this->size;
$url .= '/mimeType/'.\Qiniu\base64_urlSafeEncode($this->mime);
if ($this->key != null) {
$url .= '/key/'.\Qiniu\base64_urlSafeEncode($this->key);
}
if (!empty($this->params)) {
foreach ($this->params as $key =>$value) {
$val =  \Qiniu\base64_urlSafeEncode($value);
$url .= "/$key/$val";
}
}
return $url;
}
private function makeFile()
{
$url = $this->fileUrl();
$body = implode(',',$this->contexts);
$response = $this->post($url,$body);
if ($response->needRetry()) {
$response = $this->post($url,$body);
}
if (!$response->ok()) {
return array(null,new Error($this->currentUrl,$response));
}
return array($response->json(),null);
}
private function post($url,$data)
{
$this->currentUrl = $url;
$headers = array('Authorization'=>'UpToken '.$this->upToken);
return Client::post($url,$data,$headers);
}
private function blockSize($uploaded)
{
if ($this->size <$uploaded +Config::BLOCK_SIZE) {
return $this->size -$uploaded;
}
return  Config::BLOCK_SIZE;
}
}
?>