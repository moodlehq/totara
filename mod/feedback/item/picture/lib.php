<?php // $Id: lib.php,v 1.1.4.2 2008/01/15 23:53:27 agrabs Exp $ 
defined('MOODLE_INTERNAL') OR die('not allowed');
require_once($CFG->dirroot.'/mod/feedback/item/feedback_item_class.php');

/**
 * constant points to the directory where the picrure file library is located
 */
define ('FEEDBACK_PICTURE_FILES', '/mod/feedback/item/picture/library');

/**
 * outputs HTML for defining a new picture item or updating an existing one
 * 
 * Outputs HTML code to browser window, allows user to define
 * a new picture item  or to update an existing one
 * 
 * @param object $item contains the item data (a record from prefix_feedback_item table)
 * @param boolean $usehtmleditor should HTML editor be used or not? (not needed in feedback_show_edit_picture)
 */
class feedback_item_picture extends feedback_item_base {
    var $type = "picture";
    function init() {
    
    }
    
    function show_edit($item, $usehtmleditor = false)
    {
        global $CFG;
        $picdir = $CFG->dirroot . FEEDBACK_PICTURE_FILES;

        $item->presentation=empty($item->presentation)?'':$item->presentation;
        $itemvalues=explode('|', $item->presentation);
        
        // Let's compose the HTML select for picture filenames
        $fselect = "";
        $picfiles = $this->read_picture_list($picdir, "jpg;png;gif");

        if ($itemvalues == "") {
            // we do not have anything selected yet
            foreach ($picfiles as $picfile) {
                $fselect = '<option value="' . $picfile . '">' . $picfile . '</option>' . $fselect;
            } 
        } else {
            // we are updating an item, some picture file names are already selected
            foreach ($picfiles as $picfile) {
                if (in_array($picfile, $itemvalues)) {
                    $fselect = $fselect . '<option value="' . $picfile . '" selected="selected">' . $picfile . '</option>' ;
                } else {
                    $fselect = $fselect . '<option value="' . $picfile . '" >' . $picfile . '</option>';
                } 
            } 
        } 
        // The rest of this function will produce a HTML table and will fill in the elements we need
        ?>
       <table>
          <tr>
             <th colspan="2"><?php print_string('picture', 'feedback');

        ?> 
                &nbsp;(<input type="checkbox" name="required" value="1" <?php 
                    $item->required=isset($item->required)?$item->required:0;
                    echo ($item->required == 1?'checked="checked"':'');

        ?> />&nbsp;<?php print_string('required', 'feedback');

        ?>)
             </th>
          </tr>
          <tr>
             <td><?php print_string('item_name', 'feedback'); 

        ?></td>
             <td><input type="text" id="itemname" name="itemname" size="40" maxlength="255" value="<?php echo isset($item->name)?htmlspecialchars(stripslashes_safe($item->name)):'';?>" /></td>
          </tr>

          <tr><td colspan="2">&nbsp;</td></tr>
          <tr><td></td><td> <?php print_string('picture_file_list', 'feedback')?></td></tr>
          <tr>
             <td valign="top">
                <?php print_string('picture_values', 'feedback');

        ?>
             </td>
             <td>
                <?php $itemvalues = str_replace('|', "\n", $item->presentation);

        ?>
                <select name="itemvalues[]" size="10" multiple="multiple"><?php echo $fselect;

        ?></select>
             </td>
          </tr>
       </table>
       
       <table align="center"><tr><td>
       
       </td></tr></table>
       
    <?php
    } 
    // liefert ein eindimensionales Array mit drei Werten(typ, name, XXX)
    // XXX ist ein eindimensionales Array (anzahl der Antworten bei Typ Radio) Jedes Element ist eine Struktur (answertext, answercount)
    /**
     * counts the answers to a given picture item
     * 
     * Goes through all submitted answers to a 
     * given feedback item, counts the occurrances of each answer
     * and calculates a quotient showing 
     * (received answers per pic)/(all received answers)
     * 
     * @param object $item contains the item data (a record from prefix_feedback_item table)
     * @param boolean $groupid 
     * @return array returned array will contain something like this <pre>
     * Array
     * (
     *           [0] => picture
     *           [1] => What is the flag of Andorra?
     *           [2] => Array
     *               (
     *                   [0] => stdClass Object
     *                       (
     *                           [answertext] => angola.png
     *                           [answercount] => 1
     *                           [quotient] => 0.5
     *                       )
     *                   [1] => stdClass Object
     *                       (
     *                           [answertext] => antiguabarbuda.png
     *                           [answercount] => 0
     *                           [quotient] => 0
     *                       )
     *                   [2] => stdClass Object
     *                       (
     *                           [answertext] => andorra.png
     *                           [answercount] => 1
     *                           [quotient] => 0.5
     *                       )
     *               )
     * )</pre>
     */
    function get_analysed($item, $groupid = false, $courseid = false, $facetofacesessionid = false)
    { 
        // for the beginning first only the radiobadges
        $analysedItem = array();
        $analysedItem[] = $item->typ;
        $analysedItem[] = $item->name; 
        // the possible answers extract
        $answers = null;
        $answers = explode ("|", $item->presentation);
        if (!is_array($answers)) return null; 
        // the values get
    $values = feedback_get_group_values($item, $groupid, $courseid, $facetofacesessionid);
    if (!$values && !$facetofacesessionid) return null; 
        // trail about the values and about the answer possibilities
        $analysedAnswer = array();

        for($i = 1; $i <= sizeof($answers); $i++) {
            $ans = null;
            $ans->answertext = $answers[$i-1];
            $ans->answercount = 0;
        if($values){
            foreach($values as $value) {
                // if the answer is immediately index of the answers + 1?
                if ($value->value == $i) {
                    $ans->answercount++;
                } 
                } 
            } 
            $ans->quotient = $ans->answercount / sizeof($values);
            $analysedAnswer[] = $ans;
        } 
        $analysedItem[] = $analysedAnswer;
        return $analysedItem;
    } 

