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

// TODO VALIDACIJA: TURI MESTI KAS NEGERAI SUVESTA EMAIL SU TASKU IR @
// TODO NAUJAS KOMENTARAS TURI ATSIRASTI VIRSUJE

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tourney:ital,wght@1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <div class="topnav" id="myTopnav">
        <h1 class="title1">VIDEO GAMES</h1>
        <a href="#home" class="active">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
        <a href="javascript:void(0);" class="icon" onclick="responseNav()">
            <i class="fa fa-bars"></i>
        </a>
        <h1 class="title2">VIDEO GAMES</h1>
    </div>
    <div class="container">
        <div class="row" style="justify-content: center;">
            <div class="container">
                <div class="row" style="text-align: justify;">
                    <div class="col-md-12">
                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                            <img class="img" src="https://phantom-marca.unidadeditorial.es/8256e68fdfac5b6a6c792af7308d27e8/crop/0x0/1597x899/resize/1320/f/jpg/assets/multimedia/imagenes/2021/10/01/16330974723192.png" alt="">
                            <h1> ‘Squid Game’ in Video Games</h1>
                            <span class="g-color-gray-dark-v4 g-font-size-12">October 11, 2021 08:31 am</span>
                            <p><br>So you've recently wrapped up "Squid Game," the fabulous new Netflix Inc. show about a gathering of unfortunate individuals who contend in destructive matches to dominate a gigantic monetary reward. Presently you're searching for another thing to satisfy your yearnings for innovative fierceness and stunning unexpected developments. </p><br>
                            <p>Uplifting news: There are a great deal of computer games that fit the bill.</p><br>

                            <p>In the event that you had fun, permit me to suggest some computer games you should play. Start with Danganronpa, a progression of sickening visual books wherein a gathering of youngsters are caught by a twisted (however delightful) stuffed bear.

                                There are three games in the Danganronpa series, and all are loads of fun. They're accessible on PC, PlayStation and cell phones this moment and will be delivered on Nintendo Switch in December. Amazing luck for the showcasing people at Spike Chunsoft, the Japanese designer and distributer behind the computer games. "You've known about 'Squid Game?' Try Bear Game." </p><br>

                            <p>A comparable series is the Zero Escape set of three, one more arrangement of visual books that are brimming with brilliant characters and naughty unexpected developments. Every one of the three Zero Escape titles includes its own passing game.</p>

                            <p><br>Both the Danganronpa and Zero Escape games comprise totally of perusing and settling puzzles, so they're available regardless of whether you've never gotten a regulator. In numerous ways they're more similar to books than games.

                                Very much like "Squid Game," they have a portion of deplorable brutality, yet the genuine allure is the secret and strain.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row" style="justify-content: center;">
                    <div class="col-md-8">
                        <div class="media g-mb-30 media-comment">
                            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                <form action="" method="post">
                                    <?php $date = new DateTime('now');
                                    echo  "<input type='hidden' name='comment_created_at' value='" . $date->format('Y-m-d H:i:s') . "' required>"; ?>
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
                    <img class="d-flex g-50 rounded-circle g-mt-3 g-mr-15" src="cute-cat.jpg" alt="Image Description">
                    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                        <div class="g-mb-15">
                            <h5 class="h5 g-color-gray-dark-v1 mb-0">' . $comment->getName() . '</h5>
                            <span class="g-color-gray-dark-v4 g-font-size-12">' . $date->format('F d, Y h:i a') . '</span>
                        </div>
                        <p>' . $comment->getComment() . '</p>
                        <a data-id="' . $comment->getId() . '" onclick="showReplyForm(this)" class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void();">
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
                $replies = $entityManager->getRepository('Reply\Reply')->findAll();
                foreach ($replies as $reply) {
                    if ($comment->getId() == $reply->getPostid()) {
                        print(' <div class="g-bg-reply">
                                        <div class="reply">
                                            <img class="d-flex g-50 rounded-circle g-mt-3 g-mr-15" src="cute-cat.jpg" alt="Image Description">
                                            <div class="">
                                                <div class="">
                                                    <h5 class="h5 g-color-gray-dark-v1 mb-0">' . $reply->getName() . '</h5>
                                                        <span class="g-color-gray-dark-v4 g-font-size-12">' . $date->format('F d, Y h:i a') . '</span>
                                                </div>
                                            </div>            <p>' . $reply->getComment() . '</p>
                                        </div>
                                    </div>');
                    }
                }
                print('</div>
                </div>
            </div>');
            }          
            ?>
        </div>
        </div>
             <div class="footer-clean">
            <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Legacy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Careers</h3>
                        <ul>
                            <li><a href="#">Job openings</a></li>
                            <li><a href="#">Employee success</a></li>
                            <li><a href="#">Benefits</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">Video Games © 2021</p>
                    </div>
                </div>
            </div>
            </footer>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    // TODO KOMENTARAS TURI ATSIRASTI BE PERKROVIMO 
    // TODO PADARYTI KAD PO REPLY FORMA PASISLEPIA IR KOM ATSIRANDA BE PERKROVIMO

    function showReplyForm(self) {
        var commentId = self.getAttribute("data-id");
        if (document.getElementById("form-" + commentId).style.display == "") {
            document.getElementById("form-" + commentId).style.display = "none";
        } else {
            document.getElementById("form-" + commentId).style.display = "";
        }
    }
    function responseNav() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        } else {
          x.className = "topnav";
        }
    }
</script>

</html>