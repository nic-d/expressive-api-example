<?php

declare(strict_types=1);

namespace User\Handler;

use Exception;
use User\Filter\UserFilter;
use User\Service\UserService;
use Psr\Http\Message\ResponseInterface;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Hal\HalResponseFactory;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\ProblemDetails\ProblemDetailsResponseFactory;

/**
 * Class CreateHandler
 * @package User\Handler
 */
class CreateHandler implements RequestHandlerInterface
{
    /** @var UserService $userService */
    private $userService;

    /** @var UserFilter $userFilter */
    private $userFilter;

    /** @var ResourceGenerator $resourceGenerator */
    private $resourceGenerator;

    /** @var HalResponseFactory $halResponseFactory */
    private $halResponseFactory;

    /** @var ProblemDetailsResponseFactory $problemDetailsResponseFactory */
    private $problemDetailsResponseFactory;

    /**
     * CreateHandler constructor.
     * @param UserService $userService
     * @param UserFilter $userFilter
     * @param ResourceGenerator $resourceGenerator
     * @param HalResponseFactory $halResponseFactory
     * @param ProblemDetailsResponseFactory $problemDetailsResponseFactory
     */
    public function __construct(
        UserService $userService,
        UserFilter $userFilter,
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $halResponseFactory,
        ProblemDetailsResponseFactory $problemDetailsResponseFactory
    ) {
        $this->userService = $userService;
        $this->resourceGenerator = $resourceGenerator;
        $this->halResponseFactory = $halResponseFactory;
        $this->problemDetailsResponseFactory = $problemDetailsResponseFactory;
        $this->userFilter = $userFilter;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $this->userFilter->setData($request->getParsedBody());

        if (! $this->userFilter->isValid()) {
            return $this->problemDetailsResponseFactory->createResponse(
                $request,
                400,
                'Validation error occurred',
                'Bad Request',
                'https://httpstatus.es/400',
                ['errors' => $this->userFilter->getMessages()]
            );
        }

        try {
            $user = $this->userService->create($this->userFilter->getValues());
        } catch (Exception $e) {
            return $this->problemDetailsResponseFactory->createResponseFromThrowable(
                $request,
                $e
            );
        }

        // Let's just hydrate the user details and return that response!
        $resource = $this->resourceGenerator->fromObject($user, $request);
        return $this->halResponseFactory->createResponse($request, $resource);
    }
}
