<?php

declare(strict_types=1);

namespace User\Handler;

use User\Service\UserService;
use Psr\Http\Message\ResponseInterface;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Hal\HalResponseFactory;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\ProblemDetails\ProblemDetailsResponseFactory;

use function is_null;

/**
 * Class FetchHandler
 * @package User\Handler
 */
class FetchHandler implements RequestHandlerInterface
{
    /** @var UserService $userService */
    private $userService;

    /** @var ResourceGenerator $resourceGenerator */
    private $resourceGenerator;

    /** @var HalResponseFactory $halResponseFactory */
    private $halResponseFactory;

    /** @var ProblemDetailsResponseFactory $problemDetailsResponseFactory */
    private $problemDetailsResponseFactory;

    /**
     * FetchHandler constructor.
     * @param UserService $userService
     * @param ResourceGenerator $resourceGenerator
     * @param HalResponseFactory $halResponseFactory
     * @param ProblemDetailsResponseFactory $problemDetailsResponseFactory
     */
    public function __construct(
        UserService $userService,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $halResponseFactory,
        ProblemDetailsResponseFactory $problemDetailsResponseFactory
    ) {
        $this->userService = $userService;
        $this->resourceGenerator = $resourceGenerator;
        $this->halResponseFactory = $halResponseFactory;
        $this->problemDetailsResponseFactory = $problemDetailsResponseFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $id = $request->getAttribute('id', '');

        if (is_null($id) || empty($id)) {
            return $this->problemDetailsResponseFactory->createResponse(
                $request,
                400,
                'Id attribute expected, got nothing'
            );
        }

        $user = $this->userService->getOneById($id);
        $resource = $this->resourceGenerator->fromObject($user, $request);
        return $this->halResponseFactory->createResponse($request, $resource);
    }
}
