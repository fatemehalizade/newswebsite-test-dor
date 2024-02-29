<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip=userIP();
        $userLocation=userLocation($ip);
        $data = [
          "url" => url()->full(),
          "ip" => $ip,
          "status" => $userLocation["success"],
        ];
        if($userLocation["success"]){
            $data["continent"]=$userLocation["continent"];
            $data["country"]=$userLocation["country"];
            $data["region"]=$userLocation["region"];
            $data["region_code"]=$userLocation["region_code"];
            $data["city"]=$userLocation["city"];
            $data["latitude"]=$userLocation["latitude"];
            $data["longitude"]=$userLocation["longitude"];
        }
        Visit::create($data);
        return $next($request);
    }
}
