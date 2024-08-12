<?php

namespace App\Services;

use ElephantIO\Client;

class EventService
{

  public static function emit(string $channel, array $data)
  {
    $url     = config('socket.url');
    $options = ['client' => Client::CLIENT_4X];
    $client  = Client::create($url, $options);
    $client->connect();
    $client->of('/');
    $client->emit($channel, $data);
    $client->disconnect();
  }
}
