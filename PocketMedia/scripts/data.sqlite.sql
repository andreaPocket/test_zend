
INSERT INTO partners (name, address, email, mobile, account_manager, partner_type, details) VALUES
    ('Peter Simonds', 'St. Main Street 1, London 1054SW', 'peter.simonds@test.com', '+41/123456789', 'Jim Watson', 'advertiser', '');
INSERT INTO partners (name, address, email, mobile, account_manager, partner_type, details) VALUES
    ('Jirka Svatý', 'Ant. Jiráska 2, Praha 5, 10012', 'jirka.svaty@test.com', '+42/123456789', 'Petr Nesvatba', 'advertiser', 'November promotion' );
INSERT INTO partners (name, address, email, mobile, account_manager, partner_type, details) VALUES
    ('Ana Malá', 'St. Main Street 1, London 1054SW', 'ana.mala@test.com', '+41/987654321', 'Lubomír Zahradil', 'publisher', '');
INSERT INTO partners (name, address, email, mobile, account_manager, partner_type, details) VALUES
    ('Sebastian Flores', 'C/Mendez Alvaro 1, Madrid 28002', 'seb.flores@test.com', '+34/987654321', 'Luis Perez', 'advertiser', 'Special prices');
	
INSERT INTO partner_types (name) VALUES('advertiser');
INSERT INTO partner_types (name) VALUES('publisher');

INSERT INTO users (name, password, user_type) VALUES('admin', '$2a$10$MgOVkSxgLj9pyfY.8px7ueoeK888ovn11qcqMWvAWedtriwgU0zUm', 'admin');
INSERT INTO users (name, password, user_type) VALUES('user', '$2a$10$B1IFURvSDEnyIBR5H50NM.FT0cAsAUhuXPZraDGlh9JeRGdMqebkC', 'user');