<?php

//このファイルの場所
namespace  App\Services\Auth;

//使うファイルのディレクトリ
use Illuminate\Contracts\Auth\Authenticatable;

//このファイルのクラス名と役割
class GenericUserAccount implements Authenticatable
{
    /**
     * All of the user's attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create a new generic user object.
     *
     * @param  array  $attributes
     */
    //全体で使う変数等を定義
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get the name of the unique identifier for the user account.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'user_id';
    }

    /**
     * Get the unique identifier for the user account.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        $name = $this->getAuthIdentifierName();
        return array_get($this->attributes, $name);
    }

    /**
     * Get the password for the user account.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return array_get($this->attributes, 'password');
    }

    /**
     * Get the "remember me" token value.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return '';
    }

    /**
     * Set the "remember me" token value.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // empty
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return '';
    }

    public function getUserId()
    {
        return array_get($this->attributes, 'user_id');
    }

    public function getName()
    {
        return array_get($this->attributes, 'name');
    }

    public function getPassword()
    {
        return array_get($this->attributes, 'password');
    }

    public function getAddress()
    {
        return array_get($this->attributes, 'address');
    }
    public function getText1()
    {
        return array_get($this->attributes, 'user_text1');
    }
    public function getText2()
    {
        return array_get($this->attributes, 'user_text2');
    }
    public function getFlag1()
    {
        return array_get($this->attributes, 'user_flag1');
    }
    public function getFlag2()
    {
        return array_get($this->attributes, 'user_flag2');
    }
}
