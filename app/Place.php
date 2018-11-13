<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    //
        protected $fillable=["city_id","id","unicid","name","admin","phone","email","address","slug","type","logo","status","description","lat","lng"];

    public function services(){
        return $this->belongsToMany('App\Service');
    }
    
    public function spaces(){
        return $this->belongsToMany('App\Space');
    }
    
    public function hours(){
        return $this->hasMany('App\Hour');
    }
    
      public function reviews(){
        return $this->hasMany('App\Review');
    }
    
    
       public function neighborhood(){
        return $this->hasOne('App\Neighborhood',"id","neighborhood_id");
    }
    
    
    public function city(){
        return $this->hasOne('App\City',"id","city_id");
    }
    
    
    public function Googlereviews(){
        return $this->hasMany('App\GoogleReview');
    }
    
    
      public function placeImages(){
        return $this->hasMany('App\PlaceImage');
    }
    
    
      public function cities(){
        return $this->hasMany('App\City');
    }
    
        public function reservations(){
        return $this->hasMany('App\Reservation');
    }
    
       public function reservationsLimit(){
        return $this->hasMany('App\Reservation')->take(2);
    }
  
    
    public function types(){
        return $this->hasOne('App\Type',"id","type");
    }
    
    public function getAllSites(){
        return $this
                ->with("services")
                ->with("hours")
                ->with("types")
                ->with("placeImages")
                ->with("reviews")
  
                
                ->with("spaces")
                ->get();
    } 
    
    public function findByName($name){
        return $this
                ->where("status",2)
                ->select("name","id","type")
                ->with("reviews")

                ->where("name","like","%".$name."%")
                ->get();
        
    }
    
     public function findBySlug($slug){
        return $this
                ->with("placeImages")
                ->with("services")
                ->with("hours")
                ->with("reviews")
                ->where("status",2)
                ->with("types")
                ->with("neighborhood")
                ->with("city") 
                ->with("reservationsLimit")
                ->with("reservations")
                ->where("slug",$slug)
                ->first();
    }
    
    public function findById($id){
        return $this
                ->with("placeImages")
                ->with("services")
                ->with("hours")
                ->with("reviews")
                ->where("status",2)
                ->with("types")
                ->with("reservationsLimit")
                ->with("reservations")
                ->where("id",$id)
                ->first();
    }
    public function getPlaces(){
        return $this
                ->with("placeImages")
                ->with("services")
                ->with("hours")
                ->with("reviews")
                ->where("status",2)
                ->with("types")
                ->with("reservationsLimit")
                ->with("reservations")
                ->get();
    } 
    
    
    
    public function getPlacesByFilters($filters){
                $query = Place::query();

                if($filters->has("services")){
                    if($filters->get("services")!= -1){
                        $query->join("place_service","place_id","places.id");
                        $query->where("place_service.service_id",$filters->get("services"));
                    }   
                }
                if($filters->has("types")){
                     if($filters->get("types")!= -1){
                        $query->where("type",$filters->get("types"));
                    }
                }
                if($filters->has("extras")){
                    if($filters->get("extras")==1){
                         $query->select("places.*",DB::raw("(select count(id) from reservations where reservations.place_id = places.id) as countreservation"));
                         $query->orderBy("countreservation","desc");
                    }
                    
                    if($filters->get("extras")==2){
                         $query->select("places.*",DB::raw("(select avg(rating) from reviews where reviews.place_id = places.id) as avgreviews"));
                         $query->orderBy("avgreviews","desc");
                    }
                   
                }
                $query->with("placeImages");
                $query->with("services");
                $query->with("hours");
                $query->with("reviews");
                $query->where("status",2);
                $query->with("types");
                $query->with("reservationsLimit");
                $query->with("reservations");
                
        
        return $query->get();
    } 
}
