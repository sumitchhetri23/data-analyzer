<?php
    if (isset($_GET["username"])) {   
        $php_abc= $_GET["username"];
    echo $php_abc;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body>
<form id="viform" action="check.php" method="get">
<input type="text" id="user1" name="username">
<input type="submit" onclick="vci()"><br />
</form>
<h1 id="label1"></h1>
<script>
function vci(){
    var abc = document.getElementById("user1").value;
alert(abc);
}
</script>
</body>
</html>