    /**
     * outputs HTML presenting the distribution of answers
     * 
     * Outputs HTML code to browser window, which shows
     * the distribution of answers to feedback item $item
     * 
     * @param object $item contains the item data (a record from prefix_feedback_item table)
     * @param integer $itemnr used for ordering items list for viewing
     * @param boolean $groupid 
     * @return integer 
     */
    function print_analysed($item, $itemnr = 0, $groupid = false, $courseid = false)
    {
        global $CFG;
       
       $sep_dec = get_string('separator_decimal', 'feedback');
       if(substr($sep_dec, 0, 2) == '[['){
          $sep_dec = FEEDBACK_DECIMAL;
       }
       
       $sep_thous = get_string('separator_thousand', 'feedback');
       if(substr($sep_thous, 0, 2) == '[['){
          $sep_thous = FEEDBACK_THOUSAND;
       }
       
        $analysedItem = $this->get_analysed($item, $groupid, $courseid); //compute the distribution of received answers        
        // do we have anlyzed items to show?
        if ($analysedItem) {
            $itemnr++; 
            // outputs running index of item together with the question associated with the item
            echo '<tr><th colspan="3" align="left">' . $itemnr . '.)&nbsp;' . $analysedItem[1] . '</th></tr>';
            $analysedVals = $analysedItem[2];
            $pixnr = 0; 
            // create suitably wide picture to present a horizontal bar proportional to the number of answers received
            foreach($analysedVals as $val) {
                if (function_exists("bcmod")) {
                    $pix = 'pics/' . bcmod($pixnr, 10) . '.gif'; // define the colour of the bar
                } else {
                    $pix = 'pics/0.gif';
                } 
                $pixnr++;
                $pixwidth = intval($val->quotient * FEEDBACK_MAX_PIX_LENGTH);
                $quotient = number_format(($val->quotient * 100), 2, $sep_dec, $sep_thous);
                list($picname) = explode('.', trim($val->answertext)); //removing file name extension        
                // create HTML for a horizontal graph showing distribution of answers
                echo '<tr><td align="left" valign="bottom">' . $picname . '</td><td align="left"> <img style="padding-right: 20px;padding-left: 20px;" src="' . $CFG->wwwroot . FEEDBACK_PICTURE_FILES . '/' . trim($val->answertext) . '" />' . ':</td><td align="left" width="'.FEEDBACK_MAX_PIX_LENGTH.'"><img style=" vertical-align: baseline;" src="' . $pix . '" height="5" width="' . $pixwidth . '" />&nbsp;'
                 . $val->answercount . (($val->quotient > 0)?'&nbsp;(' . $quotient . '&nbsp;%)':'') . '</td></tr>';
            } 
        } 
        return $itemnr;
    } 

