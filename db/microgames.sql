#存储937.com小游戏的数据库 新版 2013年7月2日12点03分
#一个表的columns太多，是否会使数据库查询速度下降？若将关联性很强的数据保存到多个表中，会导致采集数据时需要对多个表进行操作，显然会降低数据库查询速度。
#在version1基础上的改动：1.把所有采集到的游戏数据（webURL\swfUrl\thumbUrl\mediumThumbUrl等）都保存到一个表中，将这些数据下载到服务器时再将他们的数据保存到其他的表中。2.增加了flash和gameTags 表。
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

create table game   #游戏。若是引用网络资源，此表就足够提供所需的数据
(
	gameId int not null auto_increment primary key,
	name char(60) not null,#游戏名
	introduction MEDIUMTEXT not null,#游戏简介、游戏目标、如何开始
	gameKey char(240) not null,#操作指南
	popularity int not null default 0, #受欢迎度
	commentId int not null, #评论ID
	webUrl char(100) not null,#包含该游戏的web页面URL
	swfUrl char(100) not null,  #swf文件的URL
	pic1Url char(100) not null,#小缩略图的URL
	pic2Url char(100) not null,#大缩略图的URL
	isGather int not null default 0,#是否采集了这些数据，0为未采集，1为采集了。在第二次更新将数据补充完整时设置为1.
	isSavePic int not null default 0,#是否下载了图，0为未下载，1为已经下载
	isSaveFlash int nont null default 0,#是否下载了flash文件，0为未下载，1为已经下载
	brief MEDIUMTEXT not null,#游戏简介
	tags char(240) not null#游戏标签
);

create table flash  #flash文件
(
	flashId int not null auto_increment primary key,
	gameId int not null,#游戏ID
	flashUrl char(100) not null,#flash文件地址
	#isSave int not null default 0  #是否已经保存到自身服务器，0为未保存，1为保存了
);

create table picture #游戏的缩略图
(
	picId int not null auto_increment primary key,
	kind int not null,#区分是小缩略图还是大缩略图，1为小缩略图，2为大缩略图
	gameId int not null,#游戏ID,图片是哪个游戏的缩略图	
	picUrl char(240) not null,#图在自身服务器的地址	
	#isSave int not null default 0  #是否将图片保存到了自身服务器，0为未保存，1为保存了
);
	

create table comments #评论表
(
	commentId int not null auto_increment primary key,
	poster char(30) not null,#发表评论者
	content mediumtext not null,#评论内容
	verify int not null default 1,#区分是否审核 0为未审核了，1为审核
	posted timestamp not null #发表评论的时间
);

create table gameTags   #游戏与标签关系表。此表这样设计好吗？
(
	gtId int not null auto_increment primary key,
	tagId int not null,#标签ID
	gameId int not null #游戏ID
);

grant select,update,delete,insert 
on microgames.*
to microgames@localhost identified by 'password';

	