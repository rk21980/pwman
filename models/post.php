<?php

/**
 * Created by PhpStorm.
 * User: rob
 * Date: 27/09/2016
 * Time: 20:16
 */
class Post
{
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $author;
    public $content;

    public function __construct($id, $author, $content)
    {
        $this->id      = $id;
        $this->author  = $author;
        $this->content = $content;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $posts = $db->query('SELECT * FROM posts');

        // we create a list of Post objects from the database results
        foreach($posts as $post) {
            $list[] = new Post($post['id'], $post['author'], $post['content']);
        }

        return $list;
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $post = $req->fetch();

        return new Post($post['id'], $post['author'], $post['content']);
    }
}