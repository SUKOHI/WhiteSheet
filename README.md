# WhiteSheet
A Laravel package to get many kinds of DB information through command line.

(This package is maintained under L5.4)

# Installation

Execute the next command.

    composer require sukohi/white-sheet:1.*

Set the service providers in app.php

    'providers' => [
        ...Others...,
        Sukohi\WhiteSheet\WhiteSheetServiceProvider::class,
    ]

Now you have `db:code` and `db:find` in `php artisan` commands.

# Usage

## 1. Generating code

**Basic**

You need to set two arguments to run this package like so.

    php artisan db:code (Model) (SHOWING_TYPE)
    
(e.g.)

    php artisan db:code User array

* In this case, User means `App\User`.

or 

    php artisan db:code App\\User array
    
SHOWING_TYPEs

* array
* rule
* getter
* setter
* request
* js
* seed
* html
* accessor
* mutator

**array**

    php artisan db:code User array
    
(output)

    $array = [
        'id' => 'id',
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'remember_token' => 'remember_token',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

**rule**

    php artisan db:code User rule
    
(output)

    return [
        'id' => 'required',
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'remember_token' => 'required',
        'created_at' => 'required',
        'updated_at' => 'required',
    ];


**getter**

    php artisan db:code User getter
    
(output)

    $id = $user->id;
    $name = $user->name;
    $email = $user->email;
    $password = $user->password;
    $remember_token = $user->remember_token;
    $created_at = $user->created_at;
    $updated_at = $user->updated_at;
    $created_on = $user->created_on;

Note: Output code is including accessors.

**setter**

    php artisan db:code User setter
    
(output)

    // Variable
    $user = new \App\User();
    $user->id = $id;
    $user->name = $name;
    $user->email = $email;
    $user->password = $password;
    $user->remember_token = $remember_token;
    $user->created_at = $created_at;
    $user->updated_at = $updated_at;
    $user->created_on = $created_on;
    $user->save();
    
    // Request
    $user = new \App\User();
    $user->id = $request->id;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->remember_token = $request->remember_token;
    $user->created_at = $request->created_at;
    $user->updated_at = $request->updated_at;
    $user->created_on = $request->created_on;
    $user->save();

Note: Output code is including mutators.

**request**

    php artisan db:code User request
    
(output)

    $id = $request->id;
    $name = $request->name;
    $email = $request->email;
    $password = $request->password;
    $remember_token = $request->remember_token;
    $created_at = $request->created_at;
    $updated_at = $request->updated_at;

**js**

    php artisan db:code User js
    
(output)

    // Basic
    var id = user.id;
    var name = user.name;
    var email = user.email;
    var password = user.password;
    var providerName = user.providerName;
    var providerId = user.providerId;
    var rememberToken = user.rememberToken;
    var createdAt = user.createdAt;
    var updatedAt = user.updatedAt;
    
    // Vue
    this.id = user.id;
    this.name = user.name;
    this.email = user.email;
    this.password = user.password;
    this.providerName = user.providerName;
    this.providerId = user.providerId;
    this.rememberToken = user.rememberToken;
    this.createdAt = user.createdAt;
    this.updatedAt = user.updatedAt;

**seed**

    php artisan db:code User seed

(output)

    $user = new \App\User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->remember_token = $request->remember_token;
    $user->created_on = $request->created_on;
    $user->save();


**html**

    php artisan db:code User html
    
(output)

    <!-- Empty -->
    <input type="text" name="id" value="">
    <input type="text" name="name" value="">
    <input type="text" name="email" value="">
    <input type="text" name="password" value="">
    <input type="text" name="remember_token" value="">
    <input type="text" name="created_at" value="">
    <input type="text" name="updated_at" value="">
    
    <!-- with Values -->
    <input type="text" name="id" value="{{ $user->id }}">
    <input type="text" name="name" value="{{ $user->name }}">
    <input type="text" name="email" value="{{ $user->email }}">
    <input type="text" name="password" value="{{ $user->password }}">
    <input type="text" name="remember_token" value="{{ $user->remember_token }}">
    <input type="text" name="created_at" value="{{ $user->created_at }}">
    <input type="text" name="updated_at" value="{{ $user->updated_at }}">
    
    <!-- Vue -->
    <input type="text" name="id" v-model="id">
    <input type="text" name="name" v-model="name">
    <input type="text" name="email" v-model="email">
    <input type="text" name="password" v-model="password">
    <input type="text" name="remember_token" v-model="rememberToken">
    <input type="text" name="created_at" v-model="createdAt">
    <input type="text" name="updated_at" v-model="updatedAt">

**Accessor**

    php artisan db:code User accessor

(Output)

    public function getIdAttribute($value) {
    
        return $value;
    
    }
    public function getNameAttribute($value) {
    
        return $value;
    
    }
    public function getEmailAttribute($value) {
    
        return $value;
    
    }
    public function getPasswordAttribute($value) {
    
        return $value;
    
    }
    public function getProviderNameAttribute($value) {
    
        return $value;
    
    }
    public function getProviderIdAttribute($value) {
    
        return $value;
    
    }
    public function getRememberTokenAttribute($value) {
    
        return $value;
    
    }
    public function getCreatedAtAttribute($value) {
    
        return $value;
    
    }
    public function getUpdatedAtAttribute($value) {
    
        return $value;
    
    }
    
**Mutator**

    php artisan db:code User mutator

(Output)

    public function setIdAttribute($value) {
    
        $this->attributes['id'] = $value;
    
    }
    public function setNameAttribute($value) {
    
        $this->attributes['name'] = $value;
    
    }
    public function setEmailAttribute($value) {
    
        $this->attributes['email'] = $value;
    
    }
    public function setPasswordAttribute($value) {
    
        $this->attributes['password'] = $value;
    
    }
    public function setProviderNameAttribute($value) {
    
        $this->attributes['provider_name'] = $value;
    
    }
    public function setProviderIdAttribute($value) {
    
        $this->attributes['provider_id'] = $value;
    
    }
    public function setRememberTokenAttribute($value) {
    
        $this->attributes['remember_token'] = $value;
    
    }
    public function setCreatedAtAttribute($value) {
    
        $this->attributes['created_at'] = $value;
    
    }
    public function setUpdatedAtAttribute($value) {
    
        $this->attributes['updated_at'] = $value;
    
    }


## 2. Finding column or table 

    php artisan db:find SEARCH_KEYWORD

e.g.)

    php artisan db:find user

    /* Output
    
        [ authors ]:
         => created_user_id
         => updated_user_id
         
        [ users ]:

    */
    
## 3. Show fields 

    php artisan db:fields TABLE_NAME

e.g.)

    php artisan db:fields users

    /* Output
    
        [ users ]:
         - id
         - name
         - email
         - password
         - provider_name
         - provider_id
         - remember_token
         - created_at
         - updated_at

    */
    
## 3. Show rows 

    php artisan db:count TABLE_NAME

e.g.)

    php artisan db:count items

    /* Output
    
        [ items ]: 12345 rows

    */
    

# License

This package is licensed under the MIT License.  
Copyright 2017 Sukohi Kuhoh
