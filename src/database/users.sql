CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL DEFAULT '',
    first_name VARCHAR(255) DEFAULT '',
    last_name VARCHAR(255) DEFAULT '',
    role_id TINYINT DEFAULT 1,
    birthday DATETIME,
    PRIMARY KEY (user_id)
)  ENGINE=INNODB;