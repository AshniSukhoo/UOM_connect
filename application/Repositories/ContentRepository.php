<?php

namespace App\Repositories;

use App\Repositories\Contracts\ContentRepositoryInterface;
use App\Eloquent\Content;

/**
 * Class ContentRepository
 * @package App\Repositories
 */
class ContentRepository implements  ContentRepositoryInterface
{
    /**
     * The Content model
     *
     * @var \App\Eloquent\Content
     */
    protected $content;

    /**
     * Create a new instance of the content repository interface
     *
     * @return void
     */
    public function __construct()
    {
        //Inject Content model in repository
        $this->content = new Content();
    }

    /**
     * Get content from Database
     *
     * @param string $id
     * @return \App\Eloquent\Content|null
     */
    public function getContent($id)
    {
        //Return content from DB
        return $this->content->findOrFail($id);
    }
}
