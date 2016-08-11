<?php
namespace Kourtis\Controllers;

use Kourtis\Database\TheatreDB;

class TheatreController extends Controller
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function showAllPosts()
    {
        $theatreDB = new TheatreDB();

        $posts = $theatreDB->getAllPosts();

        $sector = $this->sector;

        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

    public function single_post()
    {
        $sector = $this->sector;

        $theatreDB = new TheatreDB();

        $post = $theatreDB->getPostFromUrlName($this->post);

        if ( !empty($post) ){
            echo $this->twig->render('single_post.twig', array('post' => $post, 'sector'=>$sector));
        } else { //if no items found
            echo '404';
        }
    }

    public function showCompetitions()
    {
        $theatreDB = new TheatreDB();

        $posts = $theatreDB->getAllCompetitions();

        $sector = $this->sector;

        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

    public function showCritics()
    {
        $theatreDB = new TheatreDB();

        $posts = $theatreDB->getAllCritics();

        $sector = $this->sector;

        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

    public function showPlays()
    {
        $theatreDB = new TheatreDB();

        $posts = $theatreDB->getAllPlays();

        $sector = $this->sector;

        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

    public function showInterviews()
    {
        $theatreDB = new TheatreDB();

        $posts = $theatreDB->getAllInterviews();

        $sector = $this->sector;

        echo $this->twig->render( 'post_list.twig', array('posts'=>$posts, 'sector'=>$sector) );
    }

}