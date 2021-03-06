<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/setup.php';

use Kourtis\Controllers;
use Kourtis\Router;

//Load .env variables
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../app/');
$dotenv->load();

$router = new Router\Router();

//---------- GET ----------//
//Public
$router->get('/', 'MainController', 'index');
$router->get('/contact', 'MainController', 'contact');
$router->get('/theatre', 'TheatreController', 'showAllPosts');
$router->get('/theatre/critics', 'TheatreController', 'showCritics');
$router->get('/theatre/hearings', 'TheatreController', 'showHearings');
$router->get('/theatre/news', 'TheatreController', 'showNews');
$router->get('/theatre/competitions', 'TheatreController', 'showCompetitions');
$router->get('/theatre/plays', 'TheatreController', 'showPlays');
$router->get('/theatre/interviews', 'TheatreController', 'showInterviews');
$router->get('/theatre/[-\w\p{M}!\.]+', 'TheatreController', 'single_post');
$router->get('/cinema', 'CinemaController', 'showAllPosts');
$router->get('/cinema/[-\w\p{M}!\.]+', 'CinemaController', 'single_post');
$router->get('/music', 'MusicController', 'showAllPosts');
$router->get('/music/[-\w\p{M}!\.]+', 'MusicController', 'single_post');
$router->get('/photos', 'PhotosController', 'showAllPosts');
$router->get('/photos/[-\w\p{M}!\.]+', 'PhotosController', 'single_post');
$router->get('/podcasts', 'PodcastsController', 'showAllPosts');
$router->get('/podcasts/[-\w\p{M}!\.]+', 'PodcastsController', 'single_post');
//Admin - General
$router->get('/admin/dashboard', 'Admin\AdminController', 'index');
$router->get('/admin/dashboard/contactSupport', 'Admin\AdminController', 'contactSupport');
$router->get('/admin/login', 'Admin\AdminController', 'login');
$router->get('/admin/logout', 'Admin\AdminController', 'logout');
//Admin - Add Post
$router->get('/admin/dashboard/addTheatrePost', 'Admin\TheatreAdminController', 'addPost');
$router->get('/admin/dashboard/addCinemaPost', 'Admin\CinemaAdminController', 'addPost');
$router->get('/admin/dashboard/addMusicPost', 'Admin\MusicAdminController', 'addPost');
$router->get('/admin/dashboard/addPhotoPost', 'Admin\PhotosAdminController', 'addPost');
$router->get('/admin/dashboard/addPodcastPost', 'Admin\PodcastsAdminController', 'addPost');
//Admin - Edit Post
$router->get('/admin/dashboard/editTheatrePost', 'Admin\TheatreAdminController', 'editPost');
$router->get('/admin/dashboard/editCinemaPost', 'Admin\CinemaAdminController', 'editPost');
$router->get('/admin/dashboard/editMusicPost', 'Admin\MusicAdminController', 'editPost');
$router->get('/admin/dashboard/editPhotoPost', 'Admin\PhotosAdminController', 'editPost');
$router->get('/admin/dashboard/editPodcastPost', 'Admin\PodcastsAdminController', 'editPost');
//Admin - Delete Post
$router->get('/admin/dashboard/deleteTheatrePost', 'Admin\TheatreAdminController', 'deletePost');
$router->get('/admin/dashboard/deleteCinemaPost', 'Admin\CinemaAdminController', 'deletePost');
$router->get('/admin/dashboard/deleteMusicPost', 'Admin\MusicAdminController', 'deletePost');
$router->get('/admin/dashboard/deletePhotoPost', 'Admin\PhotosAdminController', 'deletePost');
$router->get('/admin/dashboard/deletePodcastPost', 'Admin\PodcastsAdminController', 'deletePost');
//Admin - Carousel
$router->get('/admin/dashboard/editCarousel', 'Admin\CarouselAdminController', 'editCarousel');
$router->get('/admin/dashboard/postEditCarousel', 'Admin\CarouselAdminController', 'postEditCarousel');
$router->get('/admin/dashboard/uploadCarousel', 'Admin\CarouselAdminController', 'uploadCarousel');
$router->get('/deleteFromCarouselDB', 'Admin\CarouselAdminController', 'deleteFromCarousel');


//---------- POST ----------//
//Public
$router->post('/contact', 'MainController', 'postContact');
$router->post('/theatre/contactCompetition', 'TheatreController', 'postContactCompetition');
//Admin - Add Posts
$router->post('/admin/dashboard/addTheatrePost', 'Admin\TheatreAdminController', 'postAddPost');
$router->post('/admin/dashboard/addCinemaPost', 'Admin\CinemaAdminController', 'postAddPost');
$router->post('/admin/dashboard/addMusicPost', 'Admin\MusicAdminController', 'postAddPost');
$router->post('/admin/dashboard/addPhotosPost', 'Admin\PhotosAdminController', 'postAddPost');
$router->post('/admin/dashboard/addPodcastsPost', 'Admin\PodcastsAdminController', 'postAddPost');

$router->post('/admin/deleteItem', 'Admin\AdminController', 'postDeleteItem');
$router->post('/admin/editItem', 'Admin\AdminController', 'postEditItem');
$router->post('/admin/login', 'Admin\AdminController', 'postLogin');
$router->post('/admin/contact', 'Admin\AdminController', 'postContact');
//Admin - Carousel
$router->post('/admin/dashboard/uploadCarousel', 'Admin\CarouselAdminController', 'postUploadCarousel');


////See inside $router
//echo "<pre>";
//print_r($router);

$router->submit();