    /**
     * returns the value of an item to be used in an Excel report 
     * 
     * used by funtion feedback_excelprint_detailed_items in analysis_to_excel.php
     * 
     * @param object $item contains the item data (a record from prefix_feedback_item table)
     * @param integer $value value of the item as submitted (integer index of the selected radio button)
     * @return string string presentation of item value
     */
    function get_printval($item, $value)
    {
        $printval = '';
        
        if(!isset($value->value)) return $printval;
        
        $presentation = explode ("|", $item->presentation);
        $index = 1;
        foreach($presentation as $pres) {
            if ($value->value == $index) {
                $printval = $pres;
                break;
            } 
            $index++;
        } 
        list($tmp) = explode(".", $printval); //just removing the file extensiom
        return $tmp;
    } 

    /**
     * outputs analyzed data into an Excel worksheet
     * 
     * used by analysis_to_excel.php
     * 
     * @param  $ &EasyWorkbook reference to the Excel workbook into which data is written
     * @param integer $rowOffset printing will take place to row number $rowoffset
     * @param object $item contains the item data (a record from prefix_feedback_item table)
     * @param boolean $groupid 
     * @return integer retuns value of $rowOffset
     */
    function excelprint_item(&$worksheet, $rowOffset, $item, $groupid, $courseid = false, $colOffset = 0, $facetofacesessionid = false)
    {
        $analysed_item = $this->get_analysed($item, $groupid, $courseid, $facetofacesessionid);
        $data = $analysed_item[2];

        $worksheet->setFormat("<l><f><ro2><vo><c:green>"); 
        // write question
        $worksheet->write_string($rowOffset, $colOffset, $analysed_item[1]);
        if (is_array($data)) {
            for($i = 0; $i < sizeof($data); $i++) {
                $aData = $data[$i]; 
                // $i is index to the column
                $worksheet->setFormat("<l><f><ro2><vo><c:blue>");
                $worksheet->write_string($rowOffset, $colOffset + $i + 1, trim($aData->answertext));

                $worksheet->setFormat("<l><vo>");
                $worksheet->write_number($rowOffset + 1, $colOffset + $i + 1, $aData->answercount);
                $worksheet->setFormat("<l><f><vo><pr>");
                $worksheet->write_number($rowOffset + 2, $colOffset + $i + 1, $aData->quotient);
            } 
        } 
        $rowOffset += 3 ;
        return $rowOffset;
    } 

