<?php
require_once "bootstrap.php";
use Reply\Reply;

$newReplyEmail = "rob@r.com";
$newReplyName = $argv[1];
$newReplyComment = "Nice Post!";
$newReplyPostid = 1;


$reply = new Reply();
    $reply->setEmail($newReplyEmail);
    $reply->setName($newReplyName);
    $reply->setComment($newReplyComment);
    $reply->setPostid($newReplyPostid);
    $reply->getCreatedat($newReplyCreatedat);



$entityManager->persist($reply);
$entityManager->flush();


