<?php
$root_dir=__DIR__;

//Fetch the command line arguments.
$value = $_SERVER['argv'];

//Declare the config folder path.
$config_upload_path=$root_dir."/"."fixtures";

require_once ($root_dir."/lib/DividoFileParser.php");
$dividoParser = new DividoFileParser($config_upload_path, $root_dir);

$files = $dividoParser->loadFixtureFiles();
$files_content = $dividoParser->readAllFiles($files);
$dividoParser->pushOutput($files_content);


$dividoParser->readConfig("config.database.username");
?>
