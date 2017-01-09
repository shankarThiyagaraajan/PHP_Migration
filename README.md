# PHP_Migration
Simple PHP package for Database Migration, Suitable for all kind PHP Projects

### Sample Table Scheme
        
    class Migration
     {    
     /**
      * Sample Table Schema.
      */
      public static function tables()
      {
        $tables = array(
            'student' => [
                'student_id' => 'integer',
                'name' => 'string',
                'class' => 'string',
                'dob'  => 'data',
                'age' => 'integer'
            ],
            'class' => [
                'class_id' => 'integer',
                'student_id' => 'integer',
                'section' => 'string'
            ]
        );
       }
     }
       
 ### Initiating Migration
 
       use shankarbala33\php_migration\Database;
       
       // Call Function as Static to Initate Migration.
       Database::migration();
        
It will creates the table **Student** and **Class** with given properties.
