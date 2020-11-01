<?php

function geocode($query){
    
    $curl = curl_init( "https://maps.googleapis.com/maps/api/geocode/json?address=${query}&region=uk&key=" . GOOGLE_CLIENT_KEY );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec( $curl );
    curl_close( $curl );
    
    $data = json_decode($response);
    return $data->results[0]->geometry->location;
}