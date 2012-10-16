<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_customfield
 */

$string['commonsettings'] = 'Common settings';
$string['confirmfielddeletionnodata'] = 'Are you sure you want to delete this field?';
$string['confirmfielddeletionsingle'] = 'There is 1 record for this field which will be deleted. <br />Do you still wish to delete this field?';
$string['confirmfielddeletionplural'] = 'There are {$a} records for this field which will be deleted. <br />Do you still wish to delete this field?';
$string['coursecustomfields'] = 'Course custom fields';
$string['createnewcustomfield'] = 'Create a new custom field';
$string['createnewfield'] = 'Create a new &quot;{$a}&quot; custom field';
$string['customfieldtypecheckbox'] = 'Checkbox';
$string['customfieldtypemenu'] = 'Menu of choices';
$string['customfieldtypetext'] = 'Text input';
$string['customfieldtypetextarea'] = 'Text area';
$string['customfieldtypefile'] = 'File';
$string['customfield'] = 'Custom field';
$string['customfields'] = 'Custom fields';
$string['defaultdata'] = 'Default value';
$string['deletefield'] = 'Deleting a field';
$string['description'] = 'Description of the field';
$string['editfield'] = 'Editing custom field: {$a}';
$string['fieldcolumns'] = 'Columns';
$string['fieldrows'] = 'Rows';
$string['fieldsize'] = 'Display size';
$string['fieldmaxlength'] = 'Maximum length';
$string['fieldispassword'] = 'Is this a password field?';
$string['menuoptions'] = 'Menu options (one per line)';
$string['menunooptions'] = 'No menu options supplied';
$string['menutoofewoptions'] = 'You must provide at least 2 options';
$string['menudefaultnotinoptions'] = 'The default value is not one of the options';
$string['notset'] = 'Not set';
$string['defaultchecked'] = 'Checked by default';
$string['forceunique'] = 'Should the data be unique?';
$string['locked'] = 'Is this field locked?';
$string['nocustomfieldsdefined'] = 'No fields have been defined';
$string['pluginname'] = 'Customfields';
$string['shortname'] = 'Short name (must be unique)';
$string['shortnamenotunique'] = 'This short name is already in use';
$string['specificsettings'] = 'Specific settings';
$string['customfieldrequired'] = 'This field is required';
$string['visible'] = 'Hidden on the settings page?';
$string['customfieldfullname'] = 'Custom Field full name';
$string['customfieldshortname'] = 'Custom Field short name';
$string['customfieldlocked'] = 'Custom Field locked';
$string['customfieldforceunique'] = 'Custom Field unique';
$string['customfieldhidden'] = 'Custom Field hidden';
$string['customfielddefaultdatatextarea'] = 'Custom Field default data';
$string['returntoframework'] = 'Return to Framework';
$string['customfieldtypedatetime'] = 'Date/time';
$string['endyear'] = 'End year';
$string['startyear'] = 'Start year';
$string['startyearafterend'] = 'The start year can\'t occur after the end year';
$string['wanttime'] = 'Include time?';
$string['error:abstractmethod'] = 'This abstract method must be overriden';
$string['error:updatecustomfield'] = 'Error updating custom field!';
// HELP strings
$string['customfieldhidden_help'] = 'When set to Yes the custom field will not be visible on the settings page or elsewhere where it would have been shown. When No the custom field will be visible.';
$string['customfieldfullname_help'] = 'Custom field full name is the complete title of the custom field.';
$string['customfieldforceunique_help'] = 'When set to Yes the custom field will only accept a unique value. If a duplicate value is used in this field the system will not allow the item to be saved.

When set to No the custom field will accept any value in the field.';
$string['customfieldlocked_help'] = 'When set to Yes the custom field will only display the information set when the field was set up. The field cannot be edited.';
$string['customfieldmenuoptions'] = 'Menu options (Menu of choices)';
$string['customfieldmenuoptions_help'] = 'Enter the menu options that will appear in the drop down box.

Only enter one option per line.';
$string['customfieldshortname_help'] = 'Custom field short name is the abbreviated name of the custom field and can be used for display purposes.

Custom fields will appear as options on the edit item screen for items.';
$string['customfieldrowstextarea'] = 'Rows (text area)';
$string['customfieldrowstextarea_help'] = 'Set the height of the text area that will be available (number of lines).';
$string['customfieldrequired_help'] = 'If set to Yes, it will be a compulsory field when creating new items

If set to No, it will be an optional field when creating new items.';
$string['customfieldfieldsizetext'] = 'Display size (Text input)';
$string['customfieldfieldsizetext_help'] = 'Display size sets that number of characters that will be displayed in the text field.';
$string['customfieldmaxlengthtext'] = 'Maximum length (Text Input)';
$string['customfieldmaxlengthtext_help'] = 'Maximum length sets the maximum number of characters the text field will accept.';
$string['customfielddefaultdatatext'] = 'Default value (Text input)';
$string['customfielddefaultdatatext_help'] = 'Default value is the text that will appear in the text field by default.

Leave this field blank if no default text is required.';
$string['customfielddefaultdatatextarea_help'] = 'Default value is the text that will appear in the text area by default.

Leave this field blank if no default text is required.';
$string['customfieldcolumnstextarea'] = 'Columns (text area)';
$string['customfieldcolumnstextarea_help'] = '**Columns** sets the width of text area that will be available.';
$string['customfielddefaultdatamenu'] = 'Default value (menu of choices)';
$string['customfielddefaultdatamenu_help'] = 'Set the default value that will appear in the drop down box. The default value must appear in the menu options above.

Leave blank if there is no default entry required.';
$string['customfielddefaultdatacheckbox'] = 'Checked by default (Checkbox)';
$string['customfielddefaultdatacheckbox_help'] = 'When set to Yes the Custom field checkbox will be checked by default.

When set to No the Custom field checkbox will not be checked by default.';
$string['description_help'] = 'A text description of this custom field';
