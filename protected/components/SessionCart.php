<?php  

    /**
     * Maitains session cart
     * 
     */
    class SessionCart {

        private static $carts =  array();
        private $id;
        private $quantity;

        public function __construct() {
            self::getFromSession();
        }
        
        /**
         * Adds product
         * @param integer $id
         * @param integer $quantity
         */
        public static function add($id, $quantity) {
            $cart = new SessionCart;
            $cart->id = $id;
            $cart->quantity = $quantity;
            self::$carts[$id] = $cart;
        }
        
        /**
         * Updates the quantity of the cart if exists
         * @param integer $id
         * @param interger $quantity
         * @return boolean
         */
        public function updateQuantity($id, $quantity) {
            if(! isset(self::$carts[$id]))
                return FALSE;
            
            $cart = self::$carts[$id];
            $cart->quantity = $quantity;
            self::$carts[$id] = $cart;
            return TRUE;
        }
        
        /**
         * Removes product if exists from cart
         * @param integer $id
         * @return boolean
         */
        public function remove($id) {
            if(! isset(self::$carts[$id]))
                return FALSE;
            
            unset (self::$carts[$id]);
            return TRUE;
        }

        /**
         * Returns all the carts
         * @return SessionCart array 
         */
        public static function getCarts() {
            return self::$carts;
        }
        
        /**
         * Returns the no of items in the cart
         * @return integer
         */
        public static function getItemsCount() {
            $count = self::countCarts();
            return $count;
        }
        
        /**
         * Helper for counting items
         * @return integer
         */
        public static function countCarts() {
            return count(self::$carts);
        }
        
        /**
         * Saves the current Cart to session
         */
        public static function saveToSession() {
            
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
        
        /**
         * Get carts from session
         */
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
        
        /**
         * Returns the ID of the current cart
         * @return integer
         */
        public function getId() {
            return $this->id;
        }
        
        /**
         * Returns the quantity of the current cart item
         * @return integer
         */
        public function getQuantity() {
            return $this->quantity;
        }
    }
?>