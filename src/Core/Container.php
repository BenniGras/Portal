<?php
namespace Website\Core;

use PDO;
use PDOException;
use Website\Item\ItemRepository;
use Website\User\UserRepository;
use Website\Highlight\HighlightRepository;
use Website\Picture\PictureRepository;
use Website\CrossSelling\CrossSellingRepository;
use Website\Wishlist\WishlistRepository;
use Website\Item\ItemController;
use Website\User\LoginController;
use Website\User\LoginService;

class Container
{
    private $receipts = [];

    private $instances = [];

    public function __construct()
    {
        $this->receipts = [
            'loginService' => function()
            {
                return new LoginService(
                    $this->make('userRepository')
                );
            },
            'loginController' => function()
            {
                return new LoginController(
                    $this->make('loginService'),
                    $this->make('userRepository')
                );
            },
            'itemController' => function()
            {
                return new ItemController(
                    $this->make('loginService'),
                    $this->make('itemRepository'),
                    $this->make('userRepository'),
                    $this->make('highlightRepository'),
                    $this->make('pictureRepository'),
                    $this->make('crossSellingRepository'),
                    $this->make('wishlistRepository'),
                );
            },
            'userRepository' => function()
            {
                return new UserRepository(
                    $this->make("pdo")
                );
            },
            'itemRepository' => function()
            {
                return new ItemRepository(
                    $this->make("pdo")
                );
            },
            'highlightRepository' => function()
            {
                return new HighlightRepository(
                    $this->make("pdo")
                );
            },
            'pictureRepository' => function()
            {
                return new PictureRepository(
                    $this->make("pdo")
                );
            },
            'crossSellingRepository' => function()
            {
                return new CrossSellingRepository(
                    $this->make("pdo")
                );
            },
            'wishlistRepository' => function()
            {
                return new WishlistRepository(
                    $this->make("pdo")
                );
            },
            'pdo' => function() {
            try{
                $pdo = new PDO(
                    'mysql:host=localhost;dbname=byecycle;charset=utf8',
                    'root', 
                    ''
                );
            } catch (PDOException $e) {
                echo "Es konnte keine Verbindung zu Datenbank aufgebaut werden.";
                die();
            }
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return $pdo; 
            }
        ];
    }

    public function make($name)
    {
        if (!empty($this->instances[$name]))
        {
            return $this->instances[$name];
        }

        if (isset($this->receipts[$name]))
        {
            $this->instances[$name] = $this-> receipts[$name]();
        }

        // ERZEUGE: $this->instances[$name]

        return $this->instances[$name];
    }
}
?>