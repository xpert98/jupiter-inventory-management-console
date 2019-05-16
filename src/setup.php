<html>
<head>
    <title>Setup</title>
</head>
<body>

<?php
include 'secret.php';
$secret = new secret;
?>

Encryption Key:
<br>
<textarea rows="4" style="width: 800px;">
<?php

$secretKey = $secret->genString(4);

echo $secretKey;

?>
</textarea>

<br>
<br>

Initialization Vector:
<br>
<textarea rows="2" style="width: 800px;">
<?php

$iv = $secret->genString(1);

echo $iv;

?>
</textarea>
</body>
</html>