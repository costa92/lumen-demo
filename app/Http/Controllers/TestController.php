<?php


namespace App\Http\Controllers;


use Costalong\LaravelUpload\OssCloud\OssFile;
use GuzzleHttp\Client;

class TestController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		$user = $this->gitHubApi();
	}

	public function gitHubApi()
	{
		$gitHubUrl = "https://api.github.com/users/costa92";
		$client = new Client();
		$result = $client->request('GET', $gitHubUrl);
		$body = $result->getBody()->getContents();
		$apiResult = json_decode($body, true);
		$avatar = $this->getAvatar($apiResult['avatar_url']);


		$ossClient = new OssFile();
		$ossClient = $ossClient->connOss();
		$fileName = '1.jpg';
		$filePath = "/upload/avatar/" . $fileName;
		$ossClient->uploadFile($ossClient->getBucket(), $avatar, $filePath);

		$success = [
			'name' => $fileName,
			'path' => 'https://' . self::$endpoint . '/' . $filePath
		];
		unset($avatar);
		return $success;
	}


	public function getAvatar($avater)
	{
		$client = new Client();
		$avatarPath = storage_path('avatar') . '/10903903.jpg';
		$client->request('GET', $avater, ['sink' => $avatarPath]);
		return $avatarPath;
	}
}