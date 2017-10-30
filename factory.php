<?php
/**
 * 工厂模式 是一种类，它具有为您创建对象的某些方法。您可以使用工厂类创建对象，而不直接使用 new。
 * 这样，如果您想要更改所创建的对象类型，只需更改该工厂即可。使用该工厂的所有代码会自动更改。
 * 上面的代码用来一个工厂来创建 Automobile 对象。用这种方式创建对象有两个好处： 
 * 首先，如果你后续需要更改，重命名或替换 Automobile 类，你只需要更改工厂类中的代码，而不是在每一个用到 Automobile 类的地方修改； 
 * 其次，如果创建对象的过程很复杂，你也只需要在工厂类中写，而不是在每个创建实例的地方重复地写。
 */
class Automobile
{
    private $vehicleMake;
    private $vehicleModel;

    public function __construct($make, $model)
    {
        $this->vehicleMake = $make;
        $this->vehicleModel = $model;
    }

    public function getMakeAndModel()
    {
        return $this->vehicleMake . ' ' . $this->vehicleModel;
    }
}

class AutomobileFactory
{
    public static function create($make, $model)
    {
        return new Automobile($make, $model);
    }
}

// 用工厂的 create 方法创建 Automobile 对象
$veyron = AutomobileFactory::create('Bugatti', 'Veyron');
//
print_r($veyron->getMakeAndModel()); // outputs "Bugatti Veyron"
?>
