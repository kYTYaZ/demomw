<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Place;
use App\Hour;
use \App\Status;
use \App\Review;
use App\City;
use \App\Type;
use Illuminate\Support\Facades\Hash;
use Mail;

use App\User;
 class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
 
    
    public function confirmation(){
        
       /*  Mail::send('emails.reservationConfirm', array(), function($message) {
             
         
            $message->to("informacion@cristiangarcia.co", "cristian")
                    ->subject('Bienvenido a MeetWork cristian' );

        });
        */
        return view('emails.reservationInfo');
    }
    /**   
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        
        return view('home');
    }
    
    
    public function importUsers(){ 
        $user= new Place(); 
        return $user;
        
        
    }

    public function importSites() {
        $sites = file_get_contents("http://dev.meetwork.co/getAllScapes");
        $sitesArray = json_decode($sites, true);

        foreach ($sitesArray as $value) {
            $location = $value["location"]["coordinates"];


                $logos="https://s3.amazonaws.com/meetworks/thumbnails/9/logo/1522621990_small_bio-675x731.jpg";
                if(isset($value["logo"])){
                    $logos=$value["logo"];
                }

                $placeArray = array(
                    "unicid" => $value["_id"],
                    "name" => $value["name"],
                    "admin" => $value["admin"],
                    "phone" => $value["phone"],
                    "email" => $value["email"],
                    "address" => $value["address"],
                    "slug" => $value["slug"],
                    "type" => $value["typeSpace"],
                    "logo" => $logos,
                    "status" => $value["status"],
                    "description" => $value["description"],
                    "lat" => $location[0],
                    "lng" => $location[1],
                    "city_id"=>1
                );

                $place = Place::create($placeArray);

                if(isset($value["services"])){
                    foreach ($value["services"] as $valueServices) {
                        $service = Service::updateOrCreate(["name" => $valueServices["name"], "icon" => $valueServices["icon"]]);
                        $place->services()->sync($service->id);
                    }
                }
                
                if(isset($value["spaces"])){
                    foreach ($value["spaces"] as $valueSpaces) {
                    $service = Service::updateOrCreate(["name" => $valueSpaces["name"], "icon" => $valueSpaces["icon"]]);
                    $place->spaces()->sync($service->id);
                }
                } 
                
                if(isset($value["hours"])){
                    foreach ($value["hours"] as $valueHours) {
                        $place->hours()->updateOrCreate(['hour_open' => $valueHours["hour_open"], 'hour_close' => $valueHours["hour_close"], "order_hour" => $valueHours["orderHour"]]);
                    }
                }
                
                if(isset($value["reviews"])){
                    foreach ($value["reviews"] as $valueReview) {
                    $arrayReview=array(
                        "rating"=>$valueReview["rating"],
                        "comment"=>$valueReview["comment"],
                        "user_id_m"=>$valueReview["userreview"]["id"],
                        "user_id"=>1
                    );
                    $place->reviews()->updateOrCreate($arrayReview);
                }
                }
                
                
                if(isset($value["reviewsGoogle"])){
                      foreach ($value["reviewsGoogle"] as $valueReviewGoogle) {
                    $arrayReview=array(
                        "author_name"=>$valueReviewGoogle["author_name"],
                        "author_url"=>$valueReviewGoogle["author_url"],
                        "language"=>$valueReviewGoogle["language"],
                        "profile_photo_url"=>$valueReviewGoogle["profile_photo_url"],
                        "rating"=>$valueReviewGoogle["rating"],
                        "relative_time_description"=>$valueReviewGoogle["relative_time_description"],
                        "text"=>$valueReviewGoogle["text"],
                        "time"=>$valueReviewGoogle["time"],
                    );
                    $place->Googlereviews()->updateOrCreate($arrayReview);
                }
                }
              
                if(isset($value["images"])){
                    foreach ($value["images"] as $valueImages) {
                        $size=10000;
                        if($valueImages["size"]){
                            $size=$valueImages["size"];
                        }
                    $arrayImages=array(
                        "url"=>$valueImages["url"],
                        "size"=>$size,
                    );
                    $place->placeImages()->updateOrCreate($arrayImages);
                }

                }
                
                if(isset($value["reservations"])){
                     foreach ($value["reservations"] as $valueRservation) {
                         $status=2;
                         if(isset($valueRservation["status"])){
                            $service = Status::updateOrCreate(["name" => $valueRservation["status"]]);
                            $status=$service->id;
                         }
                    if (isset($valueRservation["asistans"])) {
                        $arrayReservation = [
                            "date_reserv" => $valueRservation["datereserv"],
                            "status_id" =>$status,
                            "place_id" => $valueRservation["site_id"],
                            "asistans" => json_encode($valueRservation["asistans"])
                        ];

                        $place->reservations()->updateOrCreate($arrayReservation);
                    }
                }
                }
                $cityName="Buenos Aires";
                if($value["city"]["name"]){
                    $cityName=$value["city"]["name"];
                }
               
                    $city = City::updateOrCreate(["name" => $cityName]);
                    $place->city_id=$city->id;
                    $place->save();
                    
                    $type = Type::updateOrCreate(["name" => $value["type"]["name"]]);
                    $place->type=$type->id;
                    $place->save();
            
        }
    }

    public function extract_tags_from_url($url) {
        $tags = array();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $contents = curl_exec($ch);
        curl_close($ch);

        if (empty($contents)) {
            return $tags;
        }

        if (preg_match_all('/<meta([^>]+)content="([^>]+)>/', $contents, $matches)) {
            $doc = new \DOMDocument();
            $doc->loadHTML('<?xml encoding="utf-8" ?>' . implode($matches[0]));
            $tags = array();
            foreach ($doc->getElementsByTagName('meta') as $metaTag) {
                if ($metaTag->getAttribute('name') != "") {
                    $tags[$metaTag->getAttribute('name')] = $metaTag->getAttribute('content');
                } elseif ($metaTag->getAttribute('property') != "") {
                    $tags[$metaTag->getAttribute('property')] = $metaTag->getAttribute('content');
                }
            }
        }


        $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $contents, $matches) ? $matches[1] : null;

        $tags["simpletitle"] = $title;

        return $tags;
    }

    public function processWebSite(Request $request) {
        $metas = $this->extract_tags_from_url($request->get("url"));
        $title = "";
        $thumbnail_url = "";
        if (isset($metas["og:title"])) {
            $title = $metas["og:title"];
        } else if (isset($metas["twitter:title"])) {
            $title = $metas["twitter:title"];
        } else if (isset($metas["simpletitle"])) {
            $title = $metas["simpletitle"];
        }

        if (isset($metas["og:image"])) {
            $thumbnail_url = $metas["og:image"];
        } else if (isset($metas["twitter:image"])) {
            $thumbnail_url = $metas["twitter:image"];
        }

        $site = "";
        if (isset($metas["og:site_name"])) {
            $site = $metas["og:site_name"];
        } else if (isset($metas["twitter:site"])) {
            $site = $metas["twitter:site"];
        } else {
            $site = $request->get("url");
        }


        $description = "";
        if (isset($metas["description"])) {
            $description = $metas["description"];
        } else if (isset($metas["og:description"])) {
            $description = $metas["og:description"];
        }


        return array("title" => $title, "thumbnail_url" => $thumbnail_url, "description" => $description, "site" => $site);
    }

    public function processYoutube(Request $request) {

        try {


            $scrapeUrl = file_get_contents("https://www.youtube.com/oembed?url=" . $request->get("url") . "&format=json");

            $embedYoutube = json_decode($scrapeUrl, true);

            if (isset($embedYoutube["author_name"])) {
                return $embedYoutube;
            } else {
                return array("error" => true);
            }
        } catch (\Exception $exc) {
            return array("error" => true);
        }
    }

}
