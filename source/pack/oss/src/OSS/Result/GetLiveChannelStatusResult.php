<?php


namespace OSS\Result;
use OSS\Model\GetLiveChannelStatus;
class GetLiveChannelStatusResult extends Result
{
protected function parseDataFromResponse()
{
$content = $this->rawResponse->body;
$channelList = new GetLiveChannelStatus();
$channelList->parseFromXml($content);
return $channelList;
}
}
?>