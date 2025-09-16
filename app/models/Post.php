<?php

class Post
{
    private string $title;
    private string $text;
    private int $upvotes;
    private int $downvotes;
    private int $post_id;
    private User $author;
    private DateTime $date_posted;

    /**
     * Summary of __construct
     * @param int $post_id
     */
    public function __construct(int $post_id) 
    {
        /**
         * Database Implementation Needed!!!
         */
    }

    
    /**
     * Summary of delete_post
     * @param int $user_id
     * @return bool
     */
    public function delete_post(int $user_id): bool 
    {
        /**
         * return post_deletion_ok();
         * 
         * Database Implementation Needed!!!
         */
        return false;
    }

    public function upvote_post(int $user_ud) 
    {

    }

    public function downvote_post(int $user_id) 
    {

    }

    /**
     * Summary of to_array
     * @return array{author_id: mixed, date: string, downvotes: int, post_id: int, text: string, title: string, upvotes: int}
     */
    public function to_array() 
    {
        return [
            "title" => $this->title,
            "text" => $this->text,
            "upvotes" => $this->upvotes,
            "downvotes" => $this->downvotes,
            "post_id" => $this->post_id,
            "author_id" => $this->author->get_user_id(),
            "date" => $this->date_posted->format("Y-m-d")
        ];
    }
}