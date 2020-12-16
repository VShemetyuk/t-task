<?php

class User
{

}

class Article
{
    /**
     * возможность получить автора статьи;
     *
     * @return User
     */
    public function getAuthor()
    {
    }

    /**
     * возможность сменить автора статьи.
     *
     * @param User $author
     *
     * @return void
     */
    public function setAuthor(User $author)
    {
    }
}

class ArticleManager
{
    /**
     * возможность для пользователя создать новую статью;
     *
     * @param User $author
     *
     * @return void
     */
    public function create(User $author)
    {
    }

    /**
     * возможность получить все статьи конкретного пользователя;
     *
     * @param User $author
     *
     * @return array User list
     */
    public function findAll(User $author)
    {
    }
}
