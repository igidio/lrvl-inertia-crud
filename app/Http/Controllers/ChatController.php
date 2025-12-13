<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ChatController extends Controller
{
  function fetchApiData($url, array $messages)
  {
    $client = new Client();
    $payload = [
      "model" => "google/gemma-3-4b",
      "messages" => $messages,
      "temperature" => 0.1,
      "stream" => false,
    ];
    $response = $client->post($url, [
      'json' => $payload,
      'timeout' => 10,
    ]);
    $stream = $response->getBody();
    $contents = $stream->getContents();
    $data = json_decode($contents, true);
    return [
      'type' => gettype($data),
      'content' => $data
    ];
  }

  function selectFromDatabase($query)
  {

    if (!is_string($query) || stripos(trim($query), 'select') !== 0) {
      return response()->json(['error' => 'Only SELECT queries are allowed.'], 400);
    }

    try {
      $results = DB::select($query);
      return response()->json($results);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Invalid query or execution error.'], 400);
    }
  }

  function addToMessages(array $messages, string $role, string $content)
  {
    $messages[] = [
      'role' => $role,
      'content' => $content
    ];
    return $messages;
  }

  public function index(Request $request)
  {
    $language_model_url = env('LANGUAGE_MODEL_URL');

    $messages = $request->input('messages');
    $apiUrl = $language_model_url . 'v1/chat/completions';
    $result = $this->fetchApiData($apiUrl, $messages);
    $content = $result['content']['choices'][0]['message']['content'] ?? null;
    $contentObject = json_decode($content);
    $res = $contentObject->content;

    if ($contentObject->type == 'sql') {
      $select_result = $this->selectFromDatabase($contentObject->content);
      $select_result_json = json_encode($select_result->original);
      $new_messages = $this->addToMessages($messages, 'assistant', $contentObject->content);
      $new_messages_2 = $this->addToMessages($new_messages, 'user', $select_result_json);
      $result = $this->fetchApiData($language_model_url . 'v1/chat/completions', $new_messages_2);
      $content = $result['content']['choices'][0]['message']['content'] ?? null;
      $contentObject = json_decode($content);
      $res = $contentObject->content;
    }

    return response()->json($res, 200);
  }

  public function select(Request $request)
  {
    $query = $request->input('query');
    return $this->selectFromDatabase($query);
  }


}
