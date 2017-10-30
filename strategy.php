<?php
/**
 * 在此模式中，算法是从复杂类提取的，因而可以方便地替换。
 * 例如，如果要更改搜索引擎中排列页的方法，则策略模式是一个不错的选择。
 * 思考一下搜索引擎的几个部分 —— 一部分遍历页面，一部分对每页排列，
 * 另一部分基于排列的结果排序。
 * 在复杂的示例中，这些部分都在同一个类中。
 * 通过使用策略模式，您可将排列部分放入另一个类中，以便更改页排列的方式，而不影响搜索引擎的其余代码。
 * 示例显示了一个用户列表类，它提供了一个根据一组即插即用的策略查找一组用户的方法
 * 策略模式非常适合复杂数据管理系统或数据处理系统，二者在数据筛选、搜索或处理的方式方面需要较高的灵活性
 */
interface IStrategy
{
    function filter( $record );
}

class FindAfterStrategy implements IStrategy
{
    private $_name;

    public function __construct( $name )
    {
        $this->_name = $name;
    }

    public function filter( $record )
    {
        return strcmp( $this->_name, $record ) <= 0;
    }
}

class RandomStrategy implements IStrategy
{
    public function filter( $record )
    {
        return rand( 0, 1 ) >= 0.5;
    }
}

class UserList
{
    private $_list = array();

    public function __construct( $names )
    {
        if ( $names != null )
        {
            foreach( $names as $name )
            {
                $this->_list []= $name;
            }
        }
    }

    public function add( $name )
    {
        $this->_list []= $name;
    }

    public function find( $filter )
    {
        $recs = array();
        foreach( $this->_list as $user )
        {
            if ( $filter->filter( $user ) )
                $recs []= $user;
        }
        return $recs;
    }
}

$ul = new UserList( array( "Andy", "Jack", "Lori", "Megan" ) );
$f1 = $ul->find( new FindAfterStrategy( "J" ) );
print_r( $f1 );

$f2 = $ul->find( new RandomStrategy() );
print_r( $f2 );
?>
