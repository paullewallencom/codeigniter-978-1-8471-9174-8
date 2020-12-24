<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cache_log extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('xml');
		$this->load->driver('cache', array('adapter' => 'apc'));
	}

	public function index() {
		$raw_feed = '<?xml version="1.0" encoding="ISO-8859-1" ?>
		<rss version="2.0">
		<channel>
		  <title>RSS Feed</title>
		    <link>http://www.domain.com</link>
		    <description>General Description</description>
		  <item>
		    <title>RSS Item 1 Title</title>
		    <link>http://www.domain1.com/link1</link>
		    <description>Description of First Item</description>
		  </item>
		  <item>
		    <title>RSS Item 2 Title</title>
		    <link>http://www.domain2.com/link2</link>
		    <description>Description of Second Item</description>
		  </item>
		  <item>
		    <title>RSS Item 3 Title</title>
		    <link>http://www.domain3.com/link3</link>
		    <description>Description of Third Item</description>
		  </item>			  
		</channel>
		</rss>';

		$feed = new SimpleXmlElement($raw_feed);

		if (!$feed) {
			log_message('error', 'Unable to instantiate SimpleXmlElement.');
		} else {
			log_message('info', 'SimpleXmlElement was instantiated correctly.');
		}

		if (!$cached_feed = $this->cache->get('rss')) {
			foreach ($feed->channel->item as $item) {
				$cached_feed .= $item->title . '<br />' . $item->description . '<br /><br />';
			}

		    $this->cache->save('rss', $cached_feed, 7);
			log_message('info', 'Cache item saved.');
		}

		echo $this->cache->get('rss');
		
	}

	public function clear_cache() {
		if (!$this->cache->clean()) {
			log_message('error', 'Unable to clear Cache.');
		} else {
			log_message('info', 'Cache cleared.');
		}

		redirect('rss_cache');
	}
}
?>
