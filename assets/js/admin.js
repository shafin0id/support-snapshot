/**
 * Support Snapshot Admin JavaScript
 */

(function($) {
	'use strict';

	$(document).ready(function() {
		
		// Copy to clipboard functionality
		$('#copy-snapshot').on('click', function() {
			var $button = $(this);
			var $feedback = $('.copy-feedback');
			var $textarea = $('#snapshot-text');
			
			// Disable button temporarily
			$button.prop('disabled', true);
			
			try {
				// Select the text
				$textarea.select();
				$textarea[0].setSelectionRange(0, 99999); // For mobile devices
				
				// Copy to clipboard
				var successful = document.execCommand('copy');
				
				if (successful) {
					// Show success message
					$feedback
						.removeClass('error')
						.addClass('success show')
						.text(supportSnapshotData.copySuccess);
					
					// Change button text temporarily
					var originalText = $button.html();
					$button.html('<span class="dashicons dashicons-yes"></span> ' + supportSnapshotData.copySuccess);
					
					// Reset after 2 seconds
					setTimeout(function() {
						$button.html(originalText);
						$feedback.removeClass('show');
					}, 2000);
					
				} else {
					throw new Error('Copy command failed');
				}
				
			} catch (err) {
				// Show error message
				$feedback
					.removeClass('success')
					.addClass('error show')
					.text(supportSnapshotData.copyError);
				
				// Select the textarea so user can copy manually
				$textarea.select();
				
				setTimeout(function() {
					$feedback.removeClass('show');
				}, 3000);
			}
			
			// Re-enable button
			setTimeout(function() {
				$button.prop('disabled', false);
			}, 500);
		});
		
	});

})(jQuery);
