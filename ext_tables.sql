#
# Table structure for table 'tx_contributorycalculator_domain_model_care'
#
CREATE TABLE tx_contributorycalculator_domain_model_care
(
	title             varchar(50) DEFAULT '' NOT NULL,
	calculation_bases text
);

#
# Table structure for table 'tx_contributorycalculator_domain_model_calculationbase'
#
CREATE TABLE tx_contributorycalculator_domain_model_calculationbase
(
	year_of_validity int   DEFAULT 0   NOT NULL,
	value_below_3    float DEFAULT '0' NOT NULL,
	value_above_3    float DEFAULT '0' NOT NULL,
	care_form        int   DEFAULT 0   NOT NULL,
	minimal_income   int   DEFAULT 0   NOT NULL,
	maximum_income   int   DEFAULT 0   NOT NULL
);
