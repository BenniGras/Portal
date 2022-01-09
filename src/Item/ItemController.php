<?php 
namespace Website\Item;

use Website\Core\AbstractController;
use Website\User\LoginService;
use Website\User\UserRepository;
use Website\Highlight\HighlightRepository;
use Website\Picture\PictureRepository;
use Website\CrossSelling\CrossSellingRepository;
use Website\Wishlist\WishlistRepository;

class ItemController extends AbstractController
{
    public function __construct(LoginService $loginService, ItemRepository $itemRepository, UserRepository $userRepository, 
    HighlightRepository $highlightRepository, PictureRepository $pictureRepository,  CrossSellingRepository $crossSellingRepository,
    WishlistRepository $wishlistRepository)
    {
        $this->loginService = $loginService;
        $this->itemRepository = $itemRepository;
        $this->userRepository = $userRepository;
        $this->highlightRepository = $highlightRepository;
        $this->pictureRepository = $pictureRepository;
        $this->crossSellingRepository = $crossSellingRepository;
        $this->wishlistRepository = $wishlistRepository;
    }

    public function addItem()
    {
        $this->loginService->isLocked();
        $this->loginService->check();
        $addItem = null;        
        
        if(!empty($_POST))
        {
        $item_id = $this->itemRepository->insertItem($_POST);
        $this->pictureRepository->uploadPicture($_FILES, $item_id);
        } 

        $this->render("add_item", []);
    }

    public function renderIndex()
    {
        $this->loginService->isLocked();

        $items = $this->itemRepository->getItemsforPreview(); 
    

        $this->render("index", [
            'items' => $items,
        ]);
    }

    public function renderBookmarks()
    {
        $this->loginService->isLocked();
        $this->loginService->check();
        $items = $this->itemRepository->getWishlist($_SESSION['id']); 

        $this->render("bookmarks", [
            'items' => $items,
        ]);
    }

    public function myItems()
    {
        $this->loginService->isLocked();
        $this->loginService->check();
        $items = $this->itemRepository->allItemsByUser($_SESSION['id']);

        $this->render("my_items", [
            'items' => $items
        ]);
    }

    public function renderItem()
    {
        $this->loginService->isLocked();

        $id = $_GET['id'];
        $item = $this->itemRepository->find($id);
        $user_id = $item->user_id;
        $user = $this->userRepository->find($user_id);
        $pictures = $this->pictureRepository->getPictures($id);

        $this->render("item", [
            'item' => $item,
            'user' => $user,
            'pictures' => $pictures
        ]);
    }

    public function editItem()
    {
        $this->loginService->isLocked();
        $this->loginService->check();

        $id = $_GET['id'];
        $item = $this->itemRepository->find($id);

        if($item->user_id !== $_SESSION['id']) {
            header("Location: meine_anzeigen");
            die();
        }

        if(!empty($_POST))
        {
            $item->title = $_POST['title'];
            $item->description = $_POST['description'];
            $item->price = $_POST['price'];
            $item->negotiation = $_POST['negotiation'];
            $item->status = $_POST['status'];
            $item->pictures = $_POST['pictures'];

           
            $this->itemRepository->updateItem($item);
            header("Location: meine_anzeigen"); 
        }

        $this->render("edit_item", [
            'item' => $item
        ]);
    }

    public function search()
    {
        // Check if you can load the page
        $this->loginService->isLocked();
        
        // Get the Item-Objects from the Database
        $items = $this->itemRepository->searchByFilter($_GET);


        // Renders the page
        $this->render("results", [
            'items' => $items,
        ]);
    }

    // Adds the Highlights to the Database
    public function addHighlightItem()
    {
        // Creates variables
        $id = $_GET['id'];
        $addHighlight = null;

        // Get the Item-Object from the Database
        $item = $this->itemRepository->getItemById($id);

        // Check if you can load the page
        $this->loginService->isLocked();
        $this->loginService->check();

        if($item->user_id !== $_SESSION['id']) {
            header("Location: meine_anzeigen");
            die();
        }

        if ($this->highlightRepository->getItemHighlight($id)) {
            header("Location: highlight_dashboard?id=".$id);
            die();
        }

        // Add the Highlight to the Database
        if(!empty($_POST))
        {
            $addHighlight = $this->highlightRepository->insertHighlight($_POST, $id);
            header("Location: meine_anzeigen");
            die();
        }

        // Renders the page
        $this->render("highlight_item", [
            'item' => $item,
            'addHighlight' => $addHighlight
        ]);
    }

    // Gives the user an interface to check their highlights
    public function highlightDashboard()
    {
        // Creates variables
        $id = $_GET['id'];

        // Get the Item-Object from the Database
        $item = $this->itemRepository->getItemById($id);

        //Get the Highlight-Object from the Database
        $highlight = $this->highlightRepository->getItemHighlight($id);

        // Renders the page
        $this->render("highlight_dashboard", [
            'item' => $item,
            'highlight' => $highlight,
        ]);
    }

    public function crossSelling()
    {
        // Creates variables
        $id = $_GET['id'];

        // Get the Item-Object from the Database
        $item = $this->itemRepository->find($id);

        // Check if you can load the page
        $this->loginService->isLocked();
        $this->loginService->check();

        if($item->user_id !== $_SESSION['id']) {
            header("Location: meine_anzeigen");
            die();
        }

        if ($this->highlightRepository->getItemHighlight($id)) {
            header("Location: highlight_dashboard?id=".$id);
            die();
        }

        if (($_GET['type'] != "highlight" && $_GET['type'] != "top anzeige" && $_GET['type'] != "gallerie") ||
        ($_GET['dauer'] != "7" && $_GET['dauer'] != "14" && $_GET['dauer'] != "21" && $_GET['dauer'] != "28")) {
            header("Location: anzeige_hervorheben?id=".$id);
            die();
        }

        // Add the Highlight to the Database
        if(!empty($_POST))
        {
            $addHighlight = $this->highlightRepository->insertHighlight($_POST, $id);
            header("Location: meine_anzeigen");
            die();
        }

        // Gets the Data from the Database
        $data = $this->crossSellingRepository->getData($_GET['type'], $_GET['dauer']);

        // Renders the page
        $this->render("cross_selling", [
            'item' => $item,
            'data' => $data,
        ]);
    }

    public function changeWishlist()
    {
        $item_id = $_GET['id'];
        $user_id = $_SESSION['id'];

        if($this->wishlistRepository->getWishlistItem($item_id, $user_id)){
            $this->wishlistRepository->deleteWishlist($item_id, $user_id);
            header("Location: merkliste");
        } else {
            $this->wishlistRepository->addWishlist($item_id, $user_id);
            header("Location: merkliste");
        }
        
    }

}
?>