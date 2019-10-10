<?php


class CFG{

 private static $action;
 private static $ordersource;
 private static $transaction;
 private static $gbauthdate;
 private static $dateval;
 private static $distributor;
 private static $operatorURL;
 private static $sharedSecret;
 private static $linkURL;




 /*
 *	Generates links provided by the order id
 */
 public static function generateLinks($orderId){

	if(empty($orderId)){
		return false;
	}

   self::loadXML();

   $pClass = "text-center";
   $btnClass = "btn btn-submit";
   $spnClass = "fas fa-download mr-3";

   $order = new Order();
   $order->get($orderId);
   $proNames = $order->getProductNames();
   $proSkus = $order->getProductSkus();
   $resIds = [];
   $links = "";

   for($x = 0; $x < count($proSkus); $x++){
    $sku = $proSkus[$x];

    $result = getResId($sku);
     if($result){
        $name = $proNames[$x];
        $resIds[] = ["name" => $name, "resid" =>$result];
     }
   }//for

   for($x=0 ; $x < count($resIds); $x++){
     $url = self::generateURL($resIds[$x]["resid"]);
     $name = $resIds[$x]["name"];
    $links .= "<p class='$pClass'><a href=$url class='$btnClass' ><span class='$spnClass'> </span> $name </a></p>" ;
   }



   return $links;
 }//generateLinks


 /*
 *	Generates the download URL
 */
 public static function generateURL($bookID){


   // rights is optional paramter. Omit it if there are no permissions to send (no further restriction);
   //$rights= $rights ? "&rights=".$rights : "";

   $bookDownloadURL =
         "action=".urlencode(self::$action).
         "&ordersource=".urlencode(self::$ordersource).
         "&orderid=".urlencode(self::$transaction).
         "&resid=".urlencode($bookID).
         //$rights.
         //"&gbauthdate=".urlencode($gbauthdate).
         "&dateval=".urlencode(self::$dateval).
         "&gblver=4";



   // Digitaly sign the request
   $bookDownloadURL = self::$linkURL."?".$bookDownloadURL."&auth=".hash_hmac("sha1", $bookDownloadURL, self::$sharedSecret );

  return $bookDownloadURL;
 }//generateURL


 /*
 * Open & parse Configuration xml file
 */
 public static function loadXML(){


   // Read Store Configuration
   $fp = fopen(CFG_XML_FILE,"r");    // open the xml file
   if (!$fp) ERROR_DIE("Error opening config xml file \"".CFG_XML_FILE."\"");

       $xml = fread($fp, filesize(CFG_XML_FILE)); // read in the size of the file into the variable xml
       fclose($fp);                           // close the stream
   if (!$xml) ERROR_DIE("Error reading xml file \"".CFG_XML_FILE."\"");


   $cfg = new DOMDocument("1.0","UTF-8");
   if (!$cfg)
       ERROR_DIE("Can't create Configuration XML Document");

   if( !$cfg->LoadXML($xml) )
     ERROR_DIE ("Failed to parse configuration xml:<br />".$xml);


   // find configuration root element
   $cfgRoot = $cfg->documentElement;

   if (!$cfgRoot || ($cfgRoot->nodeName != CFG_DISTRIBUTOR_INFO))
     ERROR_DIE("Invalid configuration file \"".CONFIG_XML_FILE."\"");


   $distributor = $cfgRoot->getElementsByTagName(CFG_DISTRIBUTOR);

   $distributor  = $distributor->length > 0 ? $distributor->item(0)->nodeValue : ERROR_DIE("Invalid store configuration: distributor info not found."); PRINT_DEBUG( "Distibutor: \"".$distributor."\"" );
   self::$distributor = $distributor;

   $ordersource = $cfgRoot->getElementsByTagName(CFG_ORDERSOURCE);
   $ordersource = $ordersource->length > 0 ? $ordersource->item(0)->nodeValue : ERROR_DIE("Invalid store configuration: ordersource info not found."); PRINT_DEBUG( "Ordersource: \"".$ordersource."\"" );
   self::$ordersource = $ordersource;

   $sharedSecret = $cfgRoot->getElementsByTagName(CFG_SHARED_SECRET);
   $sharedSecret = $sharedSecret->length > 0 ? $sharedSecret->item(0)->nodeValue : ERROR_DIE("Invalid store configuration: sharedSecret info not found."); PRINT_DEBUG( "SharedSecret: \"".$sharedSecret."\"" );
   $sharedSecret = base64_decode($sharedSecret);PRINT_DEBUG( "SharedSecret base64 decoded: \"".$sharedSecret."\"" );
   self::$sharedSecret = $sharedSecret;


   $linkURL = $cfgRoot->getElementsByTagName(CFG_LINK_URL);
   $linkURL = $linkURL->length > 0 ? $linkURL->item(0)->nodeValue : ERROR_DIE("Invalid store configuration: linkURL info not found."); PRINT_DEBUG( "linkURL: \"".$linkURL."\"" );
   self::$linkURL = $linkURL;

   $operatorURL = $cfgRoot->getElementsByTagName(CFG_OPERATOR_URL);
   $operatorURL = $operatorURL->length > 0 ? $operatorURL->item(0)->nodeValue : ERROR_DIE("Invalid store configuration: operatorURL info not found."); PRINT_DEBUG( "operatorURL: \"".$operatorURL."\"" );
    self::$operatorURL = $operatorURL;

   self::$action=KEY_ACT_PURCHASE;
   self::$transaction=get_uniqueID();
   $bookResID=0; PRINT_DEBUG("Resource ID: \"".$bookResID."\"");
   self::$dateval=time();
   self::$gbauthdate=gmdate('r', self::$dateval);
 }//loadXML

}//class CFG
