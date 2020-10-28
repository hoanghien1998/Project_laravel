<?php

namespace App\Services;

use App\Dto\Comments\CreateCommentDto;
use App\Http\Requests\Comments\CommentFilter;
use App\Models\Comment;
use App\Repositories\CommentsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Saritasa\DingoApi\Paging\PagingInfo;
use Saritasa\LaravelRepositories\Contracts\IRepository;
use Saritasa\LaravelRepositories\Contracts\IRepositoryFactory;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;

/**
 * Comment business-logic service.
 */
class CommentService
{
    /**
     * Comment repository
     *
     * @var IRepository
     */
    private $repository;

    /**
     * Comment repository
     *
     * @var CommentsRepository
     */
    private $commentsRepository;

    /**
     * ListingService constructor.
     *
     * @param IRepositoryFactory $repositoryFactory Service factory
     * @param CommentsRepository $commentsRepository Comment repository
     *
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function __construct(IRepositoryFactory $repositoryFactory, CommentsRepository $commentsRepository)
    {
        $this->repository = $repositoryFactory->getRepository(Comment::class);
        $this->commentsRepository = $commentsRepository;
    }

    /**
     * Create user and fill user's profile.
     *
     * @param CreateCommentDto $createCommentDto Comment dto
     *
     * @return Comment
     *
     * @throws RepositoryException
     */
    public function createComment(CreateCommentDto $createCommentDto, $user_id): Comment
    {

        $data_tmp = $createCommentDto->toArray();
        $data = array_merge(
            $data_tmp,
            [Comment::USER_ID => $user_id]
        );

        return $this->repository->create(new Comment($data));
    }

    /**
     * Get listing pagination.
     *
     * @param PagingInfo $pagingInfo pagination class
     * @param CommentFilter $commentFilter comment filter
     *
     * @return LengthAwarePaginator
     */
    public function paginatedComment(PagingInfo $pagingInfo, CommentFilter $commentFilter): LengthAwarePaginator
    {
        $per_page = $pagingInfo->pageSize;
        $object_name = $commentFilter->object_name;

        return $this->commentsRepository->getAllComments($per_page, $object_name);
    }

    /**
     * Get all comment by the specific listing
     *
     * @param $id
     * @return mixed
     */
    public function getCommentsListing($id)
    {
        return $this->commentsRepository->getCommentsListing($id);
    }
}
