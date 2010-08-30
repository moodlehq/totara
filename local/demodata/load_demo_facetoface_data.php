<?php
@raise_memory_limit('392M');
@ini_set('max_execution_time','3000');
print "Loading data for table 'facetoface'<br>";
$items = array(array('id' => '1','course' => '2','name' => 'Stakeholder Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '2','course' => '3','name' => 'Business Law','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '3','course' => '4','name' => 'Budgeting','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '4','course' => '5','name' => 'Business Skills for New Managers','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '5','course' => '6','name' => 'Coaching and Mentoring','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','shortname' => '','description' => '','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '6','course' => '7','name' => 'Time Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '7','course' => '8','name' => 'Business Writing Skills','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '8','course' => '9','name' => 'Rapid Reading for business','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '9','course' => '10','name' => 'Change Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '10','course' => '11','name' => 'Organisational Behaviour','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '11','course' => '12','name' => 'Facilitation','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '12','course' => '13','name' => 'Hospitality','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '13','course' => '14','name' => 'Supply Chain Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '14','course' => '15','name' => 'Advanced Strategic Planning','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '15','course' => '16','name' => 'Leading Strategically','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '16','course' => '17','name' => 'Emotional Intelligence','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '18','course' => '19','name' => 'Advanced Accounting','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '19','course' => '20','name' => 'Key Account Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '20','course' => '21','name' => 'Risk Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '21','course' => '22','name' => 'Knowing My Computer (Refresher)','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','shortname' => '','description' => '','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '22','course' => '23','name' => 'Reducing Working Capital','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '23','course' => '24','name' => 'Human Centered Design','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '24','course' => '25','name' => 'Law of Business Entities','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '25','course' => '26','name' => 'Forecasting, Budgeting and Strategic Planning','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '26','course' => '27','name' => 'Knowledge Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '27','course' => '28','name' => 'Company Valuations','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '28','course' => '29','name' => 'Public Relations','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '29','course' => '30','name' => 'Better Communications','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '30','course' => '31','name' => 'New Product Development','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '31','course' => '32','name' => 'Contract Tendering','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '32','course' => '33','name' => 'Conflict Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '33','course' => '34','name' => 'Managing Information Technology Projects','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '34','course' => '35','name' => 'Systematic Problem Solving','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '35','course' => '36','name' => 'Sales and Marketing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '36','course' => '37','name' => 'Business Strategy','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '37','course' => '38','name' => 'Communication Theory and Concepts','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '38','course' => '39','name' => 'Buyer Behaviour','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422886','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '39','course' => '40','name' => 'Marketing Planning','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '40','course' => '41','name' => 'Assertiveness Skills','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '41','course' => '42','name' => 'Effective Meetings','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '42','course' => '43','name' => 'Managing Resources','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '43','course' => '44','name' => 'Event Planning','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '44','course' => '45','name' => 'Web Conferencing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '45','course' => '46','name' => 'Advanced Business Process Improvement','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '46','course' => '47','name' => 'Introduction to Banking and Financial Services','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '47','course' => '48','name' => 'Mind Mapping','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '48','course' => '49','name' => 'Research Methods','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '49','course' => '50','name' => 'Digital Marketing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '50','course' => '51','name' => 'Quality Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '51','course' => '52','name' => 'Finance for Managers','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '52','course' => '53','name' => 'Business Modelling','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '53','course' => '54','name' => 'Outsourcing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '54','course' => '55','name' => 'Professional Communication','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '55','course' => '56','name' => 'Program Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '57','course' => '58','name' => 'Systems Thinking','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '58','course' => '59','name' => 'Achieving Success','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '59','course' => '60','name' => 'Motivation and Leadership','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '60','course' => '61','name' => 'Intranet Content Editors Training','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '61','course' => '62','name' => 'Empowering Individuals and Teams','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '62','course' => '63','name' => 'Portfolio and programme management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '63','course' => '64','name' => 'Business Case Development','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '64','course' => '65','name' => 'Advertising Practice','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '65','course' => '66','name' => 'Developing Strengths into Talents','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '66','course' => '67','name' => 'Advanced Selling Skills','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '67','course' => '68','name' => 'Netiquette','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '68','course' => '69','name' => 'Pricing Strategies and Tactics','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '69','course' => '70','name' => 'Value Stream Mapping','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '70','course' => '71','name' => 'Finance for the Public Sector','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '71','course' => '72','name' => 'Myers-Briggs for Personal Development','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '72','course' => '73','name' => 'Service Level Agreements','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '73','course' => '74','name' => 'Generating Sustainable Revenue Streams','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '74','course' => '75','name' => 'Data Analysis','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '75','course' => '76','name' => 'Critical Thinking','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '76','course' => '77','name' => 'Touch Typing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '77','course' => '78','name' => 'Media Training','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '78','course' => '79','name' => 'Economics','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '79','course' => '80','name' => 'Inventory Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '80','course' => '81','name' => 'International Marketing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '81','course' => '82','name' => 'Technical Writing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '82','course' => '83','name' => 'Team Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '83','course' => '84','name' => 'Writing Contracts','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '84','course' => '85','name' => 'Business Analysis','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '85','course' => '86','name' => 'Advanced Project Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '86','course' => '87','name' => 'Principles of Managerial Finance','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '87','course' => '88','name' => 'Business Administration','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '88','course' => '89','name' => 'Finance','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '89','course' => '90','name' => 'Tax Law','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '90','course' => '91','name' => 'International business','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '91','course' => '92','name' => 'Basic Accounting','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '92','course' => '93','name' => 'Creativity and Innovation','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '93','course' => '94','name' => 'Negotiating Contracts','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '94','course' => '95','name' => 'Human Resources','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '95','course' => '96','name' => 'Building Rapport and Trust','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '96','course' => '97','name' => 'Strategic Marketing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '97','course' => '98','name' => 'Obtaining Feedback','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '98','course' => '99','name' => 'Event Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '99','course' => '100','name' => 'Writing Reports','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '100','course' => '101','name' => 'Design Led Thinking','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '101','course' => '102','name' => 'Customer Attraction','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '102','course' => '103','name' => 'Procurement Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '103','course' => '104','name' => 'Basic Project Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '104','course' => '105','name' => 'The Business Environment','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '105','course' => '106','name' => 'Delegation','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '106','course' => '107','name' => 'Business Computing','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '107','course' => '108','name' => 'Operations Management','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '108','course' => '109','name' => 'Sales Skills','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '109','course' => '110','name' => 'Pay and Performance','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '110','course' => '111','name' => 'Creating a successful sales proposal','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationinstrmngr' => '','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.','cancellationsubject' => 'Course booking cancellation','cancellationinstrmngr' => '','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','reminderinstrmngr' => '','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [location]
Venue:   [venue]
Room:   [room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]','reminderperiod' => '1','timecreated' => '1263422844','timemodified' => '0','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => '','requestinstrmngr' => '','requestmessage' => '',),
array('id' => '158','course' => '217','name' => 'Presentation Skills','thirdparty' => '','thirdpartywaitlist' => '0','display' => '3','confirmationsubject' => 'Course booking confirmation: [facetofacename], [starttime]-[finishtime], [sessiondate]','confirmationmessage' => 'This is to confirm that you are now booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:    [duration]
Date(s):
[alldates]

Location:   [session:location]
Venue:   [session:venue]
Room:   [session:room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]

You will receive a reminder [reminderperiod] business days before this course.
','waitlistedsubject' => 'Waitlisting advice for [facetofacename]','waitlistedmessage' => 'This is to advise that you been added to the waitlist for:

Course:   [facetofacename]
Location:  [session:location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***

By waitlisting you have registered your interest in this course and will be contacted directly when sessions become available.

To remove yourself from this waitlist please return to this course and click Cancel Booking. Please note there is no waitlist removal confirmation email.
','cancellationsubject' => 'Course booking cancellation','cancellationmessage' => 'This is to advise that your booking on the following course has been cancelled:

***BOOKING CANCELLED***

Participant:   [firstname] [lastname]
Course:   [facetofacename]

Duration:   [duration]
Date(s):
[alldates]

Location:   [session:location]
Venue:   [session:venue]
Room:   [session:room]
','remindersubject' => 'Course booking reminder: [facetofacename], [starttime]-[finishtime], [sessiondate]','remindermessage' => 'This is a reminder that you are booked on the following course:

Participant:   [firstname] [lastname]
Course:   [facetofacename]
Cost:   [cost]

Duration:   [duration]
Date(s):
[alldates]

Location:   [session:location]
Venue:   [session:venue]
Room:   [session:room]

***Please arrive ten minutes before the course starts***

To re-schedule or cancel your booking
To re-schedule your booking you need to cancel this booking and then re-book a new session.  To cancel your booking, return to the site, then to the page for this course, and then select \\\'cancel\\\' from the booking information screen.

[details]
','reminderperiod' => '2','timecreated' => '0','timemodified' => '1267735576','shortname' => '','description' => '','showoncalendar' => '1','approvalreqd' => '0','requestsubject' => 'Course booking request for [facetofacename]','requestinstrmngr' => '*** Action required ****

Your staff member [firstname] [lastname] has requested a booking to attend the above course and has also received this email.

To confirm or decline their request, visit the following link:
[attendeeslink]

If you are not their Team Leader / Manager and believe you have received this email by mistake please reply to this email.

*** [firstname] [lastname]\\\'s email is copied below ****
','requestmessage' => 'This is to advise that your manager has been sent your request to be booked to:

Course:   [facetofacename]
Location:  [session:location]
Participant:   [firstname] [lastname]

***Please note this is not a course booking confirmation***
',),
);
print "\n";print "Inserting ".count($items)." records<br />\n";
$i=1;
foreach($items as $item) {
    if(get_field('facetoface', 'id', 'id', $item['id'])) {
        print "Record with id of {$item['id']} already exists!<br>\n";
        continue;
    }
    $newid = insert_record('facetoface',(object) $item);
    if($newid != $item['id']) {
        if(!set_field('facetoface', 'id', $item['id'], 'id', $newid)) {
            print "Could not change id from $newid to {$item['id']}<br>\n";
            continue;
        }
    }
    // record the highest id in the table
    $maxid = get_field_sql('SELECT '.sql_max('id').' FROM '.$CFG->prefix.'facetoface');
    // make sure sequence is higher than highest ID
    bump_sequence('facetoface', $CFG->prefix, $maxid);
    // print output
    // 1 dot per 10 inserts
    if($i%10==0) {
        print ".";
        flush();
    }
    // new line every 200 dots
    if($i%2000==0) {
        print $i." <br>";
    }
    $i++;
}
print "<br>";

set_config("guestloginbutton", 0);
set_config("langmenu", 0);
set_config("forcelogin", 1);
        