<?php

include_once('src/wordpress/migration.php');

class PostTest extends PHPUnit_Framework_TestCase
{
    public function testTableSchemaReturn()
    {
        $db_helper = ST_DATABASE::tableToRegister();
        $this->assertEquals('true', is_array($db_helper));
    }
}
