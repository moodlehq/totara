<?php // $Id$

/**
 * Edit page for a plan template
 *
 * @copyright Catalyst IT Limited
 * @autho Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

$id = optional_param('id', null, PARAM_INT);

admin_externalpage_setup('managetemplates');

if(!$template = get_record('dp_template', 'id', $id)){
    error('error:invalidtemplateid');
}


admin_externalpage_print_header();

print_heading($template->fullname);

require('tabs.php');




print_footer();

?>
