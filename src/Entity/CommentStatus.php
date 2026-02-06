<?php

namespace App\Controller\Posts;

enum CommentStatus: string
{
    case VALID = "valide";
    case WAITING = "en-attente";
    case UNAPPROVE = "non-approve";
    case DELETED = "supprime";
}