<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Place;
use \App\User;
use \App\Space;
use \App\Reservation;
use \App\Profile;
use \App\Type;
use \App\Service;
use App\Neighborhood;
use App\AssistantReservation;
use Carbon\Carbon;
use Mail;

class PlaceController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function dumpsites() {
        $place = new Place();
        $getAllSites = $place->getAllSites();
        return $getAllSites;
    }

    public function reservation(Request $request) {

        try {



            $place = Place::find($request->get("place"));
            $arrayReservation = [
                "date_reserv" => $request->get("time") . " " . $request->get("hour"),
                "hour" => $request->get("hour"),
                "status_id" => 1,
                "place_id" => $request->get("place"),
                "asistans" => json_encode($request->get("assistants"))
            ];




            $dateToSpanish = $this->dateToSpanish($request->get("time") . " " . $request->get("hour"));




            $reservation = $place->reservations()->updateOrCreate($arrayReservation);
            $arrayReservation["formatedDate"] = $dateToSpanish;

            $reservationArray = array();
            foreach ($request->get("assistants") as $key => $assistant) {
                $AssistantReservation = new AssistantReservation();

                $user = new User();
                $assistantModel = $user->getUserByEmail($assistant);

                if ($assistantModel) {
                    $AssistantReservation->is_user = 1;
                    $reservationArray[$key]["userModel"] = $assistantModel->toArray();
                } else {
                    $AssistantReservation->is_user = 0;
                    $reservationArray[$key]["userModel"] = null;
                }

                $reservationArray[$key]["reservation"] = $arrayReservation;
                $reservationArray[$key]["place"] = $place;
                $AssistantReservation->user_email = $assistant;
                $AssistantReservation->place_id = $request->get("place");
                $AssistantReservation->reservation_id = $reservation->id;
                if ($key == 0) {
                    $AssistantReservation->status = 1;
                }
                $AssistantReservation->save();
                $reservationArray[$key]["data"] = $AssistantReservation->toArray();
                $reservationArray[$key]["admin"] = $reservationArray[0]["userModel"]["name"];
            }


            foreach ($reservationArray as $reservationData) {

                if ($reservationData["data"]["is_user"] == 1) {
                    Mail::send('emails.reservationInfoNoUser', $reservationData, function($message) use($reservationData) {
                        $message->to($reservationData["userModel"]["email"], $reservationData["userModel"]["name"])
                                ->subject('Información de tu reserva ');
                    });
                } else {
                    Mail::send('emails.reservationInfoNoUser', $reservationData, function($message) use($reservationData) {
                        $message->to($reservationData["userModel"]["email"], $reservationData["userModel"]["name"])
                                ->subject('Información de tu reserva ');
                    });
                }
            }
            return array("response" => true);
        } catch (\Exception $exc) {

            return array("response" => false);
        }
    }

    public function dateToSpanish($dateString) {
        $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $date = Carbon::parse($dateString);
        $month = $months[($date->format('n')) - 1];
        return array("d" => $date->format('d'), "m" => $month, "y" => $date->format('Y'));
    }

    public function getServicesAndSpaces() {

        $services = Service::select("name", "id", "icon")->get();

        $types = Type::select("name", "id")->get();
        return array("services" => $services, "types" => $types, "extras" => array(array("name" => "Más reservados", "id" => "1"), array("name" => "Más calificados", "id" => "2"), array("name" => "Recomendados por la comunidad", "id" => "3")));
    }

    public function searchSpace(Request $request) {

        $place = new Place();
        $findByName = $place->findByName($request->get("q"));




        foreach ($findByName as $value) {
            $value->position = array("lat" => floatval($value->lat), "lng" => floatval($value->lng));

            $value->icon = "https://s3.amazonaws.com/meetworks/" . $value->type . "_normal.png";

            if ($value->reviews->avg("rating")) {
                $value->rating = $value->reviews->avg("rating");
            } else {
                $value->rating = 5;
            }
        }
        return $findByName;
    }

    public function findById(Request $request) {
        $place = new Place();
        $findById = $place->findById($request->get("id"));
        $findById->position = array("lat" => floatval($findById->lat), "lng" => floatval($findById->lng));

        if ($findById->type == 1) {
            $findById->icon = "/img/placeOneIcon.png";
        }

        $findById->icon = "https://s3.amazonaws.com/meetworks/" . $findById->type . "_normal.png";


        if ($findById->reviews->avg("rating")) {
            $findById->rating = $findById->reviews->avg("rating");
        } else {
            $findById->rating = 5;
        }

        $assistants = [];
        foreach ($findById->reservationsLimit as $valueL) {
            $assistants[] = json_decode($valueL->asistans)[0];
        }
        $reservation = new Reservation();
        $getAssistants = $reservation->getAssistants($assistants);
        $findById->assistansUsers = $getAssistants;
        return $findById;
    }

    public function setNeiborhood() {
        $place = Neighborhood::all();
        foreach ($place as $value) {

            $data = $this->getdata("https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($value->name . ",Buenos Aires") . ",&key=AIzaSyD2t5yFhzd2B1Re1NhX8dzxu55RGNtRpxI");

            $datajson = json_decode($data, true);

            $value->lat = $datajson["results"][0]["geometry"]["location"]["lat"];
            $value->lng = $datajson["results"][0]["geometry"]["location"]["lng"];
            $value->save();
        }
        dd($place);
    }

    public function fakeip() {
        return long2ip(mt_rand(0, 65537) * mt_rand(0, 65535));
    }

    public function getdata($url, $args = false) {
        global $session;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: " . $this->fakeip(), "X-Client-IP: " . $this->fakeip(), "Client-IP: " . $this->fakeip(), "HTTP_X_FORWARDED_FOR: " . $this->fakeip(), "X-Forwarded-For: " . $this->fakeip()));
        if ($args) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:8888"); 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function filterPlaces(Request $request) {
        $place = new Place();
        $getPlaces = $place->getPlacesByFilters($request);
        $getPlaces = $this->formatSites($getPlaces);

        return $getPlaces;
    }

    public function places(Request $request) {





        $place = new Place();
        $getPlaces = $place->getPlacesByFilters($request);

        $getPlaces = $this->formatSites($getPlaces);


        return view('place.index')->with("places", $getPlaces);
    }

    public function formatSites($getPlaces) {
        foreach ($getPlaces as $value) {
            $value->position = array("lat" => floatval($value->lat), "lng" => floatval($value->lng));


            $value->icon = "https://s3.amazonaws.com/meetworks/" . $value->type . "_normal.png";

            if ($value->reviews->avg("rating")) {
                $value->rating = $value->reviews->avg("rating");
            } else {
                $value->rating = 5;
            }

            $assistants = [];
            foreach ($value->reservationsLimit as $valueL) {
                $assistants[] = json_decode($valueL->asistans)[0];
            }
            $reservation = new Reservation();
            $getAssistants = $reservation->getAssistants($assistants);
            $value->assistansUsers = $getAssistants;
        }

        return $getPlaces;
    }

    public function findNeighborhood(Request $request) {

        $Neighborhood = new Neighborhood();
        $getByName = $Neighborhood->getByName($request->get("q"));
        return $getByName;
    }

    public function profile($slug) {
        $place = new Place();
        $findBySlug = $place->findBySlug($slug);

        if ($findBySlug->reviews->avg("rating")) {
            $findBySlug->rating = $findBySlug->reviews->avg("rating");
        } else {
            $findBySlug->rating = 5;
        }
        return view('place.profile')->with("place", $findBySlug);
    }

}
