<?php

namespace Coe\Moodle;

use Coe\Moodle;

class My {

    protected $moodle;

    public function __construct(Moodle $moodle)
    {
        $this->moodle = $moodle;
    }

    public function printOverview($courses, $remote_courses)
    {
        global $OUTPUT;

        foreach ($courses as $course) {
            $fullname = format_string($course->fullname, true, array('context' => get_context_instance(CONTEXT_COURSE, $course->id)));
            echo $OUTPUT->box_start('coursebox');
            $attributes = array('title' => s($fullname));
            if (empty($course->visible)) {
                $attributes['class'] = 'dimmed';
            }
            $heading = \html_writer::link(
                new \moodle_url('/course/view.php', array('id' => $course->id)), $fullname, $attributes);

            $ajaxLink = new \moodle_url('/_coe/my_moodle/ajax.php', array('id' => $course->id));
            $heading .= " <span class='coe-show-activities' data-courseid='{$course->id}' data-src='$ajaxLink'></span>";
            echo $OUTPUT->heading($heading, 3);

            echo "<div id='coe-activities-{$course->id}'></div>";

            echo $OUTPUT->box_end();
        }

        if (!empty($remote_courses)) {
            echo $OUTPUT->heading(get_string('remotecourses', 'mnet'));
        }
        foreach ($remote_courses as $course) {
            echo $OUTPUT->box_start('coursebox');
            $attributes = array('title' => s($course->fullname));
            echo $OUTPUT->heading(\html_writer::link(
                new \moodle_url('/auth/mnet/jump.php', array('hostid' => $course->hostid, 'wantsurl' => '/course/view.php?id='.$course->remoteid)),
                format_string($course->shortname),
                $attributes) . ' (' . format_string($course->hostname) . ')', 3);
            echo $OUTPUT->box_end();
        }
    }
}
