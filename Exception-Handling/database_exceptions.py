class DatabaseError(Exception):
    """Базовое исключение для ошибок базы данных"""
    pass


class UserNotFoundError(DatabaseError):
    """Исключение: пользователь не найден"""
    def __init__(self, user_id):
        self.user_id = user_id
        super().__init__(f"Пользователь с ID {user_id} не найден")


class UserAlreadyExistsError(DatabaseError):
    """Исключение: пользователь уже существует"""
    def __init__(self, user_id):
        self.user_id = user_id
        super().__init__(f"Пользователь с ID {user_id} уже существует")