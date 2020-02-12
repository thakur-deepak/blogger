<?php
namespace App\Repositories\Posts;

use App\Repositories\Posts\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    private $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function create(Array $data) : Post {
        
        return $this->model->create($data);
    }
}
