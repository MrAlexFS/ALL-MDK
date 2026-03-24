# User Database Project

Проект для демонстрации работы с обработкой исключений в Python.

## Структура проекта

- `database_exceptions.py` - собственные классы исключений
- `user_database.py` - класс для работы с базой данных пользователей
- `main.py` - демонстрация работы с обработкой ошибок
- `tests/` - юнит-тесты

## Установка зависимостей
```bash
pip install -r requirements.txt
```

## Запуск

```bash
# Запуск основной программы
python main.py

# Запуск тестов
pytest tests/ -v

# Запуск тестов с покрытием
pytest tests/ --cov=. --cov-report=html
```