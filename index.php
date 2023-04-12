<?php

//TODO: Operador comando de windows ``

function ejemploComandos(){
    $var = `HELP DIR`; // Comando linux para mostrar un listado de archivos completo del directorio actual
    echo "<pre>$var</pre>";
}
// ejemploComandos();

//TODO: Bucles

// Todos los siguientes ejemplos son válidos y devuelven lo mismo, 123456789
// EJEMPLO 1
function ejemploFor(){
    echo('for normal:');
    for($i = 1; $i <= 10; $i++) {
        echo $i;
    }

    ?><br><?php

    echo('for condicioón interna y break:');
    // EJEMPLO 2
    for ($i = 1; ; $i++){
        if($i > 10) {
            break;
        }
        echo $i;
    }

    ?><br><?php

    echo('for expresión vacía:');
    // EJEMPLO 3
    $i = 1;
    for( ; ; ){
        if($i > 10){
            break;
        }
        echo $i;
        $i++;
    }

    ?><br><?php

    echo('for imprime en expresión:');
    // EJEMPLO 4
    for ($i = 1, $j = 0; $i <= 10; $j += $i, print $i, $i++);
}
// ejemploFor();

// TODO: ticks

function handler(){
    echo "<br>";
}

function ejemploTicks(){
    register_tick_function("handler");
    $i = 0;
    declare(ticks = 3) {
        while($i < 9)
            echo ++$i;
    }
}
// ejemploTicks();

// TODO: echo

function ejemploEcho(){
    $color = 'verde';
    $array = ['animal'=>'perro'];

    echo "Color: $color";
    echo "<br>";
    echo "El animal es {$array['animal']}";
}
// ejemploEcho();

// TODO: funciones
function ejemploFunciones1(){
    print "Esta es mi función";
    return 1;
    print "Ahora saldré de la función";
}
// ejemploFunciones1(); //No imprime el 1
// print ejemploFunciones1(); //Imprime el 1

function square($num){
    return $num * $num;
}
// print square(4); //No funciona sin el print o echo
 
function verPelicula($titulo = "Avatar"){
    return "Vamos a ver la película $titulo" . "<br>";
} 
// echo verPelicula();
// echo verPelicula("Braveheart");

function verPeliculas($titulos = array("Avatar"), $genero = null){
    $generoPelicula = is_null($genero) ? "" : " cuyo género es: $genero";
    return "Hoy vamos a ver: ".join(", ", $titulos) . $generoPelicula . "<br>";
}
// echo verPeliculas();
// echo verPeliculas(array("La jungla de cristal", "007", "Transporter"), "acción");

function incrementar(&$var){
    $var++;
}
$numero = 10;
incrementar($numero);
// echo $numero;

// TODO: funciones anónimas

class Numeros {
    static function mostrarNumero()
    {
        echo "5";
    }
}
// call_user_func(array('Numeros', 'mostrarNumero')); // Muestra 5
// Esta forma de llamar al método es estática.
// Si el método no fuera static, con esta forma generaría un error
// Strict Standards, non-static method should not be called statically
// Llamada a un método estático:
// call_user_func('Numeros::mostrarNumero');

/* En la función _arraywalk, el primer parámetro es un array, y el segundo un callback que suele
 aceptar dos parámetros, el primero es el valor ($potencia) y el segundo la clave ($coche). */

class Coche
{
    protected $coches = array();
    public function add($coche, $potencia)
    {
        $this->coches[$coche] = $potencia;
    }
    public function mostrarCoches()
    {
        $callback = function ($potencia, $coche) {
            echo $coche . " -> " . $potencia . "<br>";
        };
        array_walk($this->coches, $callback);
    }
}
$coche = new Coche;
$coche->add('Audi', '200');
$coche->add('BMW', '220');
$coche->add('Mercedes', 250);
// $coche->mostrarCoches(); 

/* Lo que hace es crear un nuevo closure en el scope del nuevo objeto $newthis, por lo que tendrá los valores de este nuevo objeto.
Los closures son realmente objetos, instancias de la clase Closure. Esta clase dispone de los métodos bind() y bindTo(), que permiten 
duplicar una clausura con un objeto vinculado y ámbito de clase nuevos. */

class ClaseUno
{
    private $privadaUno = "Valor Uno";
    private $privadaDos = "Valor Dos";
    public function obtenerPropiedades()
    {
        return 'Las propiedades privadas son: '.
        $this->privadaUno . ' y ' . $this->privadaDos;
    }
}
$claseUno = new ClaseUno();
// echo $claseUno->obtenerPropiedades() . "\n"; 

class CarroDeLaCompra {
    const PRECIO_BROCOLI = 1.00;
    const PRECIO_PIMIENTO = 0.40;
    const PRECIO_CALABACIN = 0.60;

