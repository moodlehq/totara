<?php
/**
* Unit tests for mod/facetoface/lib.php
*
* @author Chris Wharton <chrisw@catalyst.net.nz>
* @author Aaron Barnes <aaronb@catalyst.net.nz>
*/

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot .'/mod/facetoface/lib.php');

require_once($CFG->libdir . '/simpletestlib.php');

class facetofacelib_test extends prefix_changing_test_case {
    // test database data
    var $config_data = array(
        array('id', 'name', 'value'),
        array(0, '', ''),
    );

    var $facetoface_data = array(
        array('id',                     'course',           'name',                     'thirdparty',
            'thirdpartywaitlist',       'display',          'confirmationsubject',      'confirmationinstrmngr',
            'confirmationmessage',      'waitlistedsubject','waitlistedmessage',        'cancellationsubject',
            'cancellationinstrmngr',    'cancellationmessage','remindersubject',        'reminderinstrmngr',
            'remindermessage',          'reminderperiod',   'requestsubject',           'requestinstrmngr',
            'requestmessage',           'timecreated',      'timemodified',             'shortname',
            'description',              'showoncalendar',   'approvalreqd'
            ),
        array(1,                        1,                  'name1',                    'thirdparty1',
            0,                          0,                  'consub1',                  'coninst1',
            'conmsg1',                  'waitsub1',         'waitmsg1',                 'cansub1',
            'caninst1',                 'canmsg1',          'remsub1',                  'reminst1',
            'remmsg1',                  0,                  'reqsub1',                  'reqinst1',
            'reqmsg1',                  0,                  0,                          'short1',
            'desc1',                    1,                  0
            ),
        array(2,                        2,                  'name2',                    'thirdparty2',
            0,                          0,                  'consub2',                  'coninst2',
            'conmsg2',                  'waitsub2',         'waitmsg2',                 'cansub2',
            'caninst2',                 'canmsg2',          'remsub2',                  'reminst2',
            'remmsg2',                 0,                  'reqsub2',                  'reqinst2',
            'reqmsg2',                  0,                  0,                          'short2',
            'desc2',                    1,                  0
            ),
        array(3,                        3,                  'name3',                    'thirdparty3',
            0,                          0,                  'consub3',                  'coninst3',
            'conmsg3',                  'waitsub3',         'waitmsg3',                 'cansub3',
            'caninst3',                 'canmsg3',          'remsub3',                  'reminst3',
            'remmsg3',                  0,                  'reqsub3',                  'reqinst3',
            'reqmsg3',                  0,                  0,                          'short3',
            'desc3',                    1,                  0
            ),
        array(4,                        4,                  'name4',                    'thirdparty4',
            0,                          0,                  'consub4',                  'coninst4',
            'conmsg4',                  'waitsub4',         'waitmsg4',                 'cansub4',
            'caninst4',                 'canmsg4',          'remsub4',                  'reminst4',
            'remmsg4',                  0,                  'reqsub4',                  'reqinst4',
            'reqmsg4',                  0,                  0,                          'short4',
            'desc4',                    1,                  0
            ),
    );

    var $facetoface_sessions_data = array(
        array('id', 'facetoface', 'capacity', 'allowoverbook', 'details', 'datetimeknown',
              'duration', 'normalcost', 'discountcost', 'timecreated', 'timemodified'),
        array(1,    1,   100,    1,  'dtl1',     1,     4,     75,     60,     1500,   1600),
        array(2,    2,    50,    0,  'dtl2',     0,     1,     90,   NULL,     1400,   1500),
        array(3,    3,    10,    1,  'dtl3',     1,     7,    100,     80,     1500,   1500),
        array(4,    4,    1,     0,  'dtl4',     0,     7,     10,      8,     0500,   1900),
        );

    var $facetoface_session_field_data = array(
        array('id',     'name',     'shortname',    'type',     'possiblevalues',
            'required',     'defaultvalue',   'isfilter',     'showinsummary'),
        array(1,    'name1',    'shortname1',   0,  'possible1',    0,  'defaultvalue1',    1,  1),
        array(2,    'name2',    'shortname2',   2,  'possible2',    0,  'defaultvalue2',    1,  1),
        array(3,    'name3',    'shortname3',   3,  'possible3',    1,  'defaultvalue3',    1,  1),
        array(4,    'name4',    'shortname4',   4,  'possible4',    1,  'defaultvalue4',    1,  1),
    );

    var $facetoface_session_data_data = array(
        array('id', 'fieldid', 'sessionid', 'data'),
        array(1,    0,  0,  'test data1'),
        array(2,    1,  1,  'test data2'),
        array(3,    2,  2,  'test data3'),
        array(4,    3,  3,  'test data4'),
    );

    var $facetoface_sessions_dates_data = array(
        array('id',     'sessionid',    'timestart',    'timefinish'),
        array(1,        1,              1100,           1300),
        array(2,        2,              1900,           2100),
        array(3,        3,              0900,           1100),
        array(3,        3,              1200,           1400),
    );

    var $facetoface_signups_data = array(
        array('id', 'sessionid', 'userid', 'mailedreminder', 'discountcode', 'notificationtype'),
        array(1,    1,  1,  1,  'disc1',    7),
        array(2,    2,  2,  0,  NULL,       6),
        array(3,    2,  3,  0,  NULL,       5),
        array(4,    2,  4,  0,  'disc4',   11),
    );

    var $facetoface_signups_status_data = array(
        array('id',     'signupid',     'statuscode',   'superceded',   'grade',
            'note',     'advice',       'createdby',    'timecreated'),
        array(1,        1,              70,             0,              99.12345,
            'note1',    'advice1',      'create1',      1600),
        array(2,        2,              70,             0,              32.5,
            'note2',    'advice2',      'create2',      1700),
        array(3,        3,              70,             0,              88,
            'note3',    'advice3',      'create3',      0700),
        array(4,        4,              70,             0,              12.5,
            'note4',    'advice4',      'create4',      1100),
    );

    var $course_data = array(
        array('id',         'category',     'sortorder',    'password',
            'fullname',    'shortname',    'idnumber',     'summary',
            'format',      'showgrades',   'modinfo',      'newsitems',
            'teacher',     'teachers',     'student',      'students',
            'guest',       'startdate',    'enrolperiod',  'numsections',
            'marker',      'maxbytes',     'showreports',  'visible',
            'hiddensections','groupmode',  'groupmodeforce','defaultgroupid',
            'lang',        'theme',        'cost',         'currency',
            'timecreated', 'timemodified', 'metacourse',   'requested',
            'restrictmodules','expirynotify','expirythreshold','notifystudents',
            'enrollable',  'enrolstartdate','enrolenddate','enrol',
            'defaultrole', 'enablecompletion','completionstartenrol',  'icon'
            ),
        array(1,            0,              0,              'pw1',
            'name1',        'sn1',          '101',          'summary1',
            'format1',      1,              'mod1',         1,
            'teacher1',     'teachers1',    'student1',     'students1',
            0,              0,              0,              1,
            0,              0,              0,              1,
            0,              0,              0,              0,
            'lang1',        'theme1',       'cost1',        'cu1',
            0,              0,              0,              0,
            0,              0,              0,              0,
            1,              0,              0,              'enrol1',
            0,              0,              0,              'icon1'
            ),
        array(2,            0,              0,              'pw2',
            'name2',        'sn2',          '102',          'summary2',
            'format2',      1,              'mod2',         1,
            'teacher2',     'teachers2',    'student2',     'students2',
            0,              0,              0,              1,
            0,              0,              0,              1,
            0,              0,              0,              0,
            'lang2',        'theme2',       'cost2',        'cu2',
            0,              0,              0,              0,
            0,              0,              0,              0,
            1,              0,              0,              'enrol2',
            0,              0,              0,              'icon2'
            ),
        array(3,            0,              0,              'pw3',
            'name3',        'sn3',          '103',          'summary3',
            'format3',      1,              'mod3',         1,
            'teacher3',     'teachers3',    'student3',     'students3',
            0,              0,              0,              1,
            0,              0,              0,              1,
            0,              0,              0,              0,
            'lang3',        'theme3',       'cost3',        'cu3',
            0,              0,              0,              0,
            0,              0,              0,              0,
            1,              0,              0,              'enrol3',
            0,              0,              0,              'icon3'
            ),
        array(4,            0,              0,              'pw4',
            'name4',        'sn4',          '104',          'summary4',
            'format4',      1,              'mod4',         1,
            'teacher4',     'teachers4',    'student4',     'students4',
            0,              0,              0,              1,
            0,              0,              0,              1,
            0,              0,              0,              0,
            'lang4',        'theme4',       'cost4',        'cu4',
            0,              0,              0,              0,
            0,              0,              0,              0,
            1,              0,              0,              'enrol4',
            0,              0,              0,              'icon4'
            ),
    );

