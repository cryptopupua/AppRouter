<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img src="//ipv6.he.net/certification/create_badge.php?pass_name=CryptopupSite&amp;badge=3" style="border: 0; width: 229px; height: 137px" alt="IPv6 Certification Badge for CryptopupSite"></img>
    <div id="idSitesList"></div><?php
    require_once('Apps.php');
    $apps = new Apps();
    $htmlResponse = "<table border='1'>";
    foreach ($apps->getAllApps() as $key => $value) {
        $htmlResponse .= \sprintf('<tr><td><a href="%s">%s</a></td></tr>', $value, $key);
    }
    $htmlResponse .= "</table>";
    echo $htmlResponse;
    ?>

</html>
