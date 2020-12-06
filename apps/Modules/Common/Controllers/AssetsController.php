<?php


namespace App\Modules\Common\Controllers;

use Phalcon\Http\Response;

class AssetsController extends ControllerBase
{
    public function serveAction(): \Phalcon\Http\ResponseInterface
    {
        // Getting a response instance
        $response = new Response();

        // Prepare output path
        $collectionName = $this->dispatcher->getParam('collection');
        $extension = $this->dispatcher->getParam('extension');
        $type = $this->dispatcher->getParam('type');
        $targetPath = "assets/{$type}/{$collectionName}.{$extension}";

        // Setting up the content type
        $contentType = $type == 'js' ? 'application/javascript' : 'text/css';
        $response->setContentType($contentType, 'UTF-8');

        // Check collection existence
        if (!$this->assets->exists($collectionName)) {
            return $response->setStatusCode(404, 'Not Found');
        }

        // Setting up the Assets Collection
        $collection = $this->assets
            ->collection($collectionName)
            ->setTargetUri($targetPath)
            ->setTargetPath($targetPath);

        // Store content to the disk and return fully qualified file path
        $contentPath = $this->assets->output(
            $collection,
            function (array $parameters) {
                return $parameters[0];
            },
            $type
        );

        // Set the content of the response
        $response->setContent(
            file_get_contents($contentPath)
        );

        // Return the response
        return $response;
    }
}