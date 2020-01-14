#**********************************************************
# user
#**********************************************************
CREATE TABLE user (
	user_id INT NOT NULL AUTO_INCREMENT
	,name VARCHAR (100) NOT NULL DEFAULT ''
	,password VARCHAR (100) NOT NULL DEFAULT ''
	,address VARCHAR (200) NOT NULL DEFAULT ''
	,user_text1 VARCHAR (500) NOT NULL DEFAULT ''
	,user_text2 VARCHAR (500) NOT NULL DEFAULT ''
	,user_flag1 TINYINT NOT NULL DEFAULT 0
	,user_flag2 TINYINT NOT NULL DEFAULT 0
	,delete_flag TINYINT NOT NULL DEFAULT 0
	,created_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,updated_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_user PRIMARY KEY (user_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# room
#**********************************************************
CREATE TABLE room (
	room_id INT NOT NULL AUTO_INCREMENT
	,category_id INT NOT NULL DEFAULT 0
	,user_id INT NOT NULL DEFAULT 0
	,title VARCHAR (200) NOT NULL DEFAULT ''
	,body VARCHAR (1000) NOT NULL DEFAULT ''
	,room_text1 VARCHAR (500) NOT NULL DEFAULT ''
	,room_text2 VARCHAR (500) NOT NULL DEFAULT ''
	,room_flag1 TINYINT NOT NULL DEFAULT 0
	,room_flag2 TINYINT NOT NULL DEFAULT 0
	,delete_flag TINYINT NOT NULL DEFAULT 0
	,created_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,updated_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_room PRIMARY KEY (room_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# category
#**********************************************************
CREATE TABLE category (
	category_id INT NOT NULL AUTO_INCREMENT
	,category_name VARCHAR (100) NOT NULL DEFAULT ''
	,room_count INT NOT NULL DEFAULT 0
	,delete_flag TINYINT NOT NULL DEFAULT 0
	,created_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,updated_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_category PRIMARY KEY (category_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#**********************************************************
# comment
#**********************************************************
CREATE TABLE comment (
	comment_id INT NOT NULL AUTO_INCREMENT
	,room_id INT NOT NULL
	,user_id INT NOT NULL
	,comment_body VARCHAR (1000) NOT NULL DEFAULT ''
	,destination_id TINYINT DEFAULT 0
	,comment_text1 VARCHAR (500) NOT NULL DEFAULT ''
	,comment_text2 VARCHAR (500) NOT NULL DEFAULT ''
	,comment_flag1 TINYINT NOT NULL DEFAULT 0
	,comment_flag2 TINYINT NOT NULL DEFAULT 0
	,delete_flag TINYINT NOT NULL DEFAULT 0
	,created_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,updated_date DATETIME NOT NULL DEFAULT '1900/1/1'
	,CONSTRAINT PK_commnet PRIMARY KEY (comment_id)
 ) ROW_FORMAT=DYNAMIC ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

