<?php

    if (!function_exists("convertDateTimeToFarsi")) {
        /*********************************
         *
         * @return
         ********************************/
        function convertDateTimeToFarsi($date)
        {
            return \Morilog\Jalali\Jalalian::forge($date)->format("Y-m-d H:i:s");
        }
    }

    if (!function_exists("convertDateToFarsi")) {
        /*********************************
         *
         * @return
         ********************************/
        function convertDateToFarsi($date)
        {
            return \Morilog\Jalali\Jalalian::forge($date)->format("Y-m-d");
        }
    }

    if (!function_exists("randomCode")) {
        /*********************************
         *
         * @return
         ********************************/
        function randomCode($size)
        {
            $alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $code = "";

            for($i=0; $i< $size ;$i++){
                $code .= $alpha[rand(0, 61)];
            }
            return $code;
        }
    }

    if (!function_exists("UploadFunc")) {
        /*********************************
         *
         * @return
         ********************************/
        function UploadFunc($file,$folderName)
        {
            $basename=explode(".",$file->getClientOriginalName())[0];
            $newName=$basename."_".(time().randomCode(3)).".".$file->getClientOriginalExtension();
            $path=$file->storeAs("upload/".$folderName,$newName,"public");
            Intervention\Image\Facades\Image::make(storage_path("app/public/upload/{$folderName}/{$newName}"))->resize(50,50)->save();
            return $path;
        }
    }

    if (!function_exists("emailTo")) {
        /*********************************
         *
         * @return
         ********************************/
        function emailTo($toEmail,$contact)
        {
            \Illuminate\Support\Facades\Mail::to($toEmail)->send(new \App\Mail\UserMail($contact));
            return true;
        }
    }

    if (!function_exists("convertObjToArr")) {
        /*********************************
         *
         * @return
         ********************************/
        function convertObjToArr($object,$filed)
        {
            $array=[];
            foreach ($object as $key => $obj){
                $array[]=$obj->$filed;
            }
            return $array;
        }
    }

    if (!function_exists("userIP")) {
        /*********************************
         *
         * @return
         ********************************/
        function userIP(){
            $IPaddress="";
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $IPaddress=$_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $IPaddress=$_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $IPaddress=$_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
                $IPaddress=$_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $IPaddress=$_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $IPaddress=$_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $IPaddress=$_SERVER['REMOTE_ADDR'];
            else
                $IPaddress='UNKNOWN';
            return $IPaddress;
        }
    }

    if (!function_exists("userLocation")) {
        /*********************************
         *
         * @return
         ********************************/
        function userLocation($IP){
            $userIP=$IP;
    //        \Illuminate\Support\Facades\Http::get('http://ipwho.is/'.$userIP);
            $curl=curl_init('http://ipwho.is/'.$userIP);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $IP_Who_Is=json_decode(curl_exec($curl), true);
            curl_close($curl);
            return $IP_Who_Is;
        }
    }

    if (!function_exists("convertShamsiToMiladi")) {
        /*********************************
         *
         * @return
         ********************************/
        function convertShamsiToMiladi(string $date) {
            return \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $date)->format('Y-m-d');
        }
    }

