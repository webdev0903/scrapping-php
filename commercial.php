<?php


ini_set('max_execution_time', 6000); //300 seconds = 5 minutes

if($debug=='yes')
{
	error_reporting(E_ERROR | E_PARSE);
	//error_reporting(0);
	
	ini_set('display_errors', 1);
	
}

ini_set("memory_limit","1024M");

date_default_timezone_set('America/New_York');

include 'lib/Database.class.php';
include 'lib/simple_html_dom.php';
include 'lib/cURL.php';
include 'lib/http_connection.php';

$html1 = new simple_html_dom();
$html2 = new simple_html_dom();
$html3 = new simple_html_dom();
$html4 = new simple_html_dom();
$html5 = new simple_html_dom();
$html6 = new simple_html_dom();
$html7 = new simple_html_dom();

// make allowance for parameters to be passed via command line PHP
	if (PHP_SAPI === 'cli') {
		
		$scrapePhotos	= $argv[1];
		$debug			= $argv[2];

	}
	else
	{
		
		$scrapePhotos	= $_GET['scrapePhotos'];
		$debug			= $_GET['debug'];

	}



$db = new Database();
include 'createTable.php';

$qry_delete="delete from scraped_commercial";
$db->delete($qry_delete);
if($debug=='yes') 
{
	echo "<p>Query: $qry_delete </p>"; 
	//exit;
}


$file2 = __DIR__."/resources/url.txt";
$fh = fopen($file2,'r');



$t=0;
$tab = array();
while($line = fgets($fh)){
	$exploded=explode('|',$line);
	$MunicipalityDistrict=$exploded[0];
	$url=trim($exploded[1]);
	$tab[$t]['MunicipalityDistrict'] = $MunicipalityDistrict;
	$tab[$t]['url']=$url;
	$t++;
}
fclose($fh);

//echo '<pre>';print_r($tab);
//exit;

