<?php


namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\BaseService;
use App\Services\UserService;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
	/**
	 * @var JWTAuth
	 */
	protected $jwt;

	/**
	 * @var UserService
	 */
	protected $userService;

	/**
	 * AuthController constructor.
	 * @param JWTAuth $jwt
	 * @param UserService $userService
	 */
	public function __construct(JWTAuth $jwt, UserService $userService)
	{
		$this->jwt = $jwt;
		$this->userService = $userService;
	}

	/**
	 * 获取token
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function authenticate(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|max:255',
			'password' => 'required',
		], ['email.required' => 'email 不能为空']);

		try {
			if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
				$this->response->error("账号或密码错误！", 404);
			}
		} catch (TokenExpiredException $e) {
			$this->response->error("token_expired！", 500);
		} catch (TokenInvalidException $e) {
			$this->response->error("token_invalid！", 500);
		} catch (JWTException $e) {
			return response()->json(['token_absent' => $e->getMessage()], 500);
		}
		$user = $this->myInfo();
		$result = [
			'token' => $token,
			'id' => $user->id,
			'username' => $user->name,
			'email' => $user->email,
		];

		return $this->response->array($result);
	}

	/**
	 * @param Request $request
	 * @return mixed
	 * @throws \Illuminate\Validation\ValidationException
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function register(Request $request)
	{
		$rules = [
			'name' => ['required'],
			'email' => ['required'],
			'password' => ['required', 'min:6', 'max:16'],
		];

		$hint = [
			'name.required' => '用户名不能为空',
			'email.required' => '邮箱不能为空',
			'password:required' => '密码不能为空',
			'password:min' => '密码不能少于六个字符',
			'password:max' => '密码不能大于16个字符',
		];

		$this->validate($request, $rules, $hint);

		$payload = $request->only('name', 'email', 'password');

		$user = $this->userService->userFirstByEmail($payload['email']);
		if ($user) {
			$this->response->error("该邮件已经注册了，请换邮件！", 404);
		}

		$data = [
			'name' => $payload['name'],
			'email' => $payload['email'],
			'password' => password_hash($payload['password'], PASSWORD_BCRYPT),
		];
		// 创建用户
		$result = User::create($data);


		if ($result) {
			return $this->response->array(['success' => '创建用户成功']);
		} else {
			return $this->response->array(['error' => '创建用户失败']);
		}
	}

	/**
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function logout()
	{
		Auth::invalidate(true);
	}

	/**
	 * @return mixed
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function login()
	{
		$info = User::all();
		return $this->response->array($info);
	}

}