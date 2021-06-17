<?php

namespace App\DataSource;

class Affiliate
{
	/**
	 * Parses the json file and returns the data as an array object
	 * @return array
	 */
	public static function get()
	{
		$file = base_path('affiliates.txt');

		// lets get the contents from the txt file
		$contents = file_get_contents($file);

		// the data is split on a per line basis
		// so we will explode it into an array and format it from there
		$rows = explode(PHP_EOL, $contents);

		$data = [];

		foreach ($rows as $row) {
			$data[] = json_decode($row);
		}

		return self::collectAndSort($data);
	}

	/**
	 * Filters the affiliate data to get only the affiliates within a distance (in km) of the office
	 * @param  decimal $distance
	 * @return array
	 */
	public static function getWithinDistance($distance)
	{
		$data = self::get();

		// lets filter through each row and see if its within the right distance
		foreach ($data as $key => $row) {
			$distanceFromOffice = self::distance('53.3340285', '-6.2535495', $row->latitude, $row->longitude);

			if ($distanceFromOffice > $distance) {
				unset($data[$key]);
			}

			$row->distance = $distanceFromOffice;
		}

		return self::collectAndSort($data);
	}

	/**
	 * Filters the data into a collection and sorts by affiliate id
	 * @param  array $data
	 * @return Collection
	 */
	private static function collectAndSort($data)
	{
		// lets put the data into a Laravel Collection, so we can easily reorder the data
		$data = collect($data);

		// lets sort the data by affiliate_id
		return $data->sortBy('affiliate_id');
	}

	/**
	 * Method used to calculate distance between two coordinates.
	 * Original code taken from: http://www.geodatasource.com/developers/php
	 *
	 * @param  string $lat1
	 * @param  string $lon1
	 * @param  string $lat2
	 * @param  string $lon2
	 * @return decimal
	 */
	private static function distance($lat1, $lon1, $lat2, $lon2)
	{
	 	if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	  		return 0;
	  	} else {
	    	$theta = $lon1 - $lon2;
	    	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	    	$dist = acos($dist);
	    	$dist = rad2deg($dist);
	    	$miles = $dist * 60 * 1.1515;

	    	return $miles * 1.609344;
	  	}
	}
}
