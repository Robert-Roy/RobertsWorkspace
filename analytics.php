<!--
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89608698-1', 'auto');
  ga('send', 'pageview');

</script>
-->
<?php
$page = $_SERVER['PHP_SELF'];
$time = date("Y-m-d H:i:s");
$IP = htmlspecialchars(\filter_var(\trim($_SERVER['REMOTE_ADDR']), FILTER_SANITIZE_STRING));
$json = file_get_contents("http://ip-api.com/json/$IP");
$array = json_decode($json);
if (is_object($array)) {
    $status = htmlspecialchars(\filter_var(\trim($array->status), FILTER_SANITIZE_STRING));
    if ($status === "success") {
        $country = htmlspecialchars(\filter_var(\trim($array->country), FILTER_SANITIZE_STRING));
        $regionName = htmlspecialchars(\filter_var(\trim($array->regionName), FILTER_SANITIZE_STRING));
        $city = htmlspecialchars(\filter_var(\trim($array->city), FILTER_SANITIZE_STRING));
        $org = htmlspecialchars(\filter_var(\trim($array->org), FILTER_SANITIZE_STRING));
        //$query= htmlspecialchars(\filter_var(\trim($array->query), FILTER_SANITIZE_STRING));
        mail('robertproy@live.com', "Pageload Logged", "$IP loaded $page at $time
        
Information about this ip:
    Country: $country
    City: $city
    Region: $regionName
    Organization: $org
    ");
    } else {
        mail('robertproy@live.com', "Analytics Failure", "Analytics failed for some reason at $time for $IP CODE 2");
    }
} else {
    mail('robertproy@live.com', "Analytics Failure", "Analytics failed for some reason at $time for $IP CODE 1");
}
?>
