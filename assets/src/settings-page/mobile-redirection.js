
/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useContext } from '@wordpress/element';

/**
 * Internal dependencies
 */
import { RedirectToggle } from '../components/redirect-toggle';
import { Options } from '../components/options-context-provider';

/**
 * Mobile redirection section of the settings page.
 */
export function MobileRedirection() {
	const { editedOptions } = useContext( Options );

	const { theme_support: themeSupport } = editedOptions || {};

	if ( ! [ 'reader', 'transitional' ].includes( themeSupport ) ) {
		return null;
	}

	return (
		<section className="mobile-redirection">
			<h2>
				{ __( 'Mobile Redirection', 'amp' ) }
			</h2>
			<RedirectToggle direction="left" />
		</section>
	);
}