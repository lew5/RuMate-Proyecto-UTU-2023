<?php
require_once base_path("api/services/delete.php");
$remate = App::resolve("Remate");
deleteData($remate);
?>