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
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name

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