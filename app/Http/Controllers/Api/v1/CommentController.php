<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Comments\CreateCommentRequest;
use App\Http\Requests\Comments\PaginatedCommentRequest;
use App\Http\Transformers\CommentTransformer;
use App\Services\CommentService;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;
use Saritasa\LaravelControllers\Api\BaseApiController;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Tymon\JWTAuth\JWTAuth;

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
     * @param JWTAuth $jwtAuth check auth login
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
        $user_id = $this->jwtAuth->user()->id;
        $comment = $this->commentService->createComment($request->getCreateCommentDto(), $user_id);
        return $this->json($comment);
    }

    public function paginatedComment(PaginatedCommentRequest $request): Response
    {
        $comments = $this->commentService->paginatedComment($request->getPagingInfo(), $request->getCommentFilters());
        return $this->json($comments);
    }

    /**
     * Get all comment by the specific listing
     *
     * @param int $id listing id
     * @return Response|JsonResponse
     */
    public function getCommentsListing($id)
    {
        $comments = $this->commentService->getCommentsListing($id);
        return $this->response->collection($comments, new CommentTransformer() ) ;
    }
}
