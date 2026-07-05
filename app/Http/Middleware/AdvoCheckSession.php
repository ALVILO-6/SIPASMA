<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AdvoStruktur;

class AdvoCheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah session sudah expired tapi user masih logged_in di DB
        if(!session()->has('nim')) {
            $nim = $request->input('nim');
            if($nim) {
                AdvoStruktur::where('nim',$nim)
                ->where('logged_in',true)->update(['logged_in' => false]);
            }
        }
        return $next($request);
    }
}
