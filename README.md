# Laravel Tech Exam API

This is a Laravel-based RESTful API that fetches and stores data from [JSONPlaceholder](https://jsonplaceholder.typicode.com) and provides secure authenticated endpoints. The app is fully containerized using Docker.

---

## 📦 Requirements

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git https://github.com/jrmaloc08/tech_interview_app.git

```
### 2. Build and start the containers:
```
docker-compose up --build -d

```
### 3. Run Database Migrations

```
docker-compose exec app php artisan migrate


```
### 4. Fetch Data from JSONPlaceholder
```
docker-compose exec app php artisan app:fetch-json-placeholder

```