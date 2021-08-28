<?php
namespace OSS\Http;
class ResponseCore
{
public $header;
public $body;
public $status;
public function __construct($header,$body,$status = null)
{
$this->header = $header;
$this->body = $body;
$this->status = $status;
return $this;
}
public function isOK($codes = array(200,201,204,206))
{
if (is_array($codes)) {
return in_array($this->status,$codes);
}
return $this->status === $codes;
}
}
?>