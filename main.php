<?php

class Main {

    /**
     * @var PDO
     */
    private $db;
    public function __construct()
    {
        include_once 'db.php';
        //$this->db = new db('localhost', 'root', '1', 'test');
        $this->db = new PDO('mysql:host=localhost;dbname=test', 'root', '1');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function dispatch()
    {
        if (empty($_SESSION)) {
            return $this->loginForm();
        }
        switch ($_GET['action']) {
            case 'login': $this->login(); break;
            case 'post': $this->post(); break;
            case 'view': $this->view(); break;
            case 'comment': $this->comment(); break;
            default: $this->posts();
        }
   }

    public function loginForm()
    {
        include 'tpl/loginForm.php';
    }

    public function login()
    {
        $st = $this->db->prepare('SELECT * FROM users WHERE name=? AND password=md5(?)');
        $st->execute(array($_POST['username'], $_POST['password']));
        $row = $st->fetchAll();
        if (empty($row)) {
            $message = 'Invalid username or password';
            include 'tpl/loginForm.php';
            return;
        }
        $_SESSION['user'] = $row[0];
        return $this->posts();
    }

    private function posts()
    {
        $start = $_GET['start'];
        if (!$start) $start = 0;
        $posts = $this->db->query('SELECT * FROM posts LIMIT ' . $start . ', 3')->fetchAll();
        $count = $this->db->query('select count(*) as cnt from posts')->fetchColumn();
        include 'tpl/posts.php';
        return;
    }

    private function post()
    {
        $st = $this->db->prepare('INSERT INTO posts(title, teaser, body, posted) VALUES (?, ?, ?, now())');
        $st->execute(array($_POST['title'], $_POST['teaser'], $_POST['body']));
        return $this->posts();
    }

    private function view($id = null)
    {
        if (!$id) $id = $_GET['id'];
        $st = $this->db->prepare('SELECT * FROM posts WHERE id=?');
        $st->execute(array($id));
        $post = $st->fetch();
        $st = $this->db->prepare('SELECT * FROM comments c JOIN users u ON u.id=c.author WHERE c.post_id=?');
        $st->execute(array($id));
        $comments = $st->fetchAll();
        include 'tpl/post.php';
    }

    private function comment()
    {
        $st = $this->db->prepare('INSERT INTO comments(post_id, author, comment) values(?, ?, ?)');
        $st->execute(array($_GET['post'], $_SESSION['user']['id'], $_GET['comment']));
        return $this->view($_GET['post']);
    }

}