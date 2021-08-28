<?php
namespace OSS\Result;
use OSS\Model\GetLiveChannelHistory;
class GetLiveChannelHistoryResult extends Result
{
protected function parseDataFromResponse()
{
$content = $this->rawResponse->body;
$channelList = new GetLiveChannelHistory();
$channelList->parseFromXml($content);
return $channelList;
}
}
?>