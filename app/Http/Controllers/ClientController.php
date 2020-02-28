<?php


namespace App\Http\Controllers;


use App\Library\Tools\Socket;
use Illuminate\Http\Request;

class ClientController extends Controller
{
	public function client(Request $request)
	{
		//接收参数
		$param = $request->input("params");
		//调用Service
		$data = Socket::SocketToErp($param, 'login', 'LoginService');

		return response()->json($data);
	}
}