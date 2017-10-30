<?php
/**
 *某些应用程序资源是独占的，因为有且只有一个此类型的资源。
 *例如，通过数据库句柄到数据库的连接是独占的。您希望在应用程序中共享数据库句柄，因为在保持连接打开或关闭时，它是一种开销，在获取单个页面的过程中更是如此。单元素模式可以满足此要求。
 *如果应用程序每次包含且仅包含一个对象，那么这个对象就是一个单元素（Singleton）。
 *此代码显示名为 DatabaseConnection 的单个类。您不能创建自已的 DatabaseConnection，因为构造函数是专用的。但使用静态 get 方法，您可以获得且仅获得一个 DatabaseConnection 对象。
 */
require_once("DB.php");

class DatabaseConnection
{
    public static function get()
    {
        static $db = null;
        if ( $db == null )
            $db = new DatabaseConnection();
        return $db;
    }

    private $_handle = null;

    private function __construct()
    {
        $dsn = 'mysql://root:password@localhost/photos';
        $this->_handle =& DB::Connect( $dsn, array() );
    }

    public function handle()
    {
        return $this->_handle;
    }
}

//在两次调用间，handle 方法返回的数据库句柄是相同的，这就是最好的证明。您可以在命令行中运行代码来观察这一点。
//返回的两个句柄是同一对象。如果您在整个应用程序中使用数据库连接单元素，那么就可以在任何地方重用同一句柄。
//您可以使用全局变量存储数据库句柄，但是，该方法仅适用于较小的应用程序。在较大的应用程序中，应避免使用全局变量，并使用对象和方法访问资源。
print( "Handle = ".DatabaseConnection::get()->handle()."\n" );
print( "Handle = ".DatabaseConnection::get()->handle()."\n" );
?>
