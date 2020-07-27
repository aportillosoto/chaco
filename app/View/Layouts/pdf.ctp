<?php
$this->response->type('application/pdf');
header("Content-type: application/pdf");
echo $content_for_layout;
?>
