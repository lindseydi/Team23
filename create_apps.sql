drop table if exists applicant cascade;
create table applicant (
  studentNO 		varchar(8) not null,
  password			varchar(20) not null,
  fname				varchar(20) not null,
  lname				varchar(30) not null,
  email				varchar(20) not null,
  addr1			varchar(50) not null,
  addr2			varchar(50),
  city				varchar(20) not null,
  state				varchar(3) not null,
  zip				varchar(9) not null,
  phoneNO			varchar(12) not null,
  app_status		varchar(20) not null,
  student_status    varchar(20) not null,
  primary key (studentNO));


drop table if exists application cascade;
create table application(
  studentNO			varchar(8) not null,
  fname				varchar(20) not null,
  lname				varchar(30) not null,
  transcript_recv	varchar(2) not null,
  starting_sem		varchar(10),
  prior_degree		varchar(10),
  pr_school			varchar(80) ,      
  pr_GPA			varchar(4),
  pr_year			varchar(4),
  prior_degree2		varchar(10),
  pr_school2		varchar(80), 
  pr_GPA2			varchar(4),
  pr_year2			varchar(4),
  GRE_analytical	varchar(3),
  GRE_quant			varchar(3),
  GRE_verbal		varchar(3),
  GRE_subj1			varchar(3),
  GRE_subj2			varchar(3),
  prior_work1		varchar(200),
  prior_work2		varchar(200),
  interest			varchar(20),
  rec_email			varchar(40),
  rec_full_name      varchar(50),
  date_submitted    DATETIME,
  letter_recv varchar(2) not null,
  program   varchar(60),
  primary key (studentNO),
  foreign key (studentNO, fname, lname) references applicant);

drop table if exists CAC cascade;
create table CAC(

  name			varchar(100) not null,
  aid       varchar(6), not null,
  email			varchar(40) not null,
  password		varchar(40) not null,
  primary key (aid));

drop table if exists fcommittee cascade;
create table fcommittee(
  name			varchar(100) not null,
  fcid      varchar(6) not null,
  email			varchar(40) not null,
  password		varchar(20) not null,
  primary key (fcid));

drop table if exists recommender cascade;
create table recommender(
  rec_email		varchar(40) not null,
  password		varchar(20) not null,
  primary key (rec_email),
  foreign key (rec_email) references application);

drop table if exists recommends cascade;
create table recommends(
  title				varchar(30) not null,
  affiliation		varchar(20) not null,
  rec_full_name			varchar (50) not null,
  rec_email			varchar(40) not null,
  rec_letter		TEXT not null,
  primary key (rec_email),
  foreign key (rec_email, rec_full_name) references application);

drop table if exists review cascade;
create table review(
  studentNO			varchar(8) not null,
  email				varchar(40) not null,
  letter_rank		varchar(10) not null,
  letter_cred		varchar(15) not null,
  advisor_rec		varchar(20) not null,
  rank 				varchar(2) not null,
  comments			varchar(255) not null,
  reason_reject varchar(100),
  primary key (studentNO, email),
  foreign key (email) references fcommittee,
  foreign key (studentNO) references application);

drop table if exists processes cascade;
create table processes(
  studentNO			varchar(8) not null,
  student_status	varchar(2) DEFAULT '0',
  average_rank		varchar(2),
  ranking_final		varchar(2),
  primary key (studentNO),
  foreign key (studentNO) references applicant);

ALTER TABLE applicant
ADD FOREIGN KEY(student_status)
REFERENCES processes(student_status);