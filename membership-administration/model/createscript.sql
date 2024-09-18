-- Creating tables

CREATE TABLE IF NOT EXISTS member_type (
    member_type_id INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (member_type_id)
);

CREATE TABLE IF NOT EXISTS family (
    family_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    surname VARCHAR(50) NOT NULL,
    streetname VARCHAR(50) NOT NULL,
    house_number VARCHAR(50) NOT NULL,
    zip_code VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (family_id)
);

CREATE TABLE IF NOT EXISTS family_member_type (
    family_member_type_id INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (family_member_type_id)
);

CREATE TABLE IF NOT EXISTS family_member (
    family_member_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    member_type_id INT,
    family_member_type_id INT,
    family_id INT, -- Relation with the table family
    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (family_member_id),
    FOREIGN KEY (family_id) REFERENCES family(family_id),
    FOREIGN KEY (member_type_id) REFERENCES member_type(member_type_id),
    FOREIGN KEY (family_member_type_id) REFERENCES family_member_type(family_member_type_id)
);



CREATE TABLE IF NOT EXISTS financial_year (
    financial_year_id INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (financial_year_id)
);

CREATE TABLE IF NOT EXISTS contribution (
    contribution_id INT NOT NULL AUTO_INCREMENT,
    age_min VARCHAR(50) NOT NULL,
    age_max VARCHAR(50) NOT NULL,
    member_type_id INT NOT NULL, -- Relation with the table member_type
    amount INT NOT NULL,
    discount double NOT NULL,
    financial_year_id INT NOT NULL, -- Relation with the table financial_year
    PRIMARY KEY (contribution_id),
    FOREIGN KEY (member_type_id) REFERENCES member_type(member_type_id),
    FOREIGN KEY (financial_year_id) REFERENCES financial_year(financial_year_id)
);

CREATE TABLE IF NOT EXISTS user (
    user_id int NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM ('admin', 'secretary', 'treasurer') NOT NULL,
    PRIMARY KEY (user_id)
);

