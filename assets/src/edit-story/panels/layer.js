/**
 * External dependencies
 */
import PropTypes from 'prop-types';
import styled from 'styled-components';

/**
 * WordPress dependencies
 */
import { useCallback } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import { useStory } from '../app';
import { Panel, PanelTitle, PanelContent } from './panel';

const ICON_BACKGROUND = 'B';
const ICON_MEDIA = 'I';
const ICON_VIDEO = 'V';
const ICON_TEXT = 'T';

const DEFUALT_LAYERS_VISIBLE = 6;
const LAYER_HEIGHT = 40;

function getIconForElementType( type ) {
	switch ( type ) {
		case 'video': return ICON_VIDEO;
		case 'text': return ICON_TEXT;
		default: return ICON_MEDIA;
	}
}

function useElements() {
	const {
		state: { currentPage, selectedElements },
	} = useStory();

	if ( ! currentPage ) {
		return [];
	}

	let backgroundElement, otherElements;
	const hasBackground = Boolean( currentPage.backgroundElementId );

	if ( hasBackground ) {
		[ backgroundElement, otherElements ] = currentPage.elements;
	} else {
		otherElements = currentPage.elements;
		backgroundElement = {};
	}

	const layers = [
		{
			icon: ICON_BACKGROUND,
			isSelected: hasBackground ? selectedElements.includes( backgroundElement.id ) : selectedElements.length === 0,
			elementId: hasBackground ? backgroundElement.id : '',
			element: backgroundElement,
		},
		...otherElements.map( ( element ) => {
			const { type, id } = element;
			return {
				icon: getIconForElementType( type ),
				isSelected: selectedElements.includes( id ),
				id,
				element,
			};
		} ),
	];

	// Flip it and...
	layers.reverse();

	return layers;
}

function LayerContent( { element } ) {
	switch ( element.type ) {
		case 'text':
			return <LayerText dangerouslySetInnerHTML={ { __html: element.content } } />;

		case 'image':
			// Disable reason: Well, it's actually an image element, so it's the best description
			// eslint-disable-next-line jsx-a11y/img-redundant-alt
			return <img src={ element.src } alt="Image element" height="20" />;

		case 'video':
			return <img src={ element.poster } alt="Video element" height="20" />;

		case 'square':
			return 'Square';

		default:
			return (
				<LayerBackground>
					{ __( 'Background (locked)', 'amp' ) }
				</LayerBackground>
			);
	}
}

LayerContent.propTypes = {
	element: PropTypes.object.isRequired,
};

function Layer( { icon, id, isSelected, element } ) {
	const {
		actions: { setSelectedElementsById, clearSelection },
	} = useStory();

	const handleClick = useCallback( ( evt ) => {
		evt.preventDefault();
		evt.stopPropagation();
		if ( id ) {
			setSelectedElementsById( { elementIds: [ id ] } );
		} else {
			clearSelection();
		}
	}, [ setSelectedElementsById, clearSelection, id ] );

	return (
		<LayerButton
			isSelected={ isSelected }
			onPointerDown={ handleClick }
		>
			<LayerIcon>
				{ icon }
			</LayerIcon>
			<LayerDescription>
				<LayerContent element={ element } />
			</LayerDescription>
		</LayerButton>
	);
}

Layer.propTypes = {
	icon: PropTypes.string.isRequired,
	id: PropTypes.string,
	isSelected: PropTypes.bool.isRequired,
	element: PropTypes.object.isRequired,
};

function LayerPanel() {
	const layers = useElements();

	return (
		<Panel initialHeight={ DEFUALT_LAYERS_VISIBLE * LAYER_HEIGHT }>
			<PanelTitle isPrimary isResizable>
				{ __( 'Layers', 'amp' ) }
			</PanelTitle>
			<PanelContent isScrollable padding={ '0' }>
				<LayerList>
					{ layers.map( ( { icon, isSelected, id, element } ) => (
						<Layer key={ id } icon={ icon } id={ id } isSelected={ isSelected } element={ element } />
					) ) }
				</LayerList>
			</PanelContent>
		</Panel>
	);
}

export default LayerPanel;

const LayerList = styled.div`
	display: flex;
	flex-direction: column;
	width: 100%;
`;

const LayerButton = styled.button.attrs( { type: 'button' } )`
	display: flex;
	border: 0;
	background: transparent;
	height: ${ LAYER_HEIGHT }px;
	width: 100%;

	&:focus, &:active {
		outline: none;
	}
`;

const LayerIcon = styled.div`
	width: ${ LAYER_HEIGHT }px;
	flex-shrink: 0;
	height: 100%;
	display: flex;
	align-items: center;
	justify-content: center;
	margin-left: 10px;
`;

const LayerDescription = styled.div`
	flex-grow: 1;
	height: 100%;
	display: flex;
	align-items: center;
	margin-left: 10px;
`;

const LayerBackground = styled.span`
	opacity: .5;
`;

const LayerText = styled.span`
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
`;
