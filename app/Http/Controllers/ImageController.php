<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ImageController extends Controller
{

  protected $structured_output = [
    "type" => "object",
    "properties" => [
      "name" => [
        "type" => "string",
        "description" => "El nombre del producto."
      ],
      "description" => [
        "type" => "string",
        "description" => "Una descripción detallada del producto."
      ],
      "category" => [
        "type" => "string",
        "description" => "Una lista de categorías aplicables al producto.",
        "enum" => [
          "Cuidado de la piel",
          "Maquillaje",
          "Cuidado del cabello",
          "Perfumes",
          "Cuidado de las uñas",
          "Cuidado corporal",
          "Cuidado facial",
          "Cuidado dental",
          "Protección solar",
          "Aromaterapia",
          "Accesorios de belleza",
          "Cuidado de los pies",
          "Cuidado de los ojos",
          "Cuidado de labios",
          "Cuidado masculino",
          "Cuidado infantil",
          "Otros"
        ]
      ]
    ],
    "required" => [
      "name",
      "description",
      "tags"
    ],
    "additionalProperties" => false
  ];

  public function fetchApiController($url,  $image)
  {
    $client = new Client();
    $payload = [
      "model" => "qwen/qwen3-vl-4b",
      "messages" => [
        [
          "role" => "user",
          "content" => [
            [
              "type" => "image_url",
              "image_url" => [
                "url" => "data:image/png;base64," . $image
              ]
            ]
          ]
        ]
      ],
      // "response_format" => [
      //   "type" => "json_schema",
      //   "json_schema" => [
      //     "name" => "Product Information",
      //     "schema" => $this->structured_output
      //   ]
      // ],
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

  public function index(Request $request)
  {
    $image_model_url = env('LANGUAGE_MODEL_URL');

    $image = $request->file('image');
    $apiUrl = $image_model_url . 'v1/chat/completions';
    $imageBase64 = base64_encode(file_get_contents($image->getRealPath()));
    $result = $this->fetchApiController($apiUrl, $imageBase64);
    $content = $result['content']['choices'][0]['message']['content'] ?? null;
    $contentObject = json_decode($content);

    return response()->json($contentObject);
  }
}
