<?php


/**
 *
 */
class Resource
{
  private static $file  = PATH_TO_JSON;

  // appends  multiple sources of data to the resource array
  public static function appendData($data){

    $data = self::appendId($data);
    $data = self::appendSku($data);
    return $data;
  }


  // appends  the resource id to the resource array
  public static function appendId($data){
  	for($x = 0; $x < count($data); $x++){
  		$thumb = $data[$x]["thumbnail"];
  		$find = "media/";
  		$last = strpos($thumb,$find)+strlen($find);
  		$url = substr($thumb,0,$last);
  		$id = str_replace($url,"",$thumb);
  		$id = str_replace(".img","",$id);
  		$data[$x]["resid"] = "urn:uuid:".$id;

  	}
  	return $data;
  }


  // appends  the resource sku to the resource array
  public static function appendSku($data){

  	for( $i = 0; $i < count($data) ; $i++){
  		$sku = str_replace("urn:isbn:", "", $data[$i]["identifier"]);

  		$data[$i]["sku"] = $sku;
  	}

  	return $data;
  }

  // checks if both IDs are valid outputs information based on their values
    public static function checkIDs($order, $cust, $orderId){

  	if($order  && $cust){

  	 $list =	CFG::generateLinks($orderId);
     json(["list" => $list]);

  	}elseif(empty($order)){

  		$err = "<p class='text-center text-danger'>
                <span class='fas fa-exclamation-circle'><span>
                the order id does not match the customer id
                </p>";
  		json(["error" => $err]);

  	}elseif(empty($cust)){
  		$err = "<p class='text-center text-danger'>
                <span class='fas fa-exclamation-circle'><span>
                  the customer id does not match the order id
                  </p>";
  		json(["error" => $err]);

  	}else{

  		$err = "<p class='text-center text-danger'>
                <span class='fas fa-exclamation-circle'><span>
                  none of the information matches
                  </p>";
  		json(["error" => $err]);
  	}

  }

  // retreives the json file
   public static function getJson(){
     $file = self::$file;
  	$json = file_get_contents($file);
  	if(isset($json)){
  		$json = json_decode($json,1);
  		return $json;
  	}
  	throw new Exception("could not find json file");
  }

  // reterives  the resource id based on the sku number
  public static function getResId($sku){
  	$json = self::getJson();

  	for($x =0 ; $x < count($json);$x++){
  		$current_sku = $json[$x]["sku"];
  		if ( $sku  == $current_sku){
  			$resid = $json[$x]["resid"];
  			break;
  		}
  	}
  	$resid = !empty($resid)? $resid: false;

  	return $resid;
  }


  // sends json data to a specific destination
	public static function jsonTo($array,$destination = null){
	  $filename = empty($destination)? self::$file : $destination;

		$json = json_encode($array);
		$result =file_put_contents($filename,$json);
		chmod($filename,0775);

		if(empty($result)){
		  throw new Exception("JSON file has not been created");
		}else{
		  echo "file was created successfully";
		}
	}

}// Resource
