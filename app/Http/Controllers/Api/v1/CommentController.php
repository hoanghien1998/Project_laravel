<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Comments\CreateCommentRequest;
use App\Http\Requests\Comments\PaginatedCommentRequest;
use App\Http\Transformers\CommentTransformer;
use App\Services\CommentService;
use Dingo\Api\Http\Response;
use Saritasa\LaravelControllers\Api\BaseApiController;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class CommentController Contains all of function relate to comments
 *
 * @package App\Http\Controllers\Api\v1
 */
class CommentController extends BaseApiController
{
    /**
     * Jwt auth service.
     *
     * @var JWTAuth
     */
    protected $jwtAuth;
    /**
     * Comment business-logic service.
     *
     * @var CommentService
     */
    private $commentService;

    /**
     * CommentController constructor.
     *
     * @param CommentService $commentService Comment business-logic service.
     * @param JWTAuth $jwtAuth
     */
    public function __construct(CommentService $commentService, JWTAuth $jwtAuth)
    {
        parent::__construct();
        $this->jwtAuth = $jwtAuth;
        $this->commentService = $commentService;
    }

    /**
     * Create comment
     *
     * @param CreateCommentRequest $request Validate form comment
     *
     * @return Response
     *
     * @throws RepositoryException
     */
    public function createComment(CreateCommentRequest $request): Response
    {
        $comment = $this->commentService->createComment($request->getCreateCommentDto());
        return $this->json($comment, new CommentTransformer());
    }

    public function paginatedComment(PaginatedCommentRequest $request): Response
    {
        $comments = $this->commentService->paginatedComment($request->getPaginateCommentDto());
        return $this->response->paginator($comments, new CommentTransformer());
    }
}
