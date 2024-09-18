-- Table financial_year
INSERT INTO financial_year(financial_year_id, description)
VALUES (1, 2023);
INSERT INTO financial_year(financial_year_id, description)
VALUES (2, 2024);

-- Table family
INSERT INTO family(family_id, surname, streetname, house_number, zip_code, city, country)
VALUES (1, 'Henk', 'Kerklaan', '23', '2291CE', 'Wateringen', 'Nederland');


-- Table member_type
INSERT INTO member_type(member_type_id, description)
VALUES (1, 'family member');

-- Table family_member_type
INSERT INTO family_member_type(family_member_type_id, description)
VALUES (1, 'Daughter');
INSERT INTO family_member_type(family_member_type_id, description)
VALUES (2, 'Son');
INSERT INTO family_member_type(family_member_type_id, description)
VALUES (3, 'Father');
INSERT INTO family_member_type(family_member_type_id, description)
VALUES (4, 'Mother');
INSERT INTO family_member_type(family_member_type_id, description)
VALUES (5, 'Grandfather');
INSERT INTO family_member_type(family_member_type_id, description)
VALUES (6, 'Grandmother');
INSERT INTO family_member_type(family_member_type_id, description)
VALUES (7, 'Other');

-- Table family_member
INSERT INTO family_member (family_member_id, first_name, birthday, member_type_id, family_member_type_id, family_id) VALUES (NULL, 'Veronika', '1980-04-03', 1, 1, 1);
INSERT INTO family_member (family_member_id, first_name, birthday, member_type_id, family_member_type_id, family_id) VALUES (NULL, 'Kevin', '1990-05-20', 1, 2, 1);
INSERT INTO family_member (family_member_id, first_name, birthday, member_type_id, family_member_type_id, family_id) VALUES (NULL, 'Marc', '1960-10-10', 1, 3, 1);


-- Table contribution
INSERT INTO contribution (contribution_id, age_min, age_max, member_type_id, amount, discount, financial_year_id) VALUES (NULL, '0', '8', 1, 100, 0.50, 2);
INSERT INTO contribution (contribution_id, age_min, age_max, member_type_id, amount, discount, financial_year_id) VALUES (NULL, '8', '12', 1, 100, 0.40, 2);
INSERT INTO contribution (contribution_id, age_min, age_max, member_type_id, amount, discount, financial_year_id) VALUES (NULL, '13', '17', 1, 100, 0.25, 2);
INSERT INTO contribution (contribution_id, age_min, age_max, member_type_id, amount, discount, financial_year_id) VALUES (NULL, '18', '50', 1, 100, 0.25, 2);
INSERT INTO contribution (contribution_id, age_min, age_max, member_type_id, amount, discount, financial_year_id) VALUES (NULL, '51', '120', 1, 100, 0.45, 2);


-- Users
INSERT IGNORE INTO user (user_id, username, password, role) VALUES (NULL, 'admin', '$2y$10$J173n.ElT92puL3UJvhihuqk6eJNFDbzjcV3qZ6kQb9W.gSOtW9ta', 'admin');
INSERT IGNORE INTO user (user_id, username, password, role) VALUES (NULL, 'john', '$2y$10$qqdokczZf6yX.igj9pMeCe4LMrGCKs78N58nSmvfdMbo1lZPbq0i.', 'secretary');
INSERT IGNORE INTO user (user_id, username, password, role) VALUES (NULL, 'anne', '$2y$10$YDrZmU5DC4w15BlwY99J8.Dbw9pxVlcwDgpjKvKlxvTXwsrxMVelW', 'treasurer');

