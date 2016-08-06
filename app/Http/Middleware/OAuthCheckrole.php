<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthCheckrole
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public  function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function handle($request, Closure $next, $role)
    {
        $id = Authorizer::getResourceOwnerId();
        $user = $this->userRepository->find($id);

        if($user->role != $role){
            abort(403, 'Access Forbidden');
        }
        return $next($request);
    }
}
