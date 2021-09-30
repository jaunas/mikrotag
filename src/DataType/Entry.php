<?php

namespace Jaunas\Mikrotag\DataType;

class Entry extends DataType
{

    private string $id;
    private string $date;
    private string $body;
    private array $author;
    private string $blocked;
    private string $favorite;
    private string $voteCount;
    private string $commentsCount;
    private string $status;
    private ?array $embed;
    private string $userVote;
    private ?string $app;

    protected function parseResponse(): void
    {
        // TODO Maybe property attributes can help here?
        $map = [
            'id' => 'id',
            'date' => 'date',
            'body' => 'body',
            'author' => 'author',
            'blocked' => 'blocked',
            'favorite' => 'favorite',
            'vote_count' => 'voteCount',
            'comments_count' => 'commentsCount',
            'status' => 'status',
            'embed' => 'embed',
            'user_vote' => 'userVote',
            'app' => 'app'
        ];

        foreach ($map as $id => $property) {
            $this->$property = @$this->dataArray[$id];
        }
    }
}
