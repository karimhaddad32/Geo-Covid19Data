<?php


class Covid19Controller extends Controller {

	public function index() {

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://covid-19-tracking.p.rapidapi.com/v1",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"x-rapidapi-host: covid-19-tracking.p.rapidapi.com",
				"x-rapidapi-key: f9b47901a0mshc5fbb9a45f238edp127b82jsnc12aad8f0ce8"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		return $this->view("Covid19/index",  $response);

	}


}

?>