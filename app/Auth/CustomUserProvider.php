<?php namespace App\Auth;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\Http\Controllers\Auth\Itsc\Itscapi;

class CustomUserProvider implements UserProvider {

    protected $model;

    protected $models;

    protected $spec_model;

    public function __construct($models)
    {
        $this->models = $models;
        $model = "";
    }

    public function retrieveById($identifier)
    {
        $this->model = $this->models[0];
        return $this->createModel()->newQuery()->find($identifier);
    }

    public function retrieveByCredentials(array $credentials)
    {
        $sauth = Itscapi::authen_with_ITSC_api($credentials['email'], $credentials['password']);

//        dd($sauth);
        if ($sauth->success == true)
        {
//            $parts = explode('@', $credentials['email']);
//            $username = $parts[0];
            $email = $credentials['email'] . '@cmu.ac.th';
            $this->model = $this->models[0];
            $query = $this->createModel()->newQuery();
            $query->where('username',$credentials['email']);

//            dd($query->first());
            $sinfo = Itscapi::get_student_info($credentials['email'],$sauth->ticket->access_token);

            return $query->first();
        }

        return redirect('/login')->withErrors([
            'email' => 'The credentials you entered did not match our records. Try again?',
        ]);

    }

    protected function findUser($userDetails)
    {

    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
//        $model = $this->createModel();
//
//        return $model->newQuery()
//            ->where($model->getKeyName(), $identifier)
//            ->where($model->getRememberTokenName(), $token)
//            ->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
//        $user->setRememberToken($token);
//
//        $user->save();
    }

//    /**
//     * Retrieve a user by the given credentials.
//     *
//     * @param  array  $credentials
//     * @return \Illuminate\Contracts\Auth\Authenticatable|null
//     */
//    public function retrieveByCredentials(array $credentials)
//    {
//        // First we will add each credential element to the query as a where clause.
//        // Then we can execute the query and, if we found a user, return it in a
//        // Eloquent User "model" that will be utilized by the Guard instances.
//        $query = $this->createModel()->newQuery();
//
//        foreach ($credentials as $key => $value)
//        {
//            if ( ! str_contains($key, 'password'))
//            {
//                $query->where($key, $value);
//            }
//        }
//
//        return $query->first();
//    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
//        $plain = $credentials['password'];
//
//        return $this->hasher->check($plain, $user->getAuthPassword());
        return true;
    }

    /**
     * Create a new instance of the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createModel()
    {
//        $name = class_basename($this->model);
//        $name = 'App\\' . $name;

        $class = '\\'.ltrim($this->model, '\\');

        return new $class;
    }

}