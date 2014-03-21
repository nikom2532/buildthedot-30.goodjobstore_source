<?php
/*require_once '../../../src/Google_Client.php';
require_once '../../../src/contrib/Google_AnalyticsService.php';
session_start();

$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

$client = new Google_Client();
$client->setAccessType('online'); // default: offline
$client->setApplicationName('blue');
$client->setClientId('1061875279943-ohlvv952u9tt2d4ct98g5kok20sordfh.apps.googleusercontent.com');
$client->setClientSecret('8OT33NIoCw0kwr7pkd06iIlW');
$client->setRedirectUri($scriptUri);
$client->setDeveloperKey('AIzaSyC1wxoxcGwqQGQr8lXkUfvL-ZZqKxmPlzg'); // API key

// $service implements the client interface, has to be set before auth call
$service = new Google_AnalyticsService($client);

if (isset($_GET['logout'])) { // logout: destroy token
	unset($_SESSION['token']);
	die('Logged out.');
}

if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
	$client->authenticate();
	$_SESSION['token'] = $client->getAccessToken();
}

if (isset($_SESSION['token'])) { // extract token from session and configure client
	$token = $_SESSION['token'];
	$client->setAccessToken($token);
}

if (!$client->getAccessToken()) { // auth call to google
	$authUrl = $client->createAuthUrl();
	header("Location: ".$authUrl);
	die;
}

try {
	$props = $service->management_webproperties->listManagementWebproperties("~all");
	echo '<h1>Available Google Analytics projects</h1><ul>'."\n";
	foreach($props['items'] as $item) printf('<li>%1$s</li>', $item['name']);
	echo '</ul>';

	$props = $service->management_webproperties->listManagementWebproperties("~all");
	print "<h1>Web Properties</h1><pre>" . print_r($props, true) . "</pre>";

	$accounts = $service->management_accounts->listManagementAccounts();
	print "<h1>Accounts</h1><pre>" . print_r($accounts, true) . "</pre>";

	$segments = $service->management_segments->listManagementSegments();
	print "<h1>Segments</h1><pre>" . print_r($segments, true) . "</pre>";

	$goals = $service->management_goals->listManagementGoals("~all", "~all", "~all");
	print "<h1>Segments</h1><pre>" . print_r($goals, true) . "</pre>";


	$ids = "ga:20551386";
	$start_date = "2013-05-01";
	$end_date = "2013-06-30";
	$metrics = "ga:visits,ga:pageviews";
	$dimensions = "ga:browser";
	$optParams = array('dimensions' => $dimensions,'sort' => '-ga:pageviews');
	$data = $service->data_ga->get($ids,$start_date,$end_date,$metrics,$optParams);

	print "<h1>My data</h1><pre>" . print_r($data, true) . "</pre>";

	$_SESSION['token'] = $client->getAccessToken();
}

catch (Exception $e) {
	die('An error occured: ' . $e->getMessage()."\n");
}
*/
?>

<!DOCTYPE>
<html>
<head><title>GA Dash Demo</title></head>
<body>

  <!-- Add Google Analytics authorization button -->
  <button id="authorize-button" style="visibility: hidden">
        Authorize Analytics</button>

  <!-- Div element where the Line Chart will be placed -->
  <div id='line-chart-example'></div>

  <!-- Load all Google JS libraries -->
  <script src="https://www.google.com/jsapi"></script>
  <script src="http://backoffice.planetlanka.com/public/js/charts/gadash-1.0.js"></script>
  <script src="https://apis.google.com/js/client.js?onload=gadashInit"></script>
  <script>
    // Configure these parameters before you start.
    var API_KEY = 'AIzaSyC1wxoxcGwqQGQr8lXkUfvL-ZZqKxmPlzg';
    var CLIENT_ID = '1061875279943-ohlvv952u9tt2d4ct98g5kok20sordfh.apps.googleusercontent.com';
    var TABLE_ID = 'ga:20551386';
    // Format of table ID is ga:xxx where xxx is the profile ID.

    gadash.configKeys({
      'apiKey': API_KEY,
      'clientId': CLIENT_ID
    });

    // Create a new Chart that queries visitors for the last 30 days and plots
    // visualizes in a line chart.
    var chart1 = new gadash.Chart({
      'type': 'LineChart',
      'divContainer': 'line-chart-example',
      'last-n-days':45,
      'query': {
        'ids': TABLE_ID,
        'metrics': 'ga:visitors',
        'dimensions': 'ga:date'
      },
      'chartOptions': {
        height:600,
        title: 'Visits in June 2013',
        hAxis: {title:'Date'},
        vAxis: {title:'Visits'},
        curveType: 'none'
      }
    }).render();
  </script>
</body>
</html>