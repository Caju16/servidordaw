<?php

namespace App\Controllers;

use App\Models\Blog;
use App\Models\Comment;

class CargarController extends BaseController
{
    public function IndexAction()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $tags = $_POST['tags'] ?? '';
            $description = $_POST['description'] ?? '';
            $author = $_POST['author'] ?? 'Anonymoues';
            $imagePath = null;
    
            if(isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK){
                $imageName = time() . '_' . $_FILES['image']['name'];
                $imagePath = 'uploads/' . $imageName;
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            }
    
            $blog = new Blog();
            $blog->title = $title;
            $blog->tags = $tags;
            $blog->description = $description;
            $blog->author = $author;
            $blog->image = $imagePath;
            $blog->save();
    
            header('Location: /');
        } else {
            $this->renderHTML('../app/views/datos_view.php');
        }
    }
}

?>