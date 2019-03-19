<?php
namespace Farbesofts\Checkrolepast\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Carbon\Carbon;

class CheckRolePast{
    public function handle($request, Closure $next,$role)
    {
        $timetable = $request->user()->getTimetable();
        $time_now = Carbon::now()->format('H:i:s');

        if($request->user()->hasRole($role) &&
            ($time_now < $timetable->time_initiate || $time_now > $timetable->time_end ) ){
            Session()->put('timetable',$timetable);
            auth()->logout();
            return redirect('/notaccess');
        }
        return $next($request);
    }
}