<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
// header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");

function autoload($class) {
    include "classes/" . $class . ".php";
}
spl_autoload_register("autoload");