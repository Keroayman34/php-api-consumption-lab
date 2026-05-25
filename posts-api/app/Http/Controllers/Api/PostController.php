<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::latest()->get();

        return $this->successResponse(PostResource::collection($posts), 'Posts retrieved successfully');
    }

    public function show(string $id): JsonResponse
    {
        $post = Post::find($id);

        if (! $post) {
            return $this->errorResponse('Post not found', [], 404);
        }

        return $this->successResponse(new PostResource($post), 'Post retrieved successfully');
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $payload = $request->validated();
        $payload['user_id'] = auth('api')->id();

        $post = Post::create($payload);

        return $this->successResponse(new PostResource($post), 'Post created successfully', 201);
    }

    public function update(UpdatePostRequest $request, string $id): JsonResponse
    {
        $post = Post::find($id);

        if (! $post) {
            return $this->errorResponse('Post not found', [], 404);
        }

        if ($post->user_id !== auth('api')->id()) {
            return $this->errorResponse('Forbidden', [], 403);
        }

        $post->update($request->validated());

        return $this->successResponse(new PostResource($post), 'Post updated successfully');
    }

    public function destroy(string $id): JsonResponse
    {
        $post = Post::find($id);

        if (! $post) {
            return $this->errorResponse('Post not found', [], 404);
        }

        if ($post->user_id !== auth('api')->id()) {
            return $this->errorResponse('Forbidden', [], 403);
        }

        $post->delete();

        return $this->successResponse((object) [], 'Post deleted successfully');
    }
}