    var $event_data = array(
        array('id',         'name',     'description',      'format',
            'courseid',     'groupid',  'userid',           'repeatid',
            'modulename',   'instance', 'eventtype',        'timestart',
            'timeduration', 'visible',  'uuid',             'sequence',
            'timemodified'),
        array(1,            'name1',    'desc1',            0,
            1,              1,          1,                  0,
            'facetoface',   1,          'facetofacesession',1300,
            3,             1,          'uuid1',            1,
            0),
        array(2,            'name2',    'desc2',            0,
            2,              2,          2,                  0,
            'facetoface',   2,          'facetofacesession',2300,
            3,              2,          'uuid2',            2,
            0),
        array(3,            'name3',    'desc3',            0,
            3,              3,          3,                  0,
            'facetoface',   3,          'facetofacesession',3300,
            3,              3,          'uuid3',            3,
            0),
        array(4,            'name4',    'desc4',            0,
            4,              4,          4,                  0,
            'facetoface',   4,          'facetofacesession',4300,
            3,              4,          'uuid4',            4,
            0),
    );

    var $role_data = array(
        array('id', 'name',     'shortname'),
        array(1,    'Manager',    'manager'),
        array(2,    'Trainer',    'trainer'),
    );

    var $role_assignments_data = array(
        array('id', 'roleid', 'contextid', 'userid', 'hidden',
            'timestart', 'timeend'),
        array(1,  1,  1,  2,  0,  0,  0),
        array(2,  2,  2,  2,  1,  0,  0),
        array(3,  3,  3,  3,  0,  0,  0),
        array(4,  2,  3,  2,  0,  0,  0),
    );

    var $pos_assignment_data = array(
        array('id', 'fullname', 'shortname', 'idnumber', 'description',
            'timevalidfrom', 'timevalidto', 'timecreated', 'timemodified',
            'usermodified', 'organisationid', 'userid', 'positionid',
            'reportstoid', 'type'),
        array(1, 'fullname1', 'shortname1', 'idnumber1', 'desc1',
            0900, 1000, 0800, 1300,
            1, 1122, 1, 2,
            1, 1),
        array(2, 'fullname2', 'shortname2', 'idnumber2', 'desc2',
            0900, 2000, 0800, 2300,
            2, 2222, 2, 2,
            2, 2),
        array(3, 'fullname3', 'shortname3', 'idnumber3', 'desc3',
            0900, 3000, 0800, 3300,
            3, 3322, 3, 2,
            3, 3),
        array(4, 'fullname4', 'shortname4', 'idnumber4', 'desc4',
            0900, 4000, 0800, 4300,
            4, 4422, 4, 2,
            4, 4),
    );

    var $course_modules_data =array(
        array('id', 'course', 'module', 'instance', 'section', 'idnumber',
            'added', 'score', 'indent', 'visible', 'visibleold', 'groupmode',
            'groupingid', 'groupmembersonly', 'completion', 'completiongradeitemnumber',
            'completionview', 'completionview', 'completionexpected', 'availablefrom',
            'availableuntil', 'showavailability'),
        array(1, 2, 3, 4, 5, '1001',
            6, 1, 7, 1, 1, 0,
            8, 0, 0, 10,
            0, 11, 12, 13,
            14, 1),
        array(2, 2, 3, 4, 5, '1002',
            6, 1, 7, 1, 1, 0,
            8, 0, 0, 10,
            0, 11, 12, 13,
            14, 1),
        array(3, 2, 3, 4, 5, '1003',
            6, 1, 7, 1, 1, 0,
            8, 0, 0, 10,
            0, 11, 12, 13,
            14, 1),
        array(4, 2, 3, 4, 5, '1004',
            6, 1, 7, 1, 1, 0,
            8, 0, 0, 10,
            0, 11, 12, 13,
            14, 1),
    );

    var $grade_items_data = array(
        array('id', 'courseid', 'categoryid', 'itemname', 'itemtype',
            'itemmodule', 'iteminstance', 'itemnumber', 'iteminfo', 'idnumber',
            'calculation', 'gradetype', 'grademax', 'grademin', 'scaleid',
            'outcomeid', 'gradepass', 'multfactor', 'plusfactor', 'aggregationcoef',
            'sortorder', 'display', 'decimals', 'hidden', 'locked',
            'locktime', 'needsupdate', 'timecreated', 'timemodified'),
        array(1, 1, 1, 'itemname1', 'type1',
            'module1', 1, 100, 'info1', '10012',
            'calc1', 1, 100, 0, 70,
            80, 0, 1.0, 0, 0,
            0, 0, 1, 0, 0,
            0, 0, 0, 0),
        array(2, 1, 1, 'itemname1', 'type1',
            'module1', 1, 100, 'info1', '10012',
            'calc1', 1, 100, 0, 70,
            80, 0, 1.0, 0, 0,
            0, 0, 1, 0, 0,
            0, 0, 0, 0),
        array(3, 1, 1, 'itemname1', 'type1',
            'module1', 1, 100, 'info1', '10012',
            'calc1', 1, 100, 0, 70,
            80, 0, 1.0, 0, 0,
            0, 0, 1, 0, 0,
            0, 0, 0, 0),
        array(4, 1, 1, 'itemname1', 'type1',
            'module1', 1, 100, 'info1', '10012',
            'calc1', 1, 100, 0, 70,
            80, 0, 1.0, 0, 0,
            0, 0, 1, 0, 0,
            0, 0, 0, 0),
    );

    var $modules_data = array(
        array('id', 'name', 'version', 'cron',
            'lastcron', 'search', 'visible'),
        array(1, 'name1', 0, 0,
            0, 'search1', 1),
        array(2, 'name1', 0, 0,
            0, 'search1', 1),
        array(3, 'name1', 0, 1,
            0, 'search1', 1),
        array(4, 'name1', 0, 1,
            0, 'search1', 1),
    );

    var $grade_categories_data = array(
        array('id', 'courseid', 'parent', 'depth', 'path',
            'fullname', 'aggregation', 'keephigh', 'droplow',
            'aggregateonlygrade', 'aggregateoutcomes', 'aggregatesubcats',
            'timecreated', 'timemodified'),
        array(1, 1, 1, 1, 'path1',
            'fullname1', 0, 0, 0,
            0, 0, 0,
            1300, 1400),
        array(2, 1, 1, 1, 'path1',
            'fullname1', 0, 0, 0,
            0, 0, 0,
            1300, 1400),
        array(3, 1, 1, 1, 'path1',
            'fullname1', 0, 0, 0,
            0, 0, 0,
            1300, 1400),
        array(4, 1, 1, 1, 'path1',
            'fullname1', 0, 0, 0,
            0, 0, 0,
            1300, 1400),
    );

