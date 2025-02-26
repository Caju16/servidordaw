<?php

namespace App\Models;

class Comment extends DBAbstractModel
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

    private $user;
    private $comment;
    private $blog;
    private $created;

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setBlog($blog)
    {
        $this->blog = $blog;
    }

    public function getBlog()
    {
        return $this->blog;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    protected function set()
    {
        $this->query = "INSERT INTO comments (blog_id, user, comment, approved, created) VALUES (:blog_id, :user, :comment, :approved, :created)";
        $this->parametros[":blog_id"] = $this->blog_id;
        $this->parametros[":user"] = $this->user;
        $this->parametros[":comment"] = $this->comment;
        $this->parametros[":approved"] = $this->approved;
        $this->parametros[":created"] = $this->created;

        $this->get_results_from_query();
    }

    // Métodos vacíos
    protected function get() {}
    protected function edit() {}
    protected function delete() {}


}
?>