<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BusServiceTest extends TestCase
{
    /**
     * Registor link test.
     *
     * @return void
     */
    public function testRegisterLink()
    {
        $this->visit('/')
             ->click('Register')
             ->seePageIs('auth/register');
    }

    /**
     * Login link test.
     *
     * @return void
     */
    public function testLoginLink()
    {
        $this->visit('/')
             ->click('Login')
             ->seePageIs('auth/login');
    }

    /**
     * User Registor test.
     * This testcase successfully run first time only,
     * because email is unique for user table 
     *
     * @return void
     */
    public function testNewUserRegistration()
    {
        $this->visit('auth/register')
             ->type('Asanka', 'first_name')
             ->type('Lakmal', 'last_name')
             ->type('asankafit@gmail.com', 'email')
             ->type('asankafit', 'password')
             ->type('asankafit', 'password_confirmation')
             ->press('Register')
             ->seePageIs('home');
    }

    /**
     * User Login test.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $this->visit('auth/login')
             ->type('asankafit@gmail.com', 'email')
             ->type('asankafit', 'password')
             ->press('Login')
             ->seePageIs('home');
    }
}
