<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_customfield
 */

$string['category'] = 'Category';
$string['categorynamemustbeunique'] = 'Category name (must be unique)';
$string['categorynamenotunique'] = 'This category name is already in use';
$string['confirmcategorydeletion'] = 'There is/are {$a} field/s in this category which will be moved into the category above (or below if in the top category). <br />Do you still wish to delete this category?';
$string['commonsettings'] = 'Common settings';
$string['confirmfielddeletion'] = 'There is/are {$a} record/s for this field which will be deleted. <br />Do you still wish to delete this field?';
$string['coursecustomfields'] = 'Course custom fields';
$string['createcustomfieldcategory'] = 'Create custom field category';
$string['createnewcustomfield'] = 'Create a new custom field';
$string['createnewfield'] = 'Create a new &quot;{$a}&quot; custom field';
$string['createnewcategory'] = 'Creating a new category';
$string['customfieldtypecheckbox'] = 'Checkbox';
$string['customfieldtypemenu'] = 'Menu of choices';
$string['customfieldtypetext'] = 'Text input';
$string['customfieldtypetextarea'] = 'Text area';
$string['customfieldtypefile'] = 'File';
$string['customfield'] = 'Custom field';
$string['customfields'] = 'Custom fields';
$string['defaultdata'] = 'Default value';
$string['deletecategory'] = 'Deleting a category';
$string['deletefield'] = 'Deleting a field';
$string['description'] = 'Description of the field';
$string['editcategory'] = 'Editing custom field category: {$a}';
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
$string['defaultchecked'] = 'Checked by default';
$string['forceunique'] = 'Should the data be unique?';
$string['locked'] = 'Is this field locked?';
$string['nocustomfieldsdefined'] = 'No fields have been defined';
$string['pluginname'] = 'Customfields';
$string['shortname'] = 'Short name (must be unique)';
$string['shortnamenotunique'] = 'This short name is already in use';
$string['specificsettings'] = 'Specific settings';
$string['customfieldrequired'] = 'Is this field required?';
$string['visible'] = 'Hidden on the settings page?';
$string['nocustomfieldcategories'] = 'To add custom fields, first create a custom field category';
$string['nocustomfieldcategoriesdefined'] = 'No custom field categories defined';
$string['customfieldcategories'] = 'Custom Field Categories';
$string['returntocategories'] = 'Return to Custom Field Categories';
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
$string['wanttime'] = 'Include time?';
$string['error:abstractmethod'] = 'This abstract method must be overriden';
$string['error:updatecustomfield'] = 'Error updating custom field!';
// HELP strings
$string['customfieldhidden_help'] = '# Hidden on the settings page?

When set to Yes the custom field will not be visible on the settings page or elsewhere where it would have been shown. When No the custom field will be visible.';
$string['customfieldfullname_help'] = '# Custom field full name

Custom field full name is the complete title of the custom field.';
$string['customfieldforceunique_help'] = '# Should the data be unique?

When set to Yes the custom field will only accept a unique value. If a duplicate value is used in this field the system will not allow the item to be saved.

When set to No the custom field will accept any value in the field.';
$string['customfieldlocked_help'] = '# Is this field locked?

When set to Yes the custom field will only display the information set when the field was set up. The field cannot be edited.';
$string['customfieldmenuoptions_help'] = '# Menu options (Menu of choices)

Enter the menu options that will appear in the drop down box.

Only enter one option per line.';
$string['customfieldshortname_help'] = '# Custom Field Short name

Custom field short name is the abbreviated name of the custom field and can be used for display purposes.

Custom fields will appear as options on the edit item screen for items at the same depth level as this custom field is assigned.';
$string['customfieldrowstextarea_help'] = '# Rows (text area)

Set the height of the text area that will be available (number of lines).';
$string['customfieldrequired_help'] = '# Is this field required?

Is this field required? If set to Yes, it will be a compulsory field when creating new items at this depth level.

If set to No, it will be an optional field when creating new items at this depth level.';
$string['customfieldfieldsizetext_help'] = '# Display size (Text input)

Display size sets that number of characters that will be displayed in the text field.';
$string['customfieldmaxlengthtext_help'] = '# Maximum length (Text Input)

Maximum length sets the maximum number of characters the text field will accept.';
$string['customfielddefaultdatatext_help'] = '# Default value (Text input)

Default value is the text that will appear in the text field by default.

Leave this field blank if no default text is required.';
$string['customfieldcategory_help'] = '# Category

A **Category** is created to group together additional customised fields on a page, e.g. a on a competency, positions or organisations page.';
$string['customfieldcategories_help'] = '# Custom Field Categories

**Custom field categories** allow you to set up customised categories to hold custom fields under a depth level.

Custom field categories and Custom fields are set up to allow all the relevant information for hierarchy items to be captured and appear on the \'Add/Edit Hierarchy Item\' pages.

Custom field category names must be unique to the depth level. You need to have at least one custom field category set up to be able to set up custom fields.

**Adding a Custom Category: **Click **Create Custom field category** to add a new custom field category.

**Edit/Delete a custom category: **Click **Turn editing on** to edit or delete an existing custom field category.';
$string['customfielddefaultdatatextarea_help'] = '# Default value (text area)

Default value is the text that will appear in the text area by default.

Leave this field blank if no default text is required.';
$string['customfieldcategoryname_help'] = '# Custom Field Category Name

The **Custom field category** name helps to group together the types of customised fields you require and must be unique to the depth level you are working in. 

Type in the name and click **Save changes**.';
$string['customfieldcolumnstextarea_help'] = '# Columns (text area)

**Columns** sets the width of text area that will be available.';
$string['customfielddefaultdatamenu_help'] = '# Default value (menu of choices)

Set the default value that will appear in the drop down box. The default value must appear in the menu options above.

Leave blank if there is no default entry required.';
$string['customfielddefaultdatacheckbox_help'] = '# Checked by default (Checkbox)

When set to Yes the Custom field checkbox will be checked by default.

When set to No the Custom field checkbox will not be checked by default.';

