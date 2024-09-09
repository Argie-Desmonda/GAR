<?php
if ($_SERVER["REQUEST_METHOD" !== "POST"]) {
  exit("POST Request Method required");
}

print_r($_FILES);
