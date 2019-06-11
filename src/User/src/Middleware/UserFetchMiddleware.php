<?php

declare(strict_types=1);

namespace User\Middleware;

use User\Entity\User;
use User\Service\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use User\Exception\UserNotFoundException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\ProblemDetails\ProblemDetailsResponseFactory;

use function is_null;

/**
 * Class UserFetchMiddleware
 * @package User\Middleware
 */
class UserFetchMiddleware implements MiddlewareInterface
{
    /** @var UserService $userService */
    private $userService;

    /** @var ProblemDetailsResponseFactory $problemDetailsResponseFactory */
    private $problemDetailsResponseFactory;

    /**
     * UserFetchMiddleware constructor.
     * @param UserService $userService
     * @param ProblemDetailsResponseFactory $problemDetailsResponseFactory
     */
    public function __construct(
        UserService $userService,
        ProblemDetailsResponseFactory $problemDetailsResponseFactory
    ) {
        $this->userService = $userService;
        $this->problemDetailsResponseFactory = $problemDetailsResponseFactory;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        /** @var string $id */
        $id = $request->getAttribute('id', '');

        if (is_null($id) || empty($id)) {
            return $this->problemDetailsResponseFactory->createResponse(
                $request,
                400,
                'Id attribute expected, got nothing'
            );
        }

        try {
            $user = $this->userService->getOneById($id);
        } catch (UserNotFoundException $exception) {
            return $this->problemDetailsResponseFactory->createResponseFromThrowable(
                $request,
                $exception
            );
        }

        // Let's add this User entity to the request attributes, so we can use it in our handlers
        return $handler->handle($request->withAttribute(User::class, $user));
    }
}
