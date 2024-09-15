<?php
define('BOT_TOKEN', '6839677737:AAGYTLMtDc47LYDDD739bCt_dQBI2h7XdmU); // place bot  of your bot here kolumninBot 6839677737:AAGYTLMtDc47LYDDD739bCt_dQBI2h7XdmU 
//kolumnin_bot 6613405752:AAHm4-6oQJLuHeeXx_etyo1ei2VzuXTK3nU

function checkTelegramAuthorization($auth_data) {

$check_hash = $auth_data['hash'];

unset($auth_data['hash']);

$data_check_arr = [];

foreach ($auth_data as $key => $value) {

$data_check_arr[] = $key . '=' . $value;

}

sort($data_check_arr);

$data_check_string = implode("\n", $data_check_arr);

$secret_key = hash('sha256', BOT_TOKEN, true);

$hash = hash_hmac('sha256', $data_check_string, $secret_key);

if (strcmp($hash, $check_hash) !== 0) {

throw new Exception('Data is NOT from Telegram');

}

if ((time() - $auth_data['auth_date']) > 86400) {

throw new Exception('Data is outdated');

}

return $auth_data;

}

function saveTelegramUserData($auth_data) {

$auth_data_json = json_encode($auth_data);

setcookie('tg_user', $auth_data_json);

}

try {

$auth_data = checkTelegramAuthorization($_GET);

saveTelegramUserData($auth_data);

} catch (Exception $e) {

die ($e->getMessage());

}

header('Location: login_example.php');

?>

<!--view rawcheck_authorization.php hosted with ❤ by GitHub-->
<?php
define('BOT_USERNAME', 'XXXXXXXXXX'); // place username of your bot here
function getTelegramUserData() {
if (isset($_COOKIE['tg_user'])) {
$auth_data_json = urldecode($_COOKIE['tg_user']);
$auth_data = json_decode($auth_data_json, true);
return $auth_data;
}
return false;
}
if ($_GET['logout']) {
setcookie('tg_user', '');
header('Location: login_example.php');
}
$tg_user = getTelegramUserData();
if ($tg_user !== false) {
$first_name = htmlspecialchars($tg_user['first_name']);
$last_name = htmlspecialchars($tg_user['last_name']);
if (isset($tg_user['username'])) {
$username = htmlspecialchars($tg_user['username']);
$html = "<h1>Hello, <a href=\"https://t.me/{$username}\">{$first_name} {$last_name}</a>!</h1>";
} else {
$html = "<h1>Hello, {$first_name} {$last_name}!</h1>";
}
if (isset($tg_user['photo_url'])) {
$photo_url = htmlspecialchars($tg_user['photo_url']);
$html .= "<img src=\"{$photo_url}\">";
}
$html .= "<p><a href=\"?logout=1\">Log out</a></p>";
} else {
$bot_username = BOT_USERNAME;
$html = <<<HTML
<h1>Hello, anonymous!</h1>
<script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="{$bot_username}" data-size="large" data-auth-url="check_authorization.php"></script>
HTML;
}
echo <<<HTML
<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
 <title>Login Widget Example</title>
 </head>
 <body><center>{$html}</center></body>
</html>
HTML;
?>
<!--view rawlogin_example.php hosted with ❤ by GitHub-->

<!DOCTYPE HTML5>
<head><script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-login="kolumnin" data-size="large" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
<script type="text/javascript">
  function onTelegramAuth(user) {
    alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (user.username ? ', @' + user.username : '') + ')');
  }
</script>
<script src="https://gist.github.com/anonymous/6516521b1fb3b464534fbc30ea3573c2.js"></script>

</head>
<title>BotFather_Menu</title>
<body>
<Menu>
 <!-- I can help you create and manage Telegram bots. If you're new to the Bot API, please see the manual.

You can control me by sending these commands:

/newbot - create a new bot
/mybots - edit your bots

Edit Bots
/setname - change a bot's name
/setdescription - change bot description
/setabouttext - change bot about info
/setuserpic - change bot profile photo
/setcommands - change the list of commands
/deletebot - delete a bot

Bot Settings
/token - generate authorization token
/revoke - revoke bot access token
/setinline - toggle inline mode
/setinlinegeo - toggle inline location requests
/setinlinefeedback - change inline feedback settings
/setjoingroups - can your bot be added to groups?
/setprivacy - toggle privacy mode in groups

Web Apps
/myapps - edit your web apps
/newapp - create a new web app
/listapps - get a list of your web apps
/editapp - edit a web app
/deleteapp - delete an existing web app

Games
/mygames - edit your games
/newgame - create a new game
/listgames - get a list of your games
/editgame - edit a game
/deletegame - delete an existing game-->
</Menu>
  
</body>
</html>