    /**
     * outputs HTML for picture item
     * 
     * Outputs HTML code to browser window showing the picture item,
     * item may have already a $value (a sumitted form has been received), and
     * it is possible to show only the selected picture ($readonly=true)
     * 
     * Radio button values are numbered starting from 1 ($index)
     * 
     * @param object $item contains the item data (a record from prefix_feedback_item table)
     * @param integer $value gives the index to the selected picture (if any)
     * @param boolean $readonly if true, only the selected picture is shown
     */
    function print_item($item, $value = false, $readonly = false, $edit = false, $highlightrequire = false) {
        global $CFG;
        global $SESSION;
        
        $align = get_string('thisdirection') == 'ltr' ? 'left' : 'right';
        $padding_label = get_string('thisdirection') == 'ltr' ? 'right' : 'left';

        $feedbackid = $item->feedback;
        if($feedbackid > 0) {
            $feedback = get_record('feedback', 'id', $feedbackid);
            $cm = get_coursemodule_from_instance("feedback", $feedback->id, $feedback->course);
            $capabilities = feedback_load_capabilities($cm->id);
        }

        $presentation = explode ("|", $item->presentation);
        if($highlightrequire AND $item->required AND intval($value) <= 0) {
            $highlight = 'bgcolor="#FFAAAA" class="missingrequire"';
        }else {
            $highlight = '';
        }
        $requiredmark = ($item->required == 1)?'<font color="red">*</font>':'';

        ?>
       <td <?php echo $highlight;?> valign="top" align="<?php echo $align;?>" style="padding-<?php echo $padding_label;?>: 40px;"><?php echo format_text(stripslashes_safe($item->name) . $requiredmark, true, false, false);

        ?></td>
       <td valign="top" align="<?php echo $align;?>">
    <?php
        $index = 1;
        $checked = '';
        if ($readonly) {
            // here we want to show the selected picture only, $value must be provided
            // this is used by feedback/show_entries.php, for example
            foreach($presentation as $pic) {
                if ($value == $index) {
                    // print_simple_box_start($align);
                    print_box_start('generalbox boxalign'.$align);
                    echo '<img style="padding-'.$align.': 20px;" src="' . $CFG->wwwroot . FEEDBACK_PICTURE_FILES . '/' . $pic . '" />';
                    // print_simple_box_end();
                    print_box_end();
                    break;
                } 
                $index++;
            } 
        } else {
            // this is what we want most of the time, to show the picture item so that answering is possible
            // item may have already a value, after a failed saving attempt, say)
            $currentpic = 0;
            $piccount = count($presentation);
            //$course_module = get_record('course_modules', 'id', $cm->id);

            foreach($presentation as $pic) {
                // do we have somehting already selected?
                if ($value == $index) {
                    $checked = 'checked="checked"';
                } else {
                    $checked = '';
                } 
                // generate the HTML for the item
                $inputid = $item->typ.'_'.$item->id.'_'.$index;
                ?>
             <table><tr>
             <td valign="top" align="<?php echo $align;?>"><input type="radio"
                   name="<?php echo $item->typ . '_' . $item->id?>"
                   id="<?php echo $inputid;?>"
                   value="<?php echo $index;

                ?>" <?php echo $checked;

                ?> />
             </td><td align="<?php echo $align;?>"><label for="<?php echo $inputid;?>"><?php echo '<img style="padding-left: 20px;" src="' . $CFG->wwwroot . FEEDBACK_PICTURE_FILES . '/' . $pic . '" /></label>';

                ?>&nbsp;
             <?php
                $currentpic++;
                // if (isadmin() || isteacher($course_module->course)) {
                if (isset($capabilities->edititems) AND $capabilities->edititems) {
                    if ($currentpic != 1) {
                        echo '</td>
                            <td width="20">
                                <form action="'.$CFG->wwwroot.'/mod/feedback/item/picture/action.php" method="post" >
                                    <input type="hidden" name="index" value="'.$index.'" />
                                    <input type="hidden" name="itemid" value="'.$item->id.'" />
                                    <input type="hidden" name="id" value="'.$cm->id.'" />
                                    <input type="hidden" name="action" value="moveup" />
                                    <input type="image" title="'.get_string('moveup', 'feedback').'" name="moveup" src="'.$CFG->pixpath.'/t/up.gif" hspace="1" height="11" width="11" border="0" />
                                </form>'; //feedback_create_action_form('moveup', array($item, $currentpic), 'up.gif');
                    } else {
                        echo '</td><td width="20"> &nbsp;';
                    } 

                    if ($currentpic < $piccount) {
                        echo '</td>
                            <td width="20">
                                <form action="'.$CFG->wwwroot.'/mod/feedback/item/picture/action.php" method="post" >
                                    <input type="hidden" name="index" value="'.$index.'" />
                                    <input type="hidden" name="itemid" value="'.$item->id.'" />
                                    <input type="hidden" name="id" value="'.$cm->id.'" />
                                    <input type="hidden" name="action" value="movedown" />
                                    <input type="image" title="'.get_string('movedown', 'feedback').'" name="movedown" src="'.$CFG->pixpath.'/t/down.gif" hspace="1" height="11" width="11" border="0" />
                                </form>'; //feedback_create_action_form('movedown', array($item, $currentpic), 'up.gif');
                    } else {
                        echo '</td><td width="50"> &nbsp;';
                    } 
                } 

                ?>
             </td></tr></table>
    <?php
                $index++;
            } 
        } 

        ?>
       </td>
    <?php
    } 

    /**
     * validity check for picture item value
     * 
     * @param string $value data to be checked
     * @return boolean true if data is acceptable to be stored in picture item
     */
    function check_value($value, $item){
        //if the item is not required, so the check is true if no value is given
        if((!isset($value) OR $value == '' OR $value == 0) AND $item->required != 1) return true;
        if (intval($value) > 0)return true;
        return false;
    } 

