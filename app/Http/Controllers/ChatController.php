<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
  public function index(Request $request)
  {
    $query = $request->input('message');
    $chunks = [
      "Hello, ",
      "this is a ",
      "streamed response ",
      "from the server."
    ];

    return response()->stream(function () use ($chunks) {
      foreach ($chunks as $chunk) {
        echo $chunk;
        ob_flush();
        flush();
        sleep(1); // Simulate delay
      }
    }, 200, [
      'Content-Type' => 'text/plain',
      'Cache-Control' => 'no-cache',
      'X-Accel-Buffering' => 'no', // For nginx
    ]);
  }


public
function select(Request $request)
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
