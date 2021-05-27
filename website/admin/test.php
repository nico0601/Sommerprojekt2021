<pre>
<?php
echo file_get_contents("php://input");
echo "\n";
var_dump($_POST);
?>
</pre>


<form method="post" action="/api/therapy.php">
    <input type="text" name="test">

    <input type="submit">
</form>
