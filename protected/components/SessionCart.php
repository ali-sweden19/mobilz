<?php   
    class SessionCart {

        private static $carts =  array();
        private $id;
        private $quantity;

        public function __construct() {
            self::getFromSession();
        }

        public static function add($id, $quantity) {
            $cart = new SessionCart;
            $cart->id = $id;
            $cart->quantity = $quantity;
            self::$carts[$id] = $cart;
        }

        public function updateQuantity($id, $quantity) {
            if(! isset(self::$carts[$id]))
                return FALSE;
            
            $cart = self::$carts[$id];
            $cart->quantity = $quantity;
            self::$carts[$id] = $cart;
            return TRUE;
        }
        
        public function remove($id) {
            if(! isset(self::$carts[$id]))
                return FALSE;
            
            unset (self::$carts[$id]);
            return TRUE;
        }

        public static function getCarts() {
            return self::$carts;
        }
        
        public static function getItemsCount() {
            $count = self::countCarts();
            return $count;
        }
        public static function countCarts() {
            return count(self::$carts);
        }
        
        public static function saveToSession() {
            // session_start(); // this makes the $_SESSION set, without the need to set a value in it.
            // session_unset(); // it does not unset $_SESSION
            // unset($_SESSION); // however this does unset $_SESSION
            
            // check if session is started
            if(isset($_SESSION)) {
                // clear
                // unset($_SESSION['usercarts']);
                $_SESSION['usercarts']=  self::$carts;
            } else {
                session_start();
                $_SESSION['usercarts']=  self::$carts;
            }
        }
        
        public static function getFromSession() {
            if(! isset($_SESSION)) {
                session_start();
            }
            
            if(empty($_SESSION['usercarts'])) {
                self::$carts = array();
            } else {
                self::$carts = $_SESSION['usercarts'];
            }
        }
        
        public function __destruct() {
            self::saveToSession();
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function getQuantity() {
            return $this->quantity;
        }
    }
?>