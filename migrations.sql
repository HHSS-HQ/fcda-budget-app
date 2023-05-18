
   INFO  Running migrations.  

  2013_01_06_100239_role .................................................................................................................  
  ⇂ create table `role` (`id` int unsigned not null auto_increment primary key, `role_name` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  2014_10_12_000000_create_users_table ...................................................................................................  
  ⇂ create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `username` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255) not null, `role_id` int unsigned null, `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `users` add index `fk_user_1_idx`(`role_id`)  
  ⇂ alter table `users` add constraint `fk_user_1_idx` foreign key (`role_id`) references `role` (`id`) on delete no action on update no action  
  ⇂ alter table `users` add unique `users_email_unique`(`email`)  
  ⇂ alter table `users` add unique `users_username_unique`(`username`)  
  2014_10_12_100000_create_password_resets_table .........................................................................................  
  ⇂ create table `password_resets` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `password_resets` add index `password_resets_email_index`(`email`)  
  2019_08_19_000000_create_failed_jobs_table .............................................................................................  
  ⇂ create table `failed_jobs` (`id` bigint unsigned not null auto_increment primary key, `uuid` varchar(255) not null, `connection` text not null, `queue` text not null, `payload` longtext not null, `exception` longtext not null, `failed_at` timestamp default CURRENT_TIMESTAMP not null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `failed_jobs` add unique `failed_jobs_uuid_unique`(`uuid`)  
  2019_12_14_000001_create_personal_access_tokens_table ..................................................................................  
  ⇂ create table `personal_access_tokens` (`id` bigint unsigned not null auto_increment primary key, `tokenable_type` varchar(255) not null, `tokenable_id` bigint unsigned not null, `name` varchar(255) not null, `token` varchar(64) not null, `abilities` text null, `last_used_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `personal_access_tokens` add index `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`)  
  ⇂ alter table `personal_access_tokens` add unique `personal_access_tokens_token_unique`(`token`)  
  2023_01_01_001041_project_type .........................................................................................................  
  ⇂ create table `project_type` (`id` int unsigned not null auto_increment primary key, `project_type` varchar(255) null, `created_by` bigint unsigned not null, `remarks` varchar(255) null, `status` varchar(255) not null default 'ACTIVE', `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  ⇂ alter table `project_type` add index `fk_entered_by_id_7_idx`(`created_by`)  
  ⇂ alter table `project_type` add constraint `fk_entered_by_id_7_idx` foreign key (`created_by`) references `users` (`id`) on delete no action on update no action  
  2023_01_01_014728_project ..............................................................................................................  
  ⇂ create table `project` (`id` bigint unsigned not null auto_increment primary key, `project_type_id` int unsigned null, `project_id` varchar(255) not null, `project_title` varchar(255) not null, `project_location` varchar(255) not null, `contractor_id` varchar(255) null, `date_of_award` varchar(255) null, `appropriation` varchar(255) null, `contract_sum` varchar(255) null, `commencement_date` varchar(255) null, `completion_period` varchar(255) null, `percentage_completion` varchar(255) null, `amount_paid_till_date` varchar(255) null, `outstanding_balance` varchar(255) null, `certified_cv_not_paid` varchar(255) null, `year_last_funded` varchar(255) null, `last_funded_date` varchar(255) null, `project_year` varchar(255) null, `added_by` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ alter table `project` add index `fk_project_type_id_1_idx`(`project_type_id`)  
  ⇂ alter table `project` add constraint `fk_project_type_id_1_idx` foreign key (`project_type_id`) references `project_type` (`id`) on delete no action on update no action  
  ⇂ alter table `project` add unique `project_project_id_unique`(`project_id`)  
  2023_01_01_063739_accounting_year ......................................................................................................  
  ⇂ create table `accounting_year` (`id` bigint unsigned not null auto_increment primary key, `accounting_year_name` varchar(255) null, `start_date` varchar(255) null, `end_date` varchar(255) null, `status` varchar(255) null default 'INACTIVE', `comment` varchar(255) null, `added_by` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  2023_01_08_153914_department ...........................................................................................................  
  ⇂ create table `department` (`id` int unsigned not null auto_increment primary key, `department_name` varchar(255) null, `created_by` bigint unsigned not null, `remarks` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  ⇂ alter table `department` add index `fk_entered_by_id_1_idx`(`created_by`)  
  ⇂ alter table `department` add constraint `fk_entered_by_id_1_idx` foreign key (`created_by`) references `users` (`id`) on delete no action on update no action  
  2023_01_08_153922_unit .................................................................................................................  
  ⇂ create table `unit` (`id` int unsigned not null auto_increment primary key, `department_id` int unsigned null, `unit_name` varchar(255) null, `remarks` varchar(255) null, `created_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  ⇂ alter table `unit` add index `fk_department_id_1_idx`(`department_id`)  
  ⇂ alter table `unit` add index `fk_entered_by_id_2_idx`(`created_by`)  
  ⇂ alter table `unit` add constraint `fk_department_id_1_idx` foreign key (`department_id`) references `department` (`id`) on delete no action on update no action  
  ⇂ alter table `unit` add constraint `fk_entered_by_id_2_idx` foreign key (`created_by`) references `users` (`id`) on delete no action on update no action  
  2023_01_09_063750_budget ...............................................................................................................  
  ⇂ create table `budget` (`id` bigint unsigned not null auto_increment primary key, `budget_year` bigint unsigned null, `code` varchar(255) null, `remarks` varchar(255) null, `appropriated_amount` double null, `status` varchar(255) not null default 'INACTIVE', `created_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  ⇂ alter table `budget` add index `fk_budget_year_id_4_idx`(`budget_year`)  
  ⇂ alter table `budget` add constraint `fk_budget_year_id_4_idx` foreign key (`budget_year`) references `accounting_year` (`id`) on delete no action on update no action  
  ⇂ alter table `budget` add index `fk_entered_by_id_3_idx`(`created_by`)  
  ⇂ alter table `budget` add constraint `fk_entered_by_id_3_idx` foreign key (`created_by`) references `users` (`id`) on delete no action on update no action  
  2023_01_09_123322_subhead ..............................................................................................................  
  ⇂ create table `subhead` (`id` int unsigned not null auto_increment primary key, `subhead_code` varchar(255) null, `subhead_name` varchar(255) null, `department_id` varchar(32) null, `approved_provision` varchar(255) null, `revised_provision` varchar(255) null, `remarks` varchar(255) null, `status` varchar(255) not null default 'ACTIVE', `created_by` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  ⇂ alter table `subhead` add index `fk_entered_by_id_4_idx`(`created_by`)  
  ⇂ alter table `subhead` add constraint `fk_entered_by_id_4_idx` foreign key (`created_by`) references `users` (`id`) on delete no action on update no action  
  2023_03_28_101501_ecf ..................................................................................................................  
  ⇂ create table `ecf` (`id` int unsigned not null auto_increment primary key, `department_id` varchar(32) null, `head_id` varchar(255) null, `subhead_id` varchar(255) null, `expenditure_item` varchar(255) null, `payee_id` varchar(255) null, `approved_provision` varchar(255) null, `revised_provision` varchar(255) null, `present_requisition` varchar(255) null, `status` varchar(255) not null default 'PENDING APPROVAL', `checked_by` bigint unsigned null, `prepared_by` bigint unsigned null, `budget_id` bigint unsigned null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  ⇂ alter table `ecf` add index `fk_prepared_by_id_4_idx`(`prepared_by`)  
  ⇂ alter table `ecf` add constraint `fk_prepared_by_id_4_idx` foreign key (`prepared_by`) references `users` (`id`) on delete no action on update no action  
  ⇂ alter table `ecf` add index `fk_checked_by_id_4_idx`(`checked_by`)  
  ⇂ alter table `ecf` add constraint `fk_checked_by_id_4_idx` foreign key (`checked_by`) references `users` (`id`) on delete no action on update no action  
  ⇂ alter table `ecf` add index `fk_budget_id_id_4_idx`(`budget_id`)  
  ⇂ alter table `ecf` add constraint `fk_budget_id_id_4_idx` foreign key (`budget_id`) references `budget` (`id`) on delete no action on update no action  
  2023_03_28_110401_country_state_lga ....................................................................................................  
  ⇂ create table `countries` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ create table `states` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `country_id` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  ⇂ create table `cities` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `state_id` int not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'  
  2023_04_16_063409_fundproject ..........................................................................................................  
  ⇂ create table `project_funding` (`id` int unsigned not null auto_increment primary key, `project_id` varchar(255) null, `budget_id` varchar(32) null, `amount` varchar(255) null, `comment` varchar(255) null, `added_by` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  2023_04_16_063506_payee ................................................................................................................  
  ⇂ create table `payee` (`id` int unsigned not null auto_increment primary key, `payee_name` varchar(255) null, `payee_account_number` varchar(255) null, `payee_account_name` varchar(255) null, `payee_bank` varchar(255) null, `payee_phone_number` varchar(255) null, `added_by` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  2023_04_16_063519_contractor ...........................................................................................................  
  ⇂ create table `contractor` (`id` int unsigned not null auto_increment primary key, `company_name` varchar(255) not null, `contractor_name` varchar(255) null, `contractor_account_number` varchar(255) null, `contractor_account_name` varchar(255) null, `contractor_bank` varchar(255) null, `contractor_phone_number` varchar(255) null, `added_by` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  ⇂ alter table `contractor` add unique `contractor_company_name_unique`(`company_name`)  
  2023_04_17_033211_project_report .......................................................................................................  
  ⇂ create table `project_report` (`id` int unsigned not null auto_increment primary key, `project_id` varchar(255) null, `observations` varchar(255) null, `challenges` varchar(255) null, `recommendations` varchar(255) null, `image_id` varchar(255) null, `added_by` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  2023_04_17_034418_project_images .......................................................................................................  
  ⇂ create table `project_images` (`id` int unsigned not null auto_increment primary key, `project_id` varchar(255) null, `image_name` varchar(255) null, `image_location` varchar(255) null, `added_by` varchar(255) null, `created_at` timestamp null, `updated_at` timestamp null, `deleted_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB  
  2023_05_12_092524_update_payee_phone_number ............................................................................................  
  ⇂ alter table `payee` add `alternate_phone_number` varchar(255) null  
  2023_05_12_143606_update_contractor_phone_number .......................................................................................  


