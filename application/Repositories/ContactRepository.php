<?php

namespace App\Repositories;

use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use App\Eloquent\ContactMessage;

/**
 * Class ContactRepository
 *
 * @package App\Repositories
 */
class ContactRepository implements ContactMessageRepositoryInterface
{
    /**
     * The Contact message model
     *
     * @var \App\Eloquent\ContactMessage
     */
    protected $contactMessage;

    /**
     * Create the new instance of the ContactRepository
     */
    public function __construct()
    {
        //Inject new contact model in the repo
        $this->contactMessage = new ContactMessage();
    }

    /**
     * Save new contact message
     *
     * @param array $details
     * @return \App\Eloquent\ContactMessage
     */
    public function saveMessage($details = [])
    {
        //Save and return model
        return $this->contactMessage->create($details);
    }
}
