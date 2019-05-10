<?php

namespace qlixes\Tiket;

use qlixes\Tiket\Base;
use Carbon\Carbon;

class Tiket extends Base
{
    var $secret;
    var $output;
    var $lang;

    function __construct($uri, $api_secret, $output = 'array', $lang = 'id')
    {
        $this->client = $this->getBaseUri($uri);

        $this->secret = $api_secret;
        $this->query['output'] = $output;
        $this->query['lang'] = $lang;
    }

    function getAuthenticate()
    {
        $request_path = '/apiv2/payexpress';

        $query = [];
        $query['method'] = 'getToken';
        $query['secretkey'] = $this->secret;

        $this->options['query'] = array_merge($query, $this->query);

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function searchByParams($token, $params = [])
    {
        $query = [];
        $query['token'] = $token;

        if($params['departure_code'])
            $query['d'] = $params['departure_code'];
        if(params['arrival_code'])
            $query['a'] = $params['arrival_code'];

        if(params['departure_date'])
            $query['date'] = $params['departure_date'];

        if(params['return_date'])
            $query['ret_date'] = $params['return_date'];
        else
            $query['ret_date'] = Carbon::now()->isoFormat('Y-m-d');

        if(params['adult'])
            $query['adult'] = $params['adult'];
        if(params['children'])
            $query['child'] = $params['children'];
        if(params['baby'])
            $query['infant'] = $params['baby'];

        if(params['version'])
            $query['v'] = $params['version'];

        if($params['time'])
            $query['time'] = Carbon::now()->getTimestamp();

        if($params['lion_captcha'])
            $query['lioncaptcha'] = $params['lion_captcha'];

        if($params['lion_session'])
            $query['lionsessionid'] = $params['lion_session'];

        if($params['flight_id'])
            $query['flight_id'] = $params['flight_id'];

        if($params['return_flight_id'])
            $query['ret_flight_id'] = $params['return_flight_id'];

        $this->options['query'] = array_merge($query, $this->query);

        return $this;
    }

    function getListCurrency()
    {
        $request_path = '/general_api/listCurrency';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function getListLanguage($token)
    {
        $request_path = '/general_api/listLanguage';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function getListCountry($token)
    {
        $request_path = '/general_api/listCountry';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function getTransactionsPolicy($token)
    {
        $request_path = '/general_api/getPolicies';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function searchFlights()
    {
        $request_path = '/search/flight';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function searchAirport()
    {
        $request_path = '/flight_api/all_airport';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function checkUpdate()
    {
        $request_path = '/ajax/mCheckFlightUpdated';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function getLionCaptcha()
    {
        $request_path = '/flight_api/getLionCaptcha';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function getFlightData()
    {
        $request_path = '/flight_api/get_flight_data';

        $response = $this->client->request('GET', $request_path, $this->options);

        return $response->getBody()->getContents();
    }

    function setOrder()
}
