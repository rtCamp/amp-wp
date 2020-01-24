/**
 * External dependencies
 */
import styled from 'styled-components';
import PropTypes from 'prop-types';

/**
 * WordPress dependencies
 */
import { useContext } from '@wordpress/element';

/**
 * Internal dependencies
 */
import panelContext from './context';

const Form = styled.form`
	margin: ${ ( { padding } ) => padding || '10px 20px' };
	overflow: auto;
`;

function Content( { children, padding, ...rest } ) {
	const { state: { isCollapsed, height } } = useContext( panelContext );

	if ( isCollapsed ) {
		return null;
	}

	const formStyle = {
		height: height === null ? 'auto' : `${ height }px`,
	};

	return (
		<Form style={ formStyle } padding={ padding } { ...rest }>
			{ children }
		</Form>
	);
}

Content.propTypes = {
	children: PropTypes.oneOfType( [
		PropTypes.arrayOf( PropTypes.node ),
		PropTypes.node,
	] ).isRequired,
	padding: PropTypes.string,
};

Content.defaultProps = {
	padding: null,
};

export default Content;
