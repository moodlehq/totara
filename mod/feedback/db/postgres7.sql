CREATE TABLE prefix_feedback (
	id SERIAL,
	course integer NOT NULL default 0,
	name varchar(255) NOT NULL default '',
	summary text NOT NULL,
	anonymous smallint NOT NULL default 1,
	email_notification smallint NOT NULL default 1,
	multiple_submit smallint NOT NULL default 0,
   page_after_submit text NOT NULL,
	publish_stats smallint NOT NULL default 0,
	timeopen integer NOT NULL default 0,
	timeclose integer NOT NULL default 0,
	timemodified integer NOT NULL default 0,
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_course_idx ON prefix_feedback (course);

CREATE TABLE prefix_feedback_template (
	id SERIAL,
	course integer NOT NULL default 0,
	public smallint NOT NULL default 0,
	name varchar(255) NOT NULL default '',
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_template_course_idx ON prefix_feedback_template (course);

CREATE TABLE prefix_feedback_item (
	id SERIAL,
	feedback integer NOT NULL default 0,
	template integer NOT NULL default 0,
	name varchar(255) NOT NULL default '',
	presentation text NOT NULL,
	typ varchar(255) NOT NULL default 0,
	hasvalue smallint NOT NULL default 0,
	position integer NOT NULL default 0,
	required smallint NOT NULL default 0,
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_item_feedback_idx ON prefix_feedback_item (feedback);
CREATE INDEX prefix_feedback_item_template_idx ON prefix_feedback_item (template);

CREATE TABLE prefix_feedback_completed (
	id SERIAL,
	feedback integer NOT NULL default 0,
	userid integer NOT NULL default 0,
	timemodified integer NOT NULL default 0,
   random_response integer NOT NULL default 0,
   anonymous_response smallint NOT NULL default 1,
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_completed_userid_idx ON prefix_feedback_completed (userid);
CREATE INDEX prefix_feedback_completed_feedback_idx ON prefix_feedback_completed (feedback);

CREATE TABLE prefix_feedback_completedtmp (
	id SERIAL,
	feedback integer NOT NULL default 0,
	userid integer NOT NULL default 0,
	guestid varchar(255) NOT NULL default '',
	timemodified integer NOT NULL default 0,
   random_response integer NOT NULL default 0,
   anonymous_response smallint NOT NULL default 1,
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_completedtmp_userid_idx ON prefix_feedback_completedtmp (userid);
CREATE INDEX prefix_feedback_completedtmp_feedback_idx ON prefix_feedback_completedtmp (feedback);

CREATE TABLE prefix_feedback_value (
	id SERIAL,
        course_id integer NOT NULL default 0,
	item integer NOT NULL default 0,
	completed integer NOT NULL default 0,
	tmp_completed integer NOT NULL default 0,
	value text NOT NULL,
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_value_completed_idx ON prefix_feedback_value (completed);
CREATE INDEX prefix_feedback_value_item_idx ON prefix_feedback_value (item);

CREATE TABLE prefix_feedback_valuetmp (
	id SERIAL,
        course_id integer NOT NULL default 0,
	item integer NOT NULL default 0,
	completed integer NOT NULL default 0,
	tmp_completed integer NOT NULL default 0,
	value text NOT NULL,
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_valuetmp_completed_idx ON prefix_feedback_valuetmp (completed);
CREATE INDEX prefix_feedback_valuetmp_item_idx ON prefix_feedback_valuetmp (item);

CREATE TABLE prefix_feedback_tracking (
	id SERIAL,
	userid integer NOT NULL default 0,
	feedback integer NOT NULL default 0,
	completed integer NOT NULL default 0,
	tmp_completed integer NOT NULL default 0,
	count smallint NOT NULL default 0,
	PRIMARY KEY (id)
);
CREATE INDEX prefix_feedback_tracking_completed_idx ON prefix_feedback_tracking (completed);
CREATE INDEX prefix_feedback_tracking_userid_idx ON prefix_feedback_tracking (userid);
CREATE INDEX prefix_feedback_tracking_feedback_idx ON prefix_feedback_tracking (feedback);

CREATE TABLE prefix_feedback_sitecourse_map (
    id SERIAL PRIMARY KEY,
    feedbackid integer NOT NULL default 0,
    courseid integer NOT NULL default 0
);

CREATE UNIQUE INDEX prefix_feedback_sitecourse_map_feedbackcourseid_idx ON prefix_feedback_sitecourse_map (feedbackid, courseid);
