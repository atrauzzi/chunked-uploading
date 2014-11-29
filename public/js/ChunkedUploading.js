"use strict";

var ChunkedUploading = function () {

	/**
	 *
	 * @type {string}
	 */
	var target = "/receive-chunks";

	//
	// Private
	//

	/**
	 *
	 * @param file {string}
	 * @returns {jQuery.Deferred}
	 */
	function doFlowJs(file) {

		var deferred = new $.Deferred();

		var flow =
			new Flow({
				target: target
			})
			.on("complete", function (one, two, three) {
				console.log(one, two, three);
				allUploadsComplete(deferred);
			})
			//.on("fileSuccess")
			//.on("")
		;
		//.fileSuccess(file, message, chunk) A specific file was completed. First argument file is instance of FlowFile, second argument message contains server response. Response is always a string. Third argument chunk is instance of FlowChunk. You can get response status by accessing xhr object chunk.xhr.status.
		//.fileProgress(file, chunk) Uploading progressed for a specific file.
		//.fileAdded(file, event) This event is used for file validation. To reject this file return false. This event is also called before file is added to upload queue, this means that calling flow.upload() function will not start current file upload. Optionally, you can use the browser event object from when the file was added.
		//.filesAdded(array, event) Same as fileAdded, but used for multiple file validation.
		//.filesSubmitted(array, event) Can be used to start upload of currently added files.
		//.fileRetry(file, chunk) Something went wrong during upload of a specific file, uploading is being retried.
		//.fileError(file, message, chunk) An error occurred during upload of a specific file.
		//.uploadStart() Upload has been started on the Flow object.
		//.complete() Uploading completed.
		//.progress() Uploading progress.
		//.error(message, file, chunk) An error, including fileError, occurred.
		//.catchAll(event, ...) Listen to all the events listed above with the same callback function.

		flow.addFile(file);
		flow.upload();

		return deferred;

	}

	//
	// Wrappers for library events.

	function allUploadsComplete() {

	}


	//
	// Public
	//

	/**
	 * Triggers chunked uploading using the desired library.  Returns a deferred that can be used to track
	 * all the various uploading events (progress, notify, fail, success).
	 *
	 * @param files [{File}]
	 * @param library {string}
	 * @returns {jQuery.Deferred}
	 */
	this.upload = function (files, library) {

		console.log("Submitting \"" + files.name + "\" using " + library);

		switch(library) {

			case "flow.js":
				return doFlowJs(files);
			break;

			// Return a failed deferred.
			default:
				var failure = $.Deferred();
				failure.reject();
				return failure;
			break;

		}

	}

};