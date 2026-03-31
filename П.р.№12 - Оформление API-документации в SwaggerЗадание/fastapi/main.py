from fastapi import FastAPI, Depends, HTTPException, Query, Path, status
from sqlalchemy.orm import Session
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from typing import Optional, List
from pydantic import BaseModel, Field

from app.models.pizza import Base, PizzaDB
from app.managers.manager_pizza import PizzaManager

# --- Настройка базы данных ---
SQLALCHEMY_DATABASE_URL = "sqlite:///./pizza.db"
engine = create_engine(
    SQLALCHEMY_DATABASE_URL, connect_args={"check_same_thread": False}
)
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

# Создание таблиц
Base.metadata.create_all(bind=engine)

# Dependency для получения сессии БД
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

# --- Pydantic модели с документацией ---
class PizzaCreate(BaseModel):
    """Схема для создания пиццы"""
    name: str = Field(
        ...,
        min_length=2,
        max_length=100,
        description="Название пиццы (от 2 до 100 символов)",
        example="Маргарита"
    )
    category: str = Field(
        ...,
        description="Категория пиццы. Допустимые значения: vegetarian, meat, spicy",
        example="vegetarian"
    )
    size: str = Field(
        ...,
        description="Размер пиццы. Допустимые значения: 30 (маленькая), 40 (большая)",
        example="30"
    )
    price: float = Field(
        ...,
        gt=0,
        le=5000,
        description="Цена пиццы в рублях (должна быть больше 0)",
        example=450.0
    )
    ingredients: str = Field(
        ...,
        min_length=3,
        description="Ингредиенты пиццы через запятую",
        example="томатный соус, моцарелла, базилик"
    )
    is_available: bool = Field(
        default=True,
        description="Доступна ли пицца для заказа",
        example=True
    )

class PizzaUpdate(BaseModel):
    """Схема для обновления пиццы (все поля необязательны)"""
    name: Optional[str] = Field(
        None,
        min_length=2,
        max_length=100,
        description="Название пиццы",
        example="Пепперони"
    )
    category: Optional[str] = Field(
        None,
        description="Категория пиццы: vegetarian, meat, spicy",
        example="meat"
    )
    size: Optional[str] = Field(
        None,
        description="Размер пиццы: 30 или 40",
        example="40"
    )
    price: Optional[float] = Field(
        None,
        gt=0,
        description="Цена пиццы в рублях",
        example=599.0
    )
    ingredients: Optional[str] = Field(
        None,
        min_length=3,
        description="Ингредиенты пиццы через запятую",
        example="томатный соус, моцарелла, пепперони"
    )
    is_available: Optional[bool] = Field(
        None,
        description="Доступна ли пицца для заказа",
        example=True
    )

class PizzaOut(BaseModel):
    """Схема для ответа с данными пиццы"""
    id: int = Field(
        ...,
        description="Уникальный идентификатор пиццы в базе данных",
        example=1
    )
    name: str = Field(..., description="Название пиццы", example="Маргарита")
    category: str = Field(..., description="Категория пиццы", example="vegetarian")
    size: str = Field(..., description="Размер пиццы", example="30")
    price: float = Field(..., description="Цена пиццы в рублях", example=450.0)
    ingredients: str = Field(..., description="Ингредиенты пиццы", example="томатный соус, моцарелла, базилик")
    is_available: bool = Field(..., description="Доступность пиццы для заказа", example=True)
    
    class Config:
        from_attributes = True

# --- Настройка тегов ---
tags_metadata = [
    {
        "name": "Пиццы",
        "description": """
        Управление меню пицц:
        - **GET** — просмотр всех пицц, доступных пицц и конкретной пиццы
        - **POST** — добавление новой пиццы в меню
        - **PUT** — полное обновление данных пиццы
        - **DELETE** — удаление пиццы из меню
        """
    },
    {
        "name": "Категории",
        "description": """
        Получение списка доступных категорий пицц
        """
    }
]

