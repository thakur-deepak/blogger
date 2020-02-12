<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Repositories\Posts\PostRepository;
use App\Models\Post;

class PostTest extends TestCase
{
    /**
     * Test if a user can create a post.
     *
     * @return void
     */
    public function testCanCreatePost()
    {
        $data = [
            'title' => 'title 1',
            'content' => 'This is content.',
            'status' => true,
            'user_id' => 1
        ];

        $postRepository = new PostRepository(new Post);
        $post = $postRepository->create($data);
        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['content'], $post->content);
        $this->assertEquals($data['status'], $post->status);
        $this->assertEquals($data['user_id'], $post->user_id);
    }
}
