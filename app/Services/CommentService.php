<?php

namespace App\Services;

use App\Dto\Comments\CreateCommentDto;
use App\Dto\Comments\PaginatedCommentDto;
use App\Models\Comment;
use App\Repositories\CommentsRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
    public function createComment(CreateCommentDto $createCommentDto): Comment
    {

        $data = $createCommentDto->toArray();

        return $this->repository->create(new Comment($data));
    }

    /**
     * Get listing pagination.
     *
     * @param PaginatedCommentDto $paginatedCommentDto paginate page comment
     *
     * @return LengthAwarePaginator
     */
    public function paginatedComment(PaginatedCommentDto $paginatedCommentDto): LengthAwarePaginator
    {
        $per_page = $paginatedCommentDto->per_page;
        $object_name = $paginatedCommentDto->object_name;

        return $this->commentsRepository->getAllComments($per_page, $object_name);
    }
}
