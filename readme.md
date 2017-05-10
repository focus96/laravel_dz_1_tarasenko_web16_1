# Спасибо за ответы, буду работать дальше!
# Вопросы:
---
---
### 1. Роуты:
##### 1.1
Я переписал свои роуты на группу, пример увидел в [этом проекте](https://github.com/renatomarinho/laravel-gitscrum/blob/master/routes/web.php). Не стал оставлять ```Route::middleware('auth')->resource('news','NewsController');``` т.к. мне нужно было присвоить разные middleware для роутов ресурса, и заодно попробовал себя в написании группы) В итоге получилось как-то [так](https://github.com/focus96/laravel_dz_1_tarasenko_web16_1/blob/master/routes/web.php). Старые комменты пока не удалял.
- **_Такое решение годится, и можно ли его оставить?_**

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
- **_Когда я попытаюсь перейти по роуту не тем методом, например news/store (POST) перейду GET, вылетит Exepytion, его нужно обработать к примеру перенаправлением на страницу ошибки (404)?_**

##### 1.3
В твоем коде для ```NewsRequest``` в валидации ```validateUpdate()``` заметил строку - ```'title'   => 'required|unique:news,title,' . request()->news->id,```. 

Так же в ```NewsController``` в методе ```update(NewsRequest $request, News $news)``` ты писал, что ```News $news``` уже существует.

Но проблема в том, что в первом случае отработало только ```request()->id```, а во втором мне пришлось вернуться к варианту с выбором новости из базы.. 
- **_Это связано с тем, что нужно привязать модель к роутам??_**

---
### 2. abort(404)
Когда у модератора нет прав на редактирование не своей статьи, я кидаю ошибку ```abort(403)``` - недостаточно прав. Создал папку ```resource/views/errors/```, в которую поместил файл ```403.blade.php```. Но все ровно кидает [Exeption](http://c2n.me/3KeABJ0)

- **_Это из-за ```tracy```?_**

---
### 3. ```.blade``` в ```onclick=""```
Когда я переписывал ссылки, так как ты показал, мне нужно было генерировать уникалькиые ```id``` для форм, что бы обратиться в ```onclick```. Я конкатенировал ```id```, но конструкция ```{{ ... }}``` не отрабатывала в ```onclick```. Пришлось написать так: ```...getElementById('show-form<?php echo $item->id;?>')...``` 

- **_Говнокод или сойдет?_**
---


