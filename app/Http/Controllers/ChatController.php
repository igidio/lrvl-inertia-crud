<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ChatController extends Controller
{
  function fetchApiData($url, $message)
  {
    $client = new Client();
    $payload = [
      "model" => "google/gemma-3-4b",
      "messages" => [
        [
          "role" => "user",
          "content" => $message
        ]
      ],
      "temperature" => 0.7,
      "stream" => false,
    ];
    $response = $client->post($url, [
      'json' => $payload
    ]);
    $stream = $response->getBody();
    $contents = $stream->getContents();
    $data = json_decode($contents, true);
    return [
      'type' => gettype($data),
      'content' => $data
    ];
  }

  public function index(Request $request)
  {
    $message = $request->input('message');
    $result = $this->fetchApiData('http://192.168.0.99:1234/v1/chat/completions', $message);
    $content = $result['content']['choices'][0]['message']['content'] ?? null;
    $contentObject = json_decode($content);
    $res = $contentObject->content;
    return response()->json($res, 200);
  }


  public function select(Request $request)
  {
    $query = $request->input('query');

    if (!is_string($query) || stripos(trim($query), 'select') !== 0) {
      return response()->json(['error' => 'Only SELECT queries are allowed.'], 400);
    }

    try {
      $results = \DB::select($query);
      return response()->json($results);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Invalid query or execution error.'], 400);
    }
  }
}
