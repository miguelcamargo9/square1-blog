<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Post;
use App\User;

class ImportController extends Controller
{

  private $client;

  function __construct()
  {
    $client = new Client([
      'base_uri' => env('API_IMPORT_POST'),
      'timeout' => 5.0,
    ]);

    $this->client = $client;
  }

  function importPost()
  {
    $response = $this->client->request('GET', 'posts');
    $posts = ($response->getBody()->getContents());
    $arrayPost = json_decode($posts, true);

    foreach ($arrayPost['data'] as $post) {
      $adminUser = User::where(['profile_id' => 1])->first();

      if (!Post::where(['title' => $post['title']])->exists()) {
        $post['user_id'] = $adminUser->id;
        Post::create($post);
      }
    }

    return json_encode(["message" => "ok"]);
  }
}
