<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Saritasa\LaravelRepositories\Exceptions\RepositoryException;
use Saritasa\LaravelRepositories\Repositories\Repository;

/**
 * Class CommentsRepository Comment model repository. Manages stored entities
 *
 * @package App\Repositories
 */
class CommentsRepository extends Repository
{
    /**
     * CommentsRepository constructor.
     *
     * @throws RepositoryException
     */
    public function __construct()
    {
        parent::__construct(Comment::class);
    }

    /**
     * Get all comments
     *
    * @param int $perpage per_page
    * @param string|null $object_name object_name
     *
     * @return LengthAwarePaginator
    */
    public function getAllComments(int $perpage, ?string $object_name): LengthAwarePaginator
    {
        $builder = Comment::query();

        if (!empty($object_name)) {
            $builder->where('object_name', $object_name);
        }

        return $builder->paginate($perpage);
    }

    /**
     * Get all comment by the specific listing
     *
     * @param $id
     * @return mixed
     */
    public function getCommentsListing($id)
    {
        return Comment::query()->where(Comment::OBJECT_NAME, 'listing')
            ->where(Comment::OBJECT_ID, $id)->get();
    }
}
