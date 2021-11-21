<?php
/*
 * (C) All Rights Reserved.
 * Author: N.Srinivasulu Rao<n.srinivasulurao@gmail.com>
 * Description: This code should be used only for divido assessment test.
 */
$root_dir=__DIR__;

//Fetch the command line arguments.
$value = $_SERVER['argv'];

//Declare the config folder path.
$config_upload_path=$root_dir."/"."fixtures";

//Declare our library file, this will do all the tasks step by step.
require_once ($root_dir."/lib/DividoFileParser.php");
$dividoParser = new DividoFileParser($config_upload_path, $root_dir);

switch ($value[1]) {
    /*
     * This command will basically read all the configuration files from the fixtures folder.
     * Next, it will merge the configurations in the config.json file inside the output folder.
     * Along with that it will create a history files, which can be reverted back to original config hub.
     */
    case 'insert':
        //Get the list of all the files.
        $files = $dividoParser->loadFixtureFiles();

        //Gather the content of all the files.
        $files_content = $dividoParser->readAllFiles($files);

        //Push the content to the output folder.
        $dividoParser->pushOutput($files_content);
    break;

    case 'read-config':
        $dividoParser->readConfig($value[2]);
    break;

    /*
     * This command will basically revert the history config file to the original config file.
     * ex: php index.php rollback config-2021-11-21_21-08-19.json
     */
    case 'rollback':
        $dividoParser->revertConfig($value[2]);
    break;

    /*
     * This command will basically  read all the files from the history folder
     * ex: php index.php history
     */
    case 'history':
        $dividoParser->readHistoryFolder();
    break;

    /*
     * This command will read the content of a specific history file
     * ex: php index.php read-history config-2021-11-21_21-08-19.json
     */
    case 'read-history':
        $dividoParser->readSpecificHistoryFile($value[2]);
    break;

    /*
     * Command to handle the invalid argument.
     */
    default:
        $dividoParser->printMessage("Invalid Input Parameter, supported argument are \n 
        php index.php insert \n 
        php index.php read-config config.database.username \n
        php index.php history \n
        php index.php read-history config-2021-11-21_21-08-19.json \n
        php index.php rollback config-2021-11-21_21-08-19.json \n", 'error');
    break;
}