# --- Создание приложения с метаданными ---
app = FastAPI(
    title="🍕 DoDo Pizza API",
    description="""
    ## Сервис управления меню пиццерии
    
    Этот API предоставляет полный набор операций для управления меню пицц.
    
    ### Категории пицц:
    - **vegetarian** — Вегетарианские пиццы (Маргарита, Грибная, Овощная)
    - **meat** — Мясные пиццы (Пепперони, Мясная, Барбекю)
    - **spicy** — Острые пиццы (Диабло, Острая пепперони)
    
    ### Размеры пицц:
    - **30** — Маленькая (30 см, 2-3 порции)
    - **40** — Большая (40 см, 4-5 порций)
    
    ### Возможности API:
    - 📋 Просмотр всего меню
    - ✅ Просмотр только доступных пицц
    - 🔍 Фильтрация по категории и размеру
    - ➕ Добавление новых пицц
    - ✏️ Редактирование существующих
    - 🗑️ Удаление пицц из меню
    - 📊 Получение списка категорий
    
    ### Коды ответов:
    - `200` — Успешный запрос
    - `201` — Пицца успешно создана
    - `404` — Пицца с указанным ID не найдена
    - `422` — Ошибка валидации данных
    """,
    version="1.0.0",
    openapi_tags=tags_metadata
)

# --- Эндпоинты с документацией ---

@app.get(
    "/pizzas",
    response_model=List[PizzaOut],
    tags=["Пиццы"],
    summary="Получить список всех пицц",
    description="""
    Возвращает полный список пицц из базы данных.
    
    **Параметры фильтрации:**
    - `category` — фильтр по категории (vegetarian, meat, spicy)
    - `size` — фильтр по размеру (30, 40)
    - `max_price` — максимальная цена пиццы
    
    **Если фильтры не указаны** — возвращаются все пиццы.
    """
)
def get_pizzas(
    db: Session = Depends(get_db),
    category: Optional[str] = Query(
        default=None,
        description="Фильтр по категории пиццы. Допустимые значения: vegetarian, meat, spicy",
        example="vegetarian"
    ),
    size: Optional[str] = Query(
        default=None,
        description="Фильтр по размеру пиццы. Допустимые значения: 30 (маленькая), 40 (большая)",
        example="30"
    ),
    max_price: Optional[float] = Query(
        default=None,
        gt=0,
        description="Максимальная цена пиццы в рублях",
        example=500.0
    )
):
    return PizzaManager.get_pizzas(
        db=db,
        category=category,
        size=size,
        max_price=max_price,
        available_only=False
    )

@app.get(
    "/pizzas/available",
    response_model=List[PizzaOut],
    tags=["Пиццы"],
    summary="Получить список доступных пицц",
    description="""
    Возвращает список пицц, которые доступны для заказа (is_available = True).
    
    **Параметры фильтрации:**
    - `category` — фильтр по категории
    - `size` — фильтр по размеру
    - `max_price` — максимальная цена
    
    **Если фильтры не указаны** — возвращаются все доступные пиццы.
    """
)
def get_available_pizzas(
    db: Session = Depends(get_db),
    category: Optional[str] = Query(
        default=None,
        description="Фильтр по категории пиццы",
        example="meat"
    ),
    size: Optional[str] = Query(
        default=None,
        description="Фильтр по размеру пиццы",
        example="40"
    ),
    max_price: Optional[float] = Query(
        default=None,
        gt=0,
        description="Максимальная цена пиццы в рублях",
        example=600.0
    )
):
    return PizzaManager.get_pizzas(
        db=db,
        category=category,
        size=size,
        max_price=max_price,
        available_only=True
    )

