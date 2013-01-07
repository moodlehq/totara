/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @author Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */
M.totara_iconpicker = M.totara_iconpicker || {

    Y: null,
    // optional php params and defaults defined here, args passed to init method
    // below will override these values
    config: {},

    /**
     * module initialisation method called by php js_init_call()
     *
     * @param object    YUI instance
     * @param string    args supplied in JSON format
     */
    init: function(Y, args){

        // save a reference to the Y instance (all of its dependencies included)
        this.Y = Y;

        // if defined, parse args into this module's config object
        if (args) {
            var jargs = Y.JSON.parse(args);
            for (var a in jargs) {
                if (Y.Object.owns(jargs, a)) {
                    this.config[a] = jargs[a];
                }
            }
        }

        // check jQuery dependency is available
        if (typeof $ === 'undefined') {
            throw new Error('M.totara_iconpicker.init()-> jQuery dependency required for this module to function.');
        }

        // Create a dialog to handle stuff
        var handler = new totaraDialog_handler_selectable(M.totara_iconpicker.config.selected_icon);
        var buttonsObj = {};
            buttonsObj[M.util.get_string('cancel', 'moodle')] = function() { handler._cancel(); };
            buttonsObj[M.util.get_string('ok', 'moodle')] = function() { dialog.close(); };
        var dialog = new totaraDialog(
                'icon-dialog',
                'show-icon-dialog',
                {
                    buttons: buttonsObj,
                    title: '<h2>'+M.util.get_string('chooseicon', 'totara_program')+'</h2>'
                },
                M.cfg.wwwroot + '/totara/core/icons.php?type=' + M.totara_iconpicker.config.type,
                handler
            );

        dialog.base_url = dialog.default_url;
        dialog.old_open = dialog.open;
        dialog.open = function() {
            this.old_open();
        };

        dialog.close = function() {
            var response = $(".ui-selected").attr('id');
            handler._updatePage(response);
        };

        totaraDialogs['icon-dialog'] = dialog;
    }
};
