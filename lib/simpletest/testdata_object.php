<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage datalib
 *
 * Unit tests for lib/datalib.php
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden');
}

require_once("{$CFG->libdir}/data_object.php");


/**
 * A mock object for testing the old data_object API
 */
class test_data_object_oldapi extends data_object {

    /**
     * DB Table
     * @var string $table
     */
    public $table = 'test_oldapi';

    /**
     * Array of required table fields, must start with 'id'.
     * @var array $required_fields
     */
    public $required_fields = array('id', 'content', 'foreignkey');

    /**
     * Content
     * @access  public
     * @var     str
     */
    public $content;

    /**
     * Foreign key
     * @access  public
     * @var     int
     */
    public $foreignkey;


    /**
     * Finds and returns a data_object instance based on params.
     * @static static
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public static function fetch($params) {
        return self::fetch_helper('test_oldapi', __CLASS__, $params);
    }
}


/**
 * A mock object for testing the new data_object API
 */
class test_data_object_newapi extends data_object {

    /**
     * DB Table
     * @var string $table
     */
    public $table = 'test_newapi';

    /**
     * Array of required table fields, must start with 'id'.
     * @var array $required_fields
     */
    public $required_fields = array('id', 'content', 'foreignkey');

    /**
     * Unique fields to be used in where clauses
     * when the ID is not known
     *
     * @access  public
     * @var     array       $unique fields
     */
    public $unique_fields = array('foreignkey');

    /**
     * Content
     * @access  public
     * @var     str
     */
    public $content;

    /**
     * Foreign key
     * @access  public
     * @var     int
     */
    public $foreignkey;


    /**
     * Finds and returns a data_object instance based on params.
     * @static static
     *
     * @param array $params associative arrays varname=>value
     * @return object data_object instance or false if none found.
     */
    public static function fetch($params) {
        return self::fetch_helper('test_newapi', __CLASS__, $params);
    }
}



/**
 * Test suite for lib/data_object.php
 */
class data_object_test extends prefix_changing_test_case {

    private $data_list = array('test_oldapi', 'test_newapi');

    private $data_test_oldapi = array(
        array('id', 'content', 'foreignkey'),
        array(1, 'help', 2)
    );

    private $data_test_newapi = array(
        array('id', 'content', 'foreignkey'),
        array(1, 'help', 2)
    );


    /**
     * Database setup
     */
    public function setUp() {
        global $CFG, $db;
        parent::setUp();

        foreach ($this->data_list as $table) {
            $array = "data_{$table}";
            load_test_table($CFG->prefix.$table, $this->$array, $db);
        }
    }


    /**
     * Database tear down
     */
    public function tearDown() {
        global $CFG, $db;

        foreach ($this->data_list as $table) {
            remove_test_table($CFG->prefix.$table, $db);
        }

        parent::tearDown();
    }


    /**
     * Test creation of objects using old api
     */
    function test_oldapiobjects()
    {
        // Create empty object without fetching
        $new = new test_data_object_oldapi();
        $this->assertEqual($new->id, null);

        // Create object with fetching
        $new = new test_data_object_oldapi(array('id' => 1), false);
        $this->assertEqual($new->content, null);

        // Create object which fetches from database by key
        $new = new test_data_object_oldapi(array('id' => 1));
        $this->assertEqual($new->content, 'help');

        // Create object which fetches from database with id and large WHERE
        $new = new test_data_object_oldapi(array('id' => 1, 'content' => 'help'));
        $this->assertEqual($new->foreignkey, 2);

        // Create object which fetches from database with id and incorrect WHERE
        $new = new test_data_object_oldapi(array('id' => 1, 'content' => 'incorrect'));
        $this->assertEqual($new->foreignkey, null);

        // Create object which fetches from database without id and large WHERE
        $new = new test_data_object_oldapi(array('foreignkey' => 2, 'content' => 'help'));
        $this->assertEqual($new->id, 1);

        // Create object which fetches from database without id and incorrect WHERE
        $new = new test_data_object_oldapi(array('foreignkey' => 2, 'content' => 'incorrect'));
        $this->assertEqual($new->id, null);
    }


