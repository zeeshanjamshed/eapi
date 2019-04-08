<?php

namespace App\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait
{
	public function apiException($request, $e)
	{
		if($this->isModel($e)){
			return $this->modelResponse();
		}
		else if($this->isHttp($e)){
			return $this->httpResponse();
		}
		return parent::render($request, $e);
	}

	protected function isModel($e)
	{
		return $e instanceof ModelNotFoundException;
	}
	protected function isHttp($e){
		return $e instanceof NotFoundHttpException;
	}

	protected function modelResponse(){
		return response()->json([
				"errors" => Response::HTTP_NOT_FOUND.": Model Not Found."
			], Response::HTTP_NOT_FOUND);
	}
	protected function httpResponse(){
		return response()->json([
				"errors" => Response::HTTP_NOT_FOUND.": Invalid Route."
			], Response::HTTP_NOT_FOUND);
	}
}

?>