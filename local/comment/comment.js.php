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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage comment
 */

require_once('../../config.php');
header('Content-Type: text/x-javascript');
?>

$(document).ready(function() {
    document.body.className += ' jsenabled';
    for (i in totara_comment_options) {
        var comment_obj = new totara_core_comment();
        comment_obj.init(YAHOO, totara_comment_options[i]);
    }
});

var totara_core_comment = function() {
    var api;
    var client_id;
    var itemid;
    var commentarea;
    var component;
    var courseid;
    var contextid;
    var confirmoverlay;
    var commentsperpage;
    var notoggle;
    var autostart;

    /**
     * Initialize commenting system
     */
    this.init = function(Y, args) {
            this.api = '<?php echo $CFG->wwwroot; ?>/local/comment/comment_ajax.php';

            // Init stuff
            var obj = this;
            this.client_id = args.client_id;
            this.itemid = args.itemid;
            this.commentarea = args.commentarea;
            this.component = args.component;
            this.courseid = args.courseid;
            this.contextid = args.contextid;
            this.commentsperpage = args.commentsperpage;
            this.autostart = args.autostart;
            this.notoggle = args.notoggle;
            // expand comments?
            if (this.autostart) {
                this.view(args.page);
            }
            // load comments
            var handle = $('#comment-link-'+this.client_id);
            // hide toggle link
            if (handle) {
                if (this.notoggle) {
                    handle.css('display', 'none');
                }
                handle.click(function(e) {
                    e.preventDefault();
                    obj.view(0);
                    return false;
                });
            }
            var overlay_el = document.createElement('div');
            overlay_el.className = 'comment-delete-confirm';
            var overlay_el_opt = document.createElement('span');  // Are you sure?
            overlay_el_opt.innerHTML = '<?php echo get_string('areyousure', 'local_comment') . ' ';?>';
            overlay_el.appendChild(overlay_el_opt);
            overlay_el_opt = document.createElement('a');  // Yes
            overlay_el_opt.href ='#';
            overlay_el_opt.id = 'confirmdelete-'+this.client_id;
            overlay_el_opt.innerHTML = '<?php echo get_string('yes');?>';
            overlay_el.appendChild(overlay_el_opt);
            overlay_el_opt = document.createElement('a');   // No
            overlay_el_opt.href = '#';
            overlay_el_opt.id = 'canceldelete-'+this.client_id;
            overlay_el_opt.innerHTML = '<?php echo get_string('no');?>';
            overlay_el.appendChild(overlay_el_opt);

            this.confirmoverlay = new Y.widget.Overlay(overlay_el);
            this.confirmoverlay.render(document.body);
            this.confirmoverlay.hide();
    };

    this.post = function() {
                var ta = $('#dlg-content-'+this.client_id);
                var obj = this;
                var value = ta.attr('value');
                if (value && value != '<?php echo get_string('addcomment', 'local_comment'); ?>') {
                    var params = {'content': value};
                    obj.request({
                        action: 'add',
                        scope: obj,
                        params: params,
                        beforeSend: function () {
                            // indicate loading
                            $('#comment-action-'+obj.client_id+' a').hide();
                            $('#comment-action-'+obj.client_id+' span').hide();
                            $('#comment-action-'+obj.client_id).append('<div class="mdl-align-right"><img src="<?php echo $CFG->pixpath.'/i/loading_small.gif'; ?>" /></div>');
                        },
                        callback: function(id, data, args) {
                            var scope = args.scope;
                            var cid = data.client_id;
                            var ta = $('#dlg-content-'+cid);
                            ta.attr('value', '');
                            var container = $('#comment-list-'+cid);
                            var result = obj.render([data], true);
                            var newcomment = $(result.html);
                            newcomment.hide();
                            container.append(newcomment);
                            newcomment.fadeIn(500);
                            var ids = result.ids;
                            var linktext = $('#comment-link-text-'+cid);
                            if (linktext) {
                                linktext.html('<?php echo get_string('comments', 'local_comment'); ?> ('+data.count+')');
                            }

                            // restore action buttons
                            $('#comment-action-'+obj.client_id+' a').show();
                            $('#comment-action-'+obj.client_id+' span').show();
                            $('#comment-action-'+obj.client_id+' div').remove();

                            obj.register_pagination();
                            obj.register_delete_buttons();
                        }
                    }, true);
                }
            };

    this.request = function(args, noloading) {
                var params = {};
                var obj = this;
                if (args['obj']) {
                    obj = args['obj'];
                }
                //params['page'] = args.page?args.page:'';
                // the form element only accept certain file types
                params['sesskey']   = '<?php echo $USER->sesskey; ?>';
                params['action']    = args.action?args.action:'';
                params['client_id'] = this.client_id;
                params['itemid']    = this.itemid;
                params['area']      = this.commentarea;
                params['courseid']  = this.courseid;
                params['contextid'] = this.contextid;
                params['component'] = this.component;
                params['commentsperpage'] = this.commentsperpage;
                if (args.form) {
                    params['form'] = args.form.serialize();
                }
                if (args['params']) {
                    for (i in args['params']) {
                        params[i] = args['params'][i];
                    }
                }
                $.ajax({
                    url: this.api,
                    type: 'POST',
                    beforeSend: args.beforeSend ? args.beforeSend : '',
                    success: function(o) {
                        if (!o) {
                            alert('IO FATAL');
                            return false;
                        }
                        var data = YAHOO.lang.JSON.parse(o);
                        if (data.error) {
                            if (data.error == 'require_login') {
                                args.callback(this.client_id, data, args);
                                return true;
                            }
                            alert(data.error);
                            return false;
                        } else {
                            args.callback(this.client_id, data, args);
                            return true;
                        }
                    },
                    //context: scope,
                    data: build_querystring(params)
                });

                if (!noloading) {
                    this.wait();
                }
            };

    this.render = function(list, newcmt) {
                var ret = {};
                ret.ids = [];
                var template = $('#cmt-tmpl');
                var html = '';
                for(var i in list) {
                    var htmlid = 'comment-'+list[i].id+'-'+this.client_id;
                    var val = template.html();
                    if (list[i].profileurl) {
                        val = val.replace('___name___', '<a href="'+list[i].profileurl+'">'+list[i].fullname+'</a>');
                    } else {
                        val = val.replace('___name___', list[i].fullname);
                    }
                    if (list[i]['delete']||newcmt) {
                        list[i].content = '<div class="comment-delete"><a href="#" id ="comment-delete-'+this.client_id+'-'+list[i].id+'" title="<?php echo get_string('deletecomment', 'local_comment'); ?>"><img src="<?php echo $CFG->pixpath; ?>/t/comment-delete.gif" /></a></div>' + list[i].content;
                    }
                    val = val.replace('___time___', list[i].time);
                    val = val.replace('___picture___', list[i].avatar);
                    val = val.replace('___content___', list[i].content);
                    if (list[i].userid == <?php echo $USER->id; ?>) {
                        var commentclass = 'comment-own-post';
                    } else {
                        var commentclass = 'comment-others-post';
                    }
                    val = '<li id="'+htmlid+'" class="'+commentclass+'">'+val+'</li>';
                    ret.ids.push(htmlid);
                    html = (html+val);
                }
                ret.html = html;
                return ret;
            };

    this.load = function(page) {
                var obj = this;
                var container = $('#comment-ctrl-'+this.client_id);
                var params = {
                    'action': 'get',
                    'page': page
                };
                this.request({
                    scope: obj,
                    params: params,
                    callback: function(id, ret, args) {
                        var linktext = $('#comment-link-text-'+obj.client_id);
                        if (ret.count && linktext) {
                            linktext.html('<?php echo get_string('comments', 'local_comment'); ?> ('+ret.count+')');
                        }
                        var container = $('#comment-list-'+obj.client_id);
                        var pagination = $('#comment-pagination-'+obj.client_id);
                        if (ret.pagination) {
                            pagination.html(ret.pagination);
                        } else {
                            //empty paging bar
                            pagination.html('');
                        }
                        if (ret.error == 'require_login') {
                            var result = {};
                            result.html = '<?php echo get_string('commentsrequirelogin', 'local_comment'); ?>';
                        } else {
                            var result = obj.render(ret.list);
                        }
                        container.hide();
                        container.html(result.html);
                        //container.slideDown(500);
                        container.fadeIn(500);

                        var img = $('#comment-img-'+obj.client_id);
                        if (img) {
                            img.attr('src', '<?php echo $CFG->pixpath; ?>/t/expanded.png');
                        }
                        args.scope.register_pagination();
                        args.scope.register_delete_buttons();
                    }
                });
            };

    this.dodelete = function(id) { // note: delete is a reserved word in javascript, chrome and safary do not like it at all here!
                var obj = this;
                var params = {'commentid': id};
                obj.cancel_delete();
                function remove_dom(type, anim, cmt) {
                    cmt.remove();
                }
                this.request({
                    action: 'delete',
                    scope: obj,
                    params: params,
                    callback: function(id, resp, args) {
                        // Update comment count
                        var linktext = $('#comment-link-text-'+resp.client_id);
                        if (linktext) {
                            linktext.html('<?php echo get_string('comments', 'local_comment'); ?> ('+resp.count+')');
                        }

                        // Remove element
                        var htmlid= 'comment-'+resp.commentid+'-'+resp.client_id;
                        var attributes = {
                            width:{to:0},
                            height:{to:0}
                        };
                        var cmt = $('#'+htmlid);
                        cmt.fadeOut(500, function() {
                            cmt.remove();
                        });
                    }
                }, true);
            };

    this.register_actions = function() {
                // add new comment
                var obj = this;
                var action_btn = $('#comment-action-post-'+this.client_id);
                if (action_btn) {
                    action_btn.unbind('click');
                    action_btn.click(function(e) {
                        e.preventDefault();
                        obj.post();
                        return false;
                    });
                }
                // cancel comment box
                var cancel = $('#comment-action-cancel-'+this.client_id);
                if (cancel) {
                    cancel.click(function(e) {
                        cancel.unbind('click');
                        e.preventDefault();
                        obj.view(0);
                        return false;
                    });
                }
            };

    this.register_delete_buttons = function() {
                var obj = this;
                // page buttons
                $('div.comment-delete a').each(
                    function() {
                        var node = $(this);
                        var theid = node.attr('id');
                        var parseid = new RegExp("comment-delete-"+obj.client_id+"-(\\d+)", "i");
                        var commentid = theid.match(parseid);
                        if (!commentid) {
                            return;
                        }
                        if (commentid[1]) {
                            $('#'+theid).unbind('click');
                        }
                        $(node).click(function(e) {
                            e.preventDefault();
                            jQuery.event.fix(e);    // necessary for lame ie6
                            obj.confirmoverlay.cfg.setProperty('xy',[$(this).offset().left-$('.comment-delete-confirm').width()-8, e.pageY-$('.comment-delete-confirm').height()+8]);
                            obj.confirmoverlay.show();
                            $('#canceldelete-'+obj.client_id).click(function(e) {
								e.preventDefault();
                                obj.cancel_delete();
                                });
                            $('#confirmdelete-'+obj.client_id).unbind('click');
                            $('#confirmdelete-'+obj.client_id).click(function(e) {
									e.preventDefault();
                                    if (commentid[1]) {
                                        obj.dodelete(commentid[1]);
                                    }
                                });
                        });
                    }
                );
            };

    this.cancel_delete = function() {
                //this.confirmoverlay.attr('visible', false);
                this.confirmoverlay.hide();
            };

    this.register_pagination = function() {
                var obj = this;
                // page buttons
                $('#comment-pagination-'+obj.client_id+' a').each(
                    function() {
                        node = $(this);
                        node.unbind('click');
                        node.click(function(e) {
                            e.preventDefault();
                            var id = $(this).attr('id');
                            var re = new RegExp("comment-page-"+obj.client_id+"-(\\d+)", "i");
                            var result = id.match(re);
                            obj.load(result[1]);
                        });
                    }
                );
            };

    this.view = function(page) {
                var obj = this;
                var container = $('#comment-ctrl-'+obj.client_id);
                var ta = $('#dlg-content-'+obj.client_id);
                var img = $('#comment-img-'+obj.client_id);

                if (!$(container).is(':visible')) {
                    // show
                    if (!obj.autostart) {
                        obj.load(page);
                    } else {
                        obj.register_delete_buttons();
                        obj.register_pagination();
                    }
                    container.show();
                    if (img) {
                        img.attr('src', '<?php echo $CFG->pixpath; ?>/t/expanded.png');
                    }
                } else {
                    // hide
                    //container.slideUp(500);
                    container.fadeOut(300);
                    img.attr('src', '<?php echo $CFG->pixpath; ?>/t/collapsed.png');
                    if (ta) {
                        // clear the textarea
                        ta.attr('value', '<?php echo get_string('addcomment', 'local_comment'); ?>');
                        ta.css('color','gray');
                    }
                    $('#comment-link-'+obj.client_id).scrollTop();
                }
                if (ta) {
                    //toggle_textarea.apply(ta, [false]);
                    //// reset textarea size
                    ta.unbind('click');
                    ta.click(function() {
                        obj.toggle_textarea(true);
                    });
                    ta.blur(function() {
                        obj.toggle_textarea(false);
                    });
                }
                obj.register_actions();
                return false;
            };

    this.toggle_textarea = function(focus) {
                var t = $('#dlg-content-'+this.client_id);
                if (focus) {
                    if (t.attr('value') == '<?php echo get_string('addcomment', 'local_comment'); ?>') {
                        t.attr('value', '');
                        t.css('color', 'black');
                    }
                }else{
                    if (t.attr('value') == '') {
                        t.attr('value', '<?php echo get_string('addcomment', 'local_comment'); ?>');
                        t.css('color','gray');
                        t.attr('rows', 2);
                    }
                }
            };

    this.wait = function() {
                var container = $('#comment-list-'+this.client_id);
                container.html('<div class="mdl-align"><img src="<?php echo $CFG->pixpath.'/i/loading_small.gif'; ?>" /></div>');
            };
};  // "class"

 totara_core_comment.prototype.init_admin = function(Y) {
     //TODO
        var obj = this;
        var select_all = $('#comment_select_all');
        select_all.click(function(e) {
            var comments = document.getElementsByName('comments');
            var checked = false;
            for (var i in comments) {
                if (comments[i].checked) {
                    checked=true;
                }
            }
            for (i in comments) {
                comments[i].checked = !checked;
            }
            this.attr('checked', !checked);
        });

        var comments_delete = $('#comments_delete');
        if (comments_delete) {
            comments_delete.click(function(e) {
                e.preventDefault();
                var list = '';
                var comments = document.getElementsByName('comments');
                for (var i in comments) {
                    if (typeof comments[i] == 'object' && comments[i].checked) {
                        list += (comments[i].value + '-');
                    }
                }
                if (!list) {
                    return;
                }
                var args = {};
                args.message = M.str.admin.confirmdeletecomments;
                args.callback = function() {
                    var url = M.cfg.wwwroot + '/comment/index.php';

                    var data = {
                        'commentids': list,
                        'sesskey': '<?php echo $USER->sesskey; ?>',
                        'action': 'delete'
                    };
                    var cfg = {
                        method: 'POST',
                        on: {
                            complete: function(id,o,p) {
                                if (!o) {
                                    alert('IO FATAL');
                                    return;
                                }
                                if (o.responseText == 'yes') {
                                    location.reload();
                                }
                            }
                        },
                        arguments: {
                            scope: obj
                        },
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                            'User-Agent': 'MoodleComment/3.0'
                        },
                        data: build_querystring(data)
                    };
                    Y.io(url, cfg);
                };
                M.util.show_confirm_dialog(e, args);
            });
        }
    };

function build_querystring(obj) {
    return convert_object_to_string(obj, '&');
}

function convert_object_to_string(obj, separator) {
    if (typeof obj !== 'object') {
        return null;
    }
    var list = [];
    for(var k in obj) {
        k = encodeURIComponent(k);
        var value = obj[k];
        if(obj[k] instanceof Array) {
            for(var i in value) {
                list.push(k+'[]='+encodeURIComponent(value[i]));
            }
        } else {
            list.push(k+'='+encodeURIComponent(value));
        }
    }
    return list.join(separator);
}

