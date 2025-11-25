<?php
function cleanInputs($input){  //correct wrong inputs before saving data in database
    $data = trim($input);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>