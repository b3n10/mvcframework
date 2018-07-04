DROP DATABASE IF EXISTS mvcframework;

CREATE DATABASE mvcframework;

USE mvcframework;

CREATE TABLE posts (
	id						int(11)				NOT NULL	AUTO_INCREMENT,
	title					varchar(128)	NOT NULL,
	content				text					NOT NULL,
	created_at		timestamp			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY 	(id),
	KEY						created_at		(created_at)
)	ENGINE=InnoDB	DEFAULT	CHARSET=utf8;

INSERT INTO posts (title, content) VALUES
('First post', 'This is my first post'),
('Second post', 'This is my second post'),
('Third post', 'This is my third post');
