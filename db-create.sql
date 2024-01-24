DROP DATABASE lunarenergy;

CREATE DATABASE lunarenergy;

USE lunarenergy;

CREATE TABLE users_cred (
    user_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(64) NOT NULL,
    pass VARCHAR(256) NOT NULL,
    active CHAR(32),
    registration_date DATE NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (user_id)
);

CREATE TABLE users_personal (
    fk_user_id SMALLINT UNSIGNED NOT NULL,
    first_name VARCHAR(32) NOT NULL,
    last_name VARCHAR(32) NOT NULL,
    dob DATE NOT NULL,
    PRIMARY KEY (fk_user_id),
    FOREIGN KEY (fk_user_id) REFERENCES users_cred(user_id)
);

CREATE TABLE users_points (
    fk_user_id SMALLINT UNSIGNED NOT NULL,
    points MEDIUMINT UNSIGNED DEFAULT 0,
    PRIMARY KEY (fk_user_id, points),
    FOREIGN KEY (fk_user_id) REFERENCES users_cred(user_id)
);

CREATE TABLE reviews (
    fk_user_id SMALLINT UNSIGNED NOT NULL,
    star_rating TINYINT NOT NULL,
    body VARCHAR(500),
    post_date DATE NOT NULL,
    PRIMARY KEY (fk_user_id),
    FOREIGN KEY (fk_user_id) REFERENCES users_cred(user_id)
);

CREATE TABLE service_types (
    type_id TINYINT UNSIGNED NOT NULL,
    type_desc VARCHAR(40) NOT NULL,
    PRIMARY KEY (type_id)
);

CREATE TABLE service_descriptions (
    desc_id TINYINT NOT NULL,
    service_desc VARCHAR(300) NOT NULL,
    PRIMARY KEY (desc_id)
);

CREATE TABLE services (
    service_id TINYINT UNSIGNED NOT NULL,
    fk_type_id TINYINT UNSIGNED NOT NULL,
    name VARCHAR(50) NOT NULL,
    fk_desc_id TINYINT NOT NULL,
    price TINYINT UNSIGNED NOT NULL,
    price_pts SMALLINT UNSIGNED,
    earned_pts TINYINT UNSIGNED,
    length TINYINT UNSIGNED,
    PRIMARY KEY (service_id),
    FOREIGN KEY (fk_type_id) REFERENCES service_types(type_id),
    FOREIGN KEY (fk_desc_id) REFERENCES service_descriptions(desc_id)
);

CREATE TABLE dates (
    date_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    PRIMARY KEY (date_id)
);

CREATE TABLE times (
    time_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    time TIME NOT NULL,
    PRIMARY KEY (time_id)
);

CREATE TABLE availability (
    date_id INT UNSIGNED NOT NULL,
    time_id TINYINT UNSIGNED NOT NULL,
    available BOOLEAN NOT NULL,
    FOREIGN KEY (date_id) REFERENCES dates(date_id)
        ON DELETE CASCADE,
    FOREIGN KEY (time_id) REFERENCES times(time_id),
    PRIMARY KEY (date_id, time_id)
);

CREATE TABLE appointments (
    appt_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    fk_user_id SMALLINT UNSIGNED NOT NULL,
    fk_service_id TINYINT UNSIGNED NOT NULL,
    fk_appt_date_id INT UNSIGNED NOT NULL,
    fk_appt_time_id TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (appt_id),
    FOREIGN KEY (fk_user_id) REFERENCES users_personal(fk_user_id),
    FOREIGN KEY (fk_service_id) REFERENCES services(service_id),
    FOREIGN KEY (fk_appt_date_id) REFERENCES dates(date_id),
    FOREIGN KEY (fk_appt_time_id) REFERENCES times(time_id)
);

CREATE TABLE last_book (
    fk_user_id SMALLINT UNSIGNED NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    FOREIGN KEY (fk_user_id) REFERENCES users_personal(fk_user_id),
    PRIMARY KEY (fk_user_id, time)
);