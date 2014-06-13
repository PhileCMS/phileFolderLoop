<?php

/**
 * Loop through a folder of files with Twig
 * Usage: {{ loop('content/images') }}
 */

class PhileFolderLoop extends \Phile\Plugin\AbstractPlugin implements \Phile\EventObserverInterface {
	public function __construct() {
		\Phile\Event::registerEvent('template_engine_registered', $this);
	}

	public function on($eventKey, $data = null) {
		if ($eventKey == 'template_engine_registered') {
			$loop = new Twig_SimpleFunction('loop', function ($path) {
				$images = \Phile\Utility::getFiles(ROOT_DIR.$path, '/^.*\.('. $this->settings['image_types'] .')$/');
				if ($images !== false) {
					$new_images = array();
					$counter = 0;
					foreach ($images as $image) {
						$pathinfo = pathinfo($image);
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
						$info = getimagesize($image);
						$new_images[] = array(
							'id' => $counter,
							'name' => $pathinfo['filename'],
							'path' => $image,
							'url' => str_replace(CONTENT_DIR, 'content/', $image),
							'width' => $info[0],
							'height' => $info[1],
							'attr' => $info[3],
							'mime' => finfo_file($finfo, $image)
							);
						$counter++;
					}
					return $new_images;
				} else {
					// if there is no page, returning null will fail silently
					return null;
				}
			});
			/** @var $data['engine'] */
			$data['engine']->addFunction($loop);
		}
	}
}
