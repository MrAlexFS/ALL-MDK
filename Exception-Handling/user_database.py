from database_exceptions import UserNotFoundError, UserAlreadyExistsError


class UserDatabase:
    """Простая БД пользователей в памяти"""
    
    def __init__(self):
        """Инициализация пустой базы данных"""
        self.users = {} 
    
    def add_user(self, user_id, name, email):
        """
        Добавить пользователя в БД
        
        Args:
            user_id: ID пользователя (int)
            name: Имя пользователя (str)
            email: Email пользователя (str)
        
        Raises:
            UserAlreadyExistsError: Если пользователь уже существует
            ValueError: Если переданы некорректные данные
        """

        if not isinstance(user_id, int):
            raise ValueError(f"ID пользователя должен быть целым числом, получен {type(user_id).__name__}")
        

        if not name or not isinstance(name, str):
            raise ValueError("Имя пользователя не может быть пустым")
        
        if not email or not isinstance(email, str):
            raise ValueError("Email пользователя не может быть пустым")
        

        if user_id in self.users:
            raise UserAlreadyExistsError(user_id)
        

        self.users[user_id] = {"name": name, "email": email}
        

        print(f"Пользователь {name} добавлен")
    
    def get_user(self, user_id):
        """
        Получить пользователя по ID
        
        Args:
            user_id: ID пользователя
            
        Returns:
            dict: Данные пользователя
            
        Raises:
            UserNotFoundError: Если пользователь не найден
        """

        if user_id not in self.users:
            raise UserNotFoundError(user_id)
        

        return self.users[user_id]
    
    def delete_user(self, user_id):
        """
        Удалить пользователя
        
        Args:
            user_id: ID пользователя
            
        Raises:
            UserNotFoundError: Если пользователь не найден
        """

        if user_id not in self.users:
            raise UserNotFoundError(user_id)
        

        user_name = self.users[user_id]["name"]
        

        del self.users[user_id]
        

        print(f"Пользователь {user_name} (ID: {user_id}) удален")
    
    def get_all_users(self):
        """Получить всех пользователей"""
        return self.users