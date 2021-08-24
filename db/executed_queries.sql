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



INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('payment',	2,	'Payment',	NULL,	NULL,	NULL,	NULL),
('recruited-jobseeker',	2,	'Recruited Jobseeker',	NULL,	NULL,	NULL,	NULL),
('refferal-reports',	2,	'Lead Referral',	NULL,	NULL,	NULL,	NULL),
('reports',	1,	'Reports',	NULL,	NULL,	NULL,	NULL);

UPDATE `auth_item` SET `name` = 'banner' WHERE `name` = 'Banner' AND `name` = 'Banner' COLLATE utf8mb4_bin;

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('reports',	'payment'),
('reports',	'recruited-jobseeker'),
('reports',	'refferal-reports');


-- ****************08-07-21 By Mohan
ALTER TABLE `lead_master`
CHANGE `recruiter_commission` `recruiter_commission` float NULL COMMENT 'agancy commision' AFTER `end_date`;
-- ****************08-07-21 By Mohan End

ALTER TABLE `lead_master`
CHANGE `price` `price` float NULL COMMENT 'admin or master admin decide lead price' AFTER `visible_to`;

--***************11-07-2021 By Nirav
ALTER TABLE `certifications`
CHANGE `expiry_date` `expiry_date` date NULL AFTER `document`;

ALTER TABLE `company_master`
ADD `extension` int(11) NULL AFTER `company_mobile`;

-- ************************11-07-21 By Mohan
ALTER TABLE `lead_master`
ADD `is_suspended` tinytext COLLATE 'latin1_swedish_ci' NULL DEFAULT '0' COMMENT '0:No , 1 :Yes';
-- ************************11-07-21 By Mohan End

-- 21-07-201 By Nirav

