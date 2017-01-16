<?php

/**
 * Class ST_DATABASE
 */
class ST_DATABASE
{

    /**
     * List of Database Table Schema.
     *
     * @return array
     */
    public static function tableToRegister()
    {
        return [
            'table1' => [
                'id' => [
                    'key' => [
                        'auto_increment',
                        'primary key'
                    ],
                    'type' => 'int',
                    'limit' => 20
                ],
                'name' => [
                    'key' => [
                        'unique key'
                    ],
                    'type' => 'varchar',
                    'limit' => 255
                ],
                'value' => [
                    'key' => [],
                    'type' => 'int',
                    'limit' => 50
                ]
            ],
            // "ticket_map_meta" table schema.
            'table2' => [
                'id' => [
                    'key' => [
                        'auto_increment',
                        'primary key'
                    ],
                    'type' => 'bigint',
                    'limit' => 20
                ],
                'meta_key' => [
                    'key' => [],
                    'type' => 'varchar',
                    'limit' => 255
                ],
                'meta_value' => [
                    'key' => [],
                    'type' => 'longtext',
                    'limit' => ''
                ]
            ]
        ];
    }

    /**
     * To Migrate Wordpress Tables.
     *
     * @param array $tables
     */
    public static function migrate($tables = [])
    {
        global $wpdb;

        if (empty($tables)) $tables = self::tableToRegister();

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        foreach ($tables as $table_name => $table) {

            // Empty tables won't allowed.
            if ($table_name == '' || is_null($table_name)) continue;

            $db_table_name = $wpdb->prefix . strtolower($table_name);
            $db_field_query = "CREATE TABLE {$db_table_name} ( ";

            foreach ($table as $field_name => $attr) {
                // Empty fields won't allowed.
                if ($field_name == '' || is_null($field_name)) continue;

                // Field Type is Mandatory.
                if (!isset($attr['type'])) continue;

                if (!isset($attr['key'])) $attr['key'] = [];

                $db_field_query .= $field_name . ' ' . $attr['type'] . (($attr['limit'] != '') ? '(' . $attr['limit'] . ') ' : '') . implode(' ', $attr['key']) . ', ';
            }
            $field_query[$table_name] = rtrim($db_field_query, ', ') . ' )';
            dbDelta($field_query[$table_name]);
        }
    }


}