    var $user_data = array(
        array('id',                 'auth',             'confirmed',
            'policyagreed',         'deleted',          'mnethostid',
            'username',             'password',         'idnumber',
            'firstname',            'lastname',         'email',
            'emailstop',            'icq',              'skype',
            'yahoo',                'aim',              'msn',
            'phone1',               'phone2',           'institution',
            'department',           'address',          'city',
            'country',              'lang',             'theme',
            'timezone',             'firstaccess',      'lastaccess',
            'lastlogin',            'currentlogin',     'lastip',
            'secret',               'picture',          'url',
            'description',          'mailformat',       'maildigest',
            'maildisplay',          'htmleditor',       'ajax',
            'autosubscribe',        'trackforums',      'timemodified',
            'trustbitmask',         'imagealt',         'screenreader',
            ),
        //16 lines * 3 columns = 48 fields
        array(1,                    'auth1',            0,
            0,                      0,                  10,
            'user1',                'test',             'idnumber',
            '10012',                'name1',            'user1@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '12',               0,
            0,                      'desc1',            1,
            0,                      2,                  1,
            1,                      1,                  0,
            0,                      0,                  'imgalt1',
            0,                      0,                  0,
            0,                      0,                  0
            ),
        array(2,                    'auth2',            0,
            0,                      0,                  20,
            'user2',                'test',             'idnumber',
            '20022',                'name2',            'user2@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '22',               0,
            0,                      'desc2',            2,
            0,                      2,                  2,
            2,                      2,                  0,
            0,                      0,                  'imgalt2',
            0,                      0,                  0,
            0,                      0,                  0
            ),
        array(3,                    'auth3',            0,
            0,                      0,                  30,
            'user3',                'test',             'idnumber',
            '30032',                'name3',            'user3@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '32',               0,
            0,                      'desc3',            3,
            0,                      2,                  3,
            3,                      3,                  0,
            0,                      0,                  'imgalt3',
            0,                      0,                  0,
            0,                      0,                  0
            ),
        array(4,                    'auth4',            0,
            0,                      0,                  40,
            'user4',                'test',             'idnumber',
            '40042',                'name4',            'user4@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '42',               0,
            0,                      'desc4',            4,
            0,                      2,                  4,
            4,                      4,                  0,
            0,                      0,                  'imgalt4',
            0,                      0,                  0,
            0,                      0,                  0
            ),
    );

    var $grade_grades_data = array(
        array('id',                 'itemid',           'userid',
            'rawgrade',             'rawgrademax',      'rawgrademin',
            'rawscaleid',           'usermodified',     'finalgrade',
            'hidden',               'locked',           'locktime',
            'exported',             'overridden',       'excluded',
            'feedback',             'feedbackformat',   'information',
            'informationformat',    'timecreated',      'timemodified'
            ),
        array(1,                    2,                  3,
            50,                     100,                0,
            30,                     1 ,                 80.2,
            0,                      0,                  0,
            0,                      0,                  0,
            'feedback1',            0,                  'info1',
            0,                      1300,               1400
        ),
        array(2,                    2,                  3,
            50,                     200,                0,
            30,                     2 ,                 80.2,
            0,                      0,                  0,
            0,                      0,                  0,
            'feedback2',            0,                  'info2',
            0,                      2300,               2400
        ),
        array(3,                    2,                  3,
            50,                     300,                0,
            30,                     3 ,                 80.2,
            0,                      0,                  0,
            0,                      0,                  0,
            'feedback3',            0,                  'info3',
            0,                      3300,               3400
        ),
        array(4,                    2,                  3,
            50,                     400,                0,
            30,                     4 ,                 80.2,
            0,                      0,                  0,
            0,                      0,                  0,
            'feedback4',            0,                  'info4',
            0,                      4300,               4400
        ),
    );

    var $user_info_field_data = array(
        array('id',                 'shortname',         'name',
            'datatype',             'description',      'categoryid',
            'sortorder',            'required',         'locked',
            'visible',              'forceunique',      'signup',
            'defaultdata',          'param1',           'param2',
            'param3',               'param4',           'param5'
            ),
        array(1,                    'shortname1',       'name1',
            'datatype1',            'desc1',            0,
            0,                      0,                  0,
            0,                      0,                  0,
            0,                      'param1',           'param2',
            'param3',               'param4',           'param5'
            ),
        array(2,                    'shortname2',       'name2',
            'datatype2',            'desc2',            0,
            0,                      0,                  0,
            0,                      0,                  0,
            0,                      'param1',           'param2',
            'param3',               'param4',           'param5'
            ),
        array(3,                    'shortname3',       'name3',
            'datatype3',            'desc3',            0,
            0,                      0,                  0,
            0,                      0,                  0,
            0,                      'param1',           'param2',
            'param3',               'param4',           'param5'
            ),
        array(4,                    'shortname4',       'name4',
            'datatype4',            'desc4',            0,
            0,                      0,                  0,
            0,                      0,                  0,
            0,                      'param1',           'param2',
            'param4',               'param4',           'param5'
            ),
    );

    var $user_info_data_data = array(
        array('id',    'userid',   'fieldid',  'data'),
        array(1,    1,  1,  'data1'),
        array(2,    2,  2,  'data2'),
        array(3,    3,  3,  'data3'),
        array(4,    4,  4,  'data4'),
    );

    var $block_instance_data = array(
        array('id',     'blockid',  'pageid',   'pagetype',
            'position', 'weight',   'visible',  'configdata'),
        array(1,        0,          0,          'pagetype1',
            'position1',0,          0,          'configdata1'),
        array(2,        0,          0,          'pagetype2',
            'position2',0,          0,          'configdata2'),
        array(3,        0,          0,          'pagetype3',
            'position3',0,          0,          'configdata3'),
        array(4,        0,          0,          'pagetype4',
            'position4',0,          0,          'configdata4'),
    );

    var $user_info_category_data = array(
        array('id', 'name', 'sortorder'),
        array(1,    'name1',          0),
        array(2,    'name2',          0),
        array(3,    'name3',          0),
        array(4,    'name4',          0),
    );

    var $context_data = array(
        array('id', 'contextlevel', 'instanceid',   'path', 'depth'),
        array(1,    0,              0,              'path1',    0),
        array(2,    1,              1,              'path2',    1),
        array(3,    1,              1,              'path3',    1),
        array(4,    1,              1,              'path4',    1),
    );

    var $course_categories_data = array(
        array('id',     'name', 'description',  'parent',   'sortorder',
            'coursecount',  'visible',  'timemodified', 'depth',
            'path', 'theme',    'icon'),
        array(1,    'name1',    'desc1',    0,  0,
            0,    1,          0,          0,
            'path1',    'theme1',   'icon1'),
        array(2,    'name2',    'desc2',    0,  0,
            0,    2,          0,          0,
            'path2',    'theme2',   'icon2'),
        array(3,    'name3',    'desc3',    0,  0,
            0,    3,          0,          0,
            'path3',    'theme3',   'icon3'),
        array(4,    'name4',    'desc4',    0,  0,
            0,    4,          0,          0,
            'path4',    'theme4',   'icon4'),
    );

    var $facetoface_session_roles_data = array (
        array('id', 'sessionid', 'roleid', 'userid'),
        array(1,    1,  1,  1),
        array(2,    2,  2,  2),
        array(3,    3,  3,  3),
        array(4,    4,  4,  4),
    );

    var $facetoface_notice_data = array (
        array('id', 'name',     'text'),
        array(1,    'name1',    'text1'),
        array(2,    'name2',    'text2'),
        array(3,    'name3',    'text3'),
        array(4,    'name4',    'text4'),
    );

    var $timezone_data = array (
        array('id',     'name',         'year',             'tzrule',       'gmtoff',
            'dstoff',   'dst_month',    'dst_saturday',     'dst_weekday',
            'dst_skipweeks',            'dst_time',
            'std_month',                'std_saturday',     'std_weekday',
            'std_skipweeks',            'std_time'),
        array(1,        'test',         2010,                'rule1',       0,
            0,          0,              0,                   0,
            0,          '00:00',
            0,          0,              0,
            0,          '00:00'),
        array(2,        'test2',        2010,                'rule2',       0,
            0,          0,              0,                   0,
            0,          '00:00',
            0,          0,              0,
            0,          '00:00'),
        array(3,        'test3',        2010,                'rule3',       0,
            0,          0,              0,                   0,
            0,          '00:00',
            0,          0,              0,
            0,          '00:00'),
        array(4,        'test4',        2010,                'rule4',       0,
            0,          0,              0,                   0,
            0,          '00:00',
            0,          0,              0,
            0,          '00:00'),
    );

