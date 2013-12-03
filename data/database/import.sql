-- import users

insert INTO ctv.user (username, email, display_name, password, state)
values ('Administrator', 'admin@ctv2.loc', 'Administrator', '$2y$14$9hELYpQYzBvRB3WJdrQYxex4NXYnMgwhWfFGOilcEwp9eYlg69iBq', 1);

insert into fachhochschule (user_id, name)
values (currval('user_user_id_seq'), 'Administrator');

-- import displays

insert into bildschirm (beschreibung)
values ('Hörsaal');

insert into bildschirm (beschreibung)
values ('Mensa');

insert into bildschirm (beschreibung)
values ('Büro');

insert into bildschirm (beschreibung)
values ('F-Gebäude');

-- import user roles

insert into user_role (role_id, is_default)
values('guest', 1);

insert into user_role (role_id, is_default, parent)
values(user, 0, 'guest');

insert into user_role (role_id, is_default, parent)
values('admin', 0, 'user');

insert into user_role_linker 
values(1, 'admin');