@app.get(
    "/pizzas/{pizza_id}",
    response_model=PizzaOut,
    tags=["Пиццы"],
    summary="Получить пиццу по ID",
    description="""
    Возвращает детальную информацию о пицце по её уникальному идентификатору.
    
    **Возможные ошибки:**
    - `404` — Пицца с указанным ID не найдена в базе данных
    """
)
def get_pizza(
    pizza_id: int = Path(
        ...,
        ge=1,
        description="Уникальный числовой идентификатор пиццы в базе данных",
        example=1
    ),
    db: Session = Depends(get_db)
):
    pizza = PizzaManager.get_pizza_by_id(db, pizza_id)
    if not pizza:
        raise HTTPException(
            status_code=status.HTTP_404_NOT_FOUND,
            detail="Пицца с таким ID не найдена"
        )
    return pizza

@app.post(
    "/pizzas",
    response_model=PizzaOut,
    status_code=status.HTTP_201_CREATED,
    tags=["Пиццы"],
    summary="Создать новую пиццу",
    description="""
    Добавляет новую пиццу в меню пиццерии.
    
    **Поля запроса:**
    - `name` — название пиццы (обязательно)
    - `category` — категория (обязательно)
    - `size` — размер (обязательно)
    - `price` — цена (обязательно, должна быть > 0)
    - `ingredients` — ингредиенты через запятую (обязательно)
    - `is_available` — доступность (по умолчанию True)
    
    **Возможные ошибки:**
    - `422` — Ошибка валидации данных
    """
)
def create_pizza(
    pizza: PizzaCreate,
    db: Session = Depends(get_db)
):
    return PizzaManager.create_pizza(db, pizza.model_dump())

@app.put(
    "/pizzas/{pizza_id}",
    response_model=PizzaOut,
    tags=["Пиццы"],
    summary="Обновить данные пиццы",
    description="""
    Полностью обновляет информацию о пицце по её ID.
    Все поля пиццы заменяются на новые значения.
    
    **Возможные ошибки:**
    - `404` — Пицца с указанным ID не найдена
    - `422` — Ошибка валидации данных
    """
)
def update_pizza(
    pizza_id: int = Path(
        ...,
        ge=1,
        description="ID пиццы для обновления",
        example=1
    ),
    pizza: PizzaUpdate = None,
    db: Session = Depends(get_db)
):
    update_data = pizza.model_dump(exclude_unset=True)
    updated_pizza = PizzaManager.update_pizza(db, pizza_id, update_data)
    
    if not updated_pizza:
        raise HTTPException(
            status_code=status.HTTP_404_NOT_FOUND,
            detail="Пицца с таким ID не найдена"
        )
    
    return updated_pizza

@app.delete(
    "/pizzas/{pizza_id}",
    tags=["Пиццы"],
    summary="Удалить пиццу",
    description="""
    Удаляет пиццу из меню по её идентификатору.
    
    **Возможные ошибки:**
    - `404` — Пицца с указанным ID не найдена
    """
)
def delete_pizza(
    pizza_id: int = Path(
        ...,
        ge=1,
        description="ID пиццы для удаления",
        example=1
    ),
    db: Session = Depends(get_db)
):
    deleted = PizzaManager.delete_pizza(db, pizza_id)
    
    if not deleted:
        raise HTTPException(
            status_code=status.HTTP_404_NOT_FOUND,
            detail="Пицца с таким ID не найдена"
        )
    
    return {"message": f"Пицца с ID {pizza_id} успешно удалена"}

@app.get(
    "/categories",
    tags=["Категории"],
    summary="Получить список категорий",
    description="""
    Возвращает список всех доступных категорий пицц с их описаниями.
    
    **Категории:**
    - `vegetarian` — Вегетарианские пиццы (Маргарита, Грибная, Овощная)
    - `meat` — Мясные пиццы (Пепперони, Мясная, Барбекю)
    - `spicy` — Острые пиццы (Диабло, Острая пепперони)
    """
)
def get_categories():
    return [
        {
            "name": "vegetarian",
            "display_name": "Вегетарианские",
            "description": "Пиццы с овощами и грибами"
        },
        {
            "name": "meat",
            "display_name": "Мясные",
            "description": "Пиццы с мясными ингредиентами"
        },
        {
            "name": "spicy",
            "display_name": "Острые",
            "description": "Пиццы с острыми соусами и перцем"
        }
    ]