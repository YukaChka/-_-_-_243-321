# Курсовая работа — Новостной сайт на Laravel

**Студент:** Шуфер Максим Александрович  
**Группа:** 243-321  
**Фреймворк:** Laravel 13  

---

## Цель курсовой работы

Приобретение навыков верстки сайтов с помощью Laravel. Создание новостного сайта с авторизацией, ролевой моделью, системой комментариев, email-рассылкой и очередями задач.

---

## Запуск проекта

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

# В отдельном терминале — воркер очереди
php artisan queue:work
```

### Тестовые учётные записи

| Роль | Email | Пароль |
|------|-------|--------|
| Модератор | moderator@example.com | password |
| Читатель | reader@example.com | password |

---

## Ход выполнения заданий

---

### Задание 1 — Макет страниц сайта
**Цель:** Изучить работу с маршрутизатором и шаблонизатором Blade.

| Файл | Действие | Описание |
|------|----------|----------|
| `resources/views/layouts/app.blade.php` | создан | Общий макет всех страниц: шапка с навигацией, `@yield('content')`, футер с ФИО и группой |
| `resources/views/home.blade.php` | создан | Главная страница-приветствие, расширяет макет через `@extends` |
| `resources/views/about.blade.php` | создан | Страница «О нас» с текстовым содержимым |
| `resources/views/contacts.blade.php` | создан | Страница «Контакты», выводит динамический массив данных через `@foreach` |
| `routes/web.php` | создан | Маршруты `GET /`, `/about`, `/contacts` с передачей массива контактов через `view()` |

---

### Задание 2 — Вывод данных из JSON-файла
**Цель:** Изучить работу с контроллером.

| Файл | Действие | Описание |
|------|----------|----------|
| `app/Http/Controllers/maincontroller.php` | создан | Метод `index` читает JSON-файл из `public/` и передаёт данные на главную; метод `gallery` отображает полное изображение |
| `resources/views/home.blade.php` | изменён | Переверстана под вывод карточек из JSON с превью-изображениями |
| `resources/views/gallery.blade.php` | создан | Страница галереи с отображением полного изображения (`full_image`) |
| `routes/web.php` | изменён | Маршрут `GET /` теперь вызывает `maincontroller@index`; добавлен `GET /gallery/{id}` |

---

### Задание 3 — Регистрация пользователей
**Цель:** Работа с данными пользователя, валидация, CSRF.

| Файл | Действие | Описание |
|------|----------|----------|
| `resources/views/auth/signin.blade.php` | создан | Форма регистрации с полями имя, email, пароль; CSRF-токен `@csrf`; вывод ошибок валидации |
| `app/Http/Controllers/authcontroller.php` | создан | Метод `create` — отдаёт форму; метод `registration` — валидирует данные и возвращает JSON-ответ |
| `routes/web.php` | изменён | Добавлены маршруты `GET /signin` и `POST /signin` |

---

### Задание 4 — Модель Article, миграция, фабрика, сидер
**Цель:** Изучение работы с моделями, миграциями, фабриками объектов.

| Файл | Действие | Описание |
|------|----------|----------|
| `app/Models/Article.php` | создан | Модель с `$fillable = ['title', 'description', 'image']` |
| `database/migrations/..._create_articles_table.php` | создан | Миграция таблицы `articles`: поля `title`, `description`, `image`, `timestamps` |
| `database/factories/ArticleFactory.php` | создан | Фабрика с Faker: генерирует случайные заголовок, описание и URL изображения |
| `database/seeders/DatabaseSeeder.php` | изменён | Добавлен вызов `Article::factory(10)->create()` |
| `app/Http/Controllers/ArticleController.php` | создан | Метод `index` получает статьи и передаёт в представление |
| `resources/views/articles/index.blade.php` | создан | Список статей |

---

### Задание 5 — Пагинация, CRUD
**Цель:** Работа с пагинацией, валидацией, реализация полного CRUD.

| Файл | Действие | Описание |
|------|----------|----------|
| `app/Http/Controllers/ArticleController.php` | изменён | Реализованы все методы ресурса: `index` (пагинация `paginate(5)`), `create`, `store`, `show`, `edit`, `update`, `destroy` |
| `resources/views/articles/index.blade.php` | изменён | Добавлены карточки статей, кнопки редактирования/удаления, вывод пагинации `{{ $articles->links() }}` |
| `resources/views/articles/create.blade.php` | создан | Форма создания статьи с валидацией и CSRF |
| `resources/views/articles/edit.blade.php` | создан | Форма редактирования статьи, заполнена текущими данными через `old()` |
| `resources/views/articles/show.blade.php` | создан | Страница просмотра одной статьи |
| `routes/web.php` | изменён | Маршруты статей заменены на `Route::resource('articles', ArticleController::class)` |

---

### Задание 6 — Авторизация через Sanctum
**Цель:** Изучение посредников Sanctum и Auth.

| Файл | Действие | Описание |
|------|----------|----------|
| `app/Models/User.php` | изменён | Добавлен трейт `HasApiTokens` из Sanctum |
| `app/Http/Controllers/authcontroller.php` | переписан | Методы `showRegister`, `register` (сохранение в БД, редирект на `/login`), `showLogin`, `login` (Auth::attempt + createToken), `logout` (удаление токенов, инвалидация сессии, обновление CSRF) |
| `resources/views/auth/register.blade.php` | создан | Форма регистрации с полем подтверждения пароля |
| `resources/views/auth/login.blade.php` | создан | Форма входа с выводом ошибок |
| `resources/views/layouts/app.blade.php` | изменён | Навигация адаптирована: `@auth` показывает имя и кнопку «Выйти», `@else` — «Войти» и «Регистрация» |
| `routes/web.php` | изменён | Добавлены маршруты `/register`, `/login`, `/logout`; статьи защищены `->middleware('auth:sanctum')` |
| `config/sanctum.php` | создан | Опубликован конфиг Sanctum |
| `database/migrations/..._create_personal_access_tokens_table.php` | создан | Таблица токенов Sanctum |

---

### Задание 7 — Роли пользователей, политики, шлюзы
**Цель:** Настройка политик и шлюзов Gate. Добавление ролей.

| Файл | Действие | Описание |
|------|----------|----------|
| `database/migrations/..._create_roles_table.php` | создан | Таблица `roles` с полями `name` и `label` |
| `database/migrations/..._add_role_id_to_users_table.php` | создан | Добавлен внешний ключ `role_id` в таблицу `users` |
| `app/Models/Role.php` | создан | Модель роли со связью `hasMany(User::class)` |
| `app/Models/User.php` | изменён | Добавлены `role_id` в fillable, связь `belongsTo(Role::class)`, метод `isModerator()` |
| `database/seeders/RoleSeeder.php` | создан | Заполняет таблицу ролей: `moderator` и `reader` |
| `database/seeders/DatabaseSeeder.php` | изменён | Вызывает `RoleSeeder`, создаёт пользователей модератора и читателя с нужными ролями |
| `app/Policies/ArticlePolicy.php` | создан | Методы `viewAny`, `view` — разрешены всем; `create`, `update`, `delete` — `Response::deny()` с кастомным сообщением |
| `app/Policies/CommentPolicy.php` | создан | Метод `moderate` — `Response::deny()` для не-модераторов |
| `app/Providers/AppServiceProvider.php` | изменён | Добавлен `Gate::before` — хук, возвращающий `true` для модератора до проверки политик |
| `app/Http/Controllers/Controller.php` | изменён | Добавлен трейт `AuthorizesRequests` (в Laravel 13 отсутствует по умолчанию) |
| `app/Http/Controllers/ArticleController.php` | изменён | В каждый метод добавлен вызов `$this->authorize()` |
| `bootstrap/app.php` | изменён | Настроен кастомный рендер `AuthorizationException` → Blade-страница `errors/403` |
| `resources/views/errors/403.blade.php` | создан | Страница ошибки доступа с кодом 403 и сообщением из исключения |
| `resources/views/layouts/app.blade.php` | изменён | Ссылки «Создать статью» и «Модерация» показываются только через `@can('create', Article::class)` |
| `resources/views/articles/index.blade.php` | изменён | Кнопки «Редактировать» и «Удалить» обёрнуты в `@can('update')` / `@can('delete')` |
| `resources/views/articles/show.blade.php` | изменён | Кнопки управления скрыты для читателя через `@can` |

---

### Задание 8 — Email-рассылка
**Цель:** Настройка email-рассылки через SMTP.

| Файл | Действие | Описание |
|------|----------|----------|
| `.env` | изменён | Настроены переменные `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION` |
| `app/Mail/ArticleCreated.php` | создан | Mailable-класс: принимает `Article` в конструктор; `envelope()` задаёт тему; `content()` указывает Blade-шаблон |
| `resources/views/mail/article-created.blade.php` | создан | HTML-шаблон письма: заголовок статьи, текст, дата, кнопка-ссылка на статью |
| `app/Http/Controllers/ArticleController.php` | изменён | После `Article::create()` добавлен вызов `Mail::to($moderator->email)->send(new ArticleCreated($article))` для всех модераторов |

---

### Задание 9 — Модерация комментариев
**Цель:** Настройка интерфейса модерации комментариев.

| Файл | Действие | Описание |
|------|----------|----------|
| `database/migrations/..._create_comments_table.php` | создан | Таблица `comments`: `article_id` (FK), `user_id` (FK), `body`, `approved` (boolean, default false) |
| `app/Models/Comment.php` | создан | Модель со связями `belongsTo(Article::class)` и `belongsTo(User::class)` |
| `app/Models/Article.php` | изменён | Добавлена связь `hasMany(Comment::class)` |
| `app/Http/Controllers/CommentController.php` | создан | Метод `store` — сохранение с `approved=false`; `moderation` — список непроверенных; `approve` — одобрение; `reject` — удаление |
| `resources/views/comments/moderation.blade.php` | создан | Панель модерации: список ожидающих комментариев с кнопками «Принять» и «Отклонить» |
| `resources/views/articles/show.blade.php` | изменён | Добавлены: форма добавления комментария, список одобренных комментариев, жёлтое сообщение «ожидает модерации» |
| `resources/views/layouts/app.blade.php` | изменён | Добавлена ссылка «Модерация» в навигацию, видна только модератору |
| `routes/web.php` | изменён | Добавлены маршруты `POST /articles/{article}/comments`, `POST /comments/{comment}/approve`, `DELETE /comments/{comment}`, `GET /moderation/comments` |
| `app/Http/Controllers/ArticleController.php` | изменён | В метод `show` добавлен `$article->load('comments.user')` для жадной загрузки |

---

### Задание 10 — Очереди задач
**Цель:** Изучить очереди и задачи Laravel.

| Файл | Действие | Описание |
|------|----------|----------|
| `.env` | изменён | Установлен `QUEUE_CONNECTION=database` |
| `app/Jobs/VeryLongJob.php` | создан | Job-класс: принимает `Article` в конструктор; в методе `handle()` — логика отправки письма всем модераторам через `Mail::to()->send()` |
| `app/Http/Controllers/ArticleController.php` | изменён | Прямой вызов `Mail::send` заменён на `VeryLongJob::dispatch($article)` — задание помещается в очередь |

---

## Технологии

| Категория | Технологии |
|-----------|-----------|
| Фреймворк | Laravel 13 |
| Шаблонизатор | Blade |
| БД | SQLite + Eloquent ORM |
| Аутентификация | Laravel Sanctum |
| Авторизация | Gate, Policies |
| Почта | Laravel Mail, SMTP |
| Очереди | Laravel Queue, Database driver |
| Фронтенд | HTML, CSS (inline styles) |
