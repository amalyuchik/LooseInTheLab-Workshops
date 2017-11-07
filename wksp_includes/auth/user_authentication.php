<?php
/**
 * Created by IntelliJ IDEA.
 * User: Andrei
 * Date: 9/1/2017
 * Time: 5:43 PM
 */

class user_authentication
{
    var $user_first_name;
    var $user_last_name;
    var $username;
    var $user_email;
    var $user_password;
    var $info = array();

    /**
     * user_authentication constructor.
     * @param $user_first_name
     * @param $user_last_name
     * @param $username
     * @param $user_email
     * @param $user_password
     */
    public function __construct($info)
    {
        $this->user_first_name = $info['user_first_name'];
        $this->user_last_name = $info['user_last_name'];
        $this->username = $info['username'];
        $this->user_email = $info['user_email'];
        $this->user_password = $info['password'];
    }


}