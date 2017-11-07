<?php
session_save_path($_SERVER['DOCUMENT_ROOT'].'/sessions/');
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: amalyuchik
 * Date: 9/27/2017
 * Time: 9:41 AM
 */
echo phpinfo();