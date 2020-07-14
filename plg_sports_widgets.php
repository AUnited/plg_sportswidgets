<?php

// Assert file included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgContentSWPlugin extends JPlugin
{
	function PluginSW( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	function onContentPrepare ( $context, &$article, &$params, $page = 0)
		{
		global $mainframe;
		
		if ( JString::strpos( $article->text, '{geniussports}' ) === false ) {return true;}
		$article->text = preg_replace_callback('|{geniussports}(.*){\/geniussports}|',function ($match){return $this->embedWidget($match[1]);}, $article->text);
		return true;
	}

	function embedWidget($vCode)
	{
	    return "<!-- Genius Sports Widget --><div id = '".$vCode."'></div><script>window.".$vCode." = {}; (function(a,b,c,d,e,f){e=b.createElement('script');f=b.getElementsByTagName('script')[0];e.async=1;e.src=c+'/?'+d;f.parentNode.insertBefore(e,f)})(window,document,'https://widget.wh.geniussports.com/widget/','".$vCode."');</script>";
	}
}