    /**
     * creates proper data format for picture item value
     * 
     * For picture item this function is trivial, because the submitted data
     * from radio button group is directly the integer value we want
     * 
     * NOTE: it is this integer that is stored in the database table prefix_feedback_value,
     * not the picture filename
     * 
     * @param string $data data to be modified
     * @return string picture item value
     */
    function create_value($data)
    {
        $data = clean_param($data, PARAM_INT);
        return $data;
    } 

    /**
     * creates a string presentation of a picture item
     * 
     * Data comes in as an array, but we want to make
     * the presentation to be a string, which allos easy 
     * writing to a database.
     * 
     * @param array $data data from submitted from form edit_item.php
     * @return string presentation of picture item
     */
    function get_presentation($data)
    {
        $present = isset($data->itemvalues)?$this->picture_array2string($data->itemvalues):'';
        return $present;
    } 

    /**
     * returns always 1 indicating that picture item can have a value
     * 
     * Note that this is in contrast with the label item that cannot have a value.
     * (feedback_get_hasvalue_label() returns always false)
     * 
     * @return 1
     */
    function get_hasvalue()
    {
        return 1;
    } 

    /**
     * reads the file list of a given directory
     * 
     * @param string $dir directory from which we want to list files having a given extension
     * @param string $ext gives the file name extensions that will included in the returned array, for example "jpg;png;gif"
     * @return array string array of file names
     */
    function read_picture_list ($dir, $extensions = "")
    {
        $picfiles = array();
        if (is_dir($dir)) {
            $d = dir($dir);
        } else {
            return $picfiles;
        } 
        while (false !== ($entry = $d->read())) {
            if ($extensions == "") {
                $picfiles[] = $entry;
            } else {
                if (substr_count($entry, '.') > 0) {
                  list($name, $fext) = explode('.', $entry);   
                } else{
                  $name=$entry;
                  $fext='';
                }
                $exts = explode(';', $extensions);
                foreach ($exts as $ext) {
                    if ($ext == $fext) {
                        $picfiles[] = $entry;
                    } 
                } 
            } 
        } 
        $d->close();

        return $picfiles;
    } 

    /**
     * formats an array into a string, were array values are separated by '|' 
     * 
     * This is useful for converting received form variable arrays into a string,
     * which can be easily stored in a database.
     * 
     * @param array $arr array to be converted into a string
     * @return string string where $arr values are separated by '|'
     */
    function picture_array2string($arr)
    {
        if (!is_array($arr)) {
            return '';
        } 
        $retval = '';
        $arrvals = array_values($arr);
        $retval = $arrvals[0];
        for($i = 1; $i < sizeof($arrvals); $i++) {
            $retval = $retval . '|' . $arrvals[$i];
        } 
        return $retval;
    } 


    // action handlers
    /**
     * rearrange pictures: moves picture up within one picture item
     */
    function handler_moveup($item, $index)
    {
        global $SESSION;

        $presentation = explode("|", stripslashes_safe($item->presentation));
        if ($index <= 1) {
            return false;
        } 
        $a = $presentation[$index-1];
        $presentation[$index-1] = $presentation[$index-2];
        $presentation[$index-2] = $a;
        $item->name = addslashes($item->name);
        $item->presentation = addslashes($this->picture_array2string($presentation));
        $retval = update_record('feedback_item', $item);
        return $retval;
    } 

    /**
     * rearrange pictures: moves picture down within one picture item
     */
    function handler_movedown($item, $index) {
        global $SESSION;
        $presentation = explode("|", stripslashes_safe($item->presentation));
        if ($index >= count($presentation)) {
            return false;
        } 
        $a = $presentation[$index-1];
        $presentation[$index-1] = $presentation[$index];
        $presentation[$index] = $a;
        $item->name = addslashes($item->name);
        $item->presentation = addslashes($this->picture_array2string($presentation));
        $retval = update_record('feedback_item', $item);
        return $retval;
    } 

    /**
     * just testing, used on testpage_1 amd testpage_2
     */
    function handler_print_item($text) {
        global $SESSION;
        $SESSION->feedback->testmessage = $text;
        return true;
    } 

    /**
     * just testing, used on testpage_1 amd testpage_2
     */
    function handler_submitbutton($text) {
        global $SESSION;
        $SESSION->feedback->testmessage = $text;
        return true;
    } 
}
?>
