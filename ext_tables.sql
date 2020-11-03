#
# Table structure for table 'tx_contributorycalculator_domain_model_care'
#
CREATE TABLE tx_contributorycalculator_domain_model_care (
  title varchar(50) DEFAULT '' NOT NULL,
  value_above_3 varchar(6) DEFAULT '0,00' NOT NULL,
  value_below_3 varchar(6) DEFAULT '0,00' NOT NULL
);
