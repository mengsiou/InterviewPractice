<?php 

function getUserArticles($user_id, $article_id){
    if($user_id and $article_id){
        if($user = User::getUser($user_id)){
            if($blog = $user->blog){
                if($article = $blog->getArticle($article_id)){
                    return $article;
                }else{
                    throw new AlertException("此帳號無此文章!", '/');
                }
            }else{
                throw new AlertException("帳號尚未有部落格!", '/');
            }
        }else{
            throw new AlertException("查無此帳號", '/');
        }
    }

    return null;
}

function getUserArticlesAns($user_id, $article_id){
    switch(true){
        case !$user_id:
        case !$article_id:
            return null;
        break;
        case !$user = User::getUser($user_id):
            throw new AlertException("查無此帳號", '/');
        break;
        case !$blog = $user->blog:
            throw new AlertException("帳號尚未有部落格!", '/');
        break;
        case !$article = $blog->getArticle($article_id):
            throw new AlertException("此帳號無此文章!", '/');
        break;
    }

    return $article;
}