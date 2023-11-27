# CDH (COMPANIES DATA HARVEST)

## Установка

### 1. Клонуємо репозиторий
```bash
git clone https://github.com/RomanMahiiovych/cdh-docker.git
```
### 2. Запускаємо докер контейнери

     2.1. Копіюємо **.env.example докера і .env.example проекту** в відповідні файли **.env**  
     
     2.2. Встановлюємо пароль до бази даних в **.env докеру**
     
     2.3. Запускаємо контейнери:
```bash
docker-compose up --build
```
Ця команда створить наступні контейнери
+ cdh-docker-server-1 - **Adminko API**
+ cdh-docker-client-1 - **Apache server for API Client**
+ cdh-docker-composer-1 - **Composer**
+ cdh-docker-db-1 - **MySQL database**
+ cdh-docker-adminer-1 - **Database manager**

### Змінні середовища і консольні команди
| Назва | Значення           | Коментар                                           |
| ----- |--------------------|----------------------------------------------------|
| 
| _COMPANIES_API_URI_ | http://server:3000 | Адреса зовнішнього API сервера наданого в завданні |
| _X_CLIENT_HEADER_VALUE_ | --                 | Хедер авторизації, наданий в  завданні    |

_`php artisan save:companies-data`_ - запускає 3 воркера для збереження в базу даних інформації про компанії, працівників і їх позиції.
Запущена на черзі **sync**.