<?php

namespace shankarbala33\php_migration;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * General Package for call database tables to create or update it self automatically
 */
 
class Util
{

  /**
     * To Perform migration to ensure the table and its properties
     * are up-to-date
     *
     */
    public static function migration()
    {
        $tables = Migration::tables();
        foreach ($tables as $key => $value) {
            loop:
            if (Capsule::Schema()->hasTable($key)) {
                foreach ($value as $column => $datatype) {
                    if (!Capsule::Schema()->hasColumn($key, $column)) {

                        //Assign the Name and Datatype for temporary access
                        self::$columns['name'] = $column;
                        self::$columns['datatype'] = $datatype;

                        Capsule::Schema()->table($key, function ($table) {
                            $column = self::$columns['name'];
                            $datatype = self::$columns['datatype'];
                            $table->$datatype($column)->after('id');
                        });
                    }
                }
            } else {
                Capsule::schema()->create($key, function ($table) {
                    $table->increments('id');
                    $table->timestamps();
                });
                goto loop;
            }
        }
    }

}