    var $user_preferences_data = array (
        array('id',     'userid',   'name',     'value'),
        array(1,        1,          'name1',    'val1'),
        array(2,        2,          'name2',    'val2'),
        array(3,        3,          'name3',    'val3'),
        array(4,        4,          'name4',    'val4'),
    );

    var $message_provider20_data = array(
        array('id', 'name', 'component', 'capability'),
        array(1, '', '', ''),
    );

    function setup() {
        // function to load test tables
        global $db,$CFG;
        parent::setUp();

        // try statement temporary - rebuilds error'ed tables
        // without having to manually disable setup / teardown functions
        try {
            load_test_table($CFG->prefix . 'config', $this->config_data, $db, 255, true);
            load_test_table($CFG->prefix . 'facetoface_signups', $this->facetoface_signups_data, $db);
            load_test_table($CFG->prefix . 'facetoface_sessions', $this->facetoface_sessions_data, $db);
            load_test_table($CFG->prefix . 'facetoface_session_field', $this->facetoface_session_field_data, $db);
            load_test_table($CFG->prefix . 'facetoface_session_data', $this->facetoface_session_data_data, $db);
            load_test_table($CFG->prefix . 'course', $this->course_data, $db);
            load_test_table($CFG->prefix . 'facetoface', $this->facetoface_data, $db);
            load_test_table($CFG->prefix . 'facetoface_sessions_dates', $this->facetoface_sessions_dates_data, $db);
            load_test_table($CFG->prefix . 'facetoface_signups_status', $this->facetoface_signups_status_data, $db);
            load_test_table($CFG->prefix . 'event', $this->event_data, $db);
            load_test_table($CFG->prefix . 'role', $this->role_data, $db);
            load_test_table($CFG->prefix . 'role_assignments', $this->role_assignments_data, $db);
            load_test_table($CFG->prefix . 'pos_assignment', $this->pos_assignment_data, $db);
            load_test_table($CFG->prefix . 'course_modules', $this->course_modules_data, $db);
            load_test_table($CFG->prefix . 'grade_items', $this->grade_items_data, $db);
            load_test_table($CFG->prefix . 'modules', $this->modules_data, $db);
            load_test_table($CFG->prefix . 'grade_categories', $this->grade_categories_data, $db);
            load_test_table($CFG->prefix . 'user', $this->user_data, $db);
            load_test_table($CFG->prefix . 'grade_grades', $this->grade_grades_data, $db);
            load_test_table($CFG->prefix . 'user_info_field', $this->user_info_field_data, $db);
            load_test_table($CFG->prefix . 'user_info_data', $this->user_info_data_data, $db);
            load_test_table($CFG->prefix . 'block_instance', $this->block_instance_data, $db);
            load_test_table($CFG->prefix . 'user_info_category', $this->user_info_category_data, $db);
            load_test_table($CFG->prefix . 'context', $this->context_data, $db);
            load_test_table($CFG->prefix . 'course_categories', $this->course_categories_data, $db);
            load_test_table($CFG->prefix . 'facetoface_session_roles', $this->facetoface_session_roles_data, $db);
            load_test_table($CFG->prefix . 'facetoface_notice', $this->facetoface_notice_data, $db);
            load_test_table($CFG->prefix . 'timezone', $this->timezone_data, $db);
            load_test_table($CFG->prefix . 'user_preferences', $this->user_preferences_data, $db);
            load_test_table($CFG->prefix . 'message_provider20', $this->message_provider20_data, $db, 255, true);
        }
        catch (Exception $e) {
            tearDown();
            setup();
        }

        // create sample objects
        // facetoface object 1
        $this->facetoface = array();
        $this->facetoface[0] = new stdClass();
        $this->facetoface[0]->id = 1;
        $this->facetoface[0]->instance = 1;
        $this->facetoface[0]->course = 10;
        $this->facetoface[0]->name = 'name1';
        $this->facetoface[0]->thirdparty = 'thirdparty1';
        $this->facetoface[0]->thirdpartywaitlist = 0;
        $this->facetoface[0]->display = 1;
        $this->facetoface[0]->confirmationsubject = 'consub1';
        $this->facetoface[0]->confirmationinstrmngr = '';
        $this->facetoface[0]->confirmationmessage = 'conmsg1';
        $this->facetoface[0]->reminderinstrmngr = '';
        $this->facetoface[0]->reminderperiod = 0;
        $this->facetoface[0]->waitlistedsubject = 'waitsub1';
        $this->facetoface[0]->cancellationinstrmngr = '';
        $this->facetoface[0]->showoncalendar = 1;
        $this->facetoface[0]->shortname = 'shortname1';
        $this->facetoface[0]->description = 'description1';
        $this->facetoface[0]->timestart = 1300;
        $this->facetoface[0]->timefinish = 1500;
        $this->facetoface[0]->emailmanagerconfirmation = 'test1';
        $this->facetoface[0]->emailmanagerreminder = 'test2';
        $this->facetoface[0]->emailmanagercancellation = 'test3';
        $this->facetoface[0]->showcalendar = 1;
        $this->facetoface[0]->approvalreqd = 0;
        $this->facetoface[0]->requestsubject = 'reqsub1';
        $this->facetoface[0]->requestmessage = 'reqmsg1';
        $this->facetoface[0]->requestinstrmngr = '';

        // facetoface object 2
        $this->facetoface[1] = new stdClass();
        $this->facetoface[1]->id = 2;
        $this->facetoface[1]->instance = 2;
        $this->facetoface[1]->course = 20;
        $this->facetoface[1]->name = 'name2';
        $this->facetoface[1]->thirdparty = 'thirdparty2';
        $this->facetoface[1]->thirdpartywaitlist = 0;
        $this->facetoface[1]->display = 0;
        $this->facetoface[1]->confirmationsubject = 'consub2';
        $this->facetoface[1]->confirmationinstrmngr = 'conins2';
        $this->facetoface[1]->confirmationmessage = 'conmsg2';
        $this->facetoface[1]->reminderinstrmngr = 'remmngr2';
        $this->facetoface[1]->reminderperiod = 1;
        $this->facetoface[1]->waitlistedsubject = 'waitsub2';
        $this->facetoface[1]->cancellationinstrmngr = 'canintmngr2';
        $this->facetoface[1]->showoncalendar = 1;
        $this->facetoface[1]->shortname = 'shortname2';
        $this->facetoface[1]->description = 'description2';
        $this->facetoface[1]->timestart = 2300;
        $this->facetoface[1]->timefinish = 2330;
        $this->facetoface[1]->emailmanagerconfirmation = 'test2';
        $this->facetoface[1]->emailmanagerreminder = 'test2';
        $this->facetoface[1]->emailmanagercancellation = 'test3';
        $this->facetoface[1]->showcalendar = 1;
        $this->facetoface[1]->approvalreqd = 1;
        $this->facetoface[1]->requestsubject = 'reqsub2';
        $this->facetoface[1]->requestmessage = 'reqmsg2';
        $this->facetoface[1]->requestinstrmngr = 'reqinstmngr2';

        // session object 1
        $this->session = array();
        $this->session[0] = new stdClass();
        $this->session[0]->id = 1;
        $this->session[0]->facetoface = 1;
        $this->session[0]->capacity = 0;
        $this->session[0]->allowoverbook = 1;
        $this->session[0]->details = 'details1';
        $this->session[0]->datetimeknown = 1;
        $this->session[0]->sessiondates = array();
        $this->session[0]->sessiondates[0]->id = 20;
        $this->session[0]->sessiondates[0]->timestart = time() - 1000;
        $this->session[0]->sessiondates[0]->timefinish = time() + 1000;
        $this->session[0]->duration = 3;
        $this->session[0]->normalcost = 100;
        $this->session[0]->discountcost = 75;
        $this->session[0]->timecreated = 1300;
        $this->session[0]->timemodified = 1400;

        // session object 2
        $this->session[1] = new stdClass();
        $this->session[1]->id = 2;
        $this->session[1]->facetoface = 2;
        $this->session[1]->capacity = 3;
        $this->session[1]->allowoverbook = 0;
        $this->session[1]->details = 'details2';
        $this->session[1]->datetimeknown = 0;
        $this->session[1]->sessiondates = array();
        $this->session[0]->sessiondates[0]->id = 20;
        $this->session[1]->sessiondates[0]->timestart = time() + 10000;
        $this->session[1]->sessiondates[0]->timefinish = time() + 100000;
        $this->session[1]->duration = 6;
        $this->session[1]->normalcost = 100;
        $this->session[1]->discountcost = 75;
        $this->session[1]->timecreated = 1300;
        $this->session[1]->timemodified = 1400;

        // sessiondata object 1
        $this->sessiondata = array();
        $this->sessiondata[0] = new stdClass();
        $this->sessiondata[0]->id = 1;
        $this->sessiondata[0]->fieldid = 1;
        $this->sessiondata[0]->sessionid = 1;
        $this->sessiondata[0]->data = 'testdata1';
        $this->sessiondata[0]->discountcost = 60;
        $this->sessiondata[0]->normalcost = 75;

        // sessiondata object 2
        $this->sessiondata[1] = new stdClass();
        $this->sessiondata[1]->id = 2;
        $this->sessiondata[1]->fieldid = 2;
        $this->sessiondata[1]->sessionid = 2;
        $this->sessiondata[1]->data = 'testdata2';
        $this->sessiondata[1]->discountcost = NULL;
        $this->sessiondata[1]->normalcost = 90;

        // user object 1
        $this->user = array();
        $this->user[0] = new stdClass();
        $this->user[0]->id = 1;
        $this->user[0]->firstname = 'firstname1';
        $this->user[0]->lastname = 'lastname1';

        // user object 2
        $this->user[1] = new stdClass();
        $this->user[1]->id = 2;
        $this->user[1]->firstname = 'firstname2';
        $this->user[1]->lastname = 'lastname2';

        // course object 1
        $this->course = array();
        $this->course[0] = new stdClass();
        $this->course[0]->id = 1;
        $this->course[0]->enablecompletion = TRUE;

        // course object 2
        $this->course[1] = new stdClass();
        $this->course[1]->id = 42;
        $this->course[1]->enablecompletion = FALSE;

        // message string 1
        $this->msgtrue = 'should be true';

        // message string 2
        $this->msgfalse = 'should be false';
    }

