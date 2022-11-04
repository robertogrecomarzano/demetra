<?php
use App\Core\Classes\User;
use App\Core\Lib\Page;

$page->assign("recoveryLink", Page::getURLStatic("user/passwordrecovery"));
$page->assign("signupLink", Page::getURLStatic("user/signup"));
if (User::isUserLogged())
    Page::redirect("user");

