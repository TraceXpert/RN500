#  ***********************12-JUN-2021***BY Nirav**************************

ALTER TABLE `advertisement`
CHANGE `active_from` `active_from` date NULL AFTER `location_display`,
CHANGE `active_to` `active_to` date NULL AFTER `active_from`;

#  ***********************12-JUN-2021***BY Nirav END**************************

#  ***********************12-JUN-2021***BY Mehul START**************************
ALTER TABLE `advertisement`
CHANGE `location_name` `location` int NOT NULL AFTER `icon`,
DROP `location_display`;

ALTER TABLE `advertisement`
CHANGE `file_type` `file_type` tinyint NULL COMMENT '1:image 2:youtube link' AFTER `active_to`;
#  ***********************12-JUN-2021***BY Mehul END**************************

#  ***********************13-JUN-2021***BY Mohan START**************************
CREATE TABLE `lead_rating` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `lead_id` int NOT NULL,
  `rating` float NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Job seeker ID',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);
#  ***********************13-JUN-2021***BY Mohan END**************************

#  ***********************14-JUN-2021***BY Mohan **************************
CREATE TABLE `referral_master` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `from_name` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `description` varchar(1000) NULL,
  `to_name` varchar(255) NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE `referral_master`
ADD `lead_id` int(11) NOT NULL AFTER `id`,
CHANGE `created_at` `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP AFTER `to_email`,
ADD FOREIGN KEY (`lead_id`) REFERENCES `lead_master` (`id`);
#  ***********************14-JUN-2021***BY Mohan End**************************

#  ***********************14-JUN-2021***BY Mehul START**************************
UPDATE `auth_item` SET `description` = 'Company Approval' WHERE `name` = 'user-approve' AND `name` = 'user-approve' COLLATE utf8mb4_bin;
UPDATE `auth_item` SET `description` = 'View Company Approval Request' WHERE `name` = 'user-request-view' AND `name` = 'user-request-view' COLLATE utf8mb4_bin;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES ('jobseeker', '1', 'Jobseeker', NULL, NULL, '1623685711', '1623685711');


INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES ('jobseeker-view', '2', 'View', NULL, NULL, '1623685711', '1623685711');


INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES ('jobseeker', 'jobseeker-view');

ALTER TABLE `company_subscription_payment`
ADD `is_free` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:yes 0:no' AFTER `status`;

CREATE TABLE `lead_emergency` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `lead_id` int NOT NULL,
  `emergency_id` int NOT NULL
);
#  ***********************14-JUN-2021***BY Mehul END**************************

CREATE TABLE `api_log` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `request` text NOT NULL,
  `response` text NOT NULL,
  `created_at` int NOT NULL
);

ALTER TABLE `api_log`
ADD `url` text NOT NULL AFTER `id`;

CREATE TABLE `banner` (
  `id` int NOT NULL,
  `headline` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1:active 0: inactive',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL
);


ALTER TABLE `banner`
CHANGE `id` `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES ('Banner', '1', 'Banner', NULL, NULL, NULL, NULL);

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES ('banner-create', '2', 'Create', NULL, NULL, NULL, NULL);

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES ('banner-update', '2', 'Update', NULL, NULL, NULL, NULL);

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES ('banner-view', '2', 'View', NULL, NULL, NULL, NULL);

INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES ('banner', 'banner-create');

INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES ('banner', 'banner-update');

INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES ('banner', 'banner-view');


-- ********************04-July-21 BY MOHAN

ALTER TABLE `lead_recruiter_job_seeker_mapping`
ADD `rec_end_date` date NULL AFTER `rec_joining_date`;
-- ********************04-July-21 BY MOHAN END

ALTER TABLE `documents`
CHANGE `id` `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;

ALTER TABLE `references`
CHANGE `mobile_no` `mobile_no` varchar(20) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `last_name`;

-- ****************08-07-21 By Mohan
ALTER TABLE `lead_master`
CHANGE `recruiter_commission` `recruiter_commission` float NULL COMMENT 'agancy commision' AFTER `end_date`;
-- ****************08-07-21 By Mohan End