    /**
     * Test creation of objects using new api
     */
    function test_newapiobjects()
    {
        // Create empty object without fetching
        $new = new test_data_object_newapi();
        $this->assertEqual($new->id, null);

        // Create object with fetching
        $new = new test_data_object_newapi(array('id' => 1), false);
        $this->assertEqual($new->content, null);

        // Create object which fetches from database by key
        $new = new test_data_object_newapi(array('id' => 1));
        $this->assertEqual($new->content, 'help');

        // Create object which fetches from database with id and large WHERE
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'help'));
        $this->assertEqual($new->foreignkey, 2);

        // Create object which fetches from database with id and incorrect WHERE
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'incorrect'));
        $this->assertEqual($new->foreignkey, null);

        // Create object which fetches from database without id and large WHERE
        $new = new test_data_object_newapi(array('foreignkey' => 2, 'content' => 'help'));
        $this->assertEqual($new->id, 1);

        // Create object which fetches from database without id and incorrect WHERE
        $new = new test_data_object_newapi(array('foreignkey' => 2, 'content' => 'incorrect'));
        $this->assertEqual($new->id, null);

        // Create object which fetches from database with id and large WHERE, and new API
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'help'), DATA_OBJECT_FETCH_BY_KEY);
        $this->assertEqual($new->foreignkey, 2);

        // Create object which fetches from database with id and incorrect WHERE (but new API)
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'incorrect'), DATA_OBJECT_FETCH_BY_KEY);
        $this->assertEqual($new->foreignkey, 2);

        // Create object which fetches from database with id and incorrect WHERE (but new API)
        $new = new test_data_object_newapi(array('id' => 1, 'foreignkey' => 'incorrect'), DATA_OBJECT_FETCH_BY_KEY);
        $this->assertEqual($new->foreignkey, 'incorrect');
        $this->assertEqual($new->content, 'help');

        // Create object which fetches from database without id and large WHERE, and new API
        $new = new test_data_object_newapi(array('foreignkey' => 2, 'content' => 'help'), DATA_OBJECT_FETCH_BY_KEY);
        $this->assertEqual($new->id, 1);

        // Create object which fetches from database without id and incorrect WHERE, and new API
        $new = new test_data_object_newapi(array('foreignkey' => 2, 'content' => 'incorrect'), DATA_OBJECT_FETCH_BY_KEY);
        $this->assertEqual($new->id, 1);

        // Create object which fetches from database with id and large WHERE, and new API
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'help'), array());
        $this->assertEqual($new->foreignkey, 2);

        // Create object which fetches from database with id and incorrect WHERE, and new API
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'incorrect'), array());
        $this->assertEqual($new->foreignkey, null);

        // Create object which fetches from database with id and large WHERE, and new API
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'help'), array('content'));
        $this->assertEqual($new->foreignkey, 2);

        // Create object which fetches from database with id and incorrect WHERE (but new API)
        $new = new test_data_object_newapi(array('id' => 1, 'content' => 'incorrect'), array('content'));
        $this->assertEqual($new->foreignkey, null);

        // Create object which fetches from database with id and incorrect WHERE (but new API)
        $new = new test_data_object_newapi(array('id' => 1, 'foreignkey' => 'incorrect'), array('content'));
        $this->assertEqual($new->foreignkey, 'incorrect');
        $this->assertEqual($new->content, 'help');

        // Create object which fetches from database without id and large WHERE, and new API
        $new = new test_data_object_newapi(array('foreignkey' => 3, 'content' => 'help'), array('content'));
        $this->assertEqual($new->id, 1);

        // Create object which fetches from database without id and incorrect WHERE, and new API
        $new = new test_data_object_newapi(array('foreignkey' => 2, 'content' => 'incorrect'), array('content'));
        $this->assertEqual($new->id, null);
    }
}
