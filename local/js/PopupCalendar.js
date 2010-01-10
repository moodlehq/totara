/** PopupCalendar class;
 *  @usage:
 *
 *      var cal = new PopupCalendar('date_entry_field_id');
 *  Focus and blur will show/hide the calendar, and selection of a date will
 *  hide it and set the field to the selected date.
 *
 *  @author Luke Hudson
 */
function PopupCalendar(fieldid) {
    this.containerid    = 'popupcalendar_' + fieldid + '_container';
    this.fieldid        = fieldid;
    this.container      = document.createElement('div');
    this.container.id   = this.containerid;
    this.container.className = 'popupcalendar';
    this.container.style.display = "none";
    this.field          = getobject(fieldid);

    var parentNode = document.getElementsByTagName('body')[0];
    parentNode.appendChild(this.container);

    this.mouseisover    = false;
    this.init();
};

PopupCalendar.prototype.init = function() {
    var me = this;
    this.calendar   = new YAHOO.widget.Calendar(this.containerid);
    this.calendar.cfg.setProperty("MDY_DAY_POSITION", 1);
    this.calendar.cfg.setProperty("MDY_MONTH_POSITION", 2);
    this.calendar.cfg.setProperty("MDY_YEAR_POSITION", 3);
    this.calendar.cfg.setProperty("START_WEEKDAY", 1);
    this.calendar.render();
    this.calendar.selectEvent.subscribe(
        function(type,args) {
            me.onSelectDate(type,args);
        }
    );
    this.calendar.renderEvent.subscribe(
        function(e) {
            YAHOO.util.Event.addListener(me.containerid, "mouseout",  function(e)
                { me.mouseisover = false;});
            YAHOO.util.Event.addListener(me.containerid, "mouseover", function(e)
                { me.mouseisover = true;});
        }
    );
    YAHOO.util.Event.addListener(this.fieldid, "focus",
        function(e) { me.showCal(e);});
    YAHOO.util.Event.addListener(this.fieldid, "blur",  function(e)
        { me.hideCal(e);});
}

PopupCalendar.prototype.onSelectDate = function(type, args) {
    this.mouseisover = true;
    var date    = args[0][0];
    var day     = date[2];
    var mon     = date[1];
    var year    = date[0];
    this.field.value = sprintdatef(day,mon,year);
    this.mouseisover = false;
    this.hideCal();
};

PopupCalendar.prototype.showCal = function(e) {
    var xy = YAHOO.util.Dom.getXY(this.field);
    xy[1] += 20;
    var fvalue = this.field.value;
    if (fvalue) {
        var fdate = fvalue.split(/[\s\/\|:-]+/);
        var d,m,y;
        d = fdate[0];
        m = fdate[1];
        y = fdate[2];
        if (y <= 31 && d >=31) { var t=y; y=d; d=t; }   // swap day and year if necessary
        var pagedate = m + '/' + y;
        this.calendar.cfg.setProperty('pagedate', pagedate);
        this.calendar.cfg.setProperty('selected', d + '/' + m + '/' + y);
        this.calendar.render();
    }
    this.container.style.display = 'block';
    YAHOO.util.Dom.setXY(this.container, xy);
}

PopupCalendar.prototype.hideCal = function(e) {
    if (!this.mouseisover) {
        this.container.style.display = 'none';
    }
}
