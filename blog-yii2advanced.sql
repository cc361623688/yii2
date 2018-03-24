/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.17-log : Database - yii2advanced
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`yii2advanced` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `yii2advanced`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email_validate_token` varchar(255) DEFAULT NULL COMMENT '邮箱验证token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `vip_lv` int(11) DEFAULT '0' COMMENT 'vip等级',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表';

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email_validate_token`,`email`,`role`,`status`,`avatar`,`vip_lv`,`created_at`,`updated_at`) values (1,'admin','v-j9lWpSQmy_puVCVjQ-F7T5pIjKcQQ9','$2y$13$SoEBkTZPq4TG7O4Hko/9D.lfrM7DIp0rgeCJla3McQLx7EL3Ehs1C',NULL,NULL,'361623688@qq.com',10,10,'',0,1519824675,1519824675);

/*Table structure for table `cats` */

DROP TABLE IF EXISTS `cats`;

CREATE TABLE `cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `cat_name` varchar(255) DEFAULT NULL COMMENT '分类名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='分类表';

/*Data for the table `cats` */

insert  into `cats`(`id`,`cat_name`) values (1,'分类1'),(2,'分类2'),(3,'分类3'),(4,'分类4');

/*Table structure for table `feeds` */

DROP TABLE IF EXISTS `feeds`;

CREATE TABLE `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='聊天信息表';

/*Data for the table `feeds` */

insert  into `feeds`(`id`,`user_id`,`content`,`created_at`) values (10,1,'测试1\n        ',1520950794),(11,1,'测试空间你说的空间你看见你发的\n        ',1520950803),(12,1,'\n        是导火索将大幅度发',1520950807),(13,1,' 话不多附件\n        ',1520951045),(14,1,'的范德萨发给\n        ',1520951048),(15,1,' 地方广东省给对方\n        ',1520951049),(16,1,'挂号费呢个好\n        ',1520951051),(17,1,'粉不放过gf\n        ',1520951053),(18,1,' 发给地方\n        ',1520951057),(19,1,' 地方过分\n        ',1520951061),(20,1,' 电风扇发送到\n        ',1520951063),(21,1,' 发生不放过过分\n        ',1520951065),(22,1,' 地方不多发不发达\n        ',1520951067),(23,1,'s uhgdfuy bufdh \n        ',1521124894);

/*Table structure for table `post_extends` */

DROP TABLE IF EXISTS `post_extends`;

CREATE TABLE `post_extends` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `post_id` int(11) DEFAULT NULL COMMENT '文章id',
  `browser` int(11) DEFAULT '0' COMMENT '浏览量',
  `collect` int(11) DEFAULT '0' COMMENT '收藏量',
  `praise` int(11) DEFAULT '0' COMMENT '点赞',
  `comment` int(11) DEFAULT '0' COMMENT '评论',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='文章扩展表';

/*Data for the table `post_extends` */

