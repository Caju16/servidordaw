<?php

namespace App\Models;

class Blog extends DBAbstractModel
{
    private static $instancia;

    // Patron singleton, no puedo tener dos objetos de la clase mascotas
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    private $title;
    private $blog;
    private $image;
    private $author;
    private $tags;
    private $created;
    private $updated;
    private $comments = [];

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBlog($blog)
    {
        $this->blog = $blog;
    }

    public function getBlog()
    {
        return $this->blog;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function set()
    {
        $this->query = "INSERT INTO blog (title, blog, image, author, tags) VALUES (:title, :blog, :image, :author, :tags)";
        $this->parametros['title'] = $this->title;
        $this->parametros['blog'] = $this->blog;
        $this->parametros['image'] = $this->image;
        $this->parametros['author'] = $this->author;
        $this->parametros['tags'] = $this->tags;
        

        try {
            $this->get_results_from_query();

            // Se debe ejecutar sobre la misma conexión
            $idBlog = $this->conn->lastInsertId(); // Devuelve el id del último registro insertado

            foreach ($this->comments as $comment) {
                $this->query = "INSERT INTO comment (blog_id, user, comment, approved) VALUES (:blog_id, :user, :comment, :approved)";
                $this->parametros['blog_id'] = $idBlog;
                $this->parametros['user'] = $comment->getUser();
                $this->parametros['comment'] = $comment->getComment();
                $this->parametros['approved'] = 0;
                $this->get_results_from_query();
            }
            $this->mensaje = 'Blog agregado exitosamente';
        } catch (Exception $e) {
            $this->mensaje = "ERROR: " . $e->getMessage();
        }
    }

    // Métodos vacíos
    protected function get() {}
    protected function edit() {}
    protected function delete() {}
}
?>