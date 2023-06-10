<?php


define('api_url','https://kundenkonto.fonial.de/api/2.0');


class Fonial{
    private $_sid = false;
    function __construct(){
        $this->auth();
    }

    /**
     * Diese Methode listet alle verfügbaren IP-Endgeräte eines Benutzerkontos mit deren ID auf. Die ID wird u.a. benötigt, um einen Anruf mittels Callback-Verfahren aufzubauen.
     * @return array
     */
    function deviceGet(): Array{
        return post(api_url.'/devices/get',array( "sid" => $this->_sid) );
    }
    /**
     * Diese Methode listet alle verfügbaren Rufnummern eines Benutzerkontos mit deren ID auf. 


     * @return array
     */
    function numbersGet(): Array{
        return post(api_url.'/numbers/get',array( "sid" => $this->_sid) );
    }
    /**
     * Diese Methode ermöglicht den Aufruf des Einzelverbindungsnachweises des jeweiligen Benutzerkontos in einer anzugebenden Zeitspanne. 
     * @param String $start Zeitstempel (Format YYYY-MM-DD HH:MM:SS), markiert das Ende des auszugebenden Einzelverbindungsnachweises.
     * @param String $end Zeitstempel (Format YYYY-MM-DD HH:MM:SS), markiert das Ende des auszugebenden Einzelverbindungsnachweises.
     * @return array
     */
    function evnGet(String $start, String $end = ''): Array{
        if(empty($end)){
            $end = date('Y-m-d H:i:s');
        }
        return post(api_url.'/evn/get',array( "sid" => $this->_sid, "start" => $start, "end" => $end) );
    }
    /**
     * Diese Methode ermöglicht den Aufruf der eingehenden Verbindungen des jeweiligen Benutzerkontos in einer anzugebenden Zeitspanne.
     * @param String $start Zeitstempel (Format YYYY-MM-DD HH:MM:SS), markiert das Ende des auszugebenden Einzelverbindungsnachweises.
     * @param String $end Zeitstempel (Format YYYY-MM-DD HH:MM:SS), markiert das Ende des auszugebenden Einzelverbindungsnachweises.
     * @return array
     */
    function journalGet(String $start, String $end = ''): Array{
        if(empty($end)){
            $end = date('Y-m-d H:i:s');
        }
        return post(api_url.'/journal/get',array( "sid" => $this->_sid, "start" => $start, "end" => $end) );
    }
    
    function auth(){
        $session = post(api_url.'/session');
        
        if($session['status'] == 'ok'){
            $sid = $session['sid'];
            if(debug) echo '$sid: '.$sid;
            
            
            $session_authenticate = array(
                "sid" => $sid,
                "username" => username,
                "password" =>  password
            );
            
            $auth = post(api_url.'/session/authenticate',$session_authenticate);
            if(debug) print_r($auth);
            
            if($auth['status'] == 'ok' && $auth['authenticated'] == '1'){
                $this->_sid = $sid;
                return true;
            } else {
                throw new Exception('session authenticate error',$auth);
            }
            
        } else {
            throw new Exception('session error',$session);
        }
    }
}


function post(String $url, Array $data = array()): Array{
    $jsonData = json_encode($data);
    if(debug) echo 'call url:'. $url."\n";
    
    $headers = [
        'Content-Type: application/json'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response,true);
}

