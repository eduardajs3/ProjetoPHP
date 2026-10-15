<?php

namespace App\App\Model;

class ChatModel
{
    private $id;
    private UserModel $hosts;

    public function getId()
    {
        return $this->id;
    }
}
