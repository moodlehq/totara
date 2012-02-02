<?php

require_once($CFG->dirroot . '/mod/facetoface/backup/moodle2/backup_facetoface_stepslib.php'); // Because it exists (must)

/**
 * facetoface backup task that provides all the settings and steps to perform one
 * complete backup of the activity
 */
class backup_facetoface_activity_task extends backup_activity_task {

    /**
     * Define (add) particular settings this activity can have
     */
    protected function define_my_settings() {
        // No particular settings for this activity
    }

    /**
     * Define (add) particular steps this activity can have
     */
    protected function define_my_steps() {
        // facetoface only has one structure step
        $this->add_step(new backup_facetoface_activity_structure_step('facetoface_structure', 'facetoface.xml'));
    }

    /**
     * Code the transformations to perform in the activity in
     * order to get transportable (encoded) links
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot,"/");

        // Link to the list of facetofaces
        $search="/(".$base."\/mod\/facetoface\/index.php\?id\=)([0-9]+)/";
        $content= preg_replace($search, '$@FACETOFACEINDEX*$2@$', $content);

        // Link to facetoface view by moduleid
        $search="/(".$base."\/mod\/facetoface\/view.php\?id\=)([0-9]+)/";
        $content= preg_replace($search, '$@FACETOFACEVIEWBYID*$2@$', $content);

        return $content;
    }
}
