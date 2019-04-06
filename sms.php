<?php
 $user = "94719862062";
$password = "5992";
$text = urlencode("Happy Birth Day. Savimaga.com");
$to = "94784714436";
 
$baseurl ="http://www.textit.biz/sendmsg";
$url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
$ret = file($url);
 
$res= explode(":",$ret[0]);
 
if (trim($res[0])=="OK")
{
echo "Message Sent - ID : ".$res[1];
}
else
{
echo "Sent Failed - Error : ".$res[1];
}
  ?>



  