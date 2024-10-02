<script src='assets/img/jquery.min.js'></script>
<link rel="stylesheet" type="text/css" href="assets/img/skymon_login.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<style type="text/css">
   @import("./skymon_login.css");
</style>


<?php
require_once dirname(__FILE__).'/include/classes/user/CWebUser.php';
CWebUser::disableSessionCookie();

require_once dirname(__FILE__).'/include/config.inc.php';
require_once dirname(__FILE__).'/include/forms.inc.php';

$page['title'] = _('OBSEYE by TBC');
$page['file'] = 'index.php';

define('ZBX_PAGE_NO_HEADER', 1);
define('ZBX_PAGE_NO_FOOTER', 1);
define('ZBX_PAGE_NO_MENU', true);


// VAR  TYPE    OPTIONAL        FLAGS   VALIDATION      EXCEPTION
$fields = [
        'name' =>               [T_ZBX_STR, O_NO,       null,   null,   'isset({enter}) && {enter} != "'.ZBX_GUEST_USER.'"', _('Username')],
        'password' =>   [T_ZBX_STR, O_OPT, null,        null,   'isset({enter}) && {enter} != "'.ZBX_GUEST_USER.'"'],
        'sessionid' =>  [T_ZBX_STR, O_OPT, null,        null,   null],
        'reconnect' =>  [T_ZBX_INT, O_OPT, P_SYS,       null,   null],
        'enter' =>              [T_ZBX_STR, O_OPT, P_SYS,       null,   null],
        'autologin' =>  [T_ZBX_INT, O_OPT, null,        null,   null],
        'request' =>    [T_ZBX_STR, O_OPT, null,        null,   null],
        'form' =>               [T_ZBX_STR, O_OPT, null,        null,   null]
];
check_fields($fields);

if (hasRequest('reconnect') && CWebUser::isLoggedIn()) {
        CWebUser::logout();
        redirect('index.php');
}

$config = select_config();
$autologin = hasRequest('enter') ? getRequest('autologin', 0) : getRequest('autologin', 1);
$request = getRequest('request', '');
// login via form
if (hasRequest('enter') && CWebUser::login(getRequest('name', ZBX_GUEST_USER), getRequest('password', ''))) {
        if (CWebUser::$data['autologin'] != $autologin) {
                API::User()->update([
                        'userid' => CWebUser::$data['userid'],
                        'autologin' => $autologin
                ]);
        }

        $redirect = array_filter([CWebUser::isGuest() ? '' : $request, CWebUser::$data['url'], ZBX_DEFAULT_URL]);
        redirect(reset($redirect));

        exit;
}

if (CWebUser::isLoggedIn() && !CWebUser::isGuest()) {
        redirect(CWebUser::$data['url'] ? CWebUser::$data['url'] : ZBX_DEFAULT_URL);
}

$messages = clear_messages();

/*
	(new CView('general.login', [
        'http_login_url' => $config['http_auth_enabled'] == ZBX_AUTH_HTTP_ENABLED
                ? (new CUrl('index_http.php'))->setArgument('request', getRequest('request'))
                : '',
        'guest_login_url' => CWebUser::isGuestAllowed() ? (new CUrl())->setArgument('enter', ZBX_GUEST_USER) : '',
        'autologin' => $autologin == 1,
        'error' => hasRequest('enter') && $messages ? array_pop($messages) : null
]))
        ->disableJsLoader()
        ->render();

 */

?>
<body>
<div class="container-fluid px-1 px-md-5 px-lg-1 mx-auto">
    <div class="card card0 border-0">
<div class="header-title">
		<div class="header-title"> <span <p>OBSEYE | RMM | Remote Monitoring and Management System</p> </span> </div>
</div>
	<div class="fonet-logo"> <img src="assets/img/fonetbt_logo.png" class="logo" position="absolute"> </div>
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="assets/img/foneteye_logo_v1.png" class="image"> </div>
		    <div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center"> v4.5.24</small>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                <form method="post" action="index.php" accept-charset="utf-8" aria-label="Sign in">
                    <div class="row mb-4 px-3">
                        <h6 class="mb-0 mr-4 mt-2"></h6>
                        <div class="">
                            <div class=""></div>
                        </div>
                        <div class="">
                            <div class=""></div>
                        </div>
                        <div class="">
                            <div class=""></div>
                        </div>
                    </div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">User Name</h6>
                        <label for="username" </label> <input class="mb-4" type="text" id="name" name="name" autofocus="autofocus" placeholder="Enter a valid user name" required> </div>
                    <div class="row px-3"> <label class="mb-1">
                            <h6 class="mb-0 text-sm">Password</h6>
                        <label for="password" </label > <input type="password" name="password" id="passwod" placeholder="Enter password" required > </div>
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div>
                    </div>
                    <div class="signin-links">
			<button type="submit" id="enter" name="enter" <input type="submit" value="Sign in">Sign in</button> </div>
                    <div class="red"> <small class="font-weight-bold">Don't have an account? <a class="red" href="https://www.tbcteknoloji.com/iletisim" >Register</a></small> </div>
		</form>
                </div>
            </div>
        </div>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <div class="bg-blue py-4">
		<div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright TBC Teknoloji A.S. &copy; 2024. All rights reserved.</small>
		<div class="footer-social-icons">
		    <ul class="social-icons" align="right">
		        <li><a href="https://www.facebook.com/tbcteknoloji/" class="social-icon" target="_blank"> <i class="fa fa-facebook"></i></a></li>
		        <li><a href="https://twitter.com/tbcteknoloji" class="social-icon" target="_blank"> <i class="fa fa-twitter"></i></a></li>
		        <li><a href="https://www.linkedin.com/company/tbcteknoloji" class="social-icon" target="_blank"> <i class="fa fa-linkedin"></i></a></li>
		        <li><a href="https://www.instagram.com/tbcteknoloji/" class="social-icon" target="_blank"> <i class="fa fa-instagram"></i></a></li>
			<li><a href="mailto:obseye@tbcteknoloji.com" class=social_icon"> <i class="fa fa-mail" target="_blank"></i></a></li>
		    </ul>
        	</div>
	       </div>
     	</div>
</div>

</body>
