<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos</title>
</head>
<body>
    <h1>Blogs</h1>
    <?php if (!empty($blogs)): ?>
        <?php foreach ($blogs as $blog): ?>
            <div>
                <h2><?php echo htmlspecialchars($blog->getTitle(), ENT_QUOTES, 'UTF-8'); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($blog->getBlog(), ENT_QUOTES, 'UTF-8')); ?></p>
                <p><strong>Author:</strong> <?php echo htmlspecialchars($blog->getAuthor(), ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Tags:</strong> <?php echo htmlspecialchars($blog->getTags(), ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Created:</strong> <?php echo $blog->getCreated()->format('Y-m-d H:i:s'); ?></p>
                <p><strong>Updated:</strong> <?php echo $blog->getUpdated()->format('Y-m-d H:i:s'); ?></p>
                <h3>Comments</h3>
                <?php if (!empty($blog->getComments())): ?>
                    <ul>
                        <?php foreach ($blog->getComments() as $comment): ?>
                            <li>
                                <p><strong><?php echo htmlspecialchars($comment->getUser(), ENT_QUOTES, 'UTF-8'); ?>:</strong> <?php echo htmlspecialchars($comment->getComment(), ENT_QUOTES, 'UTF-8'); ?></p>
                                <p><strong>Created:</strong> <?php echo $comment->getCreated()->format('Y-m-d H:i:s'); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No comments</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No blogs available</p>
    <?php endif; ?>
</body>
</html>