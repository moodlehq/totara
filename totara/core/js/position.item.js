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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @author Dave Wallace <dave.wallace@kineo.co.nz>
 * @package totara
 * @subpackage totara_core
 */
M.totara_positionitem = M.totara_positionitem || {

    Y: null,
    // optional php params and defaults defined here, args passed to init method
    // below will override these values
    config: {
        id:0,
        frameworkid:0
    },

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
            throw new Error('M.totara_positionitem.init()-> jQuery dependency required for this module to function.');
        }

        ///
        /// Competency dialog
        ///
        (function() {
            var url = M.cfg.wwwroot+ '/totara/hierarchy/prefix/position/assigncompetency/';
            var id = M.totara_positionitem.config.id;
            var fid = M.totara_positionitem.config.frameworkid;
            totaraMultiSelectDialog(
                'assignedcompetencies',
                M.util.get_string('assigncompetencies', 'totara_hierarchy'),
                url+'find.php?assignto='+id+'&frameworkid='+fid+'&add=',
                url+'assign.php?assignto='+id+'&frameworkid='+fid+'&deleteexisting=1&add='
            );
        })();

        ///
        /// Template dialog
        ///
        (function() {
            var url = M.cfg.wwwroot+ '/totara/hierarchy/prefix/position/assigncompetencytemplate/';
            var id = M.totara_positionitem.config.id;
            var fid = M.totara_positionitem.config.frameworkid;
            totaraMultiSelectDialog(
                'assignedcompetencytemplates',
                M.util.get_string('assigncompetencytemplate', 'totara_hierarchy'),
                url+'find.php?assignto='+id+'&frameworkid='+fid+'&add=',
                url+'assign.php?assignto='+id+'&frameworkid='+fid+'&deleteexisting=1&add='
            );
        })();
    }
};
