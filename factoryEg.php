<?php  
/**
 *主要是当操作类的参数变化时，只用改相应的工厂类就可以

 *工厂设计模式常用于根据输入参数的不同或者应用程序配置的不同来创建一种专门用来实例化并返回其对应的类的实例。

 *假设矩形、圆都有同样的一个方法，那么我们用基类提供的API来创建实例时，通过传参数来自动创建对应的类的实例，他们都有获取周长和面积的功能。
 */

interface InterfaceShape   
{  
    function getArea();  
    function getCircumference();  
}  

/** 
 * 矩形 
 */  
class Rectangle implements InterfaceShape  
{  
    private $width;  
    private $height;  

    public function __construct($width, $height)  
    {  
        $this->width = $width;  
        $this->height = $height;  
    }  

    public function getArea()   
    {  
        return $this->width* $this->height;  
    }  

    public function getCircumference()  
    {  
        return 2 * $this->width + 2 * $this->height;  
    }  
}  

/** 
 * 圆形 
 */  
class Circle implements InterfaceShape  
{  
    private $radius;  

    function __construct($radius)  
    {  
        $this->radius = $radius;  
    }  


    public function getArea()   
    {  
        return M_PI * pow($this->radius, 2);  
    }  

    public function getCircumference()  
    {  
        return 2 * M_PI * $this->radius;  
    }  
}  

/** 
 * 形状工厂类 
 */  
class FactoryShape   
{   
    public static function create()  
    {  
        switch (func_num_args()) {  
        case 1:  
            return new Circle(func_get_arg(0));  
        case 2:  
            return new Rectangle(func_get_arg(0), func_get_arg(1));  
        default:  
            break;  
        }  
    }   
}  

$rect =FactoryShape::create(5, 5);  
// object(Rectangle)#1 (2) { ["width":"Rectangle":private]=> int(5) ["height":"Rectangle":private]=> int(5) }  
var_dump($rect);  
echo "<br>";  

// object(Circle)#2 (1) { ["radius":"Circle":private]=> int(4) }  
$circle =FactoryShape::create(4);  
var_dump($circle);  

?>
