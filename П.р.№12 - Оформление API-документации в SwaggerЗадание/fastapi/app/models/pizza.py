from sqlalchemy import Column, Integer, String, Float, Boolean
from sqlalchemy.ext.declarative import declarative_base

Base = declarative_base()

class PizzaDB(Base):
    """Модель пиццы в базе данных"""
    __tablename__ = "pizzas"
    
    id = Column(Integer, primary_key=True, index=True)
    name = Column(String, nullable=False)
    category = Column(String, nullable=False)
    size = Column(String, nullable=False)
    price = Column(Float, nullable=False)
    ingredients = Column(String, nullable=False)
    is_available = Column(Boolean, default=True)