#How it works
- This code will work in command line. 
- The code will basically take few arguments and will do the task as per the assessment test. 
- The code will take the files from the fixture folder and then merge the configuration data and will upload to output/config.json file in JSON format.
- The data from the **output/config.json** file can be fetched using php commands and is capable of doing additional tasks like rollback, reading history files, reading the key value data etc.
- The code library following arguments.

##INSERT
Ex: **php index.php insert**
- This operation will read all the files from the fixture folder and it will also show that which files have invalid JSON format.
- The code will then merge the data from all valid JSON file into a single array and push the data into JSON format into **output/config.json** file.
- The code will also create a copy into the history folder with timestamp appended name.
- The data will save with base key equal to fixture file basename, for example if the JSON is present inside **fixture/config.json** data will store with base key **config** similarly **config-local** for **config-local.json** file.

##READ CONFIG DATA
Ex: **php index.php read-config config.database.username**
- This code will read the output/config.json file and will accept the key in dot separated path.
- The code will show the output in the command line if available.

##HISTORY
Ex: **php index.php history**
- This command will show all the files present in the history folder.

##READ HISTORY
Ex: **php index.php read-history config-2021-11-21_21-08-19.json**
- The command will read the entire content of the history file.

##ROLLBACK
Ex: **php index.php rollback**
- In case we want to revert back the config file to a previous history file, then this command will be useful.
- The command will copy the content from the history file to the output config.json file.



