UPDATE `persons` SET `name`='حسام حسن' 		WHERE id = 1;
UPDATE `persons` SET `name`='إبراهيم حسن' 	WHERE id = 2;
UPDATE `persons` SET `name`='محمود الخطيب' 	WHERE id = 3;
UPDATE `persons` SET `name`='أبو تريكه' 	WHERE id = 4;
UPDATE `persons` SET `name`='مصطفى عبده' 	WHERE id = 5;
UPDATE `persons` SET `name`='محمد صلاح' 		WHERE id = 6;
UPDATE `persons` SET `name`='أحمد الكاس' 	WHERE id = 7;
UPDATE `persons` SET `name`='عادل هيكل' 	WHERE id = 8;
UPDATE `persons` SET `name`='إيمان البحر' 	WHERE id = 9;
UPDATE `persons` SET `name`='سمية الخشاب' 	WHERE id = 10;
UPDATE `persons` SET `name`='طه حسين' 	    WHERE id = 11;
UPDATE `persons` SET `name`='أنيس عبيد' 	WHERE id = 12;
UPDATE `persons` SET `name`='عباس العقاد' 	WHERE id = 13;
UPDATE `persons` SET `name`='أحمد شوقى' 	WHERE id = 14;
UPDATE `persons` SET `name`='كاظم الساهر' 	WHERE id = 15;

-- Create Al Sarh Company
INSERT INTO `companies`(`name`, `director`, `state_id`, `city_id`, `address`, `cash`) VALUES
                       ('الصرح','محمد عشرى', 23, 210,'المزلقان الكبير',0);
INSERT INTO income_types (name) values ('تحصيل'),('مساهمين');
INSERT INTO payment_types (name) values ('نقدى'), ('بنك'), ('شركات');
