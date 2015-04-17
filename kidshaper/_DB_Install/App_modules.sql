use kidshaper;
CREATE TABLE `app_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_uri` varchar(90) NOT NULL DEFAULT '',
  `module_name` varchar(90) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `predefined` tinyint(1) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_uri_UNIQUE` (`module_uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into app_modules (module_uri, module_name, active, predefined, description) values ('CPanel_Head', 'cPanel HEAD', 1, 1, 'This is default module. HTML HEAD Tags module for cPanel');
insert into app_modules (module_uri, module_name, active, predefined, description) values ('CPanel_PageHeader', 'cPanel PageHeader', 1, 1, 'This is default module. Page header module for cPanel');
insert into app_modules (module_uri, module_name, active, predefined, description) values ('CPanel_Auth', 'cPanel Authorization', 1, 1, 'This is default module. Authorization module for cPanel');
insert into app_modules (module_uri, module_name, active, predefined, description) values ('CPanel_Menu', 'cPanel Mainmenu', 1, 1, 'This is default module. MainMenu module for cPanel');
insert into app_modules (module_uri, module_name, active, predefined, description) values ('CPanel_PageContainer', 'cPanel PageContainer', 1, 1, 'This is default module. Page container module for cPanel');
insert into app_modules (module_uri, module_name, active, predefined, description) values ('CPanel_FageFooter', 'cPanel PageFooter', 1, 1, 'This is default module. Page footer module for cPanel');
