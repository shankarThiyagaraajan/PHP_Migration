# PHP_Migration
Simple PHP package for Database Migration, Suitable for all kind PHP Projects

### Sample Table Scheme
        
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
        
It will creates the table **Student** and **Class** with given properties.
