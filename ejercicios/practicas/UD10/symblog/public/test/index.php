<?php
require "../../bootstrap.php";
use App\Models\Blog;


foreach (Blog::find(97)->comment as $value) {
    var_dump($value->comment);
}