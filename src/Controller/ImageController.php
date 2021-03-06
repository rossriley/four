<?php

declare(strict_types=1);

namespace Bolt\Controller;

use Bolt\Configuration\Config;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\ServerFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class ImageController
{
    /** @var Config */
    private $config;

    /**
     * ImageController constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @Route("/thumbs/{filename}", methods={"GET"}, name="thumbnail", requirements={"filename"=".+"})
     *
     * @param string $filename
     *
     * @return StreamedResponse
     */
    public function image(string $filename, Request $request): StreamedResponse
    {
        $area = $request->query->get('area', 'files');
        $server = ServerFactory::create([
            'response' => new SymfonyResponseFactory(),
            'source' => $this->config->getPath($area),
            'cache' => $this->config->getPath('cache', true, 'thumbnails'),
        ]);

        if ($path = $request->query->get('path')) {
            $filename = sprintf('%s/%s', $path, $filename);
        }

        /** @var StreamedResponse $response */
        $response = $server->getImageResponse($filename, $_GET);

        return $response;
    }
}
