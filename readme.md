Пример использования router

$routes = [
    '/' =>  'homepage',
    'show' =>  'show',
    'edit' =>  'edit',
    'update' =>  'update',
    'create' =>  'create',
    'store' =>  'store',
    'delete' =>  'delete',
    'post' =>  'post',
];

$router = new Router($routes);
include $router->start() . '.php';

Пример использования QueryBilder

$db = new QueryBilder(Connection::start(
            'mysql:host=localhost;dbname=lesson-2',
            'root',
            ''
));

$db->update('posts',[
		'title' => 'new title',
], 3);
