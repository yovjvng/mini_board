-- 데이터베이스 생성
CREATE DATABASE board;

USE board;

CREATE TABLE board_info (
	board_no INT PRIMARY KEY AUTO_INCREMENT
	,board_title VARCHAR(100) NOT NULL 
	,board_contents VARCHAR(1000) NOT NULL
	,board_write_date DATETIME NOT NULL
	,board_del_flg CHAR(1) NOT NULL DEFAULT ('0')
	,board_del_date DATETIME 
);

DESC board_info;


-- 테이블 생성

INSERT INTO board_info(
	board_no
	,board_title 
	,board_contents
	,board_write_date
	,board_del_flg
	,board_del_date
)
VALUES (
	1
	,'제목1'
	,'내용1'
	,NOW()
)







