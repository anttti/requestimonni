<?php
// The name of the log file. Must be writable by the script.
$LOG_FILE_NAME = "monni.log";

// The GET parameter to show the log file
$LOG_DISPLAY_TRIGGER = "log";

// The GET parameter to clear the log file
$LOG_CLEAR_TRIGGER = "clearlog";

function writelog($str) {
	global $LOG_FILE_NAME;
	error_log($str, 3, $LOG_FILE_NAME);
}

if (isset($_GET[$LOG_DISPLAY_TRIGGER])) :
	$filename = $LOG_FILE_NAME;
	$handle = fopen($filename, "r");
	$contents = @fread($handle, filesize($filename));
	if ($handle !== false) :
		fclose($handle);
	endif;
elseif (isset($_GET[$LOG_CLEAR_TRIGGER])) :
	$handle = @fopen($LOG_FILE_NAME, "r+");
	if ($handle !== false) {
	    ftruncate($handle, 0);
	    fclose($handle);
	}
	header("Location: " . $_SERVER['PHP_SELF'] . "?" . $LOG_DISPLAY_TRIGGER);
	exit();
endif;
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Requ-estimonni</title>
	<style>
	html { font-family: "Helvetica Neue", "Helvetica", Arial, sans-serif; }
	pre { background-color: #f5f5f5; display: block; padding: 8.5px; margin: 0 0 18px; line-height: 18px; font-size:12px; border: 1px solid #ccc; border: 1px solid rgba(0, 0, 0, 0.15); -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; white-space: pre; white-space: pre-wrap; word-wrap: break-word; }
	a { display: inline-block; margin: 10px 0; }
	</style>
</head>
<body>

<h1>
	<img width="18" height="24" title="" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAYCAIAAAB4NzpmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAxJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUREQzNERkE2QTUzMTFFMjlCREFBQzlFQTk0RUQ0NDUiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUREQzNERjk2QTUzMTFFMjlCREFBQzlFQTk0RUQ0NDUiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiBNYWNpbnRvc2giPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0iNEQ5M0M3NTJCQkMxREU3RUE0N0FFRkMwRkMwRjZDQUIiIHN0UmVmOmRvY3VtZW50SUQ9IjREOTNDNzUyQkJDMURFN0VBNDdBRUZDMEZDMEY2Q0FCIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+TJGfEgAABEJJREFUeNp0lHlMm2Ucx399ex+0pX3bAu1akIZ7Y6IdjFQ2hiERGGSSeCwOxQnGGHZkMdNk00W3aMyyMJ1hGraMhWQGdGQwhwlxLlwCZcW6cRTWUq4WSktLS0uP9/A1MCWLfJPnr28++T7P73hoJEnCUy2b+q62dnaMzT3xhnEaPYbPU3NJfZKstvxlbX4RbBFtE4v4Tn7+bf2wE9gSUKeCSglAQhQDqw16OyAyc6og5eLNGwCcLVjIV3ni00ePrbKiV/vj90HACZEg4BhECZ3vsSAa+F2UC780l0vtd9pugVBOYQh1vm/ruj3Hu1CZmxB1URkgEIJQCiIZiNVqevgMDGvZAaj7up2+99CRWsDWNtOKPrt2n71fKva4EQHweLRQgGSygSBo/1wkuDM4M85VRVlCEMVC/dnGyoSjH51BpqYmsYnflMS4G7QgV7MWbUgkxHTbmT4XAE5KFH+pyqNOH9gtgIfh7Y9P986Tixa6rvjQyN3muuecajnXMOnFST6J7iCAQ2As8BFgmZYuPGjKC/ANrX+6xKDPWzeOpQWnGOzg8pXGlsHezuctPx2b8Vllqct+OcbhJaExu1X87F1rhVoWP1VXILI+aOixrZSAMtW4Pk/P35tfUVGW82JeU/uwJlGZQToUcw9TvIZX4oOpvAiTBbhYQWCrinR0bJYwklqIhDLYqwwpilKVCYVCX5w/K+TzVt2rZusTv9/f3tbCtI6nZ2Zl6TioQu8e6x/CRUAViS9ccnuRsrJSCuNwOEJm4M23aqJr7j26F4oO7I94seQUzdHad1Ex1ST+rAcfpSWCRAgWo8Azy5BIJBR2o+3X+nsjpthCy7XuI5q+jn5jlwkXWSY+ODwCsXEAMyaLATPJGfEazDxE8qeRjWGR4gGTTwWlhw0R9NjNP7oiyZCZicyM22xuABZAwGyeB+sIfXEORHHZOTmbWKE+96ByDpqbwL0CyjRw2L4rVvx46dyEYxWAQb19MUgHdXqYiwp4oZrXyxkbmCBO1X7h/frG2w5O7KIHfy3tpdLyivvdAx6HlTJHB3o6CB1Nn0sGw/lpGmnWbsZ/y8CVnqir2bodJqOheJ/cNdGbdXIEPrxMExEwYl53OQEIBLaXd8UujRVyZYnHC1i0e5dJ8yMwtlw8mEMlUJ34fy0srNRfOoetd5Kk2740jJSchp0lPXdubbiM7aIIHE9QxNA5PIDpNtAS6e9UZ/+sL39jw90W4yAIn0ktH9NPRD658nCXqel61w//uttgPvup621DLtydQjQ4kn3TfXKNyGEYkGozWbHolr/kqZbs9q/a+40eots4CqoMEGtBxGVzQ2GXH6JrO5yT53VSsVTyLOYwmxIOHIe8KkiKQSBMjA6CfRZEKDO/iEQQ7Mv3qInJzs55FsNJorXhm7vDE1Pe4IppQAahzBRtSIB2Dw6vz03v0edVVNdUV1X9LcAA8/MOahWbFBkAAAAASUVORK5CYII=" />
	Requ-estimonni
</h1>

<?php
if (isset($_GET["log"])) :
	echo '<h2>Viewing log at ' . $LOG_FILE_NAME . '</h2>';
	echo '<a href="' . $_SERVER['PHP_SELF'] . '?' . $LOG_CLEAR_TRIGGER . '">Clear log</a>';
	echo '<pre>';
	echo $contents;
	echo "</pre>";
else :

if (!file_exists($LOG_FILE_NAME)) {
	die("<strong>Error:</strong> Log file not found! It should be called " . $LOG_FILE_NAME . ".");
}
if (!is_writable($LOG_FILE_NAME)) {
	die("<strong>Error:</strong> Log file is not writable! Please show some chmod love to " . $LOG_FILE_NAME . ".");	
}

date_default_timezone_set('Europe/Helsinki');
writelog("Request captured at " . date('Y-m-d H:i:s') . ":\n");

writelog("\n" . "  Headers\n");
foreach (getallheaders() as $name => $value) {
    writelog("    $name: $value\n");
}
writelog("\n" . '  $_GET' . "\n");
foreach ($_GET as $name => $value) {
    writelog("    $name: $value\n");
}
writelog("\n" . '  $_POST' . "\n");
foreach ($_POST as $name => $value) {
    writelog("    $name: $value\n");
}
writelog("\n" . '  $_REQUEST' . "\n");
foreach ($_REQUEST as $name => $value) {
    writelog("    $name: $value\n");
}
writelog("\n" . '  body:' . "\n");
writelog("    " . file_get_contents('php://input'));

writelog("\n*** END OF REQUEST ***\n\n\n");
?>

Request captured succesfully. Check the log by calling
<a href="<?php echo $_SERVER['PHP_SELF'] . "?" . $LOG_DISPLAY_TRIGGER; ?>">
	<?php echo $_SERVER['PHP_SELF'] . "?" . $LOG_DISPLAY_TRIGGER; ?>
</a>.

<?php
endif;
?>

</body>
</html>
