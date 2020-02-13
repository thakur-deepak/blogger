<?php

namespace App\Repositories\Posts\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{

    function create(Array $params) : Post;

}