    protected $productos = array();

    public function añadir($producto, $cantidad)
    {
        $this->productos[$producto] = $cantidad;
    }
    public function obtenerTotal($impuesto)
    {
        $total = 0.00;

        $callback = function ($cantidad, $producto) use ($impuesto, &$total)
        {
            $precioUnidad = constant(__CLASS__ . "::PRECIO_" .
                strtoupper($producto));
            $total += ($precioUnidad * $cantidad) * ($impuesto + 1.0);
        };

        array_walk($this->productos, $callback);

        return round($total, 2);
    }
}
$miCarro = new CarroDeLaCompra();
// Añadir artículos al carro de la compra
$miCarro->añadir('brocoli', 2);
$miCarro->añadir('pimiento', 4);
$miCarro->añadir('calabacin', 3);
// Devolver el total con un impuesto del 5%
// echo $miCarro->obtenerTotal(0.05) . "<br>";
// Resultado: 5.67 

// TODO: Entrecomillado de cadena de carácteres
class CocheS {
    public $color = "azul";
    public $tipo = array("Marca" => "SEAT", "Modelo" => "Toledo");
}
$miCoche = new CocheS;
//Para acceder a un valor de propiedad puede usarse sintaxis compleja o simple:
// echo "Ese coche es {$miCoche->color}" . PHP_EOL;
// echo "Ese coche es $miCoche->color" . PHP_EOL;

// Si se trata de valores de array dentro de propiedades, necesitamos la compleja:
// echo "Los coches {$miCoche->tipo['Marca']} son de buena calidad" . PHP_EOL;
// No funciona sin comillas, genera un Fatal error:
// echo "Marca de coche: {$miCoche->tipo[Marca]}" . PHP_EOL; // Fatal error: Uncaught Error: Undefined constant

// TODO: comparación de cadenas
$arr1 = $arr2 = array("img12.png", "img10.png", "img2.png", "img1.png");
// echo "Comparación estándar normal";
usort($arr1, "strcmp");
// print_r($arr1);
// echo('<br>');
// echo "\nComparación con orden natural\n";
usort($arr2, "strnatcmp");
// print_r($arr2);

// Usar SPL

// TODO: Conversión de un array multidimensional a un objeto
$animales = [
    "perro" => ["nombre" => "Spoofy", "edad" => 10],
    "gato" => ["nombre" => "Lenders", "edad" => 9],
    "conejo" => ["nombre" => "Tobby", "edad" => 4],
    "caballo" => ["nombre" => "Trotter", "edad" => 10]
];
function arrayToObject($array) {
    if (is_array($array)) {
        return (object) array_map(__FUNCTION__, $array);
    }
    else {
        // Return object
        return $array;
    }
}
$objeto = arrayToObject($animales);
// var_dump($objeto);
// echo('<br>');
// echo "Nombre del perro: " . $objeto->perro->nombre . "<br>";
// echo "Edad del perro: " . $objeto->perro->edad . "<br>";

// TODO: conversión de objetos en arrays multidimensionales
function objectToArray($objeto) {
    if (is_object($objeto)) {
        $objeto = get_object_vars($objeto);
    }
    if (is_array($objeto)) {
        return array_map(__FUNCTION__, $objeto);
    }
    else {
        return $objeto;
    }
}
$animales = new stdClass;
$animales->perro = "Spoofy";
$animales->gato = new stdClass;
$animales->gato->nombre = "Lenders";
$animales->gato->edad = "9";

$array = objectToArray($animales);
// var_dump($array);
// echo('<br>');
// echo "El nombre del gato es: {$array["gato"]["nombre"]} <br>";
// echo "La edad del gato es: {$array["gato"]["edad"]} <br>";

// TODO:  Como prevenir ataques SQL Injection en PHP
/*Usar prepared statements y parameterized queries. Esto son sentencias SQL preparadas que se envían a la base de datos 
de forma separada a cualquier parámetro. De esta forma es imposible para un atacante inyectar SQL malicioso. 
Es la forma más recomendable y segura de evitar este tipo de ataques. 
Se puede hacer de dos formas: 1. Con PDO:*/
// $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE nombre = :nombre');
// $stmt->execute(array('nombre' => $nombre));
// foreach ($stmt as $row) {
//     // Hacer algo con $row
// }

// // 2. Con MySQLi:
// $stmt = $dbConnection->prepare('SELECT * FROM usuarios WHERE nombre = ?');
// $stmt->bind_param('s', $nombre);

// $stmt->execute();

// $result = $stmt->get_result();
// while ($row = $result->fetch_assoc()){
    // Hacer algo con $row