    function tearDown() {
        global $db, $CFG;
        remove_test_table($CFG->prefix . 'config', $db);
        remove_test_table($CFG->prefix . 'facetoface_signups', $db);
        remove_test_table($CFG->prefix . 'facetoface_sessions', $db);
        remove_test_table($CFG->prefix . 'facetoface_session_field', $db);
        remove_test_table($CFG->prefix . 'facetoface_session_data', $db);
        remove_test_table($CFG->prefix . 'course', $db);
        remove_test_table($CFG->prefix . 'facetoface', $db);
        remove_test_table($CFG->prefix . 'facetoface_sessions_dates', $db);
        remove_test_table($CFG->prefix . 'facetoface_signups_status', $db);
        remove_test_table($CFG->prefix . 'event', $db);
        remove_test_table($CFG->prefix . 'role', $db);
        remove_test_table($CFG->prefix . 'role_assignments', $db);
        remove_test_table($CFG->prefix . 'pos_assignment', $db);
        remove_test_table($CFG->prefix . 'course_modules', $db);
        remove_test_table($CFG->prefix . 'grade_items', $db);
        remove_test_table($CFG->prefix . 'modules', $db);
        remove_test_table($CFG->prefix . 'grade_categories', $db);
        remove_test_table($CFG->prefix . 'user', $db);
        remove_test_table($CFG->prefix . 'grade_grades', $db);
        remove_test_table($CFG->prefix . 'user_info_field', $db);
        remove_test_table($CFG->prefix . 'user_info_data', $db);
        remove_test_table($CFG->prefix . 'block_instance', $db);
        remove_test_table($CFG->prefix . 'user_info_category', $db);
        remove_test_table($CFG->prefix . 'context', $db);
        remove_test_table($CFG->prefix . 'course_categories', $db);
        remove_test_table($CFG->prefix . 'facetoface_session_roles', $db);
        remove_test_table($CFG->prefix . 'facetoface_notice', $db);
        remove_test_table($CFG->prefix . 'timezone', $db);
        remove_test_table($CFG->prefix . 'user_preferences', $db);
        remove_test_table($CFG->prefix . 'message_provider20', $db);

        parent::tearDown();
    }

    function test_facetoface_get_status() {
        // test method - returns string

        // check for valid status codes
        $this->assertEqual(facetoface_get_status(10), 'user_cancelled');
        $this->assertEqual(facetoface_get_status(20), 'session_cancelled');
        $this->assertEqual(facetoface_get_status(30), 'declined');
        $this->assertEqual(facetoface_get_status(40), 'requested');
        $this->assertEqual(facetoface_get_status(50), 'approved');
        $this->assertEqual(facetoface_get_status(60), 'waitlisted');
        $this->assertEqual(facetoface_get_status(70), 'booked');
        $this->assertEqual(facetoface_get_status(80), 'no_show');
        $this->assertEqual(facetoface_get_status(90), 'partially_attended');
        $this->assertEqual(facetoface_get_status(100), 'fully_attended');

        //TODO error capture
        //check for invalid status code
//        $this->expectError(facetoface_get_status(17));
//        $this->expectError(facetoface_get_status('b'));
//        $this->expectError(facetoface_get_status('%'));
    }

    function test_format_cost() {
        // test method - returns a string
        // test each method with the html parameter as true/ false /null

        //test for a valid value
        $this->assertEqual(format_cost(1000, true), '$1000');

        $this->assertEqual(format_cost(1000, false), '$1000');

        $this->assertEqual(format_cost(1000), '$1000');

        //test for a large negative value, html true/ false/ null
        $this->assertEqual(format_cost(-34000, true), '$-34000');

        $this->assertEqual(format_cost(-34000, false), '$-34000');

        $this->assertEqual(format_cost(-34000), '$-34000');

        //test for a large positive value
        $this->assertEqual(format_cost(100000000000, true), '$100000000000');

        $this->assertEqual(format_cost(100000000000, false), '$100000000000');

        $this->assertEqual(format_cost(100000000000), '$100000000000');

        //test for a decimal value
        $this->assertEqual(format_cost(32768.9045, true), '$32768.9045');

        $this->assertEqual(format_cost(32768.9045, false), '$32768.9045');

        $this->assertEqual(format_cost(32768.9045), '$32768.9045');

        //test for a null value
        $this->assertEqual(format_cost(null, true), '$');

        $this->assertEqual(format_cost(null, false), '$');

        $this->assertEqual(format_cost(null), '$');

        //test for a text string value
        $this->assertEqual(format_cost('string', true), '$string');

        $this->assertEqual(format_cost('string', false), '$string');

        $this->assertEqual(format_cost('string'), '$string');
    }

    function test_facetoface_cost() {
        //test method - returns format_cost object

        //test variables case WITH discount
        $sessiondata1 = $this->sessiondata[0];

        $userid1 = 1;
        $sessionid1 = 1;

        $htmloutput1 = false; // forced to true in the function

        //variable for test case NO discount
        $sessiondata2 = $this->sessiondata[1];

        $userid2 = 2;
        $sessionid2 = 2;

        $htmloutput2 = false;

        //test WITH discount
        $this->assertEqual(facetoface_cost($userid1, $sessionid1, $sessiondata1, $htmloutput1), '$60');

        //test NO discount case
        $this->assertEqual(facetoface_cost($userid2, $sessionid2, $sessiondata2, $htmloutput2), '$90');
    }

