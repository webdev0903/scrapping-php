<?php

 $qry = "CREATE TABLE IF NOT EXISTS ".$DB_tableName1." (
	   commercial__scrapedID INT NOT NULL AUTO_INCREMENT,


        commercial__scrapedURL text NOT NULL,
        commercial__NumTrailerParkingSpots text NOT NULL,
        commercial__Building text NOT NULL,
        commercial__Address text NOT NULL,
        commercial__AirConditioning text NOT NULL,
        commercial__Amps text NOT NULL,
        commercial__ApproxAge text NOT NULL,
        commercial__AptUnit text NOT NULL,
        commercial__Area text NOT NULL,
        commercial__AreaCode text NOT NULL,
        commercial__AreaInfluences1 text NOT NULL,
        commercial__AreaInfluences2 text NOT NULL,
        commercial__Assessment text NOT NULL,
        commercial__AssessmentYear text NOT NULL,
        commercial__Basement1 text NOT NULL,
        commercial__BaySizeLengthFeet text NOT NULL,
        commercial__BaySizeLengthInches text NOT NULL,
        commercial__BaySizeWidthFeet text NOT NULL,
        commercial__BaySizeWidthInches text NOT NULL,
        commercial__BusinessBuildingName text NOT NULL,
        commercial__Category text NOT NULL,
        commercial__Chattels text NOT NULL,
        commercial__ClearHeightFeet text NOT NULL,
        commercial__ClearHeightInches text NOT NULL,
        commercial__CommercialCondoFees text NOT NULL,
        commercial__CommonAreaUpcharge text NOT NULL,
        commercial__Community text NOT NULL,
        commercial__CommunityCode text NOT NULL,
        commercial__Crane text NOT NULL,
        commercial__DaysOpen text NOT NULL,
        commercial__DirectionsCrossStreets text NOT NULL,
        commercial__DisplayAddressOnInternet text NOT NULL,
        commercial__DoubleManShippingDoorsNum text NOT NULL,
        commercial__DoubleManShippingDoorsHeightFeet text NOT NULL,
        commercial__DoubleManShippingDoorsHeightInches text NOT NULL,
        commercial__DoubleManShippingDoorsWidthFeet text NOT NULL,
        commercial__DoubleManShippingDoorsWidthInches text NOT NULL,
        commercial__Drive_InLevelShippingDoors text NOT NULL,
        commercial__Drive_InLevelShippingDoorsHeightFeet text NOT NULL,
        commercial__Drive_InLevelShippingDoorsHeightInches text NOT NULL,
        commercial__Drive_InLevelShippingDoorsWidthFeet text NOT NULL,
        commercial__Drive_InLevelShippingDoorsWidthInches text NOT NULL,
        commercial__Elevator text NOT NULL,
        commercial__Employees text NOT NULL,
        commercial__EstimInventoryValuesAtCost text NOT NULL,
        commercial__ExpensesActualEstimated text NOT NULL,
        commercial__Extras text NOT NULL,
        commercial__FinancialStatement text NOT NULL,
        commercial__Franchise text NOT NULL,
        commercial__Freestanding text NOT NULL,
        commercial__GarageType text NOT NULL,
        commercial__GradeLevelShippingDoorsNum text NOT NULL,
        commercial__GradeLevelShippingDoorsHeightFeet text NOT NULL,
        commercial__GradeLevelShippingDoorsHeightInches text NOT NULL,
        commercial__GradeLevelShippingDoorsWidthFeet text NOT NULL,
        commercial__GradeLevelShippingDoorsWidthInches text NOT NULL,
        commercial__GrossIncomeSales text NOT NULL,
        commercial__HeatExpenses text NOT NULL,
        commercial__HeatType text NOT NULL,
        commercial__HoursOpen text NOT NULL,
        commercial__HydroExpense text NOT NULL,
        commercial__IDXupdateddate text NOT NULL,
        commercial__IndustrialArea text NOT NULL,
        commercial__IndustrialAreaCode text NOT NULL,
        commercial__InsuranceExpense text NOT NULL,
        commercial__LegalDescription text NOT NULL,
        commercial__ListBrokerage text NOT NULL,
        commercial__ListPrice text NOT NULL,
        commercial__ListPriceCode text NOT NULL,
        commercial__LLBO text NOT NULL,
        commercial__LotDepth text NOT NULL,
        commercial__LotFront text NOT NULL,
        commercial__LotIrregularities text NOT NULL,
        commercial__LotSizeCode text NOT NULL,
        commercial__LotBldgUnitCode text NOT NULL,
        commercial__Maintenance text NOT NULL,
        commercial__ManagementExpense text NOT NULL,
        commercial__MapNum text NOT NULL,
        commercial__MapColumnNum text NOT NULL,
        commercial__MapRow text NOT NULL,
        commercial__MaximumRentalTerm text NOT NULL,
        commercial__MinimumRentalTerm text NOT NULL,
        commercial__MLSNum text NOT NULL,
        commercial__Municipality text NOT NULL,
        commercial__MunicipalityDistrict text NOT NULL,
        commercial__MunicpCode text NOT NULL,
        commercial__NetIncomeBeforeDebt text NOT NULL,
        commercial__Occupancy text NOT NULL,
        commercial__OfficeAptArea text NOT NULL,
        commercial__OfficeAptAreaCode text NOT NULL,
        commercial__OperatingExpenses text NOT NULL,
        commercial__OtherExpenses text NOT NULL,
        commercial__OutofAreaMunicipality text NOT NULL,
        commercial__OutsideStorage text NOT NULL,
        commercial__ParkingSpaces text NOT NULL,
        commercial__PercentageRent text NOT NULL,
        commercial__PINNum text NOT NULL,
        commercial__Pixupdateddate text NOT NULL,
        commercial__PostalCode text NOT NULL,
        commercial__Province text NOT NULL,
        commercial__Rail text NOT NULL,
        commercial__RemarksForClients text NOT NULL,
        commercial__RetailArea text NOT NULL,
        commercial__RetailAreaCode text NOT NULL,
        commercial__SaleLease text NOT NULL,
        commercial__Seats text NOT NULL,
        commercial__SellerPropertyInfoStatement text NOT NULL,
        commercial__Sewers text NOT NULL,
        commercial__SoilTest text NOT NULL,
        commercial__Sprinklers text NOT NULL,
        commercial__Status text NOT NULL,
        commercial__StreetNum text NOT NULL,
        commercial__StreetAbbreviation text NOT NULL,
        commercial__StreetDirection text NOT NULL,
        commercial__StreetName text NOT NULL,
        commercial__Survey text NOT NULL,
        commercial__TaxYear text NOT NULL,
        commercial__Taxes text NOT NULL,
        commercial__TaxesExpense text NOT NULL,
        commercial__TotalArea text NOT NULL,
        commercial__TotalAreaCode text NOT NULL,
        commercial__TruckLevelShippingDoorsNum text NOT NULL,
        commercial__TruckLevelShippingDoorsHeightFeet text NOT NULL,
        commercial__TruckLevelShippingDoorsHeightInches text NOT NULL,
        commercial__TruckLevelShippingDoorsWidthFeet text NOT NULL,
        commercial__TruckLevelShippingDoorsWidthInches text NOT NULL,
        commercial__Type text NOT NULL,
        commercial__TypeTaxes text NOT NULL,
        commercial__UFFI text NOT NULL,
        commercial__Updatedtimestamp text NOT NULL,
        commercial__Use text NOT NULL,
        commercial__Utilities text NOT NULL,
        commercial__VacancyAllowance text NOT NULL,
        commercial__VirtualTourUploadDate text NOT NULL,
        commercial__VirtualTourURL text NOT NULL,
        commercial__Volts text NOT NULL,
        commercial__Washrooms text NOT NULL,
        commercial__Water text NOT NULL,
        commercial__WaterExpense text NOT NULL,
        commercial__WaterSupplyTypes text NOT NULL,
        commercial__YearExpenses text NOT NULL,
        commercial__Zoning text NOT NULL,
        commercial__gmap_lat text NOT NULL,
        commercial__gmap_long text NOT NULL,
        commercial__gmap_precision text NOT NULL,
        commercial__photocount text NOT NULL,
        commercial__Floor text NOT NULL,
        commercial__Floors text NOT NULL,
        commercial__GrossRentPerSqFt text NOT NULL,
        commercial__BaseRentPerSqFt text NOT NULL,
        commercial__AdditionalRentPerSqFt text NOT NULL,
        commercial__MaxContiguousSqFt text NOT NULL,
        commercial__SourceLastUpdated text NOT NULL,
        commercial__BuildingClass text NOT NULL,
        commercial__TotalAvailableSpaceSqFt text NOT NULL,

	PRIMARY KEY (id)
	)
	ENGINE=MyISAM DEFAULT CHARSET=utf8
	;";

$db->select($qry);


 $qry = "CREATE TABLE IF NOT EXISTS ".$DB_tableName2." (
	    id INT NOT NULL AUTO_INCREMENT,

         id_proprety text NOT NULL,
         file_name text NOT NULL,

	PRIMARY KEY (id)
	)
	ENGINE=MyISAM DEFAULT CHARSET=utf8
	;";

$db->select($qry);

// echo $qry.'<br>';
?>



