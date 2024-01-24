INSERT INTO users_cred (email, pass, active, registration_date, is_admin)
VALUES ("admin@lunarenergy.com", SHA2('password', 512), NULL, NOW(), 1);

INSERT INTO users_cred (email, pass, active, registration_date, is_admin)
VALUES ("jdoe@gmail.com", SHA2('password', 512), NULL, NOW(), 0);

INSERT INTO users_cred (email, pass, active, registration_date, is_admin)
VALUES ("jsmith@gmail.com", SHA2('password', 512), NULL, NOW(), 0);

INSERT INTO users_cred (email, pass, active, registration_date, is_admin)
VALUES ("heisenburg@gmail.com", SHA2('password', 512), NULL, NOW(), 0);

INSERT INTO users_personal (fk_user_id, first_name, last_name, dob) 
VALUES (1, "Web", "Admin", '1979-04-05');

INSERT INTO users_personal (fk_user_id, first_name, last_name, dob) 
VALUES (2, "Jane", "Doe", '1984-11-06');

INSERT INTO users_personal (fk_user_id, first_name, last_name, dob) 
VALUES (3, "John", "Smith", '1978-02-09');

INSERT INTO users_personal (fk_user_id, first_name, last_name, dob)
VALUES (4, "Walter", "White", '1958-09-07');

INSERT INTO users_points (fk_user_id, points)
VALUES (1, 0);

INSERT INTO users_points (fk_user_id, points) 
VALUES (2, 10);

INSERT INTO users_points (fk_user_id, points) 
VALUES (3, 175);

INSERT INTO users_points (fk_user_id, points) 
VALUES (4, 30);

INSERT INTO reviews (fk_user_id, star_rating, body, post_date)
VALUES (2, 4, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu imperdiet elit. Nulla sodales sem a enim congue sagittis. Sed consequat massa nibh, nec elementum mauris posuere eget.", '2023-12-13');

INSERT INTO reviews (fk_user_id, star_rating, body, post_date)
VALUES (3, 5, "", '2023-12-15');

INSERT INTO reviews (fk_user_id, star_rating, body, post_date)
VALUES (4, 2, "Im not in danger Skylar. I am the danger.", '2024-01-04');

INSERT INTO service_types (type_id, type_desc)
VALUES (1, "Massage");

INSERT INTO service_types (type_id, type_desc)
VALUES (2, "Skin Treatment");

INSERT INTO service_types (type_id, type_desc)
VALUES (3, "Service Bundle");

INSERT INTO service_descriptions (desc_id, service_desc)
VALUES (1, "Uses massage oils to facilitate smooth, gliding strokes over the entire body for the purpose of relaxation.");

INSERT INTO service_descriptions (desc_id, service_desc)
VALUES (2, "Acupressure and massage to the ears, hands and feet.");

INSERT INTO service_descriptions (desc_id, service_desc)
VALUES (3, "Therapy specifically tailored for the expectant mother's needs. It is also called pre-natal massage.");

INSERT INTO service_descriptions (desc_id, service_desc)
VALUES (4, "Massage with deeper pressure using techniques such as trigger point.");

INSERT INTO service_descriptions (desc_id, service_desc)
VALUES (5, "Exfoliation of the entire body using a salt or sugar scrub and dry brushing. Short shower afterwards to rinse off product. Leaves your skin feeling soft, smooth, and glowing!");

INSERT INTO service_descriptions (desc_id, service_desc)
VALUES (6, "Full body exfoliation with salt/sugar scrub and dry brushing. After exfoliating, a quick rinse off and a relaxing massage which will hydrate the skin and leave you feeling amazing!");

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (1, 1, "Swedish Massage", 1, 30, 350, 5, 30);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (2, 1, "Swedish Massage", 1, 60, 450, 10, 60);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (3, 1, "Swedish Massage", 1, 90, 550, 15, 90);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (4, 1, "Reflexology Massage", 2, 30, NULL, 5, 25);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (5, 1, "Pregnancy Massage", 3, 60, NULL, 10, 60);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (6, 1, "Pregnancy Massage", 3, 90, NULL, 15, 90);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (7, 1, "Deep Tissue Massage", 4, 70, 550, 15, 60);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (8, 1, "Deep Tissue Massage", 4, 100, 650, 20, 90);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (9, 2, "Full Body Scrub", 5, 60, NULL, 10, NULL);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (10, 3, "Body Scrub with 60 Minute Massage", 6, 110, NULL, 20, 60);

INSERT INTO services (service_id, fk_type_id, name, fk_desc_id, price, price_pts, earned_pts, length)
VALUES (11, 3, "Body Scrub with 90 Minute Massage", 6, 140, NULL, 25, 90);

INSERT INTO times (time)
VALUE ('09:00:00');

INSERT INTO times (time)
VALUE ('09:15:00');

INSERT INTO times (time)
VALUE ('09:30:00');

INSERT INTO times (time)
VALUE ('09:45:00');

INSERT INTO times (time)
VALUE ('10:00:00');

INSERT INTO times (time)
VALUE ('10:15:00');

INSERT INTO times (time)
VALUE ('10:30:00');

INSERT INTO times (time)
VALUE ('10:45:00');

INSERT INTO times (time)
VALUE ('11:00:00');

INSERT INTO times (time)
VALUE ('11:15:00');

INSERT INTO times (time)
VALUE ('11:30:00');

INSERT INTO times (time)
VALUE ('11:45:00');

INSERT INTO times (time)
VALUE ('12:00:00');

INSERT INTO times (time)
VALUE ('12:15:00');

INSERT INTO times (time)
VALUE ('12:30:00');

INSERT INTO times (time)
VALUE ('12:45:00');

INSERT INTO times (time)
VALUE ('13:00:00');

INSERT INTO times (time)
VALUE ('13:15:00');

INSERT INTO times (time)
VALUE ('13:30:00');

INSERT INTO times (time)
VALUE ('13:45:00');

INSERT INTO times (time)
VALUE ('14:00:00');

INSERT INTO times (time)
VALUE ('14:15:00');

INSERT INTO times (time)
VALUE ('14:30:00');

INSERT INTO times (time)
VALUE ('14:45:00');

INSERT INTO times (time)
VALUE ('15:00:00');

INSERT INTO times (time)
VALUE ('15:15:00');

INSERT INTO times (time)
VALUE ('15:30:00');

INSERT INTO times (time)
VALUE ('15:45:00');

INSERT INTO times (time)
VALUE ('16:00:00');

INSERT INTO times (time)
VALUE ('16:15:00');

---------------------------------------------------------
-- ONLY RUN BELOW COMMANDS AFTER DATES HAVE BEEN ADDED --
---------- VIA populate_database() IN book.php ----------
---------------------------------------------------------

INSERT INTO last_book (fk_user_id, date, time)
VALUES (1, '2024-01-17', '09:05:54');

INSERT INTO last_book (fk_user_id, date, time) 
VALUES (2, '2024-01-18', '07:35:20');

INSERT INTO last_book (fk_user_id, date, time) 
VALUES (3, '2024-01-13', '06:47:43');

INSERT INTO last_book (fk_user_id, date, time) 
VALUES (4, '2023-12-14', '10:30:22');