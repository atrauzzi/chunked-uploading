<?php namespace App\Http\Controllers {

	use App\Http\Requests\ReceiveChunk;
	use Illuminate\Http\JsonResponse;


	class WelcomeController extends Controller {

		/**
		 * Show the application welcome screen to the user.
		 *
		 * @return \illuminate\Http\Response
		 */
		public function index() {
			return view('welcome');
		}

		public function checkChunk() {

			return new JsonResponse(null, 404);

		}

		/**
		 * Clients will send individual pieces of a file in multiple requests here.
		 *
		 * Chunking implementations vary significantly.
		 *
		 * @param ReceiveChunk $request
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function receiveChunk(ReceiveChunk $request) {

			return new JsonResponse($request->all());

		}

	}

}