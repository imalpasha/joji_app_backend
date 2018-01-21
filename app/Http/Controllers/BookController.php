<?php

namespace App\Http\Controllers;

use App\Http\Model\ImageLoad;
use Illuminate\Http\Request;

class BookController extends Controller
{
  
   public function test(Request $request)
	{
			//image from app (android)	
			$binary=base64_decode($request->input('image1'));
			$androidImage =  time().'_logo.jpg';
			
			//check if image null
			if($request['image1'] == null){
					return response()->json(array(
					'status' => "N",
				));
			}
			
			//path to image
			
			$file = fopen('image/'.$androidImage, 'wb');
			fwrite($file, $binary);
			fclose($file);
			
			//rewrite - path (image located at blog/public/image/)
			$androidImage = 'image/'.$androidImage;
			//$androidImage = 'image/logo2.jpg';

		
			//get image from db.. and compare with recently uploaded image.
			$allImage = ImageLoad::all();
			
			//get the highest only
			$high = 0;
			
			for($x = 0 ; $x < count($allImage) ; $x++ ){
				echo "</br>";
				$accuracy = $this->compareImages('image/'.$allImage[$x]->logo_path,$androidImage,0.5);
				
				if($high < $accuracy){
					$high = $accuracy;
					$dbPosition = $x;
				}
				
				
			}
						
			return response()->json(array(
				'status' => "Y",
				'desc_name' => $allImage[$dbPosition]->desc_name,
				'desc_description' => $allImage[$dbPosition]->desc_description,
			));
		
				
	}
	
	public function compareImages($imagePathA, $imagePathB, $accuracy){
	  //load base image
	  $bim = imagecreatefromjpeg($imagePathA);
	  //create comparison points
	  $bimX = imagesx($bim);
	  $bimY = imagesy($bim);
	  $pointsX = $accuracy*5;
	  $pointsY = $accuracy*5;
	  $sizeX = round($bimX/$pointsX);
	  $sizeY = round($bimY/$pointsY);
	  
	  //load image into an object
	  $im = imagecreatefromjpeg($imagePathB);
	  
	  
	  //loop through each point and compare the color of that point
	  $y = 0;
	  $matchcount = 0;
	  $num = 0;
	  for ($i=0; $i <= $pointsY; $i++) { 
		$x = 0;
		for($n=0; $n <= $pointsX; $n++){
	  
		  $rgba = imagecolorat($bim, $x, $y);
		  $colorsa = imagecolorsforindex($bim, $rgba);
	  
		  $rgbb = imagecolorat($im, $x, $y);
		  $colorsb = imagecolorsforindex($im, $rgbb);
	  
		  if($this->colorComp($colorsa['red'], $colorsb['red']) && $this->colorComp($colorsa['green'], $colorsb['green']) && $this->colorComp($colorsa['blue'], $colorsb['blue'])){
			//point matches
			$matchcount ++;
		  }
		  $x += $sizeX;
		  $num++;
		}
		$y += $sizeY;
	  }
	  //take a rating of the similarity between the points, if over 90 percent they match.
	  $rating = $matchcount*(100/$num);
	  return $rating;
	}

	public function colorComp($color, $c){
		//test to see if the point matches - within boundaries
	  if($color >= $c-2 && $color <= $c+2){
		return true;
	  }else{
		return false;
	  }
	}

   

}