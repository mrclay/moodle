<?php

require_once dirname(__DIR__) . '/setup-autoload.php';

$coeMoodle = new Coe\Moodle();

define('AJAX_SCRIPT', true);

require($coeMoodle->getRootPath() . '/config.php');

global $CFG, $DB;

// Must have the sesskey
$id = required_param('id', PARAM_INT); // course id

try {

    $course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
    if (! $course || $course->id == SITEID) {
        throw new moodle_exception('invalidcourse');
    }

} catch (Exception $e) {
    echo "";
    exit;
}

require_login($course);

$coeMoodle = new Coe\Moodle();
$modPath =   $coeMoodle->getRootPath() . '/mod/';

$htmlarray = array();
$courses[$course->id] = $course;

if ($modules = $DB->get_records('modules')) {
    foreach ($modules as $mod) {
        $libFile = $modPath . $mod->name . '/lib.php';
        if (file_exists($libFile)) {
            include_once($libFile);
            $fname = $mod->name.'_print_overview';
            if (function_exists($fname)) {
                $fname($courses, $htmlarray);
            }
        }
    }
}

echo implode('', $htmlarray[$course->id]);
