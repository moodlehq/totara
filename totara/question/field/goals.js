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
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */
M.totara_user_goals = M.totara_user_goals || {

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
            throw new Error('M.totara_goal.init()-> jQuery dependency required for this module to function.');
        }

        var url = M.cfg.wwwroot + '/totara/appraisal/ajax/';
        var saveurl = url + 'reviewgoal.php?id='+this.config.question_id+'&answerid='+this.config.answerid+'&formprefix='+this.config.formprefix+'&subjectid='+this.config.subjectid+'&update=';

        var handler = new totaraDialog_handler_treeview_multiselect();
        handler.baseurl = url;

        handler._update = function(response) {
            this._dialog.hide();

            M.totara_user_goals.totara_appraisal_question_update(response);
        };

        var buttonsObj = {};
        buttonsObj[M.util.get_string('cancel','moodle')] = function() { handler._cancel() }
        buttonsObj[M.util.get_string('add','moodle')] = function() { handler._save(saveurl) }

        totaraDialogs['appraisalgoal'] = new totaraDialog(
            'assigngoals',
            'id_' + this.config.formprefix + '_choosereviewitem',
            {
                buttons: buttonsObj,
                title: '<h2>' + M.util.get_string('choosegoalreview', 'totara_question') + '</h2>'
            },
            url+'goal.php?id='+this.config.question_id+'&answerid='+this.config.answerid+'&subjectid='+this.config.subjectid,
            handler
        );

        M.totara_user_goals.addActions();
    },

    /**
     * Update the table on the calling page, and remove/add no items notices
     *
     * @param   string  HTML response
     * @return  void
     */
    totara_appraisal_question_update: function(response) {
        $('.' + this.config.formprefix + 'appraisal_review').replaceWith(response);
        M.totara_user_goals.addActions();
    },

    /**
     * modal popup for deleting an item
     * @param {String} url The URL to get to delete the item.
     * @param {Object} el optional The DOM element being deleted, for fancy removal from the display.
     */
    modalDelete: function(url, id, el) {
      this.Y.use('panel', function(Y) {
        var panel = new Y.Panel({
          bodyContent: M.util.get_string('removeconfirm', 'totara_question'),
          width        : 300,
          zIndex       : 5,
          centered     : true,
          modal        : true,
          render       : true,
          buttons: [
            {
              name: "confirm",
              value  : 'Yes',
              section: Y.WidgetStdMod.FOOTER,
              action : function (e) {
                e.preventDefault();
                $.get(url).done(function(data) {
                  if (data == 'success') {
                    el.slideUp(250, function(){
                      el.remove();
                      $('input[name^="' + this.config.formprefix + 'reviewitems"][value="' + id + '"]').remove();
                    });
                  }
                  panel.destroy(true);
                });
              }
            },
            {
              name: "deny",
              value  : 'No',
              section: Y.WidgetStdMod.FOOTER,
              action : function (e) {
                e.preventDefault();
                panel.destroy(true);
              }
            }
          ]
        });
        panel.getButton("confirm").removeClass("yui3-button");
        panel.getButton("deny").removeClass("yui3-button");
        panel.show();

      });
    },

    addActions: function() {
        $('.' + this.config.formprefix + 'appraisal_review').find('a.action-icon.delete').on('click', function(){
            M.totara_user_goals.modalDelete($(this).attr('href'), $(this).attr('data-reviewitemid'), $(this).closest('tr'));
            return false;
        });
    }
};
