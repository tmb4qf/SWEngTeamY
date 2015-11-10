/*
	Create table statement with corresponding drop table statements
*/
DROP TABLE IF EXISTS address CASCADE;
CREATE TABLE address(
	addrID int AUTO_INCREMENT PRIMARY KEY,
	street varchar(50), 
	city varchar(25),
	state varchar(2),
	country varchar(3), 
	zipcode varchar(5)
);

DROP TABLE IF EXISTS person CASCADE;
CREATE TABLE person(
	id varchar(8) PRIMARY KEY,
	addrID int,
	fname varchar(20),
	lname varchar(25),
	pawprint varchar(6),
	phone_number varchar(10),
	title varchar(20),
	FOREIGN KEY(addrID) REFERENCES address(addrID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS authentication CASCADE;
CREATE TABLE authentication (
	id varchar(9) PRIMARY KEY,
	password_hash CHAR(40) NOT NULL,
	salt CHAR(40) NOT NULL,
	FOREIGN KEY (id) REFERENCES person(id)
);

DROP TABLE IF EXISTS organization CASCADE;
CREATE TABLE organization(
	orgID int AUTO_INCREMENT PRIMARY KEY,
	name varchar (75)
);

DROP TABLE IF EXISTS applicant CASCADE;
CREATE TABLE applicant(
	id varchar(9) PRIMARY KEY,
	organizationID int,
	FOREIGN KEY(id) REFERENCES person(id) ON DELETE CASCADE,
	FOREIGN KEY(organizationID) references organization(orgID) ON DELETE CASCADE,
	isStudentWorker boolean
);

DROP TABLE IF EXISTS applicationProcessor CASCADE;
CREATE TABLE applicationProcessor(
	id varchar(9) PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person(id) ON DELETE CASCADE,
	jobTitle varchar(15)
);

DROP TABLE IF EXISTS ferpaScores CASCADE;
CREATE TABLE ferpaScores(
	id varchar(9) PRIMARY KEY,
	FOREIGN KEY(id) REFERENCES person(id) ON DELETE CASCADE,
	score varchar(2)
);

DROP TABLE IF EXISTS careerTypes CASCADE;
CREATE TABLE careerTypes(
	typeID int AUTO_INCREMENT PRIMARY KEY, 
	department varchar(7)
);

DROP TABLE IF EXISTS applicationTypes CASCADE;
CREATE TABLE applicationTypes(
	typeID int AUTO_INCREMENT PRIMARY KEY,
	type varchar(10)
);

DROP TABLE IF EXISTS application CASCADE;
CREATE TABLE application(
	appID int AUTO_INCREMENT PRIMARY KEY,
	id varchar(9), 
	app_type int,
	FOREIGN KEY(id) REFERENCES person(id) ON DELETE CASCADE,
	FOREIGN KEY(app_type) REFERENCES applicationTypes(typeID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS requestedCareerTypes CASCADE;
CREATE TABLE requestedCareerTypes(
	appID int, 
	id varchar(9),
	typeID int,
	FOREIGN KEY(appID) REFERENCES application(appID) ON DELETE CASCADE,
	FOREIGN KEY(id) REFERENCES person(id) ON DELETE CASCADE,
	FOREIGN KEY(typeID) REFERENCES careerTypes(typeID) ON DELETE CASCADE,
	PRIMARY KEY(appID, id, typeID)
);

DROP TABLE IF EXISTS admissionsTestTypes CASCADE;
CREATE TABLE admissionsTestTypes(
	typeID int AUTO_INCREMENT PRIMARY KEY, 
	name varchar(7)
);

DROP TABLE IF EXISTS admissionsTest CASCADE;
CREATE TABLE admissionsTest(
	admTestID int AUTO_INCREMENT PRIMARY KEY,
	applicationID int,
	admTypeID int,
	FOREIGN KEY(applicationID) REFERENCES application(appID) ON DELETE CASCADE,
	FOREIGN KEY(admTypeID) REFERENCES admissionsTestTypes(typeID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS roleType CASCADE;
CREATE TABLE roleType(
	typeID int AUTO_INCREMENT PRIMARY KEY, 
	name varchar(30)
);

DROP TABLE IF EXISTS roles CASCADE;
CREATE TABLE roles(
	roleID int AUTO_INCREMENT PRIMARY KEY,
	roleType int,
	roleName varchar(45),
	FOREIGN KEY(roleType) REFERENCES roleType(typeID) ON DELETE CASCADE,
	roleDesc varchar(300),
	isViewable boolean, 
	isUpdateable boolean
);

DROP TABLE IF EXISTS roleAccessRequest CASCADE;
CREATE TABLE roleAccessRequest(
	roleAccessID int AUTO_INCREMENT PRIMARY KEY,
	appID int,
	roleID int,
	FOREIGN KEY(appID) REFERENCES application(appID) ON DELETE CASCADE,
	FOREIGN KEY(roleID) REFERENCES roles(roleID) ON DELETE CASCADE,
	isViewRequest boolean, 
	isUpdateRequest boolean
);


/*
	Insert statements for seed data for the following tables
*/
INSERT INTO careerTypes(department) VALUES('UGRD');
INSERT INTO careerTypes(department) VALUES('GRAD');
INSERT INTO careerTypes(department) VALUES('MED');
INSERT INTO careerTypes(department) VALUES('VET MED');
INSERT INTO careerTypes(department) VALUES('LAW');

INSERT INTO roleType(name) VALUES('Student Records Access');
INSERT INTO roleType(name) VALUES('Student Financials Access');
INSERT INTO roleType(name) VALUES('Student Financial Aid Access');
INSERT INTO roleType(name) VALUES('Reserved Access');

INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Basic Inquiry','Access to basic bio demo and 
	student data: names, address, FERPA directory data, 
	photos, term info, degree information, programs, honors 
	and awards, service indicators (holds) and previous schools.',true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Advanced Inquiry',
	'Includes Basic Inquiry access. Additionally includes relations with institution, 
	citizenship, visa, decedant data, student enrollment, gpa, term history, 3Cs,
	advisors, student groups', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, '3Cs', 'Checklists, Comments, Communications', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Advisor Update', 'Adding an advisor to a students record', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Department SOC Update', 'Scheduling courses, assigning faculty 
	to course, generating permission numbers', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Service Indicators (Holds)', 'Administrative users with proper 
	security can assign or remove service indicators from a students record',true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Student Group View', 'View groups a student is associated with',true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'View Study List', 'View a students class schedule', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Registrar Enrollment', 'Adding and dropping a course utilizing 
	Enrollment Request Advisor Student', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Advisor Student Center', 'Access to students study list, advisor, 
	program/plan, demographic data, e-mail address', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Class Permission', 'Creating general or student specific class permission numbers', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Class Permission View', 'View class permission numbers which have been created for a course', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Class Roster', 'View students enrolled, dropped or withdrawn in a course', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Block Enrollments', 'Adding and dropping a course utilizing Enrollment Request', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Report Manager', 'Assists in running various reports', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Self Service Advisor', 'View Advisee photo, addresses, service indicators, 
	emergency contacts, telephone numbers, grades, class schedule, enrollment appointment, print academic advising profile', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Fiscal Officer', 'View enrollment summary, term statistics, and UM term statistics', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES(1, 'Academic Advising Profile', 'Allows printing of the Academic Advising Profile', false, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (2, 'SF General Inquiry', 'For staff outside of the Cashiers Office', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (2, 'SF Cash Group Post', 'Also known as "Cost Centers" (for areas that want to apply charges)', true, true);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (3, 'FA Cash', 'View a students financial aid awards and budget', true, false);
INSERT INTO roles(roleType, roleName, roleDesc, isViewable, isUpdateable) VALUES (3, 'FA Non Financial Aid Staff', 'Also known as "Cost Centers" (for areas that want to apply charges)', true, false);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Immunization view', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Transfer Credit Admission', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Relationships', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Student Groups', false, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Accommodate (Student Health)', false, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Support Staff (Registrars Office)', true, true);
INSERT INTO roles(roleType, roleName, isViewable, isUpdateable) VALUES(4, 'Advance Standing Report', true, true);	

INSERT INTO admissionsTestTypes(name) VALUES('ACT'),('SAT'),('GRE'),('GMAT'),('TOFEL'),('IELTS'),('LSAT'),('MCAT'),('AP'),('CLEP'),('GED'),('MILLERS'),('PRAX'),('PLA_MU'),('BASE');

INSERT INTO applicationTypes(type) VALUES('new'),('additional');

INSERT INTO organization(name) VALUES('Academic Support Center'),('Accessibility and ADA Education'),('Accountancy'),('Accounting Services'),('Adaptive Computing Technology Center'),('Administrative Services'),('Admissions - GRAD'),('Admissions - UGRAD'),('Advancement'),('Adventure Club'),('Advertising'),('Aerospace Engineering'),('Agricultural Economics'),('Agricultural Education'),('Agricultural Journalism'),('Agricultural Systems Management'),
	('Agronomy'),('Anesthesiology and Perioperative Medicine'),('Animal Sciences'),('Anthropology'),('Applied Social Sciences'),('Architectural Studies'),('Art'),('Art History and Archaeology'),('Assessment and Consultation Clinic'),('Athletics'),('Biochemistry'),('Biological Engineering'),('Biological Sciences'),('Biomedical Sciences'),('Black Studies'),
	('Business Information Center, MU'),('Business Services'),('Campus Dining Services'),('Campus Facilities'),('Cashiers'),('Chancellors Diversity Initiative'),('Chemical Engineering'),('Chemistry'),('Child Development Lab'),('Child Health'),('Civil and Environmental Engineering'),('Classical Studies'),('Communication'),('Communication Science and Disorders'),('Computer Science'),
	('Conference Office'),('Convergence Journalism'),('Counseling Center'),('Culinary Cafe'),('Dermatology'),('Disability Services'),('Diversity Initiative, Chancellors'),('Division of IT'),('Economic Development'),('Economics'),('Educational, School and Counseling Psychology'),('Educational Leadership and Policy Analysis'),('Educational Technologies'),('Electrical and Computer Engineering'),
	('English'),('Entomology'),('Environmental Health and Safety'),('Equity Office'),('Family and Community Medicine'),('Film Studies'),('Finance'),('Financial Aid'),('Fisheries and Wildlife'),('Food Science'),('Food Systems and Bioengineering Division'),('Forestry'),('French'),('General Stores'),
	('Geography'),('Geological Sciences'),('German and Russian Studies'),('Health Management and Informatics'),('Health Psychology'),('Health Sciences'),('History'),('Honors College'),('Horticulture'),('Hotel and Restaurant Management'),('Human Development and Family Studies'),('Human Resource Services'),('Industrial and Manufacturing Systems Engineering'),('Information Sciences and Learning Technologies'),
	('Institutional Research'),('Internal Medicine'),('Italian'),('Journalism Studies'),('KBIA'),('KOMU'),('Korean'),('Law'),('Learning, Teaching and Curriculum'),('Libraries, MU'),('Licensing and Trademarks'),('Linguistics'),('Magazine Journalism'),('Mail Services'),
	('Management'),('Mandarin'),('Marketing'),('Mathematics'),('Mechanical and Aerospace Engineering'),('Medical Pharmacology and Physiology'),('Military Science and Leadership'),('Missouri Unions'),('Mizzou Advantage'),('Mizzou Online'),('Mizzou Store'),('Molecular Microbiology and Immunology'),('Music'),('Natural Resources'),
	('Naval Science'),('Neurology'),('News Bureau'),('Nursing'),('Nutrition and Exercise Physiology'),('Obstetrics and Gynecology'),('Occupational Therapy'),('Ophthalmology'),('Orthopaedic Surgery'),('Otolaryngology - Head Neck'),('Parent Relations, Office of'),('Parking and Transportation Services'),('Parks, Recreation, and Tourism'),('Pathology and Anatomical Sciences'),
	('Peace Studies'),('Personal Financial Planning'),('Philosophy'),('Photojournalism'),('Physical Medicine and Rehabilitation'),('Physical Therapy'),('Physics and Astronomy'),('Plant Microbiology and Pathology'),('Plant Sciences, Division of'),('Police Department, MU'),('Political Science'),('Portuguese'),('Printing Services and Digiprint Centers'),('Procurement Services'),
	('Psychiatry'),('Psychological Sciences'),('Public Affairs'),('Publicatons and Alumni Communication'),('Public Health'),('Radiology'),('Radio-TV Journalism'),('Religious Studies'),('Research, Office of'),('Romance Languages and Literature'),('Rural Sociology'),('Russian Studies'),('Social Work'),('Sociology'),
	('Soil, Environmental and Atmospheric Sciences'),('Spanish'),('Special Education'),('Sponsored Program Administration'),('State Historical Society'),('Statistics'),('Student Affairs'),('Student Health'),('Surgery'),('Textile and Apparel Management'),('Theatre'),('Tiger Garden'),('Tiger Team Store'),('University Affairs'),
	('University Catering'),('University Concert Series'),('University Events'),('University of Missouri Press'),('University Registrar'),('Veterinary Medicine and Surgery'),('Veterinary Pathobiology'),('Visitor Relations'),('Web Communications'),('Womens and Gender Studies');