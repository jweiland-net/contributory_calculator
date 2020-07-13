#
# Table structure for table 'tx_contributorycalculator_domain_model_chargeableincome'
#
CREATE TABLE tx_contributorycalculator_domain_model_chargeableincome (
	minimal_income int(11) DEFAULT '0' NOT NULL,
	maximal_income int(11) DEFAULT '0' NOT NULL,
	discount_in_percent int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_contributorycalculator_domain_model_step'
#
CREATE TABLE tx_contributorycalculator_domain_model_step (
	name varchar(255) DEFAULT '' NOT NULL,
	discount_in_percent int(11) DEFAULT '0' NOT NULL
);
