<?php
/**
 * 观察者模式
 * 观察者模式为您提供了避免组件之间紧密耦合的另一种方法。该模式非常简单：一个对象通过添加一个方法（该方法允许另一个对象，即观察者 注册自己）使本身变得可观察。当可观察的对象更改时，它会将消息发送到已注册的观察者。这些观察者使用该信息执行的操作与可观察的对象无关。结果是对象可以相互对话，而不必了解原因。
 * 显示一个用户列表，添加用户时，它将发送出一条消息。添加用户时，通过发送消息的日志观察者可以观察此列表。
 * IObservable 接口定义可以被观察的对象，UserList 实现该接口，以便将本身注册为可观察。
 * IObserver 列表定义要通过怎样的方法才能成为观察者，UserListLogger 实现 IObserver 接口
 */
interface IObserver
{
    function onChanged( $sender, $args );
}

interface IObservable
{
    function addObserver( $observer );
}

class UserList implements IObservable
{
    private $_observers = array();

    public function addCustomer( $name )
    {
        foreach( $this->_observers as $obs )
            $obs->onChanged( $this, $name );
    }

    public function addObserver( $observer )
    {
        $this->_observers []= $observer;
    }
}

class UserListLogger implements IObserver
{
    public function onChanged( $sender, $args )
    {
        echo( "'$args' added to user list\n" );
    }
}

$ul = new UserList();
$ul->addObserver( new UserListLogger() );
$ul->addCustomer( "Jack" );
?>