    function test_format_duration() {
        // test method - returns a string
        // ISSUES:
        //expects a space after hour/s but not minute/s
        //minutes > 59 are not being converted to hour values
        //negative values are not interpreted correctly

        //test for positive single hour value
        $this->assertEqual(format_duration('1:00'), '1 hour ');
        $this->assertEqual(format_duration('1.00'), '1 hour ');

        //test for positive multiple hours value
        $this->assertEqual(format_duration('3:00'), '3 hours ');
        $this->assertEqual(format_duration('3.00'), '3 hours ');

        //test for positive single minute value
        $this->assertEqual(format_duration('0:01'), '1 minute');
        $this->assertEqual(format_duration('0.1'), '6 minutes');

        //test for positive minutes value
        $this->assertEqual(format_duration('0:30'), '30 minutes');
        $this->assertEqual(format_duration('0.50'), '30 minutes');

        //test for out of range minutes value
        $this->assertEqual(format_duration('9:70'), '');

        //test for zero value
        $this->assertEqual(format_duration('0:00'), '');
        $this->assertEqual(format_duration('0.00'), '');

        //test for negative hour value
        $this->assertEqual(format_duration('-1:00'), '');
        $this->assertEqual(format_duration('-1.00'), '');

        //test for negative multiple hours value
        $this->assertEqual(format_duration('-7:00'), '');
        $this->assertEqual(format_duration('-7.00'), '');

        //test for negative single minute value
        $this->assertEqual(format_duration('-0:01'), '');
        $this->assertEqual(format_duration('-0.01'), '');

        //test for negative multiple minutes value
        $this->assertEqual(format_duration('-0:33'), '');
        $this->assertEqual(format_duration('-0.33'), '');

        //test for negative hours & minutes value
        $this->assertEqual(format_duration('-5:42'), '');
        $this->assertEqual(format_duration('-5.42'), '');

        //test for invalid characters value
        $this->assertEqual(format_duration('invalid_string'), '');
    }

    function test_facetoface_minutes_to_hours() {
        // test method - returns a string

        //test for positive minutes value
        $this->assertEqual(facetoface_minutes_to_hours('11'), '0:11');

        //test for positive hours & minutes value
        $this->assertEqual(facetoface_minutes_to_hours('67'), '1:7');

        //test for negative minutes value
        $this->assertEqual(facetoface_minutes_to_hours('-42'), '-42');

        //test for negative hours and minutes value
        $this->assertEqual(facetoface_minutes_to_hours('-7:19'), '-7:19');

        //test for invalid characters value
        $this->assertEqual(facetoface_minutes_to_hours('invalid_string'), '0');
    }

    function test_facetoface_hours_to_minutes() {
        // test method - returns a float
        // should negative values return 0 or a negative value?

        // test for positive hours value
        $this->assertEqual(facetoface_hours_to_minutes('10'), '600');

        // test for positive minutes and hours value
        $this->assertEqual(facetoface_hours_to_minutes('11:17'), '677');

        //test for negative hours value
        $this->assertEqual(facetoface_hours_to_minutes('-3'), '-180');

        //test for negative hours & minutes value
        $this->assertEqual(facetoface_hours_to_minutes('-2:1'), '-119');

        //test for invalid characters value
        $this->assertEqual(facetoface_hours_to_minutes('invalid_string'), '');
    }

    function test_facetoface_fix_settings() {
        // test for facetoface object
        $facetoface1 = $this->facetoface[0];

        //test for empty values
        $this->assertEqual(facetoface_fix_settings($facetoface1), null);
    }

    function test_facetoface_add_instance() {
        //test method - returns integer, being the new id in the facetoface table.

        //define test variables
        $facetoface1 = $this->facetoface[0];

        $this->assertEqual(facetoface_add_instance($facetoface1), 5);
    }

    function test_facetoface_update_instance() {
        //test method - returns boolean

        // test variables
        // copy object from add_instance function test
        $facetoface1 = $this->facetoface[0];

        //test
        $this->assertTrue(facetoface_update_instance($facetoface1));
    }

    function test_facetoface_delete_instance() {
        //test method - returns boolean

        // test variables
        $id = 1;

        //test
        $this->assertTrue(facetoface_delete_instance($id));
    }

    function test_cleanup_session_data() {
        //test method -returns session object

        //define session object for test
        //valid values
        $sessionValid = new stdClass();
        $sessionValid->duration = '1.5';
        $sessionValid->capacity = '250';
        $sessionValid->normalcost = '70';
        $sessionValid->discountcost = '50';

        //invalid values
        $sessionInvalid = new stdClass();
        $sessionInvalid->duration = '0';
        $sessionInvalid->capacity = '100999';
        $sessionInvalid->normalcost = '-7';
        $sessionInvalid->discountcost = 'b';

        //test for valid values
        $this->assertEqual(cleanup_session_data($sessionValid), $sessionValid);

        //test for invalid values
        $this->assertEqual(cleanup_session_data($sessionInvalid), $sessionInvalid);

    }

    function test_facetoface_add_session() {
        //test method - returns false or session id number

        //variable for test
        $session1 = $this->session[0];
        //test TODO fix me
        //$this->assertEqual(facetoface_add_session($session1, $sessiondates1), 4);
    }

    function test_facetoface_update_session() {
        // test method - returns boolean

        //test variables
        $session1 = $this->session[0];

        $sessiondates = new stdClass();
        $sessiondates->sessionid = 1;
        $sessiondates->timestart = 1300;
        $sessiondates->timefinish = 1400;
        $sessiondates->sessionid = 1;

    //TODO fix this
    //test
        //$this->assertTrue(facetoface_update_session($session, $sessiondates), $this->msgtrue);
    }

    function test_facetoface_update_attendees() {
        //test method - returns false or int?

        //test variables
        $session1 = $this->session[0];

        $this->assertTrue(facetoface_update_attendees($session1), $this->msgtrue);
    }

    function test_facetoface_get_facetoface_menu() {
        //test method- returns array or empty string if no match found in table
        //TODO negative test?
        // positive test
        $this->assertIsA(facetoface_get_facetoface_menu(), 'array');
    }

    function test_facetoface_delete_session() {
        //test method - returns boolean
    //TODO invalid test
        //test variables
        $session1 = $this->session[0];
#var_dump($session1);
#        $this->assertTrue(facetoface_delete_session($session1));
    }

    function test_facetoface_email_substitutions() {
        //test method - returns string

        //define test variables
        $msg = 'test message';
        $facetofacename = 'test f2f name';
        $reminderperiod = 'test reminder period';

        $user1 = $this->user[0];

        $session1 = $this->session[0];

        $sessionid = 101;

        //test
        $this->assertEqual(facetoface_email_substitutions($msg, $facetofacename, $reminderperiod, $user1, $session1, $sessionid), $msg);
        $this->assertTrue(facetoface_email_substitutions($msg, $facetofacename, $reminderperiod, $user1, $session1, $sessionid), $this->msgtrue);
    }

    function test_facetoface_cron() {
        //test method - returns boolean

        //test for valid case
        $this->assertTrue(facetoface_cron(), $this->msgtrue);
    }

    function test_facetoface_has_session_started() {
        // test method - returns boolean

        $session1 = $this->session[0];
        $session1->sessiondates[0]->timestart = time() - 100;
        $session1->sessiondates[0]->timefinish = time() + 100;
        
        $session2 = $this->session[1];

        $timenow = time();

        //test for Valid case
        $this->assertTrue(facetoface_has_session_started($session1, $timenow), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_has_session_started($session2, $timenow), $this->msgfalse);
    }

    function test_facetoface_is_session_in_progress() {
        //test method - returns boolean

        //define test variables
        $session1 = $this->session[0];
        $session1->sessiondates[0]->timestart = time() - 100;
        $session1->sessiondates[0]->timefinish = time() + 100;

        $session2 = $this->session[1];

        $timenow = time();

        //test for valid case
        $this->assertTrue(facetoface_is_session_in_progress($session1, $timenow), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_is_session_in_progress($session2, $timenow), $this->msgfalse);
    }

    function test_facetoface_get_session_dates() {
        //test method - returns array

        //test variables
        $sessionid1 = 1;
        $sessionid2 = 10;

        //test for valid case
        $this->assertTrue(facetoface_get_session_dates($sessionid1), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_get_session_dates($sessionid2), $this->msgfalse);
    }

