<?php
include("vendor/autoload.php");


$app = new Newsnav\App();

// register paths
$app->bindPaths(require("app/paths.php"));

// load helpers
$app->loadHelpers();

// load dependencies
$app->loadDependencies();

// load all pages
$app->loadPages();


$app->run();