insert  into `post_extends`(`id`,`post_id`,`browser`,`collect`,`praise`,`comment`) values (38,8,51,0,0,0),(39,12,9,0,0,0),(40,13,4,0,0,0),(41,11,7,0,0,0),(42,10,2,0,0,0);

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `summary` varchar(255) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  `label_img` varchar(255) DEFAULT NULL COMMENT '标签图',
  `cat_id` int(11) DEFAULT NULL COMMENT '分类id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `user_name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `is_valid` tinyint(1) DEFAULT '0' COMMENT '是否有效：0-未发布 1-已发布',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_cat_valid` (`cat_id`,`is_valid`) USING BTREE,
  KEY `p-user` (`user_id`),
  CONSTRAINT `p-cat` FOREIGN KEY (`cat_id`) REFERENCES `cats` (`id`),
  CONSTRAINT `p-user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文章主表';

/*Data for the table `posts` */

insert  into `posts`(`id`,`title`,`summary`,`content`,`label_img`,`cat_id`,`user_id`,`user_name`,`is_valid`,`created_at`,`updated_at`) values (8,'测试文章','测试开始案例库了','<p>测试开始案例库了</p>','/image/20180311/1520769215887189.jpg',1,1,'chenchao',0,1520769715,1520769715),(10,'常委会死','都是吃剩的地方粉','<p>都是吃剩的地方粉</p>','/image/20180311/1520771012835586.jpg',1,1,'chenchao',1,1520771028,1520771028),(11,'2ewdew','无法地方地方','<p>无法地方地方</p>','/image/20180311/1520771079910109.jpg',1,1,'chenchao',1,1520771090,1520771090),(12,'如何搭建个人独立博客？','作者：刘文图熙1895链接：https://www.zhihu.com/question/20463581/answer/54939467来源：知乎著作权归作者所有。商业转载请联系','<p>作者：刘文图熙1895<br/>链接：https://www.zhihu.com/question/20463581/answer/54939467<br/>来源：知乎<br/>著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。<br/><br/></p><p>个人博客<a href=\"https://link.zhihu.com/?target=http%3A//hill1895.rocks/\" class=\" external\" target=\"_blank\" rel=\"nofollow noreferrer\" data-za-detail-view-id=\"1043\"><span class=\"invisible\">http://</span><span class=\"visible\">hill1895.rocks/</span><span class=\"invisible\"></span></a><br/>因为觉得Wordpress啥的模板一点都不好看，就纯手工敲了一个，总计花了一个多月时间，感觉用着还挺顺手。<br/>目前总共就花费了7美金在<a href=\"https://link.zhihu.com/?target=http%3A//Name.com\" class=\" external\" target=\"_blank\" rel=\"nofollow noreferrer\" data-za-detail-view-id=\"1043\"><span class=\"invisible\">http://</span><span class=\"visible\">Name.com</span><span class=\"invisible\"></span></a>上买了个域名，其他全使用开源的资源，一分钱没花。空间使用了AWS一年的免费主机（真心是业界良心）<br/>博客架构：</p><ul class=\" list-paddingleft-2\"><li><p>服务器：空间使用AWS一年免费的虚拟机，使用ubuntu14. 04+Nginx1.8+uWSGI来部署Django应用，从<a href=\"https://link.zhihu.com/?target=http%3A//Name.com\" class=\" external\" target=\"_blank\" rel=\"nofollow noreferrer\" data-za-detail-view-id=\"1043\"><span class=\"invisible\">http://</span><span class=\"visible\">Name.com</span><span class=\"invisible\"></span></a>上购买域名，服务器配置：</p></li><ul class=\" list-paddingleft-2\" style=\"list-style-type: square;\"><li><p>内存：613MB内存，基于Xen 32位或64位</p></li><li><p>30GB月流量，其中15G上行流量， 15G下行流量</p></li><li><p>主机空间10GB硬盘，1百万以下I/O读写</p></li><li><p>可以免费使用一年，有Linux和Windows操作系统</p></li></ul><li><p>网站框架：Django1.8。<br/></p></li><li><p>博客后台：修改Django自带的Admin系统，主要添加富文本编辑器用于编写博客，富文本编辑器选择百度的UEditor，其<a href=\"https://link.zhihu.com/?target=https%3A//github.com/zhangfisher/DjangoUeditor\" class=\" wrap external\" target=\"_blank\" rel=\"nofollow noreferrer\" data-za-detail-view-id=\"1043\">Django的集成版本</a>可以在Github上找到。</p></li><li><p>数据库：使用MySQL，主要便于同Django集成，另外Django Admin后台操作数据库非常方便。</p></li><li><p>前端：框架和UI使用Bootstrap3，布局使用Bootstrap的网格布局，使用网格布局+Media Query来做响应式设计，以便支持不同尺寸的设备。使用 SyntaxHighlighter来对pre标签中的代码做代码高亮。</p></li><li><p>图片存储：七牛云存储。由于虚拟机整个只有30G空间，图片上传相当不划算，于是寻找外部存储方案，最后发现<a href=\"https://link.zhihu.com/?target=http%3A//www.qiniu.com/\" class=\" wrap external\" target=\"_blank\" rel=\"nofollow noreferrer\" data-za-detail-view-id=\"1043\">七牛云存储</a>可以做网站图片外链，每月免费10G流量，10万次免费请求，完全可以不花一分钱满足个人博客的需求。</p></li><li><p>评论和分享：<a href=\"https://link.zhihu.com/?target=http%3A//duoshuo.com/\" class=\" wrap external\" target=\"_blank\" rel=\"nofollow noreferrer\" data-za-detail-view-id=\"1043\">多说评论和分享插件</a>。使用该插件，保证在不设计自己的账号系统，不使用自己的数据库的情况下能够进行文章的评论互动和分享。</p></li></ul><p><br/></p>','/image/20180311/1520775470567303.jpg',1,1,'chenchao',1,1520775502,1520775502),(13,'PHP别名引','PHP5.3+支持命名空间：namespace，命名空间的一个重要功能是可以使用别名（alias）来引用一个符合规则的名字。命名空间支持3中形式的别名引用（或称之为引入）方式：类（','<p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">PHP5.3+支持命名空间：namespace，命名空间的一个重要功能是可以使用别名（alias）来引用一个符合规则的名字。</p><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">命名空间支持3中形式的别名引用（或称之为引入）方式：类（class）别名，接口（interface）别名和命名空间（namespace）名字别名。</p><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">PHP5.6+还支持函数别名和常量别名。</p><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">（注：php.net 网站上关于别名这一段的中文描述有歧义和错误，更正如上）</p><h5 style=\"font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; margin: 8px 0px 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); font-size: 18px; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);\">具体语法格式</h5><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">use xxx\\xxx\\xxx as xx;</p><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">所以use语句实际上是一种别名引用，而不是通常的import。那么use后面出现的名称就得是符合规则的别名。</p><h5 style=\"font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; margin: 8px 0px 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); font-size: 18px; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);\">错误及原因</h5><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">现在再来看类似文章标题中的错误信息：</p><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">“The use statement with non-compound name … has no effect”<br style=\"box-sizing: border-box;\"/></p><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">我们就能明白这个错误信息指的是use语句中出现的名称不是复合名称，不符合规则，所以“没有用”。</p><p style=\"margin-top: 0px; margin-bottom: 16px; padding: 0px; box-sizing: border-box; color: rgb(79, 79, 79); line-height: 26px; min-height: 26px; text-align: justify; font-family: &quot;PingFang SC&quot;, &quot;Microsoft YaHei&quot;, SimHei, Arial, SimSun; white-space: normal; background-color: rgb(255, 255, 255);\">检查你的语句是不是直接在use后面跟上了类或接口的名字，比如</p><p><br/></p>','/image/20180312/1520858502625151.jpg',2,1,'chenchao',1,1520858519,1520858519);

/*Table structure for table `relation_post_tags` */

DROP TABLE IF EXISTS `relation_post_tags`;

CREATE TABLE `relation_post_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `post_id` int(11) DEFAULT NULL COMMENT '文章id',
  `tag_id` int(11) DEFAULT NULL COMMENT '标签id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `relation_post_tags` */

