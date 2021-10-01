<?php
require_once "./bootstrap.php";

use Comment\Comment;
use Reply\Reply;

date_default_timezone_set('Europe/Vilnius');

// Helper functions
function redirect_to_root()
{
    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

// Add comment
if (
    isset($_POST['add_comment'])
    && !empty($_POST['comment_name'])
    && !empty($_POST['comment_email'])
    && !empty($_POST['comment_comment'])
    && !empty($_POST['comment_created_at'])
) {
    $comment = new Comment();
    $comment->setName($_POST['comment_name']);
    $comment->setEmail($_POST['comment_email']);
    $comment->setComment($_POST['comment_comment']);
    $now = date('Y-m-d H:i:s');
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $now);
    $comment->setCreatedat($date);
    $entityManager->persist($comment);
    $entityManager->flush();
    redirect_to_root();
}

// Do reply
if (
    isset($_POST['do_reply'])
    && !empty($_POST['reply_name'])
    && !empty($_POST['reply_email'])
    && !empty($_POST['reply_comment'])
    && !empty($_POST['reply_post_id'])
    && !empty($_POST['reply_created_at'])
) {
    $reply = new Reply();
    $reply->setName($_POST['reply_name']);
    $reply->setEmail($_POST['reply_email']);
    $reply->setComment($_POST['reply_comment']);

// TODO PADARYTI VEIKIANCIA REPLY FORMA - COMMENT ID PRISKIRIMAS PRIE POST ID
    
    // $comment = $entityManager->getRepository('Comment\Comment')->findOneBy($comment_id);
    // $comment = $entityManager->getReference('Comment\Comment', $comment->getId());
    // $comment = $entityManager->getReference('Comment\Comment', $id);
    // $comment = $entityManager->getReference('Comment\Comment', $_POST['comment_id']);
    // $comment = $entityManager->getRepository('Comment\Comment')->find($id);
    // $comment = $entityManager->getRepository('Comment\Comment')->find($comment->getId());
    // $comment = $entityManager->getRepository('Comment\Comment')->find($_POST['comment_id']);
    // $comment = $entityManager->find('Comment\Comment',  $_POST['comment_id']);
    // $comment = $entityManager->find('Comment\Comment', $id);
    // $comment = $entityManager->find('Comment\Comment', $comment->getId());

    $reply->setPostid($_POST['reply_post_id']);
    $now = date('Y-m-d H:i:s');
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $now);
    $reply->setCreatedat($date);
    $entityManager->persist($reply);
    $entityManager->flush();
    redirect_to_root();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Comments</title>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <div class="container">
        <div class="row" style="justify-content: center;">

            <div class="container">
                <div class="row" style="justify-content: center;">
                    <div class="col-md-8">
                        <div class="media g-mb-30 media-comment">
                            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                <form action="" method="post">
                        <?php $date = new DateTime('now');
                                echo  "<input type='hidden' name='comment_created_at' value='". $date->format('Y-m-d H:i:s') ."' required>"; ?>
                                    <p>
                                        <label>Your name</label>
                                        <input class="h5 g-color-gray-dark-v1 mb-0" style="width:70%; float:right;" type="text" name="comment_name" required>
                                    </p>
                                    <p>
                                        <label>Your email address</label>
                                        <input type="email" style="width:60%; float:right;" name="comment_email" required>
                                    </p>
                                    <p>
                                        <label>Comment</label>
                                        <textarea class="g-color-gray-dark-v4 g-font-size-12" style="width: 100%;" name="comment_comment" required></textarea>
                                    </p>
                                    <p>
                                        <input type="submit" class="button" value="Add Comment" name="add_comment">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            $comments = $entityManager->getRepository('Comment\Comment')->findAll();            
            foreach ($comments as $comment) {
                print(' <div class="col-md-8">
                <div class="media g-mb-30 media-comment">
                    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="cute-cat.jpg" alt="Image Description">
                    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                        <div class="g-mb-15">
                            <h5 class="h5 g-color-gray-dark-v1 mb-0">' . $comment->getName() . '</h5>
                            <span class="g-color-gray-dark-v4 g-font-size-12">' . $date->format('F d, Y h:i a') . '</span>
                        </div>
                    
                        <p>' . $comment->getComment() . '</p>
                        <a data-id="' . $comment->getId() . '" onclick="showReplyForm(this)" class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#">
                            <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                            Reply
                        </a>
                        <div id="form-' . $comment->getId() . '" class="container" style="display: none;">
                        <div>
                            <div>
                                <div class="media g-mb-30 media-comment">
                                    <div class="media-body u-shadow-v18 g-pa-30" style="border:1px solid;  border-radius: 10px;">
                                        <form action="" method="post">
                                        <input type="hidden" name="reply_post_id" value="' . $comment->getId() . '" required>');
                                        $date = new DateTime('now');
                                        print(' <input type="hidden" name="reply_created_at" value=". $date->format(\'Y-m-d H:i:s\') ." required>   
                                        <p>
                                                <label>Your name</label>
                                                <input class="h5 g-color-gray-dark-v1 mb-0" style="width:70%; float:right;" type="text" name="reply_name" required>
                                            </p>
                                            <p>
                                                <label>Your email address</label>
                                                <input type="email" style="width:60%; float:right;" name="reply_email" required>
                                            </p>
                                            <p>
                                                <label>Comment</label>
                                                <textarea class="g-color-gray-dark-v4 g-font-size-12" style="width: 100%;" name="reply_comment" required></textarea>
                                            </p>
        
                                            <p>
                                                <input type="submit" class="button" value="Reply" name="do_reply">
                                           </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>');

                // $servername = "localhost";
                // $username = "root";
                // $password = "mysql";
                // $dbname = "comment";
                // $conn = mysqli_connect($servername, $username, $password, $dbname);
                // $query = "SELECT replies.post_id GROUP_CONCAT(comments.id separator \", \") as post_id 
                //         FROM replies 
                //         LEFT JOIN comments  
                //         ON replies.post_id = comments.id
                //         GROUP BY replies.id";
                // $result = mysqli_query($conn, $query);

                $replies = $entityManager->getRepository('Reply\Reply')->findAll();
                foreach ($replies as $reply) {
                    print(' <div class="g-bg-reply">
                                        <div>
                                         <input type="hidden" name="reply_post_id" value="' . $comment->getId() . '" required>
                                            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="cute-cat.jpg" alt="Image Description">
                                            <div class="">
                                                <div class="">
                                                    <h5 class="h5 g-color-gray-dark-v1 mb-0">' . $reply->getName() . '</h5>
                                                        <span class="g-color-gray-dark-v4 g-font-size-12">' . $date->format('F d, Y h:i a') . '</span>
                                                </div>
                                            </div>            <p>' . $reply->getComment() . '</p>
                                        </div>
                                    </div>');
                }
                print('</div>
                </div>
            </div>');
            }
            ?>
</body>
<script>
    function showReplyForm(self) {
        var commentId = self.getAttribute("data-id");
        if (document.getElementById("form-" + commentId).style.display == "") {
            document.getElementById("form-" + commentId).style.display = "none";
        } else {
            document.getElementById("form-" + commentId).style.display = "";
        }
    }
</script>

</html>