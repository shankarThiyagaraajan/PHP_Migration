# PHP_Migration
Simple PHP package for Database Migration, Suitable for all kind PHP Projects

[![Packagist](https://img.shields.io/badge/Packagist-v0.9-blue.svg)](https://github.com/shankarThiyagaraajan/PHP_Migration/releases)
[![License](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://github.com/shankarThiyagaraajan/PHP_Migration/blob/master/LICENSE)

## For Wordpress Migration
    
    include_once('/wordpress/migration.php');
    
    $my_table_schema =  [
              'table1' => [
                 'id' => [                 ===========> Result : "id int(20) auto_increment primary key"
                     'key' => [
                         'auto_increment',
                         'primary key'
                     ],
                     'type' => 'int',
                     'limit' => 20
                 ],
                 'name' => [                ===========> Result : "name varchar(255) unique key"
                     'key' => [
                         'unique key'
                     ],
                     'type' => 'varchar',
                     'limit' => 255
                 ],
                 'value' => [               ===========> Result : "value longtext"
                     'key' => [],
                     'type' => 'longtext',
                     'limit' => ''
                 ]
               ]
              ];
    
    $table_schema = "YOUR_TABLE_SCHEMA" ( same as $my_table_schema)
    
    // Initiate Migration.
    ST_DATABASE::migrate($table_schema);     ===============> It's Generate Formatted Wordpress Query and Execute.
                                                             

      
### General PHP Migration
 
       use shankarbala33\php_migration\Database;
       
       // Call Function as Static to Initate Migration.
       Database::migration();
        
It will creates the table **Student** and **Class** with given properties.
