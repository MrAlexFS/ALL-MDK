import pytest
from user_database import UserDatabase
from database_exceptions import UserNotFoundError, UserAlreadyExistsError

class TestUserDatabase:
    
    def setup_method(self):
        """Создаем новую БД перед каждым тестом"""
        self.db = UserDatabase()
        self.db.add_user(1, "Иван", "ivan@test.com")
    
    def test_add_user_success(self):
        """Тест успешного добавления"""
        self.db.add_user(2, "Петр", "petr@test.com")
        assert 2 in self.db.users
        assert self.db.users[2]["name"] == "Петр"
    
    def test_add_user_duplicate(self):
        """Тест добавления дубликата"""
        with pytest.raises(UserAlreadyExistsError) as exc_info:
            self.db.add_user(1, "Дубликат", "dup@test.com")
        assert "уже существует" in str(exc_info.value)
    
    def test_add_user_invalid_id(self):
        """Тест с некорректным ID"""
        with pytest.raises(ValueError) as exc_info:
            self.db.add_user("строка", "Тест", "test@test.com")
        assert "целым числом" in str(exc_info.value)
    
    def test_get_user_success(self):
        """Тест успешного получения"""
        user = self.db.get_user(1)
        assert user["name"] == "Иван"
        assert user["email"] == "ivan@test.com"
    
    def test_get_user_not_found(self):
        """Тест получения несуществующего"""
        with pytest.raises(UserNotFoundError) as exc_info:
            self.db.get_user(999)
        assert "не найден" in str(exc_info.value)
    
    def test_delete_user_success(self):
        """Тест успешного удаления"""
        self.db.delete_user(1)
        assert 1 not in self.db.users
    
    def test_delete_user_not_found(self):
        """Тест удаления несуществующего"""
        with pytest.raises(UserNotFoundError):
            self.db.delete_user(999)