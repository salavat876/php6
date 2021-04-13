create table users(
                      id serial primary key,
                      name varchar(255),
                      email varchar(255),
                      age int,
                      work_id int
);

create table works(
                      id serial primary key ,
                      work_name varchar(255),
                      status bool
);

create table timings(
                        id serial primary key,
                        code varchar(255),
                        track int,
                        user_id int,
                        work_id int
);

select * from users;