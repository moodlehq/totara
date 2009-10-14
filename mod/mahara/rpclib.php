<?php
function mahara_mnet_publishes() {
    return array(array(
        'name'       => 'mahara',
        'apiversion' => 1,
        'methods'    => array(
            'get_views_for_user',
            'submit_view_for_assessment',
            'release_submitted_view',
        ),
    ));
}

function get_views_for_user($username, $query=null) {
    return new StdClass;
}

function submit_view_for_assessment($username, $viewid) {
    return array();
}

function release_submitted_view($viewid, $assessmentdata=array(), $username) {
}

?>