CREATE TABLE `certificate_master` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate_master`
--

INSERT INTO `certificate_master` (`id`, `name`) VALUES
(1, '(ABMP) Diagnostic Imaging'),
(2, '(ABMP) Hypertheremia'),
(3, '(ABMP) Magnetic Resonance Imagining : (ABMP) Magnetic Resonance Imaging  '),
(4, '(ABMP) Medical Health'),
(5, '(ABMP) Nuclear Medicine'),
(6, '(ABMP) Radiation'),
(7, 'ACSW (NASW) : Academy of Certified Social Workers '),
(8, 'ACM-RN : Accredited Case Manager-Registered Nurse'),
(9, 'CCNS : Acute Care Clinical Nurse Specialist '),
(10, 'ACNP-BC : Acute Care Nurse Practitioner-Board Certified'),
(11, 'ACNPC : Acute Care Nurse Practitioner Certification '),
(12, 'ACNS-BC : Adult  Clinical Nurse Specialist-Board Certified'),
(13, 'ANP-BC : Adult Nurse Practitioner-Board Certified (certified by ANCC)'),
(14, 'ANP-C : Adult Nurse Practitioner -Certified (certified by AANP)'),
(15, 'ABLS : Advanced Burn Life Support '),
(16, 'ACLS : Advanced Cardiac Life Support '),
(17, 'ACS (CCI) : Advanced Cardiac Sonographer '),
(18, 'ACHNP : Advanced Certified Hospice and Palliative Nurse'),
(19, 'ACHRN : Advanced Certified Hyperbaric Registered Nurse'),
(20, 'ADLS : Advanced Disaster Life Support '),
(21, 'AFN-BC : Advanced Forensic Nursing-Board Certified'),
(22, 'ALNC : Advanced Legal Nurse Consultant'),
(23, 'ANVP : Advanced Neurovascular Practitioner '),
(24, 'ANLC : Advanced Nurse Lactation Consultant '),
(25, 'AOCNS : Advanced Oncology Certified Clinical Nurse Specialist'),
(26, 'AOCN : Advanced Oncology Certified Nurse '),
(27, 'AOCNP : Advanced Oncology Certified Nurse Practitioner '),
(28, 'APRN : Advanced Practice Registered Nurse'),
(29, 'PHNA-BC : Advanced Public Health Nurse '),
(30, 'APHN-BC : Advanced Public Health Nurse-Board Certified (change to PHNA-BC)'),
(31, 'ARNP : Advanced Registered Nurse Practitioner '),
(32, 'ASW-G (NASW) : Advanced Social Worker in Gerontology'),
(33, 'ACRN : AIDS Certified Registered Nurse '),
(34, 'ARMRIT : American Registry of Magnetic Resonance Imaging Technologists'),
(35, 'ASN : Asthma Educator-Certified'),
(36, 'BHSc Nsg : Bachelor of Health Science - Nursing Nursing Qualification for RNs in Australia'),
(37, 'BM : Bachelor of Midwifery '),
(38, 'BN : Bachelor  of Nursing'),
(39, 'BNSc : Bachelor of nursing Science'),
(40, 'BPS : Bachelor of Professional Studies with a concentration in Nursing'),
(41, 'BSN : Bachelor of Science in Nursing'),
(42, 'BS : Bachelor of Science with Nursing Major'),
(43, 'BDLS : Basic Disaster Life Support'),
(44, 'BLS : Basic Life Support'),
(45, 'BMTCN : Blood and Marrow Transplant Certified Nurse'),
(46, 'BCBA (BACB) : Board Certified Behavioral Analyst'),
(47, 'BCBA-D (BACB) : Board Certified Behavioral Analyst-Doctoral Designation'),
(48, 'BCPPS (BPS) : Board Certified Pediatric Pharmacy Specialist'),
(49, 'BCEN : Board of Certification for Emergency Nursing'),
(50, 'BD (ARRT) : Bone Densitometry RT '),
(51, 'BS (ARRT) : Breast Sonography RT'),
(52, 'CL (ARRT) : Cardiac-Interventional Radiography RT '),
(53, 'CMC : Cardiac Medicine Certification '),
(54, 'CSC : Cardiac Surgery Certification '),
(55, 'CVICU : Cardiovascular Intensive Care Unit'),
(56, 'CV (ARRT) : Cardiovascular-Interventional Radiography RT'),
(57, 'CVRN-BC : Cardiovascular Nurse-Board Certified'),
(58, 'CVOR : Cardiovascular Operating Room'),
(59, 'CBSPD : Certification Board for Sterile Processing and Distribution '),
(60, 'CCRN : Certification in Acute/Critical Care Nursing'),
(61, 'CARN : Certified Addictions Registered Nurse '),
(62, 'CATC (NBCC) : Certified Addictions Treatment Counselors '),
(63, 'CANP : Certified Adult Nurse Practitioner'),
(64, 'C-CYFSW(NASW) : Certified Advanced Children,Youth, and Family Social Worker '),
(65, 'CAPSW (NASW) : Certified Advanced Practice Social Worker '),
(66, 'C-ASWCM (NASW) : Certified Advanced Social Work Case Manager'),
(67, 'CAPA : Certified Ambulatory Perianesthesia nurse '),
(68, 'CAS (BACB) : Certified Austim Specialist'),
(69, 'CBN : Certified Bariatric Nurse'),
(70, 'BMET (AAMI) : Certified Biomedical Equipment Technician'),
(71, 'CBCN : Certified Breast Care Nurse'),
(72, 'CCC (CCT) : Certified Cardiographic Technician'),
(73, 'CCM : Certified Case Manager '),
(74, 'CCE : Certified Childbirth Educator'),
(75, 'C-CATODSW (NASW) : Certified Clinical Alcohol, Tobacco & Other Drugs Social Worker'),
(76, 'CCDC : Certified Clinical Documentation Specialist'),
(77, 'CCTC : Certified Clinical Transplant Coordinator '),
(78, 'CCTN : Certified Clinical Transplant Nurse'),
(79, 'CCCN : Certified Continence Care Nurse '),
(80, 'CDDN : certified Developmental Disabilities Nurse '),
(81, 'CDE : Certified Diabetes Educator '),
(82, 'CDN : Certified Dialysis Nurse'),
(83, 'CDAL : Certified Director of Assisted Living '),
(84, 'CDONA/LTC : Certified Director of Nursing Administration/Long Term Care'),
(85, 'CDMS : Certified DisabilityManagement Specialist '),
(86, 'CEN : Certified Emergency Nurse '),
(87, 'CER : Certified Endoscope Reprocessor '),
(88, 'CETN : Certified Enterostomal Therapy Nurse'),
(89, 'CENP : Certified Executive in Nursing Practice '),
(90, 'CFNP : Certified Family Nurse Practitioner '),
(91, 'CFRN : Certified Flight Registered Nurse'),
(92, 'CFCN : Certified Foot Care Nurse '),
(93, 'CFN : Certified Forensic Nurse '),
(94, 'CGN : Certified Gastroenterology Nurse'),
(95, 'CGRN: Certified Gastroenterology  Registered Nurse'),
(96, 'CHSE : Certified Healthcare Simulation Educator '),
(97, 'CHSE-A : Certified Healthcare Simulation Educator-Advanced '),
(98, 'CHSOS : Certified Healthcare Simulation Operations Specialist '),
(99, 'CHES : Certified Health Education Specialist '),
(100, 'CHN : Certified Hemodialysis Nurse '),
(101, 'CHPLN : Certified Hospice and Palliative Licensed Nurse '),
(102, 'CHPN : Certified Hospiceand Palliative Nurse '),
(103, 'CHPNA : Certified Hospice  and Palliative Nursing  Assistant'),
(104, 'CHPPN : Certified Hospice and Palliative Pediatric Nurse '),
(105, 'CHRN : Certified Hyperbaric Registered Nurse'),
(106, 'C-EFM : Certified in Electronic Fetal Monitoring'),
(107, 'CIC : Certified in Infection Control'),
(108, 'C-NPT : Certified Neonatal Pediatric Transport '),
(109, 'CNN : Certified in Nephrology Nursing '),
(110, 'Cneph(C) : Certified in Nephrology Nursing (CANADA)'),
(111, 'CPLC : Certified in Perinatal Loss Care'),
(112, 'CT : Certified in Thanatology (dying, death and bereavement)'),
(113, 'CLES (AAMI) : Certified Laboratory Equipment Specialist'),
(114, 'CLC : Certified Lacation Counselor '),
(115, 'CLNC : Certified Legal Nurse Consultant'),
(116, 'CMCN : Certified Managed Care Nurse'),
(117, 'CMDSC : Certified MDS Coordinator '),
(118, 'CMA : Certifeid Medical Assistant '),
(119, 'CMAS : Certified Medical Audit Specialist'),
(120, 'CMSRN : Certified Medical-Surgical Registered Nurse'),
(121, 'CM : Certified Midwife'),
(122, 'CNRN : Certified Neuroscience Registered Nurse '),
(123, 'CNMT (NMTCB) :  Certified Nuclear Medicine Technologist'),
(124, 'CNCC(C) : Certified Nurse in Crtitcal Care (CANADA)'),
(125, 'CNLCP : Certified Nurse Life Care Planner '),
(126, 'CNML : Certified Nurse Manager and Leader'),
(127, 'CNM : Certified Nurse Midwife'),
(128, 'CNP : Certified Nurse Practitioner'),
(129, 'CAN : Certified Nursing Assistant '),
(130, 'CNSC : Certified Nutrition Support Clinician (Formerly CNSN:Certified Nutrition Support Nurse)'),
(131, 'COHN : Certified Occupational Health Nurse'),
(132, 'COHC : Certified Occupational Hearing Conservationist'),
(133, 'COCN : Certified Ostomy Care Nurse '),
(134, 'COROLN : Certified Otorhinolaryngology Nurse '),
(135, 'CPEN : Certified Pediatric Emergency Nurse'),
(136, 'CPHON : Certified Pediatric Hematology Oncology Nurse'),
(137, 'CONA : Certified Pediatric Nurse Associate'),
(138, 'CPN : Certified Pediatric Nurse or Community Psychiatric Nurse (United Kingdom)'),
(139, 'CPNP : Certified Pediatric Nurse Practitioner'),
(140, 'CPON : Certified Pediatric Oncology Nurse '),
(141, 'CNOR : Certified Perioperative Nurse '),
(142, 'CPDN : Certified Peritoneal Dialysis Nurse'),
(143, 'CPhT(PTCB) : Certified Pharmacy Technician'),
(144, 'CPSN : Certified Plastic Surgical Nurse'),
(145, 'CPAN : Certified Post Anesthesia Nurse'),
(146, 'CPNL : Certified Practical Nurse,Long-term care'),
(147, 'CPHQ : Certified Professional in Healthcare Quality'),
(148, 'CPFT : Certified Radiologic Nurse'),
(149, 'CRES (AAMI) : Certified Radiology Equipment Specialist '),
(150, 'CRCST : Certified Registered Central Service Technician'),
(151, 'CRNA : Certified Registered Nurse Anesthetist'),
(152, 'CRNFA : Certified Registerd Nurse Frist Assistant '),
(153, 'CRNI : Certified Registered Nurse Infusion'),
(154, 'CRNO : Certified Registered Nurse in Ophthalmology'),
(155, 'CRNL : Certified Registered Nurse , Long -term care'),
(156, 'CRNP : Certified Registered Nurse Practitioner'),
(157, 'CRRN : Certified Rehabilitation Registered Nurse'),
(158, 'CRT : Certified Respiratory Therapist '),
(159, 'CRAT (CCI) : Certified RhythmAnalysis Technician'),
(160, 'CSN : Certified School Nurse'),
(161, 'C-SSWS(NASW) : Certified School Social Work Specialist'),
(162, 'SANE-A : Certified Sexual Assault Nurse Examiner-Adult /Adolescent'),
(163, 'SANE-P : Certified Sexual Assault Nurse Examiner -Pediatric'),
(164, 'C-SWCM (NASW) : Certified Social Work Case Manager '),
(165, 'C-SWHC (NASW) : Certified Social Worker in Health Care'),
(166, 'CSHA : Certifed Specialist in Hospital Accreditation'),
(167, 'C-SPI : Certified Specialist in Poison Information '),
(168, 'CSFA : Certified Surgical Frist Assistant'),
(169, 'CST : Certified Surgical Technologist'),
(170, 'CTRS : Certified Therapeutic Recreational Specialist'),
(171, 'CTN : Certified Transcultural Nurse'),
(172, 'CTRN : Certified transport Registered Nurse'),
(173, 'CUA : Certified Urologic Associate'),
(174, 'CUCNS : Certified Urologic Clinical Nurse Specialist '),
(175, 'CUNP : Certified Urologic Nurse Practitioner'),
(176, 'CURN : Certified Urologic Registered Nurse'),
(177, 'CVN : Certified Vascular Nurse'),
(178, 'CWCN : Certified Wound Care Nurse'),
(179, 'CWOCN : Certified Wound , Ostomy, Continence Nurse'),
(180, 'CWS : Certified Wound Specialist '),
(181, 'WTA-C : Certified Wound Treatment Associate '),
(182, 'CNO : Chief Nursing Officer'),
(183, 'CLS (California DPH) : Clinical Laboratory Scientist'),
(184, 'CLS : Clinical Laboratory Scientist'),
(185, 'CNL : Clinical Nurse Leader '),
(186, 'CNS : Clinical Nurse Specialist'),
(187, 'CSW-G(NASW) : Clinical Social Worker in Gerontology'),
(188, 'CT (NMTCB) : Computed Tomography'),
(189, 'CT(ARRT) : Computed Tomography RT'),
(190, 'CATN-I : Course in Adavanced Trauma Nursing -Instructor '),
(191, 'CATN-P : Course in Advanced Trauma Nursing-Provider'),
(192, 'Covid-19 Certification'),
(193, 'CT (ASCP) : Cytotechnologist,CT'),
(194, 'DSN : Diabetes Specialist Nurse'),
(195, 'DWC : Diabetic Wound Certified '),
(196, 'DLM (ASCP) : Diplomate in Laboratory Management'),
(197, 'EdD : Doctor of Education '),
(198, 'DN : Doctor of Nursing '),
(199, 'DNP : Doctor of Nursing Practice '),
(200, 'DrNP : Doctor of Nursing Practice '),
(201, 'DNS : Doctor of Nursing Science also seen as DNSc'),
(202, 'DVNE : Domestic violence nurse examiner'),
(203, 'ECRN : Emergency Communications Registered Nurse(not intended for postnominal use)'),
(204, 'ED : Emergency Department'),
(205, 'ENP-BC : Emergency Nurse Practitioner-Board Certified (Certified by ANCC)'),
(206, 'ENP-C : Emergency Nurse Practitioner-Certified (Certified by AANP)'),
(207, 'ENPC : Emergency Nursing Pediatric Course'),
(208, 'ENPC-I : Emergency Pediatric Course Instructor'),
(209, 'ENPC-P : Emergency nursing Pediatric Course Provider'),
(210, 'ET : Enterostomal Thetapist'),
(211, 'FNC : Family Nurse Clinician'),
(212, 'FNP-C : Family Nurse Practitioner (Certified by AANP)'),
(213, 'FNP-BC : Family Nurse Practitioner (Certified by ANCC)'),
(214, 'FPNP : Family Planning Nurse Practitioner'),
(215, 'Fluoroscopy Permit (CA)'),
(216, 'GNP : Gerontological Nurse Practitioner'),
(217, 'HT (ASCP) : Histotechnician'),
(218, 'HTL (ASCP) : Histotechnologist'),
(219, 'HN-BC® : Holistic Nurse -Board Certified (certified by AHNCC)'),
(220, 'INS : Informatics Nurse Specialist'),
(221, 'ICC : Intensive Care Certification '),
(222, 'INC : Intensive Neonatal Care Certification '),
(223, 'LNC : Legal Nurse Consultant '),
(224, 'LNCC : Legal Nurse Consultant , Certified '),
(225, 'LCPC (NBCC) : Licensed Clinical Professional counselor'),
(226, 'LCSW (NASW) : Licensed Clinical Social Worker'),
(227, 'LMFT (COAMFTE) : Licensed Marriage and Family Therapist '),
(228, 'LMHC (NBCC) : Licensed Mental Health Counselor  '),
(229, 'LPN : Licensed Pratical Nurse'),
(230, 'LPCC (NBCC) : Licensed Professional Clinical Counselor'),
(231, 'LPC (NBCC) : Licensed Professional Counselor'),
(232, 'LPT (NBCC) : Licensed Psychiatric Technician'),
(233, 'LPT : Licensed Psychiatric Techinician'),
(234, 'LSN: Licensed School Nurse'),
(235, 'LTAC : Long Term Acute Care'),
(236, 'LTC : Lomg term Care (LPN Specific)'),
(237, 'MR (ARRT) : Magnetic Resonance Imaging RT'),
(238, 'M (ARRT) :Mammography RT'),
(239, 'MAB : Management of assaultive behavior, restraint training (Requirement for most working in psychiatric or correctional settings)'),
(240, 'MFT (COAMFTE) : Marriage and Family Therapist'),
(241, 'MAN : Master of Arts in Nursing'),
(242, 'MEd : Master of Education '),
(243, 'MPH : Master of Public Health '),
(244, 'MS : Master of Science'),
(245, 'MSN : Master of Science in Nursing'),
(246, 'MSN/Ed : Master  of Science in Nursing Education '),
(247, 'MSW (NASW) : Master in Social Work'),
(248, 'MLA (ASCP) : Medical Laboratory Assistant'),
(249, 'MLS (ASCP) : Medical Laboratory Scientist'),
(250, 'MLT (ASCP) : Medical Laboratory Technician'),
(251, 'MSA : Medicare Set-Aside'),
(252, 'MRCN : Member , Royal College of Nursing (UK)'),
(253, 'MHN : Mental Health Nurse-Registered Nurse Endorsed to Pratice Advanced nurisng in Mental Health'),
(254, 'NCSN : National Certified School Nurse '),
(255, 'NCSN (NBCSN) : National Certified School Nurse'),
(256, 'NCSP (NBCSN) : Nationally Certified School Psychologist'),
(257, 'NNP-BC : Neonatal Nurse Practitioner'),
(258, 'CRT-NPS or RRT-NPS : Neonatal/Pediatric Respiratory Care Specialist'),
(259, 'NRP : Neonatal Resuscitation Program'),
(260, 'NIHSS : NIH Storke Scale'),
(261, 'NCT (NMTCB) : NMTCB-CNMT'),
(262, 'N (ARRT) : Nuclear Medicine Technology RT'),
(263, 'NC-BC® : Nurse Coach-Board Certified  (certified by AHNCC)'),
(264, 'OCN : Oncology Certified Nurse'),
(265, 'ONC : Orthopaedic Nurse Certified'),
(266, 'OMS : Ostomy Management Specialist'),
(267, 'PA  (ASCP) : Pathology Assistant'),
(268, 'PALS : Pediatric Advanced Life Support'),
(269, 'PCNS : Pediatric Clinical Nurse Specialist'),
(270, 'PNP-AC : Pediatric Nurse Practitioner-Acute Care'),
(271, 'PNP-BC : Pediatric Nurse Practitioner-Board Certified '),
(272, 'PNP-PC : Pediatric Nurse Practitioner-Primary Care'),
(273, 'PBT (ASCP) : Phlebotomy Technician'),
(274, 'PET (NMTCB) : Positron Emission Technoligy'),
(275, 'PCCN : Progressive Care Certified Nurse'),
(276, 'PMHCNS-BC : Psychiatric Mental Health Clinical Nurse Specialist'),
(277, 'PMHN-BC : Psychiatric Mental Health Nurse'),
(278, 'PMHNP-BC : Psychiatric Mental Halth Nurse Practitioner '),
(279, 'PHN : Public Health Nurse'),
(280, 'QM (ARRT) : Quality Management RT'),
(281, 'T (ARRT) : Radition Therapy RT'),
(282, 'R (ARRT) : Radiography RT'),
(283, 'RDMS - AB : RDMS-Abdomen'),
(284, 'RDCS - AE : RDMS Adult Echocardiography'),
(285, 'RDMS - BR : RDMS-Breast'),
(286, 'RDCS - FE : RDMS - RDMS Fetal Echocardiography'),
(287, 'RDMS - RMSKS : RDMS - Musculoskeletal Sonography'),
(288, 'RDMS - NE : RDMS Neurosonology'),
(289, 'RDMS-OB/GYN : RDMS-Obstetrics & Gynecology'),
(290, 'RDMS - PE : RDMS Pediatric Echocardiography'),
(291, 'RDMS - PS : RDMS - Pediatric Sonography'),
(292, 'RDMS - RVT - VT : RDMS - Vascular Technology'),
(293, 'RCES (CCI) : Registered Cardiac Electrophysiology Specialist'),
(294, 'RCS (CCI) : Registered Cardiac Sonographer'),
(295, 'RCIS (CCI) : Registered Cardiovascular Invasive Specialist'),
(296, 'RCCS (CCI) : Registered Congentinal Cardiac Sonographer'),
(297, 'RM : Registered Midwife'),
(298, 'RNC : Registered Nurse, Certified: American Academy Certified  Nurse'),
(299, 'RNC-OB: Registered Nurse Certified in Inpatient Obstertics'),
(300, 'RNC-LRN : Registered Nurse Certified in Low Risk Neonatal Nursing'),
(301, 'RNC-MNN : Registered Nurse Certified in Maternal Newborn Nursing'),
(302, 'RNS- NIC : Registeres Nurse Certified in Neonatal Intensive Care'),
(303, 'RNFA : registered Nurse Frist Assistant '),
(304, 'RNM : Registered Nurse - Midwife'),
(305, 'RPhs (CCI) : Registered Phlebology Sonographer'),
(306, 'RPSGT : Registered Polysomnographic Technologist'),
(307, 'RPFT : Registered Pulmonary Function Technologist'),
(308, 'R - RRA (ARRT) : Registered Radiologist Assistant RT'),
(309, 'RRT : Registered Respiratory Therapist'),
(310, 'RVS (CCI) :Registered Vascular Specialist'),
(311, 'RDMS - RVT : registered Vascular Technologist '),
(312, 'RCP : Respiratory Care Practitioner'),
(313, 'SNSC : School Nurse Service Credential (California CTC)'),
(314, 'SHN :Sexual and Reproductive Health endorsed RN-Queensland Australia'),
(315, 'SANE : Sexual Assault Nure Examiner'),
(316, 'CRT-SDS or RRT - SDS : Sleep Disorders Specialist'),
(317, 'S (ARRT) : Sonoraphy RT'),
(318, 'SBB (ASCP) : Speacialist in Blood Banking'),
(319, 'SC (ASCP ) : Specialist in Chemistry '),
(320, 'Scym (ASCP) : Specialist in Cytometry '),
(321, 'SCT (ASCP) : Specialist in Cytotechnology'),
(322, 'SH (ASCP) : Specialist in Hematology '),
(323, 'SM (ASCP) : Specialist in Microbiology'),
(324, 'SMB (ASCP) : Specialist in Molecular Biology'),
(325, 'SEN : State Enrolled Nurse'),
(326, 'SCRN : Storke Certified Registered Nurse'),
(327, 'SN : Student nurse (RN Preparation)'),
(328, 'SCN : Supervisory Clinical Nurse'),
(329, 'BB (ASCP) : Technologist in Blood Banking'),
(330, 'C (ASCP) : Technologist in Chemistry '),
(331, 'CG (ASCP) : Technologist in Cytogenetics'),
(332, 'H (ASCP) :  Technologist in Hematology '),
(333, 'M (ASCP) : Technologist in Microbiology '),
(334, 'MB (ASCP) : Technologist in Molecular Biology'),
(335, 'TNP : Telephone Nursing Practitioner'),
(336, 'TCRN : Trauma Certified Registered Nurse'),
(337, 'TNS : Trauma Nurse Specialist'),
(338, 'TNCC : Trauma Nursing Core Course'),
(339, 'VA - BS : Vascular Access Board Certified '),
(340, 'VI (ARRT) : Vascular - Interventional Radiography RT'),
(341, ' VS (ARRT) : Vascular Sonography RT'),
(342, 'WHNP - BC : Womens Health Care Nurse Practitioner '),
(343, 'WCC : Wound Care Certified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_master`
--
ALTER TABLE `certificate_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate_master`
--
ALTER TABLE `certificate_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;
COMMIT;

-- 21-07-2021 By Nirav End


----------------------------
-- 16-AUG-21 FOR BLOGS 
----------------------------
CREATE TABLE `blog_category_master` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0: Inactive, 1 :Active',
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL
);


CREATE TABLE `blog_master` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `reference_no` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `conver_image_name` varchar(100)  NULL,
  `tags` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0:Non-Suspended, 1:Suspended',
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `blog_category_master` (`id`) ON DELETE RESTRICT
);

-- 16-AUG-21 END FOR BLOGS 

-- 17-AUG-21 END FOR BLOGS RBAC

INSERT INTO `auth_item` (`name`, `type`, `description`) VALUES ('blog', '1', 'Blog');
INSERT INTO `auth_item` (`name`, `type`, `description`) VALUES ('blog-create', '2', 'Create');
INSERT INTO `auth_item` (`name`, `type`, `description`) VALUES ('blog-update', '2', 'Update');
INSERT INTO `auth_item` (`name`, `type`, `description`) VALUES ('blog-view', '2', 'View');
INSERT INTO `auth_item` (`name`, `type`, `description`) VALUES ('blog-suspend', '2', 'Suspend');

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('blog','blog-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('blog','blog-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('blog','blog-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('blog','blog-suspend');
-- 17-AUG-20 END FOR BLOGS RBAC

ALTER TABLE `lead_master`
CHANGE `street_no` `street_no` varchar(255) COLLATE 'latin1_swedish_ci' NULL AFTER `updated_by`,
CHANGE `street_address` `street_address` varchar(255) COLLATE 'latin1_swedish_ci' NULL AFTER `street_no`;

--------23-AUG-21--------Add addiotinal field in job seeker profile
ALTER TABLE `user_details`
ADD `speciality_id` int(11) NULL COMMENT 'For Job seeker only ' AFTER `interest_level`,
ADD `discipline_id` int(11) NULL COMMENT 'For Job seeker only ' AFTER `speciality_id`,
ADD `year_of_exprience` varchar(3) NULL COMMENT 'For Job seeker only ' AFTER `discipline_id`,
ADD FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`) ON DELETE SET NULL,
ADD FOREIGN KEY (`discipline_id`) REFERENCES `discipline` (`id`) ON DELETE SET NULL;
---------------END 23-AUG-21 

CREATE TABLE `newsletter_master` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `reference_no` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `conver_image_name` varchar(100)  NULL,
  `tags` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0:Non-Suspended, 1:Suspended',
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL
);

