<?php
	$connection = new PDO ('mysql:host=localhost;dbname=data_sitemap;charset=utf8', 'root', '');
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	$base_url = 'http://localhost/core/php/sitemap/';
	
	$query = $connection->prepare("SELECT * FROM `page`");
	$query->execute();
	$fetchPages = $query->fetchAll(PDO::FETCH_ASSOC);
	
	header("Content-Type: application/xml; charset=utf-8");
	
	echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;


	foreach ($fetchPages AS $each)
	{
		echo '<url>' . PHP_EOL;

		if($each['page_url'] == 'index.php')
		{
			echo '<loc>'. $base_url .'</loc>' . PHP_EOL;
		}
		else
		{
			$explode = explode('.', $each['page_url']);
			echo '<loc>'. $base_url . $explode[0] . '/' .'</loc>' . PHP_EOL;
		}

		echo '<changefreq>daily</changefreq>' . PHP_EOL;
		echo '</url>' . PHP_EOL;
	}

	echo '</urlset>' . PHP_EOL;
?>
