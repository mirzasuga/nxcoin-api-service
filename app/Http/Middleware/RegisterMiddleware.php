<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisterMiddleware
{

    protected $user;

    public function __construct(User $user) {
        
        $this->user = $user;

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $refferal_id = $request->refferal_id;
        
        if( $refferal_id ) {
            
            $this->checkRefferal($refferal_id);
            
        }

        return $next($request);
    }

    protected function checkRefferal($refferal_id) {

        $user = $this->user->find($refferal_id);

            if(!$user)
                throw new ModelNotFoundException('Refferal not Found',422);
        return;
    }
}
