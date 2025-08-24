
# Task Manager API

Task Manager API — это простой API для управления задачами, созданный в рамках тестового задания с использованием PHP, Nginx, Docker, MySQL и Swagger.

## Начало работы
Для запуска проекта необходим установленный Docker

```bash
docker-compose up -d --build
```

Эта команда запустит сервер Nginx, PHP-приложение и базу данных MySQL

## API эндпоинты
```
http://localhost:8080/
```
| Метод | Эндпоинт            | Описание              |
|-------|---------------------|-----------------------|
| GET   | /api/tasks          | Получить все задачи   |
| POST  | /api/tasks          | Создать новую задачу  |
| GET   | /api/tasks/{id}     | Получить задачу по ID |
| PUT   | /api/tasks/{id}     | Обновить задачу по ID |
| DELETE| /api/tasks/{id}     | Удалить задачу по ID  |

## Документация Swagger
API задокументирован с помощью Swagger. Доступ к интерактивной документации можно получить по адресу:
```
http://localhost:8080/swagger/index.html
```
