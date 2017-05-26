<?php

/**
 * Class for Wordpress migtration.
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
                ],
                '__table_property' => [
                    'ENGINE' => 'InnoDB'
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

        // Getting Table Schema.
        if (empty($tables)) $tables = self::tableToRegister();

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        foreach ($tables as $table_name => $table) {

            $prop = '';

            // Table Properties.
            if (isset($table['__table_property'])) {
                $prop = array_keys($table['__table_property'])[0] . '=' . array_pop($table['__table_property']);
            }

            // Empty tables won't allowed.
            if ($table_name == '' || is_null($table_name)) continue;

            // Forming Table Name.
            $db_table_name = $wpdb->prefix . strtolower($table_name);

            // Ignore, if table already exists.
            if ($wpdb->get_var("SHOW TABLES LIKE '{$db_table_name}'") == $db_table_name) continue;

            $db_field_query = "CREATE TABLE {$db_table_name} ( ";

            foreach ($table as $field_name => $attr) {
                // Empty fields won't allowed.
                if ($field_name == '' || is_null($field_name)) continue;

                // Field Type is Mandatory.
                if (!isset($attr['type'])) continue;

                // Key is Optional, default is array.
                if (!isset($attr['key'])) $attr['key'] = [];

                // Limit is Optional, default is empty.
                if (is_array($attr['limit'])) {
                    $attr['limit'] = '"' . implode('","', $attr['limit']) . '"';
                }
                // Preparing Query.
                $db_field_query .= $field_name . ' ' . $attr['type'] . (($attr['limit'] != '') ? '(' . $attr['limit'] . ') ' : '') . implode(' ', $attr['key']) . ', ';
            }
            // Trim the Query.
            $field_query[$table_name] = rtrim($db_field_query, ', ') . ' ) ' . $prop;

            // Executing the Query.
            dbDelta($field_query[$table_name]);
        }
    }

}
