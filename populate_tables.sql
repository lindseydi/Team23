insert into applicant values (001, 'password', 'James', 'Smith', 'smith@gmail.com', 19, 'main street', 'Bethlehem', 'PA', 14584, 5053012453, 'Application complete and under review', 'no status');
insert into applicant values (002, 'password123', 'Sarah', 'Jones', 'jones1@gmail.com', 443, 'sycamore avenue', 'New York', 'NY', 17489, 6107206489, 'Application Incomplete- No transcript, GRE scores', 'no status');


insert into application values (001, 'James', 'Smith', '1', 'fall 2013', 'Bachelors', 'Drexel University', '3.5', '2012', 'null', 'null', 'null', 'null', '600', '610', '620', '400', '300', 'Worked in the Drexel University hospital.', 'null', 'null', 'meyers@gmail.com', 'David Meyers', NOW());
insert into application values (002, 'Sarah', 'Jones', '0', 'Fall 2013', 'Bachelors', 'New York University', '3.6', '2012', 'null', 'null', 'null', 'null', 'nul', 'nll', 'nll', 'nll', 'nll', 'Worked in the admissions office as a student assistant.', 'null', 'null','simon@gmail.com', 'Simon Reynolds', NOW()); 


insert into CAC values ('Todd Clark', '500001', 'clark@gwu.edu', 'gocolonials');

insert into GS values ('Mary O\'Brian', '900009', 'obrian@gwu.edu', 'george2');

insert into fcommittee values ('Kevin Varitek', '800010', 'varitek@gwu.edu', 'baseball34');
insert into fcommittee values ('Diane Smith', '8000012', 'smith2100@gwu.edu', 'sciencerules');

insert into recommender values ('meyers@gmail.com', 'meyers123');
insert into recommender values ('simon@gmail.com', 'simon456');

insert into recommends values ('Doctor', 'Undergrad Advisor', 'David Meyers', 'meyers@gmail.com', 'To whom it may concern');
insert into recommends values ('Doctor', 'Undergrad Advisor', 'Simon Reynolds', 'simon@gmail.com', 'To whom it may concern');

insert into review values (001, 'smith@gmail.com', 5, 'Generic', 'admit with aid', 3, 'Meets all requirements');
insert into review values (002, 'jones1@gmail.com', 4, 'Generic', 'borderline admit', 2, 'Incomplete record- waiting for GRE scores.');

insert into processes values ('001', '1', '4', '4');
insert into processes values ('002', '1', '2', '2');f