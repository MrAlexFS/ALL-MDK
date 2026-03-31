from sqlalchemy.orm import Session
from typing import Optional, List
from app.models.pizza import PizzaDB

class PizzaManager:
    """Класс для управления операциями с пиццами в базе данных"""
    
    @staticmethod
    def get_pizzas(
        db: Session,
        category: Optional[str] = None,
        size: Optional[str] = None,
        max_price: Optional[float] = None,
        available_only: bool = False
    ) -> List[PizzaDB]:
        """
        Получить список пицц с фильтрацией
        
        Args:
            db: Сессия базы данных
            category: Фильтр по категории
            size: Фильтр по размеру
            max_price: Максимальная цена
            available_only: Только доступные пиццы
            
        Returns:
            List[PizzaDB]: Список пицц
        """
        query = db.query(PizzaDB)
        
        if available_only:
            query = query.filter(PizzaDB.is_available == True)
        
        if category:
            query = query.filter(PizzaDB.category == category)
        
        if size:
            query = query.filter(PizzaDB.size == size)
        
        if max_price:
            query = query.filter(PizzaDB.price <= max_price)
        
        return query.all()
    
    @staticmethod
    def get_pizza_by_id(db: Session, pizza_id: int) -> Optional[PizzaDB]:
        """
        Получить пиццу по ID
        
        Args:
            db: Сессия базы данных
            pizza_id: ID пиццы
            
        Returns:
            Optional[PizzaDB]: Пицца или None если не найдена
        """
        return db.query(PizzaDB).filter(PizzaDB.id == pizza_id).first()
    
    @staticmethod
    def create_pizza(db: Session, pizza_data: dict) -> PizzaDB:
        """
        Создать новую пиццу
        
        Args:
            db: Сессия базы данных
            pizza_data: Данные пиццы
            
        Returns:
            PizzaDB: Созданная пицца
        """
        db_pizza = PizzaDB(**pizza_data)
        db.add(db_pizza)
        db.commit()
        db.refresh(db_pizza)
        return db_pizza
    
    @staticmethod
    def update_pizza(db: Session, pizza_id: int, update_data: dict) -> Optional[PizzaDB]:
        """
        Обновить пиццу
        
        Args:
            db: Сессия базы данных
            pizza_id: ID пиццы
            update_data: Данные для обновления
            
        Returns:
            Optional[PizzaDB]: Обновленная пицца или None
        """
        db_pizza = PizzaManager.get_pizza_by_id(db, pizza_id)
        if not db_pizza:
            return None
        
        for field, value in update_data.items():
            if value is not None:
                setattr(db_pizza, field, value)
        
        db.commit()
        db.refresh(db_pizza)
        return db_pizza
    
    @staticmethod
    def delete_pizza(db: Session, pizza_id: int) -> bool:
        """
        Удалить пиццу
        
        Args:
            db: Сессия базы данных
            pizza_id: ID пиццы
            
        Returns:
            bool: True если удалено, False если не найдена
        """
        db_pizza = PizzaManager.get_pizza_by_id(db, pizza_id)
        if not db_pizza:
            return False
        
        db.delete(db_pizza)
        db.commit()
        return True