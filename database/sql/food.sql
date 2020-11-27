create table customer(
	c_id		varchar(5) ,
	c_name		varchar(10) not null,
	account	varchar (10) not null,
	password 	varchar (10) not null,
	email     varchar(35),
	primary key(c_id)
) ENGINE=INNODB;

create table manager(
	m_id		varchar(5) ,
	m_name		varchar(10) not null,
	account	varchar (10) not null,
	password 	varchar (10) not null,
	email     varchar(35),
	primary key(m_id)
) ENGINE=INNODB;

create table shop(
	s_id		varchar(5),
	m_id		varchar(5) not null,
	s_name		varchar(10) not null,
	style		varchar(10),
	phone		varchar(10),
	photo		varchar(50),
	website		varchar(50),
	address		varchar(30),
	aveprice	numeric(4,0) default 0,
	avestar     numeric(1,0) default 0,
	primary key(s_id),
	foreign key (m_id) references manager(m_id)
		on delete cascade
) ENGINE=INNODB;

create table discount(
	d_id		varchar(5),
	content		varchar(30) not null,
	primary key(d_id)
) ENGINE=INNODB;

create table provide(
	s_id		varchar(5),
	d_id		varchar(5),
	t_id        date,
	primary key(s_id,d_id),
	foreign key (s_id) references shop(s_id)
		on delete cascade,
	foreign key (d_id) references discount(d_id)
		on delete cascade
) ENGINE=INNODB;

create table favorate(
	c_id		varchar(5),
	s_id		varchar(5),
	primary key(c_id,s_id),
	foreign key (c_id) references customer(c_id)
		on delete cascade,
	foreign key (s_id) references shop(s_id)
		on delete cascade
) ENGINE=INNODB;

create table comment(
	c_id		varchar(5),
	s_id		varchar(5),
	star      	numeric(5,0) not null,
	content   	varchar(30),
	primary key(c_id,s_id),
	foreign key (c_id) references customer(c_id)
		on delete cascade,
	foreign key (s_id) references shop(s_id)
		on delete cascade
) ENGINE=INNODB;

create table time(
	s_id 		varchar(5),
	day 		varchar(10),
	op_hr 		numeric(2) check (op_hr >= 0 and op_hr < 24),
	op_min 		numeric(2) check (op_min >= 0 and op_min < 60),
	cl_hr 		numeric(2) check (cl_hr >= 0 and cl_hr < 24),
	cl_min 		numeric(2) check (cl_min >= 0 and cl_min < 60),
	primary key(s_id,day,op_hr,op_min,cl_hr,cl_min),
	foreign key (s_id) references shop(s_id)
		on delete cascade
) ENGINE=INNODB;

create table menu(
	s_id 		varchar(5),
	d_name		varchar(10),
	price     	numeric(4,0),
	primary key(s_id,d_name),
	foreign key (s_id) references shop(s_id)
		on delete cascade
) ENGINE=INNODB;