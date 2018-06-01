CREATE TABLE pendingapproval (
	pa_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
	pa_name varchar(256) not null,
    pa_gender varchar(20) not null,
    pa_dob date not null,
    pa_email varchar(256) not null,
    pa_highestdegree varchar(256) not null,
    pa_yearofpassing varchar(256) not null,
    pa_course varchar(256) not null,
    pa_contact int(10) not null,
    pa_password varchar(256) not null
);

