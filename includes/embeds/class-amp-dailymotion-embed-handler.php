<?php
/**
 * Class AMP_DailyMotion_Embed_Handler
 *
 * @package AMP
 */

use AmpProject\Dom\Document;

/**
 * Class AMP_DailyMotion_Embed_Handler
 *
 * Much of this class is borrowed from Jetpack embeds
 */
class AMP_DailyMotion_Embed_Handler extends AMP_Base_Embed_Handler {

	const RATIO = 0.5625;

	/**
	 * Default width.
	 *
	 * @var int
	 */
	protected $DEFAULT_WIDTH = 600;

	/**
	 * Default height.
	 *
	 * @var int
	 */
	protected $DEFAULT_HEIGHT = 338;

	/**
	 * AMP_DailyMotion_Embed_Handler constructor.
	 *
	 * @param array $args Height, width and maximum width for embed.
	 */
	public function __construct( $args = [] ) {
		parent::__construct( $args );

		if ( isset( $this->args['content_max_width'] ) ) {
			$max_width            = $this->args['content_max_width'];
			$this->args['width']  = $max_width;
			$this->args['height'] = round( $max_width * self::RATIO );
		}
	}

	/**
	 * Register embed.
	 */
	public function register_embed() {
		// Not implemented.
	}

	/**
	 * Unregister embed.
	 */
	public function unregister_embed() {
		// Not implemented.
	}

	/**
	 * Sanitize all DailyMotion <iframe> tags to <amp-dailymotion>.
	 *
	 * @param Document $dom DOM.
	 */
	public function sanitize_raw_embeds( Document $dom ) {
		$nodes = $dom->xpath->query( '//iframe[ starts-with( @src, "https://www.dailymotion.com/embed/video/" ) ]' );

		foreach ( $nodes as $node ) {
			if ( ! $this->is_raw_embed( $node ) ) {
				continue;
			}
			$this->sanitize_raw_embed( $node );
		}
	}

	/**
	 * Determine if the node has already been sanitized.
	 *
	 * @param DOMElement $node The DOMNode.
	 * @return bool Whether the node is a raw embed.
	 */
	protected function is_raw_embed( DOMElement $node ) {
		return $node->parentNode && 'amp-dailymotion' !== $node->parentNode->nodeName;
	}

	/**
	 * Make DailyMotion embed AMP compatible.
	 *
	 * @param DOMElement $iframe_node The node to make AMP compatible.
	 */
	private function sanitize_raw_embed( DOMElement $iframe_node ) {
		$iframe_src = $iframe_node->getAttribute( 'src' );

		if ( preg_match( '#video/(?P<video_id>[a-zA-Z0-9]+)#', $iframe_src, $matches ) ) {
			$video_id = $matches['video_id'];

			$amp_node = AMP_DOM_Utils::create_node(
				Document::fromNode( $iframe_node ),
				'amp-dailymotion',
				[
					'data-videoid' => $video_id,
					'layout'       => 'responsive',
					'width'        => $this->args['width'],
					'height'       => $this->args['height'],
				]
			);

			$this->maybe_unwrap_p_element( $iframe_node );

			$iframe_node->parentNode->replaceChild( $amp_node, $iframe_node );
		}

		// Nothing to be done if the video ID could not be found.
	}
}