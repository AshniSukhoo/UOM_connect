<?php

namespace App\Repositories\Contracts;

/**
 * Interface ContentRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface ContentRepositoryInterface
{
    /**
     * Get content from Database
     *
     * @param string $id
     * @return \App\Eloquent\Content|null
     */
    public function getContent($id);

}