    function test_facetoface_get_session() {
        // test method - returns a session object

        //test variables
        $sessionid1 = 1;
        $sessionid2 = 10;

        // test for valid case
        $this->assertTrue(facetoface_get_session($sessionid1), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_get_session($sessionid2), $this->msgfalse);
    }

    function test_facetoface_get_sessions() {
        //test method - returns session object

        //test variables
        $facetofaceid1 = 1;
        $facetofaceid2 = 42;

        //test for valid case
        $this->assertTrue(facetoface_get_sessions($facetofaceid1), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_get_sessions($facetofaceid2), $this->msgfalse);
    }

    function test_facetoface_get_attendees() {
        //test method - returns user list array or false

        //test variables
        $sessionid1 = 1;
        $sessionid2 = 42;

        //test for valid sessionid
        $this->assertTrue(count(facetoface_get_attendees($sessionid1)));

        //test for invalid sessionid
        $this->assertEqual(facetoface_get_attendees($sessionid2), array());

    }

    function test_facetoface_get_attendee() {
        //test method - returns boolean or object

        //test variables
        $sessionid1 = 1;
        $sessionid2 = 42;
        $userid1 = 1;
        $userid2 = 14;

        //test for valid case
        $this->assertTrue(is_object(facetoface_get_attendee($sessionid1, $userid1)), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_get_attendee($sessionid2, $userid2), $this->msgfalse);
    }

    function test_facetoface_get_userfields() {
        //test method - returns userfields

        $this->assertTrue(facetoface_get_userfields(), $this->msgtrue);
    }

    function test_facetoface_download_attendance() {
        //test method - returns worksheet object

        //test variables
        // ODS format
        $facetofacename1 = 'testf2fname1';
        $facetofaceid1 = 1;
        $location1 = 'testlocation1';
        $format1 = 'ods';

        // Excel format
        $facetofacename2 = 'testf2fname2';
        $facetofacename2 = 2;
        $location2 = 'testlocation2';
        $format2 = 'xls';

        //test for ODS format
        //$this->assertTrue(facetoface_download_attendance($facetofacename1, $facetofaceid1, $location1, $format1), $this->msgtrue);
    //TODO this returns JUNK
        //test for Excel format
        //$this->assertTrue(facetoface_download_attendance($facetofacename2, $facetofaceid2, $location2, $format2), $this->msgtrue);
    }

    function test_facetoface_write_worksheet_header() {
        //test method - returns integer
        //TODO check on how to define worksheet object
    }

    function test_facetoface_write_activity_attendance() {
        //TODO check on how to define worksheet object
    }

    function test_facetoface_get_user_custom_fields() {
        // test method - returns object

        //test variables
        $userid1 = 1;
        $userid2 = 42;
        $fieldstoinclude1 = TRUE;

        //test for valid case
        $this->assertTrue(facetoface_get_user_customfields($userid1, $fieldstoinclude1), $this->msgtrue);
        $this->assertTrue(facetoface_get_user_customfields($userid1), $this->msgtrue);
    // TODO invalid case
        //test for invalid case
    }

    function test_facetoface_user_signup() {
        // test method - returns boolean

        //test variables
        $session1 = $this->session[0];
        $facetoface1 = $this->facetoface[0];
        $course1 = $this->course[0];

        $discountcode1 = 'disc1';
        $notificationtype1 = 1;
        $statuscode1 = 1;
        $userid1 = 100;

        $notifyuser1 = TRUE;
        $displayerrors = TRUE;

        //test for valid case
        $this->assertTrue(facetoface_user_signup($session1, $facetoface1, $course1, $discountcode1, $notificationtype1, $statuscode1), $this->msgtrue);
        //TODO invalid case?
    }

    function test_facetoface_send_request_notice() {
        //test method - returns string

        //test variables
        $session1 = $this->session[0];

        $facetoface1 = $this->facetoface[0];

        $userid1 = 1;
        $userid2 = 25;

        //test for valid case
        $this->assertEqual(facetoface_send_request_notice($facetoface1, $session1, $userid1), '');

        //test for invalid case
        $this->assertEqual(facetoface_send_request_notice($facetoface1, $session1, $userid2), 'No manager email is set');
    }

    function test_facetoface_update_signup_status() {
        //test method - returns int or false

        //test variables
        $signupid1 = 1;
        $statuscode1 = 1;
        $createdby1 = 1;
        $note1 = 'note1';
        $grade1 = 85;

        $signupid2 = 42;
        $statuscode2 = 7;
        $createdby2 = 40;
        $note2 = '';
        $grade1 = 0;


        //test for valid case
        $this->assertEqual(facetoface_update_signup_status($signupid1, $statuscode1, $createdby1, $note1), 5);

        //test for invalid case
        // TODO invlaid case - how to cause sql error from here?
        //$this->assertFalse(facetoface_update_signup_status($signupid2, $statuscode2, $createdby2, $note2), $this->msgfalse);
    }

    function test_facetoface_user_cancel() {
        // test method - returns boolean

        //test variables
        $session1 = $this->session[0];

        $userid1 = 1;
        $forcecancel1 = TRUE;
        $errorstr1 = 'error1';
        $cancelreason1 = 'cancelreason1';

        $session2 = $this->session[1];

        $userid2 = 42;

        //test for valid case
        //$this->assertTrue(facetoface_user_cancel($session1, $userid1, $forcecancel1, $errorstr1, $cancelreason1), $this->msgtrue);

        //test for invalid case
        //TODO invalid case?
        //$this->assertFalse(facetoface_user_cancel($session2, $userid2), $this->msgfalse);
    }

    function test_facetoface_send_notice() {
        //test method - returns string

        //test variables
        $facetoface1 = $this->facetoface[0];

        $session1 = $this->session[0];

        //TODO where is sessiondata coming from in here? check table references

        $postsubject1 = 'postsubject1';
        $posttext1 = 'posttext1';
        $posttextmgrheading1 = 'posttextmgrheading1';
        $notificationtype1 = 'notificationtype1';

        $userid1 = 1;

        //test for valid case
        //$this->assertEqual(facetoface_send_notice($postsubject1, $posttext1, $posttextmgrheading1, $notificationtype1, $facetoface1, $session1, $userid1), '');
    }

    function test_facetoface_send_confirmation_notice() {
    //test variables
        $facetoface1 = $this->facetoface[0];

        $session1 = $this->session[0];
        //TODO where is sessiondata coming from in here? check table references

        $postsubject1 = 'postsubject1';
        $posttext1 = 'posttext1';
        $posttextmgrheading1 = 'posttextmgrheading1';
        $notificationtype1 = 'notificationtype1';

        $userid1 = 1;

        //test for valid case
    }

    function test_facetoface_send_cancellation_notice() {
        //test method - returns string

        //test variables
        $facetoface1 = $this->facetoface[0];

        $session1 = $this->session[0];

        $userid1 = 1;

        //test for valid case
        //$this->assertEqual(facetoface_send_cancellation_notice($facetoface1, $session1, $userid1), '');
    }

    function test_facetoface_get_manageremail() {
        //test method - returns string

        // Find manager of user 1 (which is user2)
        $this->assertEqual(facetoface_get_manageremail(1), 'user2@example.com');

        // Find manager of non existant user
        $this->assertEqual(facetoface_get_manageremail(25), '');
    }

    function test_facetoface_get_manageremailformat() {
        // test method - returns string
        //TODO how to run negative test?
        //define test variables
        //$addressformat = '';

        // test for no address format
        $this->assertEqual(facetoface_get_manageremailformat(), '');
    }

    function test_facetoface_check_manageremail() {
        //test method - returns boolean
        global $CFG;

        set_config('facetoface_manageraddressformat', 'example.com');

        //define test variables
        $validEmail = 'user@example.com';
        $invalidEmail = NULL;

        //test for valid case
        $this->assertTrue(facetoface_check_manageremail($validEmail), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_check_manageremail($invalidEmail), $this->msgfalse);
    }

    function test_facetoface_take_attendance() {
        //test method - returns boolean

        //test variables
        $data1 = new stdClass();
        $data1->s = 1;
        $data1->submissionid = 1;

        //test for valid case
        $this->assertTrue(facetoface_take_attendance($data1), $this->msgtrue);
    //TODO invalid case
        //test for invalid case
    }