for($a=0;$a<count($tab);$a++){
	$MunicipalityDistrict = $tab[$a]['MunicipalityDistrict'];

	$url1 = $tab[$a]['url'];

	$str1= get($url1,'','','','','','');
	$json = json_decode($str1);

	echo "<p> url1: $url1 </p>";
	//echo '<pre>';print_r($json); die;

	$total = $json->meta->total;

	$nbr_page = ceil(intval($total)/20);
	$n1=1;
	if($nbr_page>1){

		
		for($k=1;$k<($nbr_page+1);$k++){
			//echo '$page ='.$k.'<br>';
			$url1 = $url1.'&page='.$k;
			$str1= get($url1,'','','','','','');
			$json = json_decode($str1);


		if($debug=='yes')
		{
			echo "<p> url1: $url1 </p>";
			
			echo "<pre>";
			print_r($json->results);
			echo "</pre>";
			//exit;
		}

			if(!empty ($json->results)){
				$result = $json->results;

				for($b=0;$b<count($result);$b++){
					$scrapedURL = '';
					$scrapedID = '';
					$commercial__Address = '';
					$commercial__Building = '';
					$commercial__ApproxAge = '';
					$commercial__AptUnit = '';
					$commercial__Area = '';
					$commercial__AreaCode = '';
					$commercial__AreaInfluences1 = '';
					$commercial__AreaInfluences2 = '';
					$commercial__Assessment = '';
					$commercial__AssessmentYear = '';
					$commercial__Basement1 = '';
					$commercial__BaySizeLengthFeet = '';
					$commercial__BaySizeLengthInches = '';
					$commercial__BaySizeWidthFeet = '';
					$commercial__BaySizeWidthInches = '';
					$commercial__BusinessBuildingName = '';
					$commercial__Category = '';
					$commercial__Chattels = '';
					$commercial__ClearHeightFeet = '';
					$commercial__ClearHeightInches = '';
					$commercial__CommercialCondoFees = '';
					$commercial__CommonAreaUpcharge = '';
					$commercial__Community = '';
					$commercial__CommunityCode = '';
					$commercial__Crane = '';
					$commercial__DaysOpen = '';
					$commercial__DirectionsCrossStreets = '';
					$commercial__DisplayAddressOnInternet = '';
					$commercial__DoubleManShippingDoorsNum = '';
					$commercial__DoubleManShippingDoorsHeightFeet = '';
					$commercial__DoubleManShippingDoorsHeightInches = '';
					$commercial__DoubleManShippingDoorsWidthFeet = '';
					$commercial__DoubleManShippingDoorsWidthInches = '';
					$commercial__Drive_InLevelShippingDoors = '';
					$commercial__Drive_InLevelShippingDoorsHeightFeet = '';
					$commercial__Drive_InLevelShippingDoorsHeightInches = '';
					$commercial__Drive_InLevelShippingDoorsWidthFeet = '';
					$commercial__Drive_InLevelShippingDoorsWidthInches = '';
					$commercial__Elevator = '';
					$commercial__Employees = '';
					$commercial__EstimInventoryValuesAtCost = '';
					$commercial__ExpensesActualEstimated = '';
					$commercial__Extras = '';
					$commercial__FinancialStatement = '';
					$commercial__Franchise = '';
					$commercial__Freestanding = '';
					$commercial__GarageType = '';
					$commercial__GradeLevelShippingDoorsNum = '';
					$commercial__GradeLevelShippingDoorsHeightFeet = '';
					$commercial__GradeLevelShippingDoorsHeightInches = '';
					$commercial__GradeLevelShippingDoorsWidthFeet = '';
					$commercial__GradeLevelShippingDoorsWidthInches = '';
					$commercial__GrossIncomeSales = '';
					$commercial__HeatExpenses = '';
					$commercial__HeatType = '';
					$commercial__HoursOpen = '';
					$commercial__HydroExpense = '';
					$commercial__IDXupdateddate = '';
					$commercial__IndustrialArea = '';
					$commercial__IndustrialAreaCode = '';
					$commercial__InsuranceExpense = '';
					$commercial__LegalDescription = '';
					$commercial__LLBO = '';
					$commercial__LotDepth = '';
					$commercial__LotFront = '';
					$commercial__LotIrregularities = '';
					$commercial__LotSizeCode = '';
					$commercial__LotBldgUnitCode = '';
					$commercial__Maintenance = '';
					$commercial__ManagementExpense = '';
					$commercial__MapNum = '';
					$commercial__MapColumnNum = '';
					$commercial__MapRow = '';
					$commercial__MaximumRentalTerm = '';
					$commercial__MinimumRentalTerm = '';
					$commercial__MLSNum = '';
					$commercial__Municipality = '';
					$commercial__OfficeAptArea = '';
					$commercial__OfficeAptAreaCode = '';
					$commercial__OperatingExpenses = '';
					$commercial__OtherExpenses = '';
					$commercial__OutofAreaMunicipality = '';
					$commercial__OutsideStorage = '';
					$commercial__ParkingSpaces = '';
					$commercial__PercentageRent = '';
					$commercial__PINNum = '';
					$commercial__Pixupdateddate = '';
					$commercial__PostalCode = '';
					$commercial__Province = '';
					$commercial__RemarksForClients = '';
					$commercial__RetailArea = '';
					$commercial__RetailAreaCode = '';
					$commercial__SaleLease = '';
					$commercial__Seats = '';
					$commercial__SellerPropertyInfoStatement = '';
					$commercial__Sewers = '';
					$commercial__SoilTest = '';
					$commercial__Sprinklers = '';
					$commercial__StreetNum = '';
					$commercial__StreetAbbreviation = '';
					$commercial__StreetDirection = '';
					$commercial__Survey = '';
					$commercial__TaxYear = '';
					$commercial__Taxes = '';
					$commercial__TaxesExpense = '';
					$commercial__TotalArea = '';
					$commercial__TotalAreaCode = '';
					$commercial__TruckLevelShippingDoorsNum = '';
					$commercial__TruckLevelShippingDoorsHeightFeet = '';
					$commercial__TruckLevelShippingDoorsHeightInches = '';
					$commercial__TruckLevelShippingDoorsWidthFeet = '';
					$commercial__TruckLevelShippingDoorsWidthInches = '';
					$commercial__Type = '';
					$commercial__TypeTaxes = '';
					$commercial__UFFI = '';
					$commercial__Updatedtimestamp = '';
					$commercial__Use = '';
					$commercial__Utilities = '';
					$commercial__VacancyAllowance = '';
					$commercial__VirtualTourUploadDate = '';
					$commercial__VirtualTourURL = '';
					$commercial__Volts = '';
					$commercial__Washrooms = '';
					$commercial__Water = '';
					$commercial__WaterExpense = '';
					$commercial__WaterSupplyTypes = '';
					$commercial__YearExpenses = '';
					$commercial__Zoning = '';
					$commercial__gmap_lat = '';
					$commercial__gmap_long = '';
					$commercial__gmap_precision = '';
					$commercial__Floor = '';
					$commercial__Floors = '';
					$commercial__GrossRentPerSqFt = '';
					$commercial__BaseRentPerSqFt = '';
					$commercial__AdditionalRentPerSqFt = '';
					$commercial__MaxContiguousSqFt = '';
					$commercial__BuildingClass = '';
					$commercial__ListPrice = '';

					if(!empty ($json->results[$b]->property->description)){
						$commercial__Building = $json->results[$b]->property->description;
					}
					if(!empty ($json->results[$b]->property->year_built)){
						$commercial__ApproxAge = $json->results[$b]->property->year_built;
					}
					if(!empty ($json->results[$b]->suite_number)){
						$commercial__AptUnit = $json->results[$b]->suite_number;
					}
					
					if(!empty ($json->results[$b]->property->regions)){
						foreach ($json->results[$b]->property->regions as $region)
						{
						$commercial__Area.= "|".$region->name;
						}
					}
					
					if(!empty ($json->results[$b]->property_type->value)){
						$commercial__Category = $json->results[$b]->property_type->value;
					}
					if(!empty ($json->results[$b]->calculated_price)){
						$commercial__ListPrice = $json->results[$b]->calculated_price;
						$commercial__ListPrice = preg_replace("/\.(.*)/i", "", $commercial__ListPrice);
					}
					if(!empty ($json->results[$b]->property->city->name)){
						$commercial__Municipality = $json->results[$b]->property->city->name;
					}
					if(!empty ($json->results[$b]->property->postal_code)){
						$commercial__PostalCode = $json->results[$b]->property->postal_code;
					}
					if(!empty ($json->results[$b]->property->province->name)){
						$commercial__Province = $json->results[$b]->property->province->name;
					}
					if(!empty ($json->results[$b]->{'description'})){
						$commercial__RemarksForClients = $json->results[$b]->{'description'};
					}
					if(!empty ($json->results[$b]->property->{'address'})){
						$commercial__Address = $json->results[$b]->property->{'address'};
						$StreetAbbreviation = $json->results[$b]->property->{'address'};
						$Abbreviation = explode(' ', $StreetAbbreviation);
						$commercial__StreetAbbreviation = array_pop($Abbreviation);
						$commercial__StreetName=$commercial__Address;

					}

					
					if(!empty ($json->results[$b]->for_sale)){
						$commercial__SaleLease = "sale";
					}

					if(!empty ($json->results[$b]->for_lease)){
						$commercial__SaleLease .= "lease";
					}
					
					
					if(!empty ($json->results[$b]->square_footage)){
						$commercial__TotalArea = $json->results[$b]->square_footage;
					}
					if(!empty ($json->results[$b]->property->Zoning)){
						$commercial__Zoning = $json->results[$b]->property->Zoning;
					}
					if(!empty ($json->results[$b]->floor)){
						$commercial__Floor = $json->results[$b]->floor;
					}
					if(!empty ($json->results[$b]->property->num_floors)){
						$commercial__Floors = $json->results[$b]->property->num_floors;
					}
					if(!empty ($json->results[$b]->base_rent)){
						$commercial__BaseRentPerSqFt = $json->results[$b]->base_rent;
					}
					if(!empty ($json->results[$b]->{'additional_rent'})){
						$commercial__AdditionalRentPerSqFt = $json->results[$b]->{'additional_rent'};
					}
					if(!empty ($json->results[$b]->{'calculated_sqft_yr_price'})){
						$commercial__GrossRentPerSqFt = $json->results[$b]->{'calculated_sqft_yr_price'};
					}
					if(!empty ($json->results[$b]->square_footage)){
						$commercial__MaxContiguousSqFt = $json->results[$b]->square_footage;
					}
					if(!empty ($json->results[$b]->property->building_class)){
						$commercial__BuildingClass = $json->results[$b]->property->building_class;
					}
					if(!empty ($result[$b]->friendly_path)){
						$scrapedURL = 'https://spacelist.ca'.$result[$b]->friendly_path;
					}
					if(!empty ($json->results[$b]->id)){
						$scrapedID = $json->results[$b]->id;
					}
					if(!empty ($json->results[$b]->location)){
						$commercial__gmap_long = $json->results[$b]->location[0];
						$commercial__gmap_lat = $json->results[$b]->location[1];
					}
					 

					$str2= get($scrapedURL,'','','','','','');
					$html2->load($str2);

					$commercial__NumTrailerParkingSpots = "";
					$commercial__AirConditioning = '';
					$commercial__Amps = '';
					$commercial__ListBrokerage ='' ;
					$commercial__ListPriceCode = '';
					$commercial__MunicipalityDistrict = $MunicipalityDistrict;
					$commercial__MunicpCode = '';
					$commercial__NetIncomeBeforeDebt = '';
					$commercial__Occupancy = '';
					$commercial__Rail = '';
					//$commercial__RemarksForClients = '';
					$commercial__SourceLastUpdated = '';
					$y=1;
					$class2 = 'div[class="columns"] div[class="row"] div[class="columns small-12 large-6 gray stats"] ul li';
					foreach($html2->find($class2) as $d2){
						if(!empty($d2->find('span',0))){

							if(preg_match('/^Source$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
								if(!empty($d2->find('span',1))){
									$commercial__ListBrokerage = trim(html_entity_decode($d2->find('span',1)->plaintext));
								}
							}
							if(preg_match('/^Lease$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
								if(!empty($d2->find('span',1))){
									$commercial__ListPriceCode = trim(html_entity_decode($d2->find('span',1)->plaintext));
								}
							}
							if(preg_match('/^Availability$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
								if(!empty($d2->find('span',1))){
									$commercial__Occupancy = trim(html_entity_decode($d2->find('span',1)->plaintext));
								}
							}
							if(preg_match('/^Last Updated$/i', trim(html_entity_decode($d2->find('span[class="stats-key"]',0)->plaintext)))){
								if(!empty($d2->find('span',1))){
									$date = trim(html_entity_decode($d2->find('span',1)->plaintext));
									$commercial__SourceLastUpdated = date("Y-m-d", strtotime($date));
								}
							}
						}
					}
					$image = '';
					$file_name = '';
					$commercial__photocount = 0;


					 if($scrapePhotos!='no')
					 {

						$class2 = 'div[class="photos cycle-slideshow"] div';
						foreach($html2->find($class2) as $d2){
	
							if(!empty($d2->{'data-thumb'})){
								$image = trim(html_entity_decode($d2->{'data-thumb'}));
	
								$path = __DIR__."/idxphotos/";
								if(!file_exists($path)){
									mkdir($path,0755,TRUE);
								}
	
								$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
								$context = stream_context_create($opts);
								$file = file_get_contents($image,false,$context);

								if($file===false) $scrapedPhotoStatus='fail';
								
								if($y<10){
									$file_name = $scrapedID.'_'.'0'.$y.".jpg";
									file_put_contents($path.$file_name,$file);
								}elseif($y>=10){
									$file_name = $scrapedID.'_'.$y.".jpg";
									file_put_contents($path.$file_name,$file);
	
								echo "<p>".$path.$file_name."</p>";
	
								}
	
								$qry =  "INSERT INTO `".$DB_tableName2."`(`id`, `scrapedID`, `file_name`,`scrapedURL`,`dateLastScraped`,scrapedPhotoStatus) VALUES (NULL,
								'".mysql_escape_string($scrapedID)."',
								'".mysql_escape_string($file_name)."',
								'$scrapedURL','".date('Y-m-d-H-i-s')."','$scrapedPhotoStatus');";
	
								$db->insert($qry);
								if($debug=='yes') echo '$qry0'. $qry.'<br>';
								$y++;
							}
							$scrapedPhotoStatus='';
							$commercial__photocount = $y-1;

						}
					 }
					 

					 
					$TotalAvailableSpaceSqFt = '';
					$commercial__Status = '';
					$commercial__TotalAvailableSpaceSqFt = '';
					$class2 = 'div[class="columns large-12 gray padded"] div[class="stats"] ul li';
					foreach($html2->find($class2) as $d2){
						if(!empty($d2->find('span',0))){
							if(preg_match('/^Status$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
								if(!empty($d2->find('span',1))){
									$commercial__Status = trim(html_entity_decode($d2->find('span',1)->plaintext));
								}
							}
							if(preg_match('/^Total Available Space$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
								if(!empty($d2->find('span',1))){
									$commercial__TotalAvailableSpaceSqFt = trim(html_entity_decode($d2->find('span',1)->plaintext));
									$commercial__TotalAvailableSpaceSqFt = trim(html_entity_decode(preg_replace("/\D+/i", "", $commercial__TotalAvailableSpaceSqFt)));
								}
							}
						}
					}
				 
					$qry =  "INSERT INTO `".$DB_tableName1."`(`commercial__dateLastScraped`,`commercial__scrapedID`, `commercial__scrapedURL`, `commercial__NumTrailerParkingSpots`, `commercial__Building`,
					`commercial__Address`, `commercial__AirConditioning`, `commercial__Amps`, `commercial__ApproxAge`, `commercial__AptUnit`,
					`commercial__Area`, `commercial__AreaCode`, `commercial__AreaInfluences1`, `commercial__AreaInfluences2`,
					`commercial__Assessment`, `commercial__AssessmentYear`, `commercial__Basement1`, `commercial__BaySizeLengthFeet`,
					`commercial__BaySizeLengthInches`, `commercial__BaySizeWidthFeet`, `commercial__BaySizeWidthInches`,
					`commercial__BusinessBuildingName`, `commercial__Category`, `commercial__Chattels`, `commercial__ClearHeightFeet`,
					`commercial__ClearHeightInches`, `commercial__CommercialCondoFees`, `commercial__CommonAreaUpcharge`, `commercial__Community`,
					`commercial__CommunityCode`, `commercial__Crane`, `commercial__DaysOpen`, `commercial__DirectionsCrossStreets`,
					`commercial__DisplayAddressOnInternet`, `commercial__DoubleManShippingDoorsNum`, `commercial__DoubleManShippingDoorsHeightFeet`,
					`commercial__DoubleManShippingDoorsHeightInches`, `commercial__DoubleManShippingDoorsWidthFeet`,
					`commercial__DoubleManShippingDoorsWidthInches`, `commercial__Drive_InLevelShippingDoors`,
					`commercial__Drive_InLevelShippingDoorsHeightFeet`, `commercial__Drive_InLevelShippingDoorsHeightInches`,
					`commercial__Drive_InLevelShippingDoorsWidthFeet`, `commercial__Drive_InLevelShippingDoorsWidthInches`,
					`commercial__Elevator`, `commercial__Employees`, `commercial__EstimInventoryValuesAtCost`,
					`commercial__ExpensesActualEstimated`, `commercial__Extras`, `commercial__FinancialStatement`,
					`commercial__Franchise`, `commercial__Freestanding`, `commercial__GarageType`,
					`commercial__GradeLevelShippingDoorsNum`, `commercial__GradeLevelShippingDoorsHeightFeet`,
					`commercial__GradeLevelShippingDoorsHeightInches`, `commercial__GradeLevelShippingDoorsWidthFeet`,
					`commercial__GradeLevelShippingDoorsWidthInches`, `commercial__GrossIncomeSales`, `commercial__HeatExpenses`,
					`commercial__HeatType`, `commercial__HoursOpen`, `commercial__HydroExpense`, `commercial__IDXupdateddate`,
					`commercial__IndustrialArea`, `commercial__IndustrialAreaCode`, `commercial__InsuranceExpense`, `commercial__LegalDescription`,
					`commercial__ListBrokerage`, `commercial__ListPrice`, `commercial__ListPriceCode`, `commercial__LLBO`,
					`commercial__LotDepth`, `commercial__LotFront`, `commercial__LotIrregularities`, `commercial__LotSizeCode`,
					`commercial__LotBldgUnitCode`, `commercial__Maintenance`, `commercial__ManagementExpense`, `commercial__MapNum`,
					`commercial__MapColumnNum`, `commercial__MapRow`, `commercial__MaximumRentalTerm`, `commercial__MinimumRentalTerm`,
					`commercial__MLSNum`, `commercial__Municipality`, `commercial__MunicipalityDistrict`, `commercial__MunicpCode`,
					`commercial__NetIncomeBeforeDebt`, `commercial__Occupancy`, `commercial__OfficeAptArea`, `commercial__OfficeAptAreaCode`,
					`commercial__OperatingExpenses`, `commercial__OtherExpenses`, `commercial__OutofAreaMunicipality`,
					`commercial__OutsideStorage`, `commercial__ParkingSpaces`, `commercial__PercentageRent`, `commercial__PINNum`,
					`commercial__Pixupdateddate`, `commercial__PostalCode`, `commercial__Province`, `commercial__Rail`,
					`commercial__RemarksForClients`, `commercial__RetailArea`, `commercial__RetailAreaCode`, `commercial__SaleLease`,
					`commercial__Seats`, `commercial__SellerPropertyInfoStatement`, `commercial__Sewers`, `commercial__SoilTest`,
					`commercial__Sprinklers`, `commercial__Status`, `commercial__StreetNum`, `commercial__StreetAbbreviation`,
					`commercial__StreetDirection`, `commercial__StreetName`, `commercial__Survey`, `commercial__TaxYear`,
					`commercial__Taxes`, `commercial__TaxesExpense`, `commercial__TotalArea`, `commercial__TotalAreaCode`,
					`commercial__TruckLevelShippingDoorsNum`, `commercial__TruckLevelShippingDoorsHeightFeet`,
					`commercial__TruckLevelShippingDoorsHeightInches`, `commercial__TruckLevelShippingDoorsWidthFeet`,
					`commercial__TruckLevelShippingDoorsWidthInches`, `commercial__Type`, `commercial__TypeTaxes`,
					`commercial__UFFI`, `commercial__Updatedtimestamp`, `commercial__Use`, `commercial__Utilities`,
					`commercial__VacancyAllowance`, `commercial__VirtualTourUploadDate`, `commercial__VirtualTourURL`,
					`commercial__Volts`, `commercial__Washrooms`, `commercial__Water`, `commercial__WaterExpense`,
					`commercial__WaterSupplyTypes`, `commercial__YearExpenses`, `commercial__Zoning`, `commercial__gmap_lat`,
					`commercial__gmap_long`, `commercial__gmap_precision`, `commercial__photocount`, `commercial__Floor`,
					`commercial__Floors`, `commercial__GrossRentPerSqFt`, `commercial__BaseRentPerSqFt`,
					`commercial__AdditionalRentPerSqFt`, `commercial__MaxContiguousSqFt`, `commercial__SourceLastUpdated`,
					`commercial__BuildingClass`, `commercial__TotalAvailableSpaceSqFt`) 
					VALUES (
					'".date('Y-m-d-H-i-s')."',
					'".mysql_escape_string($scrapedID)."',
					'".mysql_escape_string($scrapedURL)."',
					'".mysql_escape_string($commercial__NumTrailerParkingSpots)."',
					'".mysql_escape_string($commercial__Building)."',
					'".mysql_escape_string($commercial__Address)."',
					'".mysql_escape_string($commercial__AirConditioning)."',
					'".mysql_escape_string($commercial__Amps)."',
					'".mysql_escape_string($commercial__ApproxAge)."',
					'".mysql_escape_string($commercial__AptUnit)."',
					'".mysql_escape_string($commercial__Area)."',
					'".mysql_escape_string($commercial__AreaCode)."',
					'".mysql_escape_string($commercial__AreaInfluences1)."',
					'".mysql_escape_string($commercial__AreaInfluences2)."',
					'".mysql_escape_string($commercial__Assessment)."',
					'".mysql_escape_string($commercial__AssessmentYear)."',
					'".mysql_escape_string($commercial__Basement1)."',
					'".mysql_escape_string($commercial__BaySizeLengthFeet)."',
					'".mysql_escape_string($commercial__BaySizeLengthInches)."',
					'".mysql_escape_string($commercial__BaySizeWidthFeet)."',
					'".mysql_escape_string($commercial__BaySizeWidthInches)."',
					'".mysql_escape_string($commercial__BusinessBuildingName)."',
					'".mysql_escape_string($commercial__Category)."',
					'".mysql_escape_string($commercial__Chattels)."',
					'".mysql_escape_string($commercial__ClearHeightFeet)."',
					'".mysql_escape_string($commercial__ClearHeightInches)."',
					'".mysql_escape_string($commercial__CommercialCondoFees)."',
					'".mysql_escape_string($commercial__CommonAreaUpcharge)."',
					'".mysql_escape_string($commercial__Community)."',
					'".mysql_escape_string($commercial__CommunityCode)."',
					'".mysql_escape_string($commercial__Crane)."',
					'".mysql_escape_string($commercial__DaysOpen)."',
					'".mysql_escape_string($commercial__DirectionsCrossStreets)."',
					'".mysql_escape_string($commercial__DisplayAddressOnInternet)."',
					'".mysql_escape_string($commercial__DoubleManShippingDoorsNum)."',
					'".mysql_escape_string($commercial__DoubleManShippingDoorsHeightFeet)."',
					'".mysql_escape_string($commercial__DoubleManShippingDoorsHeightInches)."',
					'".mysql_escape_string($commercial__DoubleManShippingDoorsWidthFeet)."',
					'".mysql_escape_string($commercial__DoubleManShippingDoorsWidthInches)."',
					'".mysql_escape_string($commercial__Drive_InLevelShippingDoors)."',
					'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsHeightFeet)."',
					'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsHeightInches)."',
					'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsWidthFeet)."',
					'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsWidthInches)."',
					'".mysql_escape_string($commercial__Elevator)."',
					'".mysql_escape_string($commercial__Employees)."',
					'".mysql_escape_string($commercial__EstimInventoryValuesAtCost)."',
					'".mysql_escape_string($commercial__ExpensesActualEstimated)."',
					'".mysql_escape_string($commercial__Extras)."',
					'".mysql_escape_string($commercial__FinancialStatement)."',
					'".mysql_escape_string($commercial__Franchise)."',
					'".mysql_escape_string($commercial__Freestanding)."',
					'".mysql_escape_string($commercial__GarageType)."',
					'".mysql_escape_string($commercial__GradeLevelShippingDoorsNum)."',
					'".mysql_escape_string($commercial__GradeLevelShippingDoorsHeightFeet)."',
					'".mysql_escape_string($commercial__GradeLevelShippingDoorsHeightInches)."',
					'".mysql_escape_string($commercial__GradeLevelShippingDoorsWidthFeet)."',
					'".mysql_escape_string($commercial__GradeLevelShippingDoorsWidthInches)."',
					'".mysql_escape_string($commercial__GrossIncomeSales)."',
					'".mysql_escape_string($commercial__HeatExpenses)."',
					'".mysql_escape_string($commercial__HeatType)."',
					'".mysql_escape_string($commercial__HoursOpen)."',
					'".mysql_escape_string($commercial__HydroExpense)."',
					'".mysql_escape_string($commercial__IDXupdateddate)."',
					'".mysql_escape_string($commercial__IndustrialArea)."',
					'".mysql_escape_string($commercial__IndustrialAreaCode)."',
					'".mysql_escape_string($commercial__InsuranceExpense)."',
					'".mysql_escape_string($commercial__LegalDescription)."',
					'".mysql_escape_string($commercial__ListBrokerage)."',
					'".mysql_escape_string($commercial__ListPrice)."',
					'".mysql_escape_string($commercial__ListPriceCode)."',
					'".mysql_escape_string($commercial__LLBO)."',
					'".mysql_escape_string($commercial__LotDepth)."',
					'".mysql_escape_string($commercial__LotFront)."',
					'".mysql_escape_string($commercial__LotIrregularities)."',
					'".mysql_escape_string($commercial__LotSizeCode)."',
					'".mysql_escape_string($commercial__LotBldgUnitCode)."',
					'".mysql_escape_string($commercial__Maintenance)."',
					'".mysql_escape_string($commercial__ManagementExpense)."',
					'".mysql_escape_string($commercial__MapNum)."',
					'".mysql_escape_string($commercial__MapColumnNum)."',
					'".mysql_escape_string($commercial__MapRow)."',
					'".mysql_escape_string($commercial__MaximumRentalTerm)."',
					'".mysql_escape_string($commercial__MinimumRentalTerm)."',
					'".mysql_escape_string($commercial__MLSNum)."',
					'".mysql_escape_string($commercial__Municipality)."',
					'".mysql_escape_string($commercial__MunicipalityDistrict)."',
					'".mysql_escape_string($commercial__MunicpCode)."',
					'".mysql_escape_string($commercial__NetIncomeBeforeDebt)."',
					'".mysql_escape_string($commercial__Occupancy)."',
					'".mysql_escape_string($commercial__OfficeAptArea)."',
					'".mysql_escape_string($commercial__OfficeAptAreaCode)."',
					'".mysql_escape_string($commercial__OperatingExpenses)."',
					'".mysql_escape_string($commercial__OtherExpenses)."',
					'".mysql_escape_string($commercial__OutofAreaMunicipality)."',
					'".mysql_escape_string($commercial__OutsideStorage)."',
					'".mysql_escape_string($commercial__ParkingSpaces)."',
					'".mysql_escape_string($commercial__PercentageRent)."',
					'".mysql_escape_string($commercial__PINNum)."',
					'".mysql_escape_string($commercial__Pixupdateddate)."',
					'".mysql_escape_string($commercial__PostalCode)."',
					'".mysql_escape_string($commercial__Province)."',
					'".mysql_escape_string($commercial__Rail)."',
					'".mysql_escape_string($commercial__RemarksForClients)."',
					'".mysql_escape_string($commercial__RetailArea)."',
					'".mysql_escape_string($commercial__RetailAreaCode)."',
					'".mysql_escape_string($commercial__SaleLease)."',
					'".mysql_escape_string($commercial__Seats)."',
					'".mysql_escape_string($commercial__SellerPropertyInfoStatement)."',
					'".mysql_escape_string($commercial__Sewers)."',
					'".mysql_escape_string($commercial__SoilTest)."',
					'".mysql_escape_string($commercial__Sprinklers)."',
					'".mysql_escape_string($commercial__Status)."',
					'".mysql_escape_string($commercial__StreetNum)."',
					'".mysql_escape_string($commercial__StreetAbbreviation)."',
					'".mysql_escape_string($commercial__StreetDirection)."',
					'".mysql_escape_string($commercial__StreetName)."',
					'".mysql_escape_string($commercial__Survey)."',
					'".mysql_escape_string($commercial__TaxYear)."',
					'".mysql_escape_string($commercial__Taxes)."',
					'".mysql_escape_string($commercial__TaxesExpense)."',
					'".mysql_escape_string($commercial__TotalArea)."',
					'".mysql_escape_string($commercial__TotalAreaCode)."',
					'".mysql_escape_string($commercial__TruckLevelShippingDoorsNum)."',
					'".mysql_escape_string($commercial__TruckLevelShippingDoorsHeightFeet)."',
					'".mysql_escape_string($commercial__TruckLevelShippingDoorsHeightInches)."',
					'".mysql_escape_string($commercial__TruckLevelShippingDoorsWidthFeet)."',
					'".mysql_escape_string($commercial__TruckLevelShippingDoorsWidthInches)."',
					'".mysql_escape_string($commercial__Type)."',
					'".mysql_escape_string($commercial__TypeTaxes)."',
					'".mysql_escape_string($commercial__UFFI)."',
					'".mysql_escape_string($commercial__Updatedtimestamp)."',
					'".mysql_escape_string($commercial__Use)."',
					'".mysql_escape_string($commercial__Utilities)."',
					'".mysql_escape_string($commercial__VacancyAllowance)."',
					'".mysql_escape_string($commercial__VirtualTourUploadDate)."',
					'".mysql_escape_string($commercial__VirtualTourURL)."',
					'".mysql_escape_string($commercial__Volts)."',
					'".mysql_escape_string($commercial__Washrooms)."',
					'".mysql_escape_string($commercial__Water)."',
					'".mysql_escape_string($commercial__WaterExpense)."',
					'".mysql_escape_string($commercial__WaterSupplyTypes)."',
					'".mysql_escape_string($commercial__YearExpenses)."',
					'".mysql_escape_string($commercial__Zoning)."',
					'".mysql_escape_string($commercial__gmap_lat)."',
					'".mysql_escape_string($commercial__gmap_long)."',
					'".mysql_escape_string($commercial__gmap_precision)."',
					'".mysql_escape_string($commercial__photocount)."',
					'".mysql_escape_string($commercial__Floor)."',
					'".mysql_escape_string($commercial__Floors)."',
					'".mysql_escape_string($commercial__GrossRentPerSqFt)."',
					'".mysql_escape_string($commercial__BaseRentPerSqFt)."',
					'".mysql_escape_string($commercial__AdditionalRentPerSqFt)."',
					'".mysql_escape_string($commercial__MaxContiguousSqFt)."',
					'".mysql_escape_string($commercial__SourceLastUpdated)."',
					'".mysql_escape_string($commercial__BuildingClass)."',
					'".mysql_escape_string($commercial__TotalAvailableSpaceSqFt)."');";
					
					if($debug=='yes') echo '$n1='.$n1.'<br>';
					
					$db->insert($qry);
					
					if($debug=='yes') 
					{
						echo "<p>Query: $qry </p>"; 
						//exit;
					}
					 
					$n1++;
				}
			}
		}
	}else if($nbr_page==1){

		if(!empty ($json->results)){
			$result = $json->results;
			


			for($b=0;$b<count($result);$b++){
				$scrapedURL = '';
				$scrapedID = '';
				$commercial__Address = '';
				$commercial__Building = '';
				$commercial__ApproxAge = '';
				$commercial__AptUnit = '';
				$commercial__Area = '';
				$commercial__AreaCode = '';
				$commercial__AreaInfluences1 = '';
				$commercial__AreaInfluences2 = '';
				$commercial__Assessment = '';
				$commercial__AssessmentYear = '';
				$commercial__Basement1 = '';
				$commercial__BaySizeLengthFeet = '';
				$commercial__BaySizeLengthInches = '';
				$commercial__BaySizeWidthFeet = '';
				$commercial__BaySizeWidthInches = '';
				$commercial__BusinessBuildingName = '';
				$commercial__Category = '';
				$commercial__Chattels = '';
				$commercial__ClearHeightFeet = '';
				$commercial__ClearHeightInches = '';
				$commercial__CommercialCondoFees = '';
				$commercial__CommonAreaUpcharge = '';
				$commercial__Community = '';
				$commercial__CommunityCode = '';
				$commercial__Crane = '';
				$commercial__DaysOpen = '';
				$commercial__DirectionsCrossStreets = '';
				$commercial__DisplayAddressOnInternet = '';
				$commercial__DoubleManShippingDoorsNum = '';
				$commercial__DoubleManShippingDoorsHeightFeet = '';
				$commercial__DoubleManShippingDoorsHeightInches = '';
				$commercial__DoubleManShippingDoorsWidthFeet = '';
				$commercial__DoubleManShippingDoorsWidthInches = '';
				$commercial__Drive_InLevelShippingDoors = '';
				$commercial__Drive_InLevelShippingDoorsHeightFeet = '';
				$commercial__Drive_InLevelShippingDoorsHeightInches = '';
				$commercial__Drive_InLevelShippingDoorsWidthFeet = '';
				$commercial__Drive_InLevelShippingDoorsWidthInches = '';
				$commercial__Elevator = '';
				$commercial__Employees = '';
				$commercial__EstimInventoryValuesAtCost = '';
				$commercial__ExpensesActualEstimated = '';
				$commercial__Extras = '';
				$commercial__FinancialStatement = '';
				$commercial__Franchise = '';
				$commercial__Freestanding = '';
				$commercial__GarageType = '';
				$commercial__GradeLevelShippingDoorsNum = '';
				$commercial__GradeLevelShippingDoorsHeightFeet = '';
				$commercial__GradeLevelShippingDoorsHeightInches = '';
				$commercial__GradeLevelShippingDoorsWidthFeet = '';
				$commercial__GradeLevelShippingDoorsWidthInches = '';
				$commercial__GrossIncomeSales = '';
				$commercial__HeatExpenses = '';
				$commercial__HeatType = '';
				$commercial__HoursOpen = '';
				$commercial__HydroExpense = '';
				$commercial__IDXupdateddate = '';
				$commercial__IndustrialArea = '';
				$commercial__IndustrialAreaCode = '';
				$commercial__InsuranceExpense = '';
				$commercial__LegalDescription = '';
				$commercial__LLBO = '';
				$commercial__LotDepth = '';
				$commercial__LotFront = '';
				$commercial__LotIrregularities = '';
				$commercial__LotSizeCode = '';
				$commercial__LotBldgUnitCode = '';
				$commercial__Maintenance = '';
				$commercial__ManagementExpense = '';
				$commercial__MapNum = '';
				$commercial__MapColumnNum = '';
				$commercial__MapRow = '';
				$commercial__MaximumRentalTerm = '';
				$commercial__MinimumRentalTerm = '';
				$commercial__MLSNum = '';
				$commercial__Municipality = '';
				$commercial__OfficeAptArea = '';
				$commercial__OfficeAptAreaCode = '';
				$commercial__OperatingExpenses = '';
				$commercial__OtherExpenses = '';
				$commercial__OutofAreaMunicipality = '';
				$commercial__OutsideStorage = '';
				$commercial__ParkingSpaces = '';
				$commercial__PercentageRent = '';
				$commercial__PINNum = '';
				$commercial__Pixupdateddate = '';
				$commercial__PostalCode = '';
				$commercial__Province = '';
				$commercial__RemarksForClients = '';
				$commercial__RetailArea = '';
				$commercial__RetailAreaCode = '';
				$commercial__SaleLease = '';
				$commercial__Seats = '';
				$commercial__SellerPropertyInfoStatement = '';
				$commercial__Sewers = '';
				$commercial__SoilTest = '';
				$commercial__Sprinklers = '';
				$commercial__StreetNum = '';
				$commercial__StreetAbbreviation = '';
				$commercial__StreetDirection = '';
				$commercial__StreetName = '';
				$commercial__Survey = '';
				$commercial__TaxYear = '';
				$commercial__Taxes = '';
				$commercial__TaxesExpense = '';
				$commercial__TotalArea = '';
				$commercial__TotalAreaCode = '';
				$commercial__TruckLevelShippingDoorsNum = '';
				$commercial__TruckLevelShippingDoorsHeightFeet = '';
				$commercial__TruckLevelShippingDoorsHeightInches = '';
				$commercial__TruckLevelShippingDoorsWidthFeet = '';
				$commercial__TruckLevelShippingDoorsWidthInches = '';
				$commercial__Type = '';
				$commercial__TypeTaxes = '';
				$commercial__UFFI = '';
				$commercial__Updatedtimestamp = '';
				$commercial__Use = '';
				$commercial__Utilities = '';
				$commercial__VacancyAllowance = '';
				$commercial__VirtualTourUploadDate = '';
				$commercial__VirtualTourURL = '';
				$commercial__Volts = '';
				$commercial__Washrooms = '';
				$commercial__Water = '';
				$commercial__WaterExpense = '';
				$commercial__WaterSupplyTypes = '';
				$commercial__YearExpenses = '';
				$commercial__Zoning = '';
				$commercial__gmap_lat = '';
				$commercial__gmap_long = '';
				$commercial__gmap_precision = '';
				$commercial__Floor = '';
				$commercial__Floors = '';
				$commercial__GrossRentPerSqFt = '';
				$commercial__BaseRentPerSqFt = '';
				$commercial__AdditionalRentPerSqFt = '';
				$commercial__MaxContiguousSqFt = '';
				$commercial__BuildingClass = '';
				$commercial__ListPrice = '';

				if(!empty ($json->results[$b]->property->description)){
					$commercial__Building = $json->results[$b]->property->description;
				}
				if(!empty ($json->results[$b]->property->year_built)){
					$commercial__ApproxAge = $json->results[$b]->property->year_built;
				}
				if(!empty ($json->results[$b]->suite_number)){
					$commercial__AptUnit = $json->results[$b]->suite_number;
				}
				
				if(!empty ($json->results[$b]->property->regions)){
					foreach ($json->results[$b]->property->regions as $region)
					{
					$commercial__Area.= "|".$region->name;
					}
				}
				
				if(!empty ($json->results[$b]->property_type->value)){
					$commercial__Category = $json->results[$b]->property_type->value;
				}
				if(!empty ($json->results[$b]->calculated_price)){
					$commercial__ListPrice = $json->results[$b]->calculated_price;
					$commercial__ListPrice = preg_replace("/\.(.*)/i", "", $commercial__ListPrice);
				}
				if(!empty ($json->results[$b]->property->city->name)){
					$commercial__Municipality = $json->results[$b]->property->city->name;
				}
				if(!empty ($json->results[$b]->property->postal_code)){
					$commercial__PostalCode = $json->results[$b]->property->postal_code;
				}
				if(!empty ($json->results[$b]->property->province->name)){
					$commercial__Province = $json->results[$b]->property->province->name;
				}
				if(!empty ($json->results[$b]->{'description'})){
					$commercial__RemarksForClients = $json->results[$b]->{'description'};
				}
				if(!empty ($json->results[$b]->property->{'address'})){
					$commercial__Address = $json->results[$b]->property->{'address'};
					$StreetAbbreviation = $json->results[$b]->property->{'address'};
					$Abbreviation = explode(' ', $StreetAbbreviation);
					$commercial__StreetAbbreviation = array_pop($Abbreviation);
					$commercial__StreetName=$commercial__Address;
				}
				
				
				if(!empty ($json->results[$b]->for_sale)){
					$commercial__SaleLease = "sale";
				}

				if(!empty ($json->results[$b]->for_lease)){
					$commercial__SaleLease .= "lease";
				}


				if(!empty ($json->results[$b]->square_footage)){
					$commercial__TotalArea = $json->results[$b]->square_footage;
				}
				if(!empty ($json->results[$b]->property->Zoning)){
					$commercial__Zoning = $json->results[$b]->property->Zoning;
				}
				if(!empty ($json->results[$b]->floor)){
					$commercial__Floor = $json->results[$b]->floor;
				}
				if(!empty ($json->results[$b]->property->num_floors)){
					$commercial__Floors = $json->results[$b]->property->num_floors;
				}
				if(!empty ($json->results[$b]->base_rent)){
					$commercial__BaseRentPerSqFt = $json->results[$b]->base_rent;
				}
				if(!empty ($json->results[$b]->{'additional_rent'})){
					$commercial__AdditionalRentPerSqFt = $json->results[$b]->{'additional_rent'};
				}
				if(!empty ($json->results[$b]->{'calculated_sqft_yr_price'})){
					$commercial__GrossRentPerSqFt = $json->results[$b]->{'calculated_sqft_yr_price'};
				}
				if(!empty ($json->results[$b]->square_footage)){
					$commercial__MaxContiguousSqFt = $json->results[$b]->square_footage;
				}
				if(!empty ($json->results[$b]->property->building_class)){
					$commercial__BuildingClass = $json->results[$b]->property->building_class;
				}
				if(!empty ($result[$b]->friendly_path)){
					$scrapedURL = 'https://spacelist.ca'.$result[$b]->friendly_path;
				}
				if(!empty ($json->results[$b]->id)){
					$scrapedID = $json->results[$b]->id;
				}

				if(!empty ($json->results[$b]->location)){
					$commercial__gmap_long = $json->results[$b]->location[0];
					$commercial__gmap_lat = $json->results[$b]->location[1];
				}

			 
			 	$str2= get($scrapedURL,'','','','','','');
				$html2->load($str2);

				//$commercial__Address = "";
				$commercial__NumTrailerParkingSpots = "";
				$commercial__AirConditioning = '';
				$commercial__Amps = '';
				$commercial__ListBrokerage ='' ;
				$commercial__ListPriceCode = '';
				$commercial__MunicipalityDistrict = $MunicipalityDistrict;
				$commercial__MunicpCode = '';
				$commercial__NetIncomeBeforeDebt = '';
				$commercial__Occupancy = '';
				$commercial__Rail = '';
				$commercial__RemarksForClients = '';
				$commercial__SourceLastUpdated = '';

				$class2 = 'div[class="columns"] div[class="row"] div[class="columns small-12 large-6 gray stats"] ul li';
				foreach($html2->find($class2) as $d2){
					if(!empty($d2->find('span',0))){

						if(preg_match('/^Source$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
							if(!empty($d2->find('span',1))){
								$commercial__ListBrokerage = trim(html_entity_decode($d2->find('span',1)->plaintext));
							}
						}

						if(preg_match('/^Lease$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
							if(!empty($d2->find('span',1))){
								$commercial__ListPriceCode = trim(html_entity_decode($d2->find('span',1)->plaintext));
							}
						}

						if(preg_match('/^Availability$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
							if(!empty($d2->find('span',1))){
								$commercial__Occupancy = trim(html_entity_decode($d2->find('span',1)->plaintext));
							}
						}

						if(preg_match('/^Last Updated$/i', trim(html_entity_decode($d2->find('span[class="stats-key"]',0)->plaintext)))){
							if(!empty($d2->find('span',1))){
								$date = trim(html_entity_decode($d2->find('span',1)->plaintext));
								$commercial__SourceLastUpdated = date("Y-m-d", strtotime($date));
							}
						}
					}//end of if(!empty($d2
				}
				 


				 if($scrapePhotos!='no')
				 {
					$y=1;
					$image = '';
					$file_name = '';
					$commercial__photocount = 0;
					$class2 = 'div[class="photos cycle-slideshow"] div';
					foreach($html2->find($class2) as $d2){
						if(!empty($d2->{'data-thumb'})){
							$image = trim(html_entity_decode($d2->{'data-thumb'}));
	
							$path = __DIR__."/idxphotos/";
							if(!file_exists($path)){
								mkdir($path,0755,TRUE);
							}
	
							$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
							$context = stream_context_create($opts);
							$file = file_get_contents($image,false,$context);
							
							if($file===false) $scrapedPhotoStatus='fail';
							
							if($y<10){
								$file_name = $scrapedID.'_'.'0'.$y.".jpg";
								file_put_contents($path.$file_name,$file);
							}elseif($y>=10){
								$file_name = $scrapedID.'_'.$y.".jpg";
								file_put_contents($path.$file_name,$file);
	
							}
	
							if($debug=='yes') echo "<p>Image file: ".$path.$file_name."</p>";							
							
							
							
							$qry =  "INSERT INTO `".$DB_tableName2."` 
							(`id`, `scrapedID`, `file_name`,`scrapedURL`,`dateLastScraped`,scrapedPhotoStatus) VALUES (NULL,
							'".mysql_escape_string($scrapedID)."',
							'".mysql_escape_string($file_name)."',
							'$scrapedURL','".date('Y-m-d-H-i-s')."', '$scrapedPhotoStatus');";
							
							
	
							$db->insert($qry);
							
							if($debug=='yes') echo '$qry1 '.$qry.'<br>';
							
							$y++;
						}
						$scrapedPhotoStatus='';
						$commercial__photocount = $y-1;

						
					}

				 }


				 
				$TotalAvailableSpaceSqFt = '';
				$commercial__Status = '';
				$commercial__TotalAvailableSpaceSqFt = '';
				$class2 = 'div[class="columns large-12 gray padded"] div[class="stats"] ul li';
				foreach($html2->find($class2) as $d2){

					if(!empty($d2->find('span',0))){
						if(preg_match('/^Status$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
							if(!empty($d2->find('span',1))){
								$commercial__Status = trim(html_entity_decode($d2->find('span',1)->plaintext));
							}
						}
						if(preg_match('/^Total Available Space$/i', trim(html_entity_decode($d2->find('span',0)->plaintext)))){
							if(!empty($d2->find('span',1))){
								$commercial__TotalAvailableSpaceSqFt = trim(html_entity_decode($d2->find('span',1)->plaintext));
								$commercial__TotalAvailableSpaceSqFt = trim(html_entity_decode(preg_replace("/\D+/i", "", $commercial__TotalAvailableSpaceSqFt)));
							}
						}
					}
				}
				
				////////////////////////////////////////insertion///////////////////////////////

				$qry =  "INSERT INTO `".$DB_tableName1."`(`commercial__dateLastScraped`,`commercial__scrapedID`, `commercial__scrapedURL`, `commercial__NumTrailerParkingSpots`, `commercial__Building`,
				`commercial__Address`, `commercial__AirConditioning`, `commercial__Amps`, `commercial__ApproxAge`, `commercial__AptUnit`,
				`commercial__Area`, `commercial__AreaCode`, `commercial__AreaInfluences1`, `commercial__AreaInfluences2`,
				`commercial__Assessment`, `commercial__AssessmentYear`, `commercial__Basement1`, `commercial__BaySizeLengthFeet`,
				`commercial__BaySizeLengthInches`, `commercial__BaySizeWidthFeet`, `commercial__BaySizeWidthInches`,
				`commercial__BusinessBuildingName`, `commercial__Category`, `commercial__Chattels`, `commercial__ClearHeightFeet`,
				`commercial__ClearHeightInches`, `commercial__CommercialCondoFees`, `commercial__CommonAreaUpcharge`, `commercial__Community`,
				`commercial__CommunityCode`, `commercial__Crane`, `commercial__DaysOpen`, `commercial__DirectionsCrossStreets`,
				`commercial__DisplayAddressOnInternet`, `commercial__DoubleManShippingDoorsNum`, `commercial__DoubleManShippingDoorsHeightFeet`,
				`commercial__DoubleManShippingDoorsHeightInches`, `commercial__DoubleManShippingDoorsWidthFeet`,
				`commercial__DoubleManShippingDoorsWidthInches`, `commercial__Drive_InLevelShippingDoors`,
				`commercial__Drive_InLevelShippingDoorsHeightFeet`, `commercial__Drive_InLevelShippingDoorsHeightInches`,
				`commercial__Drive_InLevelShippingDoorsWidthFeet`, `commercial__Drive_InLevelShippingDoorsWidthInches`,
				`commercial__Elevator`, `commercial__Employees`, `commercial__EstimInventoryValuesAtCost`,
				`commercial__ExpensesActualEstimated`, `commercial__Extras`, `commercial__FinancialStatement`,
				`commercial__Franchise`, `commercial__Freestanding`, `commercial__GarageType`,
				`commercial__GradeLevelShippingDoorsNum`, `commercial__GradeLevelShippingDoorsHeightFeet`,
				`commercial__GradeLevelShippingDoorsHeightInches`, `commercial__GradeLevelShippingDoorsWidthFeet`,
				`commercial__GradeLevelShippingDoorsWidthInches`, `commercial__GrossIncomeSales`, `commercial__HeatExpenses`,
				`commercial__HeatType`, `commercial__HoursOpen`, `commercial__HydroExpense`, `commercial__IDXupdateddate`,
				`commercial__IndustrialArea`, `commercial__IndustrialAreaCode`, `commercial__InsuranceExpense`, `commercial__LegalDescription`,
				`commercial__ListBrokerage`, `commercial__ListPrice`, `commercial__ListPriceCode`, `commercial__LLBO`,
				`commercial__LotDepth`, `commercial__LotFront`, `commercial__LotIrregularities`, `commercial__LotSizeCode`,
				`commercial__LotBldgUnitCode`, `commercial__Maintenance`, `commercial__ManagementExpense`, `commercial__MapNum`,
				`commercial__MapColumnNum`, `commercial__MapRow`, `commercial__MaximumRentalTerm`, `commercial__MinimumRentalTerm`,
				`commercial__MLSNum`, `commercial__Municipality`, `commercial__MunicipalityDistrict`, `commercial__MunicpCode`,
				`commercial__NetIncomeBeforeDebt`, `commercial__Occupancy`, `commercial__OfficeAptArea`, `commercial__OfficeAptAreaCode`,
				`commercial__OperatingExpenses`, `commercial__OtherExpenses`, `commercial__OutofAreaMunicipality`,
				`commercial__OutsideStorage`, `commercial__ParkingSpaces`, `commercial__PercentageRent`, `commercial__PINNum`,
				`commercial__Pixupdateddate`, `commercial__PostalCode`, `commercial__Province`, `commercial__Rail`,
				`commercial__RemarksForClients`, `commercial__RetailArea`, `commercial__RetailAreaCode`, `commercial__SaleLease`,
				`commercial__Seats`, `commercial__SellerPropertyInfoStatement`, `commercial__Sewers`, `commercial__SoilTest`,
				`commercial__Sprinklers`, `commercial__Status`, `commercial__StreetNum`, `commercial__StreetAbbreviation`,
				`commercial__StreetDirection`, `commercial__StreetName`, `commercial__Survey`, `commercial__TaxYear`,
				`commercial__Taxes`, `commercial__TaxesExpense`, `commercial__TotalArea`, `commercial__TotalAreaCode`,
				`commercial__TruckLevelShippingDoorsNum`, `commercial__TruckLevelShippingDoorsHeightFeet`,
				`commercial__TruckLevelShippingDoorsHeightInches`, `commercial__TruckLevelShippingDoorsWidthFeet`,
				`commercial__TruckLevelShippingDoorsWidthInches`, `commercial__Type`, `commercial__TypeTaxes`,
				`commercial__UFFI`, `commercial__Updatedtimestamp`, `commercial__Use`, `commercial__Utilities`,
				`commercial__VacancyAllowance`, `commercial__VirtualTourUploadDate`, `commercial__VirtualTourURL`,
				`commercial__Volts`, `commercial__Washrooms`, `commercial__Water`, `commercial__WaterExpense`,
				`commercial__WaterSupplyTypes`, `commercial__YearExpenses`, `commercial__Zoning`, `commercial__gmap_lat`,
				`commercial__gmap_long`, `commercial__gmap_precision`, `commercial__photocount`, `commercial__Floor`,
				`commercial__Floors`, `commercial__GrossRentPerSqFt`, `commercial__BaseRentPerSqFt`,
				`commercial__AdditionalRentPerSqFt`, `commercial__MaxContiguousSqFt`, `commercial__SourceLastUpdated`,
				`commercial__BuildingClass`, `commercial__TotalAvailableSpaceSqFt`) 
				VALUES (
				'".date('Y-m-d-H-i-s')."',
				'".mysql_escape_string($scrapedID)."',
				'".mysql_escape_string($scrapedURL)."',
				'".mysql_escape_string($commercial__NumTrailerParkingSpots)."',
				'".mysql_escape_string($commercial__Building)."',
				'".mysql_escape_string($commercial__Address)."',
				'".mysql_escape_string($commercial__AirConditioning)."',
				'".mysql_escape_string($commercial__Amps)."',
				'".mysql_escape_string($commercial__ApproxAge)."',
				'".mysql_escape_string($commercial__AptUnit)."',
				'".mysql_escape_string($commercial__Area)."',
				'".mysql_escape_string($commercial__AreaCode)."',
				'".mysql_escape_string($commercial__AreaInfluences1)."',
				'".mysql_escape_string($commercial__AreaInfluences2)."',
				'".mysql_escape_string($commercial__Assessment)."',
				'".mysql_escape_string($commercial__AssessmentYear)."',
				'".mysql_escape_string($commercial__Basement1)."',
				'".mysql_escape_string($commercial__BaySizeLengthFeet)."',
				'".mysql_escape_string($commercial__BaySizeLengthInches)."',
				'".mysql_escape_string($commercial__BaySizeWidthFeet)."',
				'".mysql_escape_string($commercial__BaySizeWidthInches)."',
				'".mysql_escape_string($commercial__BusinessBuildingName)."',
				'".mysql_escape_string($commercial__Category)."',
				'".mysql_escape_string($commercial__Chattels)."',
				'".mysql_escape_string($commercial__ClearHeightFeet)."',
				'".mysql_escape_string($commercial__ClearHeightInches)."',
				'".mysql_escape_string($commercial__CommercialCondoFees)."',
				'".mysql_escape_string($commercial__CommonAreaUpcharge)."',
				'".mysql_escape_string($commercial__Community)."',
				'".mysql_escape_string($commercial__CommunityCode)."',
				'".mysql_escape_string($commercial__Crane)."',
				'".mysql_escape_string($commercial__DaysOpen)."',
				'".mysql_escape_string($commercial__DirectionsCrossStreets)."',
				'".mysql_escape_string($commercial__DisplayAddressOnInternet)."',
				'".mysql_escape_string($commercial__DoubleManShippingDoorsNum)."',
				'".mysql_escape_string($commercial__DoubleManShippingDoorsHeightFeet)."',
				'".mysql_escape_string($commercial__DoubleManShippingDoorsHeightInches)."',
				'".mysql_escape_string($commercial__DoubleManShippingDoorsWidthFeet)."',
				'".mysql_escape_string($commercial__DoubleManShippingDoorsWidthInches)."',
				'".mysql_escape_string($commercial__Drive_InLevelShippingDoors)."',
				'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsHeightFeet)."',
				'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsHeightInches)."',
				'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsWidthFeet)."',
				'".mysql_escape_string($commercial__Drive_InLevelShippingDoorsWidthInches)."',
				'".mysql_escape_string($commercial__Elevator)."',
				'".mysql_escape_string($commercial__Employees)."',
				'".mysql_escape_string($commercial__EstimInventoryValuesAtCost)."',
				'".mysql_escape_string($commercial__ExpensesActualEstimated)."',
				'".mysql_escape_string($commercial__Extras)."',
				'".mysql_escape_string($commercial__FinancialStatement)."',
				'".mysql_escape_string($commercial__Franchise)."',
				'".mysql_escape_string($commercial__Freestanding)."',
				'".mysql_escape_string($commercial__GarageType)."',
				'".mysql_escape_string($commercial__GradeLevelShippingDoorsNum)."',
				'".mysql_escape_string($commercial__GradeLevelShippingDoorsHeightFeet)."',
				'".mysql_escape_string($commercial__GradeLevelShippingDoorsHeightInches)."',
				'".mysql_escape_string($commercial__GradeLevelShippingDoorsWidthFeet)."',
				'".mysql_escape_string($commercial__GradeLevelShippingDoorsWidthInches)."',
				'".mysql_escape_string($commercial__GrossIncomeSales)."',
				'".mysql_escape_string($commercial__HeatExpenses)."',
				'".mysql_escape_string($commercial__HeatType)."',
				'".mysql_escape_string($commercial__HoursOpen)."',
				'".mysql_escape_string($commercial__HydroExpense)."',
				'".mysql_escape_string($commercial__IDXupdateddate)."',
				'".mysql_escape_string($commercial__IndustrialArea)."',
				'".mysql_escape_string($commercial__IndustrialAreaCode)."',
				'".mysql_escape_string($commercial__InsuranceExpense)."',
				'".mysql_escape_string($commercial__LegalDescription)."',
				'".mysql_escape_string($commercial__ListBrokerage)."',
				'".mysql_escape_string($commercial__ListPrice)."',
				'".mysql_escape_string($commercial__ListPriceCode)."',
				'".mysql_escape_string($commercial__LLBO)."',
				'".mysql_escape_string($commercial__LotDepth)."',
				'".mysql_escape_string($commercial__LotFront)."',
				'".mysql_escape_string($commercial__LotIrregularities)."',
				'".mysql_escape_string($commercial__LotSizeCode)."',
				'".mysql_escape_string($commercial__LotBldgUnitCode)."',
				'".mysql_escape_string($commercial__Maintenance)."',
				'".mysql_escape_string($commercial__ManagementExpense)."',
				'".mysql_escape_string($commercial__MapNum)."',
				'".mysql_escape_string($commercial__MapColumnNum)."',
				'".mysql_escape_string($commercial__MapRow)."',
				'".mysql_escape_string($commercial__MaximumRentalTerm)."',
				'".mysql_escape_string($commercial__MinimumRentalTerm)."',
				'".mysql_escape_string($commercial__MLSNum)."',
				'".mysql_escape_string($commercial__Municipality)."',
				'".mysql_escape_string($commercial__MunicipalityDistrict)."',
				'".mysql_escape_string($commercial__MunicpCode)."',
				'".mysql_escape_string($commercial__NetIncomeBeforeDebt)."',
				'".mysql_escape_string($commercial__Occupancy)."',
				'".mysql_escape_string($commercial__OfficeAptArea)."',
				'".mysql_escape_string($commercial__OfficeAptAreaCode)."',
				'".mysql_escape_string($commercial__OperatingExpenses)."',
				'".mysql_escape_string($commercial__OtherExpenses)."',
				'".mysql_escape_string($commercial__OutofAreaMunicipality)."',
				'".mysql_escape_string($commercial__OutsideStorage)."',
				'".mysql_escape_string($commercial__ParkingSpaces)."',
				'".mysql_escape_string($commercial__PercentageRent)."',
				'".mysql_escape_string($commercial__PINNum)."',
				'".mysql_escape_string($commercial__Pixupdateddate)."',
				'".mysql_escape_string($commercial__PostalCode)."',
				'".mysql_escape_string($commercial__Province)."',
				'".mysql_escape_string($commercial__Rail)."',
				'".mysql_escape_string($commercial__RemarksForClients)."',
				'".mysql_escape_string($commercial__RetailArea)."',
				'".mysql_escape_string($commercial__RetailAreaCode)."',
				'".mysql_escape_string($commercial__SaleLease)."',
				'".mysql_escape_string($commercial__Seats)."',
				'".mysql_escape_string($commercial__SellerPropertyInfoStatement)."',
				'".mysql_escape_string($commercial__Sewers)."',
				'".mysql_escape_string($commercial__SoilTest)."',
				'".mysql_escape_string($commercial__Sprinklers)."',
				'".mysql_escape_string($commercial__Status)."',
				'".mysql_escape_string($commercial__StreetNum)."',
				'".mysql_escape_string($commercial__StreetAbbreviation)."',
				'".mysql_escape_string($commercial__StreetDirection)."',
				'".mysql_escape_string($commercial__StreetName)."',
				'".mysql_escape_string($commercial__Survey)."',
				'".mysql_escape_string($commercial__TaxYear)."',
				'".mysql_escape_string($commercial__Taxes)."',
				'".mysql_escape_string($commercial__TaxesExpense)."',
				'".mysql_escape_string($commercial__TotalArea)."',
				'".mysql_escape_string($commercial__TotalAreaCode)."',
				'".mysql_escape_string($commercial__TruckLevelShippingDoorsNum)."',
				'".mysql_escape_string($commercial__TruckLevelShippingDoorsHeightFeet)."',
				'".mysql_escape_string($commercial__TruckLevelShippingDoorsHeightInches)."',
				'".mysql_escape_string($commercial__TruckLevelShippingDoorsWidthFeet)."',
				'".mysql_escape_string($commercial__TruckLevelShippingDoorsWidthInches)."',
				'".mysql_escape_string($commercial__Type)."',
				'".mysql_escape_string($commercial__TypeTaxes)."',
				'".mysql_escape_string($commercial__UFFI)."',
				'".mysql_escape_string($commercial__Updatedtimestamp)."',
				'".mysql_escape_string($commercial__Use)."',
				'".mysql_escape_string($commercial__Utilities)."',
				'".mysql_escape_string($commercial__VacancyAllowance)."',
				'".mysql_escape_string($commercial__VirtualTourUploadDate)."',
				'".mysql_escape_string($commercial__VirtualTourURL)."',
				'".mysql_escape_string($commercial__Volts)."',
				'".mysql_escape_string($commercial__Washrooms)."',
				'".mysql_escape_string($commercial__Water)."',
				'".mysql_escape_string($commercial__WaterExpense)."',
				'".mysql_escape_string($commercial__WaterSupplyTypes)."',
				'".mysql_escape_string($commercial__YearExpenses)."',
				'".mysql_escape_string($commercial__Zoning)."',
				'".mysql_escape_string($commercial__gmap_lat)."',
				'".mysql_escape_string($commercial__gmap_long)."',
				'".mysql_escape_string($commercial__gmap_precision)."',
				'".mysql_escape_string($commercial__photocount)."',
				'".mysql_escape_string($commercial__Floor)."',
				'".mysql_escape_string($commercial__Floors)."',
				'".mysql_escape_string($commercial__GrossRentPerSqFt)."',
				'".mysql_escape_string($commercial__BaseRentPerSqFt)."',
				'".mysql_escape_string($commercial__AdditionalRentPerSqFt)."',
				'".mysql_escape_string($commercial__MaxContiguousSqFt)."',
				'".mysql_escape_string($commercial__SourceLastUpdated)."',
				'".mysql_escape_string($commercial__BuildingClass)."',
				'".mysql_escape_string($commercial__TotalAvailableSpaceSqFt)."');";
				
				if($debug=='yes') echo '$n1'.$n1.'<br>';
				
				$db->insert($qry);
				
					if($debug=='yes') 
					{
						echo "<p>Query: $qry </p>"; 
						//exit;
					}

				$n1++;
			}//end of for $b
		}//end of if(!empty($json->result
	}//end of else if($nbr_page==1
}//end of for $a

echo '<span style="color: green"><strong><br>*****************************************************************<br>
*****************************************************************<br>
success
<br>*****************************************************************
<br>*****************************************************************<br></strong></span>';




$qry_delete="delete from commercial";
$db->delete($qry_delete);
if($debug=='yes') 
{
	echo "<p>Query: $qry_delete </p>"; 
	//exit;
}


$qry_sync="insert into commercial SELECT * FROM `scraped_commercial` WHERE 1";
$db->insert($qry_sync);
if($debug=='yes') 
{
	echo "<p>Query: $qry_sync </p>"; 
	//exit;
}

$qry_yonge_dundas="update commercial set commercial__Area=concat_ws('|',commercial__Area, 'Yonge_and_Dundas') where commercial__Building like '%Yonge%Dundas%'";
$db->update($qry_yonge_dundas);
if($debug=='yes') 
{
	echo "<p>Query: $qry_yonge_dundas </p>"; 
	//exit;
}


$qry_king_west="update commercial set commercial__Area=concat_ws('|',commercial__Area, 'King_West') where commercial__Building like '%King%West%'";
$db->update($qry_king_west);
if($debug=='yes') 
{
	echo "<p>Query: $qry_king_west </p>"; 
	//exit;
}

$qry_financial_core="update commercial set commercial__Area=concat_ws('|',commercial__Area, 'Downtown_Core') where commercial__Building like '%downtown%core%'";
$db->update($qry_financial_core);
if($debug=='yes') 
{
	echo "<p>Query: $qry_financial_core </p>"; 
	//exit;
}



?>
