@extends('layouts.app')

@section('content')
<div id="welcome">

    <div class="jumbotron">
        <div class="container">
            <h1 class="jumbotron__header">You have arrived.</h1>

            <p class="jumbotron__body">
                This chunking demo serves to illustrate the confusing specifics of how chunked uploads from a client are handled server-side as well as how client libraries can differ in implementation.
            </p>
        </div>
    </div>

    <div class="container">

    	<form
    		id="chunk"
    		name="chunk"
    		action="{{ url("chunk") }}"
    		method="POST"
		>

			<fieldset>

				<legend>First choose a library to use</legend>

				<dl>

					<dt><input type="radio" name="library" id="library-flow-js" value="flow.js" checked /></dt>
					<dd><label for="library-flow-js"><a href="http://github.com/flowjs/flow.js">flow.js</a></label></dd>

					<!--
					<dt><input type="radio" name="library" id="library-flow-js" value="flow.js" /></dt>
					<dd><label for="library-flow-js"><a href="http://github.com/flowjs/flow.js">flow.js</a></label></dd>
					-->

				</dl>

			</fieldset>

			<fieldset>

				<legend>Then choose one or more files</legend>

    			<input type="file" multiple />

    			<p>File upload will commence upon selection of a file.</p>

			</fieldset>


			<input type="hidden" name="_token" value="{{ csrf_token() }}" />

    	</form>

    </div>

</div>
@stop

@section('scripts')

		<script type="text/javascript" src="/vendor/flow.js/dist/flow.js"></script>
		<script type="text/javascript" src="/js/flow.js"></script>

		<script type="text/javascript" src="/js/ChunkedUploading.js"></script>

    	<script type="text/javascript">

			"use strict";

			$(document).ready(function () {

				var fileInput = $("input[type=file]").get(0);
				var chunkedUploading = new ChunkedUploading({
					csrf: $("input[type=hidden]").val()
				});

				$(fileInput).on('change', function (event) {

					var uploads = chunkedUploading.upload(
						fileInput.files,
						$("input[name=library]").val()
					);

				});

			});

    	</script>

@stop
