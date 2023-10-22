<?php
namespace App\Services\User;
use GuzzleHttp\Psr7\Request;
use App\Http\Resources\{UserCollection, UserResource, VendorResource};
use App\Models\User;
use App\Repositories\User\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Collection;


class UserService{

    protected $userRepository;

    function __construct (UserRepository $userRepository){

        $this->userRepository = $userRepository;

    }


    public function authenticate(string $username, string $password): ?object
    {

        if($token = auth("api")->attempt(['username' => $username,
        'password' => $password,
            'is_active'=>User::ACTIVE_STATUS])){

            $accessToken=$this->respondWithToken($token);
            $user = auth("api")->user();

            $data['object'] = new UserResource($user);
            $data['token'] = $accessToken;
            // dd( $user);
            return (object)$data;
        }

        return null;
    }
    public function profile():?object
    {

       return new UserResource(auth()->user());
    }
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh($userGuard)
    {
        return $this->respondWithToken(auth($userGuard)->refresh(),$userGuard);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return
            ['access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth("api")->factory()->getTTL() * 60
            ];

    }

    function store($data) : object {


        /***
         * register the user
         * use the bcrypt function to hash the password
         */

        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->store($data);
    }

    function getUserById($userId) : ?object {

        return new UserResource($this->userRepository->findById($userId)
            ->first());

    }
    function getUsers() :? UserCollection  {

        $users =  $this->userRepository->all()
            ->active()
            ->paginate();
            
        return new UserCollection($users);
    }


}