// }
// Escapar caracteres especiales.
/*La función _mysqli_real_escapestring, o _mysqli::escapestring y _mysqli::real_escapestring en su versión OOP, 
coge el string que va a ser pasado a la sentencia y lo devuelve con los posibles ataques SQL injection eliminados. Ejemplo usando su versión OOP:*/
// $mysqli = new mysqli("localhost", "usuario", "contraseña", "database");

// $usuario = "' OR 1'";
// $usuario = $mysqli->escape_string($usuario);

// $query1 = "SELECT * FROM user WHERE name = '$usuario'";
// // echo "SQL injection escapado: <br />" . $query1 . "<br />";

// $usuario2 = "'; DELETE FROM customers WHERE 1 or username = '";
// $usuario2 = $mysqli->real_escape_string($usuario2);

// $query2 = "SELECT * FROM user WHERE name = '$usuario2'";
// echo "SQL injection escapado: <br/>" . $query2; 

// TODO: Instancia de clases
class ClaseA {
    function funcionA()
    {
        if(isset($this)){
            // echo '$this está definido, su clase es: ';
            // La función get_class devuelve el nombre de la clase de un objeto:
            // echo get_class($this) . "<br>";
        } else {
            echo '$this no está definido <br>';
        }
    }
}
class ClaseB {
    function funcionB() {
        // Se llama estáticamente a la función A, pero ésta no es estática
        // Fatal error: Uncaught Error: Non-static method ClaseA::funcionA() cannot be called statically
        // ClaseA::funcionA();
    }
} 

// Probamos a instanciar Clase A y a usar la función functionA
$a = new claseA(); // $a es un objeto
$a->funcionA(); // Devuelve: $this está definido, su clase es: ClaseA

// Llamada estática a funcionA
// ClaseA::funcionA(); // Devuelve: Fatal error: Uncaught Error: Non-static method ClaseA::funcionA() cannot be called statically
// $this no funciona, no hay objeto al que hacer referencia

// Instanciamos la clase B
$b = new ClaseB(); // $b es otro objeto
$b->funcionB(); // Devuelve: $this está definido, su clase es: ClaseB
// Pero emite un E_STRICT por llamar estáticamente ClaseA::funcionA()

// Llamada estática a funcionB
// ClaseB::funcionB(); // Devuelve: $this no está definido
// Fatal error: Uncaught Error: Non-static method ClaseB::funcionB() cannot be called statically


// Dentro del contexto de una clase, se puede crear un nuevo objeto utilizando new self o new parent:
class Comunicacion {
    public $saludo = "Hola! <br>";
    // Con el constructor disparamos un echo cada vez que se instancia la clase
    function __construct(){
        echo $this->saludo;
    }
    // Si llamamos a este método, volvemos a instanciar la clase
    public function saludar(){
        $objeto = new self;
        return $objeto;
    }
}
// $obj = new Comunicacion(); // Devuelve Hola!
// $obj->saludar(); // Devuelve Hola! //Sirve para volver a llamar a la clase sin tener que crear de nuevo la instancia


/*En ocasiones lo que queremos es hacer una copia de un objeto sin afectar al original. Una copia de un objeto ya creado 
se puede hacer con la palabra clone, que copia las propiedades y métodos del objeto en uno nuevo, y llama después a la 
función clone() para la clase que está copiando. Se puede utilizar **clone()** para ejecutar más acciones si se desea 
(algo así como un constructor para el objeto copiado):*/
class Perro {
    public $nombre;
}
$unPerro = new Perro;
$unPerro->nombre = "Werthers"; // $unPerro se llama Werthers
// Creamos una función para cambiar el nombre:
function cambiarNombre($perro, $nombre){
    $perro->nombre = $nombre;
}
cambiarNombre($unPerro, "Smirnoff"); // ahora $unPerro se llama Smirnoff
// Clonamos el objeto $unPerro:
$otroPerro = clone $unPerro;
// Cambiamos el nombre del perro clonado:
cambiarNombre($otroPerro, "Donald"); // $otroPerro se llama Donald
// $unPerro se sigue llamando Smirnoff

// TODO: Type Hitting

/* el type hinting, o la determinación de tipos, que permite especificar el tipo de datos que se espera de un argumento en la 
declaración de una función */
class Aguacate {
    public $calorias = 100;
}
class Persona {
    public $energia;
    public function comerAguacate (Aguacate $aguacate) {
        $this->energia += $aguacate->calorias;
    }
    public function mostrarEnergia(){
        return "Energía actual: " . $this->energia . "<br>";
    }
}
$sonia = new Persona;
$almuerzo = new Aguacate;
$sonia->comerAguacate($almuerzo);
$sonia->comerAguacate($almuerzo);
// echo $sonia->mostrarEnergia(); // Devuelve: Energía actual 200


?>