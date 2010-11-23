<?php


abstract class dp_base_role {
    protected $plan;
    // get access to the plan object
    function __construct($plan) {
        $this->plan = $plan;
    }

    // for finding out if a user has this role
    abstract function user_has_role($userid=null);

}
