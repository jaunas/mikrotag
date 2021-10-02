<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

class Entry extends DataType
{

    #[Field]
    public string $id;

    #[Field]
    public string $date;

    #[Field]
    public ?string $body;

    #[Field]
    public array $author;

    #[Field]
    public string $blocked;

    #[Field]
    public string $favorite;

    #[Field('vote_count')]
    public string $voteCount;

    #[Field('comments_count')]
    public string $commentsCount;

    #[Field]
    public string $status;

    #[Field]
    public ?array $embed;

    #[Field('user_vote')]
    public string $userVote;

    #[Field]
    public ?string $app;
}
