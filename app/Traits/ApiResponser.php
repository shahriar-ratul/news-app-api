<?php

namespace App\Traits;

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponser
{
	/**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
	protected function success($data =null, string $message = null, int $code = 200)
	{
		return response()->json([
			'success' => true,
			'message' => $message,
			'data' => $data,
			'code' => $code
		], $code);
	}

	/**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
	protected function error(?string $message, $error ,int $code)
	{
		return response()->json([
			'success' => false,
			'message' => $message,
               'code' => $code,
               'error' => $error
		], $code);
	}

}
