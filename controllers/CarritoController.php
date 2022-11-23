<?php 

    class CarritoController{
       
        public static function index(){
            if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
                echo $GLOBALS['twig']->render('carrito/index.twig', 
                    [
                        'carrito' => $_SESSION['carrito'],
                        'identity' => $_SESSION['identity'],
                        'URL' => URL
                    ]
                );
            }
        }

        /**
         * Funcion es la que agrega un elemento a mi $_SESSION['carrito']
         */
        public static function agregar(){
            if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
                /**
                 * Primero recojo el id del producto que selecciono
                 */
                $id = $_GET['id'];
                
                /**
                 * Recojo el precio del producto seleccionado
                 * Ir a la base de datos, ver que producto he seleccionado(id)
                 * Recoger el precio del objeto retornado
                 */
                $producto = new Producto();
                $producto->setId($id);
                $precio = $producto->findById()->precio;
                
                /**
                 * Ahora tengo el producto_id, precio
                 * Me falta la cantidad (ponemos 1 por poner algo)
                 */
                $cantidad = 1;

                /**
                 * Mi $_SESSION['carrito] contiene un array con los valores seleccionados
                 */
                $_SESSION['carrito'][] = array(
                    "producto_id" => $id,
                    "precio" => $precio,
                    "cantidad" => $cantidad
                );

                header('Location: '.URL.'controller=carrito&action=index');
            }else{
                header('Location: '.URL.'controller=auth&action=login');
            }
        }

        public static function deleteAll(){
            if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
                
            }
            header('Location: '.URL.'controller=carrito&action=index');
        }

        public static function update(){
            if(isset($_SESSION['identity']) && isset($_SESSION['carrito']) && !isset($_SESSION['admin'])){
                
            }
            header('Location: '.URL.'controller=carrito&action=index');
        }
    }
?>