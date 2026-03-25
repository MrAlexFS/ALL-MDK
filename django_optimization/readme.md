# Профилирование данных в Django: проблема N+1 запросов

## 📌 Цель работы

Изучить проблему N+1 запросов в Django, научиться выявлять её с помощью Django Debug Toolbar и оптимизировать с использованием методов `select_related` и `prefetch_related`.

---

## 🛠 Технологии

- Python 3.10+
- Django 6.x
- Django Debug Toolbar
- SQLite (по умолчанию)

---

## 📁 Структура проекта

```text
django_optimization/
├── blog_project/ # основной проект Django
│ ├── settings.py
│ ├── urls.py
│ └── ...
├── blog/ # приложение с моделями
│ ├── models.py # модели Author, Category, Tag, Post
│ ├── views.py # представления (плохое и хорошее)
│ ├── urls.py # маршруты для блога
│ ├── templates/blog/ # шаблоны
│ │ ├── post_list_bad.html # для демонстрации N+1
│ │ └── post_list_good.html # после оптимизации
│ └── migrations/ # миграции
├── manage.py
└── README.md
```

---

## 🚀 Установка и запуск

### 1. Клонирование или создание проекта

Создайте виртуальное окружение и установите зависимости:

```bash
python -m venv .venv
source .venv/bin/activate      # Linux/macOS
.venv\Scripts\activate          # Windows

pip install django django-debug-toolbar
```

## 🧨 Запуск сервера

```bach
python manage.py runserver
```

## 🔓 Откройте в браузере:

```text
    http://127.0.0.1:8000/blog/bad/

    http://127.0.0.1:8000/blog/good/
```
