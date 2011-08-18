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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage plan
 */


require_once("{$CFG->dirroot}/local/plan/lib.php");


/**
 * Run cron code for Learning Plans
 *
 * At the moment all this does is update plans that are set
 * to auto complete after the end date
 *
 * @access  public
 * @return  void
 */
function plan_cron() {
    global $CFG;

    $time = time();
    $approved = DP_PLAN_STATUS_APPROVED;

    // Get plans that need completing
    $sql = "
        SELECT
            plan.id as planid
        FROM
            {$CFG->prefix}dp_plan plan
        JOIN
            {$CFG->prefix}dp_plan_settings ps
         ON plan.templateid = ps.templateid
        WHERE
            ps.autobyplandate = 1
        AND plan.enddate <= {$time}
        AND plan.status = {$approved}
    ";

    // Complete them!
    if ($plans = get_records_sql($sql)) {
        foreach ($plans as $p) {
            $plan = new development_plan($p->planid);
            mtrace("Completing plan: {$plan->name}(ID:{$plan->id})");
            $plan->set_status(DP_PLAN_STATUS_COMPLETE, DP_PLAN_REASON_AUTO_COMPLETE_DATE);
        }
    }
}

