jQuery(document).ready(function($) {
	"use strict";

	// Removes the last blank table in admin pages. This is because a blank table is left if the last
	// option is a save option
	$('.titan-framework-panel-wrap table.form-table').filter(function() {
		return $(this).find('tbody tr').length == 0;
	}).remove();


	/*
	 * Handles the showing and hiding of dependent options
	 */
	$('.titan-framework-panel-wrap [data-depends]:not([data-depends=""])').each(function() {
		var depends = JSON.parse($(this).attr('data-depends'));
		var $dependent = $(this);
		$.each( depends, function( key, value ) {
			var $otherElement = $('[name=' + key + ']');
			if ( typeof $otherElement.attr('data-dependents') === 'undefined' ) {
				$otherElement.attr( 'data-dependents', '#' + $dependent.attr('id') );
			} else {
				$otherElement.attr( 'data-dependents', $otherElement.attr('data-dependents') + ', #' + $dependent.attr('id') );
			}
		});
	});
	$('.titan-framework-panel-wrap').on('change', '[data-dependents]', function() {
		var val = $(this).val();
		var id = $(this).attr('id');
		var $this = $(this);
		$($(this).attr('data-dependents')).each(function() {
			$(this).trigger('check-dependencies', [ $this, id, val ] );
		});
	});
	$('.titan-framework-panel-wrap').on('check-dependencies', '[data-depends]:not([data-depends=""])', function( $obj, id, value ) {
		var depends = JSON.parse($(this).attr('data-depends'));
		var allTrue = true;
		$.each( depends, function( key, value ) {
			if ( ! allTrue ) {
				return;
			}

			var $elemToCheck = $('[name=' + key + ']');
			var optionType = $elemToCheck.parents('[data-depends]:eq(0)').attr('data-type');

			// Perform checks here for every option type
			if ( $elemToCheck.is(':not(:visible)') ) {
				allTrue = false;
				return;
			}

			if ( optionType === 'checkbox' || optionType === 'enable' ) {
				if ( value != $elemToCheck.is(':checked') ) {
					allTrue = false;
				}
			} else {
				if ( $.isArray( value ) && value.length > 1 ) {
					if ( value.indexOf( 'empty' ) != -1 && $elemToCheck.val() == '' ) {
						return;
					} else if ( value.indexOf( 'not_empty' ) != -1 && $elemToCheck.val() != '' ) {
						return;
					} else if ( value.indexOf( $elemToCheck.val() ) != -1 ) {
						return;
					}
					allTrue = false;
				} else {
					if ( $.isArray( value ) ) {
						value = value[0];
					}
					if ( value === 'empty' && $elemToCheck.val() != '' ) {
						allTrue = false;
					} else if ( value === 'not_empty' && $elemToCheck.val() == '' ) {
						allTrue = false;
					} else if ( value !== $elemToCheck.val() ) {
						allTrue = false;
					}
				}
			}
		});

		if ( allTrue ) {
			$(this).show();
		} else {
			$(this).hide();
		}

		$(this).find('[data-dependents]').trigger('change');

	});
	$('.titan-framework-panel-wrap input, .titan-framework-panel-wrap select').trigger('change');
});