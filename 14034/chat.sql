
#
# Table structure for table 'users'
#
DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255),
	email VARCHAR(255),
	active VARCHAR(1) DEFAULT 'n',
	sent_on TIMESTAMP,
	UNIQUE(username)
);

#
# Table structure for table 'msg'
#
DROP TABLE IF EXISTS msg;
CREATE TABLE msg(
	id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255),
	msg VARCHAR(255),
	color VARCHAR(1),
	sent_on TIMESTAMP
);
