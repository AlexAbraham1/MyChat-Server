<?php

class BaseController extends Controller {

	protected function error($error)
	{
		return Response::json($error, 400);
	}

}
