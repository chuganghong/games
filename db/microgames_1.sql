#存储937.com小游戏的数据库 2013年7月2日3点29分
create database microgames default character set utf8 collate utf8_general_ci;

use microgames;

create table topic #游戏分类表
(
	topicId int not null auto_increment primary key,
	name char(30) not null,    #游戏分类名
	url char(100) not null     #游戏栏目首页URL，存储采集所需要的数据
);

create table tag   #游戏标签表
(
	tagId int not null auto_increment primary key,
	name char(30) not null #标签名
);

create table game   #游戏
(
	gameId int not null auto_increment primary key,
	name char(60) not null,#游戏名
	introduction MEDIUMTEXT not null,#游戏简介、游戏目标、如何开始
	gameKey char(240) not null,#操作指南
	popularity int not null default 0, #受欢迎度
	commentId int not null, #评论ID
	webUrl char(100) not null,#包含该游戏的web页面URL
	url char(100) not null,  #swf文件的URL
	brief MEDIUMTEXT not null,#游戏简介
	tags char(240) not null,#游戏标签
);

create table picture #游戏的缩略图
(
	picId int not null auto_increment primary key,
	kind int not null,#区分是小缩略图还是大缩略图，1为小缩略图，2为大缩略图
	gameId int not null,#游戏ID,图片是哪个游戏的缩略图
	webUrl char(240) not null,#图的URL地址
	url char(240) not null,#图在自身服务器的地址	
	isSave int not null default 0  #是否将图片保存到了自身服务器，0为未保存，1为保存了
);
	

create table comments #评论表
(
	commentId int not null auto_increment primary key,
	poster char(30) not null,#发表评论者
	content mediumtext not null,#评论内容
	verify int not null default 1,#区分是否审核 0为未审核了，1为审核
	posted timestamp not null #发表评论的时间
);

grant select,update,delete,insert 
on microgames.*
to microgames@localhost identified by 'password';

	