insert  into `relation_post_tags`(`id`,`post_id`,`tag_id`) values (1,8,46),(2,8,47),(3,9,NULL),(4,9,NULL),(5,10,48),(6,10,49),(7,11,50),(8,11,51),(9,11,52),(10,12,53),(11,12,54),(12,13,55),(13,13,56);

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag_name` varchar(255) DEFAULT NULL COMMENT '标签名称',
  `post_num` int(11) DEFAULT '0' COMMENT '关联文章数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='标签表';

/*Data for the table `tags` */

insert  into `tags`(`id`,`tag_name`,`post_num`) values (46,'测试1',2),(47,'测试2',2),(48,'地方的',1),(49,'发的粉',1),(50,'地方的发的',1),(51,'的发的粉',1),(52,'发的出发点fv',1),(53,'PPS',1),(54,'互联网金融',1),(55,'测试',1),(56,'标签1',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '重置密码token',
  `email_validate_token` varchar(255) DEFAULT NULL COMMENT '邮箱验证token',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `vip_lv` int(11) DEFAULT '0' COMMENT 'vip等级',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表';

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email_validate_token`,`email`,`role`,`status`,`avatar`,`vip_lv`,`created_at`,`updated_at`) values (1,'chenchao','v-j9lWpSQmy_puVCVjQ-F7T5pIjKcQQ9','$2y$13$SoEBkTZPq4TG7O4Hko/9D.lfrM7DIp0rgeCJla3McQLx7EL3Ehs1C',NULL,NULL,'361623688@qq.com',10,10,'',0,1519824675,1519824675);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
