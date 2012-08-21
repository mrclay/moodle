<?php
// included by /blocks/course_overview/block_course_overview.php


require_once dirname(__DIR__) . '/setup-autoload.php';

$coeMoodle = new Coe\Moodle();
$myMoodle = new Coe\Moodle\My($coeMoodle);

$myMoodle->printOverview($courses, $remote_courses);
