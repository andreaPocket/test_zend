CREATE TABLE partners (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(50) NOT NULL,
	address TEXT NULL,
	email VARCHAR(32) NOT NULL DEFAULT 'noemail@test.com',
	mobile VARCHAR(15) NOT NULL DEFAULT '+00/000000000',
	account_manager VARCHAR(50) NULL,
	partner_type VARCHAR(25) NULL,
	details TEXT NULL
);

CREATE TABLE partner_types (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(25) NOT NULL
);


CREATE TABLE users (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(25) NOT NULL,
	password TEXT NOT NULL,
	user_type VARCHAR(10) NOT NULL
);
 

