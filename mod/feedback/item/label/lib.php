<?PHP  // $Id: lib.php,v 1.1.4.2 2008/01/15 23:53:27 agrabs Exp $
defined('MOODLE_INTERNAL') OR die('not allowed');
require_once($CFG->dirroot.'/mod/feedback/item/feedback_item_class.php');

class feedback_item_label extends feedback_item_base {
    var $type = "label";
    function init() {
    
    }
    
    function show_edit($item, $usehtmleditor = false) {
        $item->presentation=isset($item->presentation)?$item->presentation:'';
    ?>
        <table style="display:inline">
            <tr><th><?php print_string('label', 'feedback');?></th></tr>
            <tr>
                <td>
                    <?php print_textarea($usehtmleditor, 20, 60, 680, 400, "presentation", $item->presentation);?>
                    <input type="hidden" id="itemname" name="itemname" value="label" />
                </td>
            </tr>
        </table>
        <div style="clear:both"></div>
    <?php
        if ($usehtmleditor) {
            use_html_editor();
        }
    }
    function print_item($item){
    ?>
        <td colspan="2">
            <?php echo format_text($item->presentation);?>
        </td>
    <?php
    }

    function create_value($data) {
        return false;
    }

    //used by create_item and update_item functions,
    //when provided $data submitted from feedback_show_edit
    function get_presentation($data) {
        return stripslashes($data->presentation);
    }

    function get_hasvalue() {
        return 0;
    }
}
?>