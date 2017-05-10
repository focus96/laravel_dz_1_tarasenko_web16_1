# Вопросы:
---
---
### 1. Роуты:
##### 1.1
Я переписал свои роуты на группу, пример увидел в [этом проекте](https://github.com/renatomarinho/laravel-gitscrum/blob/master/routes/web.php). Не стал оставлять ```Route::middleware('auth')->resource('news','NewsController');``` т.к. мне нужно было присвоить разные middleware для роутов ресурса, и заодно попробовал себя в написании группы) В итоге получилось как-то [так](https://github.com/focus96/laravel_dz_1_tarasenko_web16_1/blob/master/routes/web.php). Старые комменты пока не удалял.
- **_Такое решение годится, и можно ли его оставить?_**

Решение неплохое, но можно пойти немного другим путем. У тебя останется только `Route::resource`.
```php
// web.php

Route::resource('news', 'NewsController')->middleware('auth');

// NewsController.php

public function __construct() {
    $this->middleware('gate:moderator', [
        'only' => ['create', 'edit', 'store', 'update']
    ]);
    $this->middleware('gate:admin', [
        'only' => ['destroy']
    ]);
    // в middleware можно передать параметры
    // middlewareName:param1,param2,param3
    // handle($request, $next, $param1, $param2, $param3, ...)
}

// GateMiddleware.php (создай такой класс)

public function handle($request, Closure $next, $roles, $param) {
    $roles = explode('|', $roles); // gate:admin|user,anotherParam
    // do something here.
}


```


##### 1.2
В итоге у меня получились такие методы для роутов:
| Rout          | Method        |
| :----------- |:-------------:|
| /news|GET|
| /news/create|GET|
| /news/edit |GET|  
|/news/show|GET|
|/news/store|POST|
|/news/update|PUT|
|/news/destroy|DELETE|
- **_Нужно ли в каких-то роутах определять по два метода?_**
- **_Когда я попытаюсь перейти по роуту не тем методом, например news/store (POST) перейду GET, вылетит Exception, его нужно обработать к примеру перенаправлением на страницу ошибки (404)?_**
Нет необходимости, у тебя это resource controller, он отвечает за хранение, редактирование, создание и удаление. Ничего лишнего. 
Нет, перенаправлять никуда не нужно, если в проекте есть такие страницы, то в production они будут отображаться по умолчанию. Создай view/errors/404.blade.php для обработки 404 ошибки (посмотри вот [это](https://ru.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D0%BA%D0%BE%D0%B4%D0%BE%D0%B2_%D1%81%D0%BE%D1%81%D1%82%D0%BE%D1%8F%D0%BD%D0%B8%D1%8F_HTTP)). Создай так же файлы для 403, 500 и других ошибок (которые будут в проекте). Например, если ты посморишь на 403 ошибку (Forbidden), ты увидишь что ее пользователь получает в случае если доступ к ресурсу запрещен. Т.е. в нашем middleware, если у юзера нет прав, мы пишем `abort(403)` и он получит эту ошибку. Если он огибся маршрутом, скормим ему 404.

##### 1.3
В твоем коде для ```NewsRequest``` в валидации ```validateUpdate()``` заметил строку - ```'title'   => 'required|unique:news,title,' . request()->news->id,```. 

Так же в ```NewsController``` в методе ```update(NewsRequest $request, News $news)``` ты писал, что ```News $news``` уже существует.

Но проблема в том, что в первом случае отработало только ```request()->id```, а во втором мне пришлось вернуться к варианту с выбором новости из базы.. 
- **_Это связано с тем, что нужно привязать модель к роутам??_**

Нужно юзать resource controller.

---
### 2. abort(404)
Когда у модератора нет прав на редактирование не своей статьи, я кидаю ошибку ```abort(403)``` - недостаточно прав. Создал папку ```resource/views/errors/```, в которую поместил файл ```403.blade.php```. Но все ровно кидает [Exeption](http://c2n.me/3KeABJ0)

- **_Это из-за ```tracy```?_**

---
### 3. ```.blade``` в ```onclick=""```
Когда я переписывал ссылки, так как ты показал, мне нужно было генерировать уникалькиые ```id``` для форм, что бы обратиться в ```onclick```. Я конкатенировал ```id```, но конструкция ```{{ ... }}``` не отрабатывала в ```onclick```. Пришлось написать так: ```...getElementById('show-form<?php echo $item->id;?>')...``` 

- **_Говнокод или сойдет?_**
Почитай про blade, про разницу между {{  }} и {!!  !!}
https://laravel.com/docs/5.4/blade
Displaying Unescaped Data
---