    function test_facetoface_approve_requests() {
        //test method - returns boolean

        //test variables
        $data1 = new stdClass();
        $data1->s = 1;
        $data1->submissionid = 1;
        $data1->requests = array();
        $data1->requests[0]->request = 1;

        //test for valid case
        $this->assertTrue(facetoface_approve_requests($data1), $this->msgtrue);

        // TODO test for invalid case
    }

    function test_facetoface_take_individual_attendance() {
        //test method - returns object

        //test variables
        //$submissionid1 = 1;
        //$grading1 = 100;
    // TODO bug check function
        //test for valid case
        //$this->assertTrue(facetoface_take_individual_attendance($submissionid1, $grading1), $this->msgtrue);
    }

    function test_facetoface_print_coursemodule_info() {
        //test method - returns html $table string
    //TODO bug check the function
        //test variables
        $coursemodule1 = new stdClass();
        $coursemodule1->id = 1;
        $coursemodule1->course = 1;
        $coursemodule1->instance = 1;

        //test for valid case
        //$this->assertTrue(facetoface_print_coursemodule_info($coursemodule1), $this->msgtrue);
    }

    function test_facetoface_get_ical_attachment() {
    //TODO ical format definintion
    }

    function test_facetoface_ical_generate_timestamp() {
        //test method - returns datetimestamp

        //test variables
        $timenow = time();
        $return = gmdate('Ymd', $timenow) . 'T' . gmdate('His', $timenow) . 'Z';
        //TODO check if this is the correct return value to compare
        //test for valid case
        $this->assertEqual(facetoface_ical_generate_timestamp($timenow), $return);
    }

    function test_facetoface_ical_escape() {
        // test method - returns string variable $text
        //TODO correct this function for ICAL format
    
        //define test variables
        $text1 = "this is a test!&nbsp";
        $text2 = NULL;
        $text3 = "more than 75 characters1 more than 75 characters2 more than 75 characters3 more than 75 characters4 more than 75 characters5";
        $text4 = "/\'s ; \" \' \n , . & &nbsp;";

        $converthtml1 = FALSE;
        $converthtml2 = TRUE;

        //tests
        $this->assertEqual(facetoface_ical_escape($text1, $converthtml1), $text1);
        $this->assertEqual(facetoface_ical_escape($text1, $converthtml2), $text1);

        $this->assertEqual(facetoface_ical_escape($text2, $converthtml1), $text2);
        $this->assertEqual(facetoface_ical_escape($text2, $converthtml2), $text2);

#        $this->assertEqual(facetoface_ical_escape($text3, $converthtml1),
#                "more than 75 characters1 more than 75 characters2 more than 75\n characters3 more than 75 characters4 more than 75 characters5");
#        $this->assertEqual(facetoface_ical_escape($text3, $converthtml2),
#                "more than 75 characters1 more than 75 characters2 more than 75\n characters3 more than 75 characters4 more than 75 characters5");

        $this->assertEqual(facetoface_ical_escape($text4, $converthtml1), "/\\\\'s \; \" \\\\' \\n \, . & &nbsp\;");
        $this->assertEqual(facetoface_ical_escape($text4, $converthtml2), "/'s \; \" ' \, . & ");
    }

    function test_facetoface_update_grades() {
        //test method

        //variables
        $facetoface1 = $this->facetoface[0];

        $userid = 0;

        $this->assertTrue(facetoface_update_grades($facetoface1, $userid), $this->msgtrue);
    }

    function test_facetoface_grade_item_update() {
        //test method - returns boolean

        //test variables
        $facetoface1 = $this->facetoface[0];

        $grades = NULL;

        //test
        $this->assertTrue(facetoface_grade_item_update($facetoface1), $this->msgtrue);
    }

    function test_facetoface_grade_item_delete() {
        //test method - returns int code boolean

        //test variables
        $facetoface1 = $this->facetoface[0];

        //test for valid case
        $this->assertTrue(facetoface_grade_item_delete($facetoface1), $this->msgtrue);
    }

    function test_facetoface_get_num_attendees() {
        //test method - returns integer

        //test variables
        $sessionid1 = 2;
        $sessionid2 = 42;

        //test for valid case
        $this->assertEqual(facetoface_get_num_attendees($sessionid1), 1);

        //test for invalid case
        $this->assertEqual(facetoface_get_num_attendees($sessionid2), 0);
    }

    function test_facetoface_get_user_submissions() {
        //test method - returns array or false

        //test variables
        $facetofaceid1 = 1;
        $userid1 = 1;
        $includecancellations1 = TRUE;

        $facetofaceid2 = 11;
        $userid2 = 11;
        $includecancellations2 = TRUE;

        //test for valid case
        $this->assertTrue(facetoface_get_user_submissions($facetofaceid1, $userid1, $includecancellations1), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_get_user_submissions($facetofaceid2, $userid2, $includecancellations2), $this->msgfalse);
    }

    function test_facetoface_user_cancel_submission() {
        //test method - returns boolean

        //test variables
        $sessionid1 = 1;
        $userid1 = 1;
        $cancelreason1 = 'cancel1';

        $sessionid2 = 2;
        $userid2 = 2;
        $cancelreason2 = 'cancel2';
        //TODO fix - table relation error
        //test for valid case
        //$this->assertTrue(facetoface_user_cancel_submission($sessionid1, $userid1, $cancelreason1), $this->msgtrue);

        //test for invalid case
        //$this->assertFalse(facetoface_user_cancel_submission($sessionid2, $userid2, $cancelreason2), $this->msgfalse);
    }

    function test_facetoface_get_view_actions() {
        // test method - returns an array

        //define test variables
        $testArray = array('view', 'view all');

        // test
        $this->assertEqual(facetoface_get_view_actions(), $testArray);
    }

    function test_facetoface_get_post_actions() {
        // test method - returns an array

        //define test variables
        $testArray = array('cancel booking', 'signup');

        // test
        $this->assertEqual(facetoface_get_post_actions(), $testArray);
    }


    function test_facetoface_session_has_capacity() {
        // test method - returns boolean

        //test variables
        $session1 = $this->session[0];

        $session2 = $this->session[1];

        //test for valid case
        $this->assertFalse(facetoface_session_has_capacity($session1), $this->msgfalse);

        //test for invalid case
        $this->assertTrue(facetoface_session_has_capacity($session2), $this->msgtrue);
    }


    function test_facetoface_get_trainer_roles() {
        //test method - returns array

        // No session roles
        $this->assertFalse(facetoface_get_trainer_roles(), $this->msgfalse);

        // Add some roles
        set_config('facetoface_session_roles', '2');

        $result = facetoface_get_trainer_roles();
        $this->assertEqual($result[2]->name, 'Trainer');
    }


    function test_facetoface_get_trainers() {
        //test method - returns array

        //test variables
        $sessionid1 = 1;
        $roleid1 = 1;

        //test for valid case
        $this->assertTrue(facetoface_get_trainers($sessionid1, $roleid1), $this->msgtrue);

        $this->assertTrue(facetoface_get_trainers($sessionid1), $this->msgtrue);
    }

    function test_facetoface_supports() {
        // test method - returns boolean

        //test variables
        $feature1 = 'grade_has_grade';
        $feature2 = 'UNSUPPORTED_FEATURE';

        //test for valid case
        $this->assertTrue(facetoface_supports($feature1), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_supports($feature2), $this->msgfalse);
    }

    function test_facetoface_manager_needed() {
        //test method - returns boolean

        //test variables
        $facetoface1 = $this->facetoface[1];

        $facetoface2 = $this->facetoface[0];

        //test for valid case
        $this->assertTrue(facetoface_manager_needed($facetoface1), $this->msgtrue);

        //test for invalid case
        $this->assertFalse(facetoface_manager_needed($facetoface2), $this->msgfalse);
    }

    function test_facetoface_list_of_sitenotices() {
        //test method - returns string

        $this->assertTrue(facetoface_list_of_sitenotices(), $this->msgtrue);
    }
}
