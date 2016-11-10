<?php

namespace shankarbala33/php_migration;

/**
 * Class Rules for Manage Rules for Different Forms
 */
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
        return $tables;
    }

}
