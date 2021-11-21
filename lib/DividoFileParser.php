<?php
/*
 * (C) All Rights Reserved.
 * Author: N.Srinivasulu Rao<n.srinivasulurao@gmail.com>
 * Description: This code should be used only for divido assessment test.
 */
class DividoFileParser{
    protected $folder_root;
    protected $root_dir;
    public function __construct($fr,$rd)
    {
        $this->folder_root=$fr;
        $this->root_dir = $rd;
    }

    /*
     * This function will load all the files and will push in an array variable.
     */
    public function loadFixtureFiles(){
        $files=[];
        try {
            $folderPointer = opendir($this->folder_root);
            while($fp=readdir($folderPointer)):
                if ($fp == '.' or $fp == '..') continue;
                $files[]=$fp;
            endwhile;
            closedir($folderPointer);
            }
            catch (Exception $e) {
                return $e->getMessage() . "@ line: " . $e->getLine();
            }
            return $files;
    }

    public function readAllFiles($files){
        $this->printMessage("Available Files :",'info');
        $files_content=[];
        try{
            if(sizeof($files) > 0){
                foreach ($files as $key=>$val):
                    $file_path=$this->folder_root."/".$val;
                    $fp=fopen($file_path,"r");
                    $file_content=fread($fp,filesize($file_path));
                    if($this->isJSON($file_content)){
                        $files_content[basename($val,'.json')]=json_decode($file_content);
                        $this->printMessage($val."->"."Valid JSON Data", 'success');
                    }
                    else{
                        $this->printMessage($val."->"."Invalid JSON Data" ,'error');
                    }
                endforeach;
            }
            else{
                throw new Exception("No config files found inside folder {$this->folder_root} !");
            }
        }
        catch(Exception $e){
            $this->printMessage($e->getMessage()."@ line: ".$e->getLine(),'error');
        }
        return $files_content;
    }

    public function pushOutput($output){
        try {
            if (is_array($output) || is_object($output)) {
                $new_file_content = json_encode($output, JSON_PRETTY_PRINT);

                $target_file_path = $this->root_dir."/output/config.json";
                $fp1 = fopen($target_file_path, "w+");
                fwrite($fp1, $new_file_content);
                fclose($fp1);
                $this->printMessage("Configuration Details Added successfully to $target_file_path", 'success');

                //Put the same content to the history folder as well for backup.
                $history_file_path = $this->root_dir."/output/history/config-".str_replace(" ","_",date("Y-m-d H-i-s")).".json";
                $fp2 = fopen($history_file_path, "w+");
                fwrite($fp2, $new_file_content);
                fclose($fp2);
                $this->printMessage("History Added Successfully to $history_file_path", 'success');
            }
        }
        catch (Exception $e){
            $this->printMessage($e->getMessage()." @ line: ".$e->getLine(),'error');
        }
    }

    public function readConfig($baseKey){
        try{
            $config_file_path = $this->root_dir . "/output/config.json";
            $fp=fopen($config_file_path,"r");
            $file_content=fread($fp, filesize($config_file_path));
            $output=json_decode($file_content);
            $baseKeyArr=explode('.', $baseKey);
            $output_data = $output;
            foreach($baseKeyArr as $key):
                if(property_exists($output_data,$key)) {
                    $output_data = $output_data->{$key};
                }
                else{
                    throw new Exception("Invalid key value passed");
                }
            endforeach;
            $this->debugger($output_data, false);
        }catch (Exception $e){
            $this->printMessage($e->getMessage()." @ line: ".$e->getLine(),'error');
        }
    }

    public function revertConfig($file_name){
        try {
            $history_file_path = $this->root_dir . "/output/history/" . $file_name;
            $config_file_path = $this->root_dir . "/output/config.json";
            if (file_exists($history_file_path)) {
                if (copy($history_file_path, $config_file_path)) {
                    $this->printMessage("Config File Reverted to $file_name", 'success');
                }
            } else {
                $this->printMessage("{$file_name} file doesn't exists", 'error');
            }
        }
        catch(Exception $e){
            $this->printMessage($e->getMessage()." @ line: ".$e->getLine(),'error');
        }
    }

    public function readHistoryFolder(){
        $this->printMessage("Files available in History folder : ",'info');
        $history_folder = $this->root_dir."/output/history";
        $folderPointer = opendir($history_folder);
        while($fp=readdir($folderPointer)):
            if ($fp == '.' or $fp == '..') continue;
            $this->printMessage($fp,'info');
        endwhile;
        closedir($folderPointer);
    }

    public function readSpecificHistoryFile($file_name){
        $history_file_path=$this->root_dir."/output/history/".$file_name;
        if(file_exists($history_file_path)) {
            $fp=fopen($history_file_path,'r');
            $file_content=fread($fp, filesize($history_file_path));
            $this->printMessage($file_content,'success');
        }else{
            $this->printMessage("{$file_name} file doesn't exists", 'error');
        }
    }

    public function isJSON($string){
       if(is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE)){
           return true;
       }
       else {
           return false;
       }
    }

    public function debugger($arr,$tags=true){
        if($tags == true)
        echo "<pre>";
        print_r($arr);
        if($tags == true)
        echo "</pre>";
    }

    public function printMessage($str, $type){

        switch ($type) {
            case 'error':
                echo "\033[31m$str \033[0m\n";
                break;
            case 'success':
                echo "\033[32m$str \033[0m\n";
                break;
            case 'warning':
                echo "\033[33m$str \033[0m\n";
                break;
            case 'info':
                echo "\033[36m$str \033[0m\n";
                break;
            default:
                $str="Invalid message type";
                echo "\033[31m$str \033[0m\n";
                break;
        }
    }

}// Class ends here.

?>