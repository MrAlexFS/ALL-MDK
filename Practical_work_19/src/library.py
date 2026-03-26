"""
Модуль, реализующий библиотеку книг.
"""

class Library:
    def __init__(self):
        self._books = {}   # {title: {'author': author, 'available': bool}}

    def add_book(self, title: str, author: str) -> None:
        """
        Добавляет книгу в библиотеку.
        :raises ValueError: если книга уже существует.
        """
        if title in self._books:
            raise ValueError(f"Книга '{title}' уже есть в библиотеке")
        self._books[title] = {'author': author, 'available': True}

    def issue_book(self, title: str) -> None:
        """
        Выдаёт книгу, если она есть и доступна.
        :raises ValueError: если книги нет или она уже выдана.
        """
        if title not in self._books:
            raise ValueError(f"Книга '{title}' не найдена")
        if not self._books[title]['available']:
            raise ValueError(f"Книга '{title}' уже выдана")
        self._books[title]['available'] = False

    def return_book(self, title: str) -> None:
        """
        Возвращает книгу, если она есть и выдана.
        :raises ValueError: если книги нет или она не была выдана.
        """
        if title not in self._books:
            raise ValueError(f"Книга '{title}' не найдена")
        if self._books[title]['available']:
            raise ValueError(f"Книга '{title}' уже в библиотеке")
        self._books[title]['available'] = True

    def get_available_count(self) -> int:
        """Возвращает количество доступных книг."""
        return sum(1 for b in self._books.values() if b['available'])

    def get_issued_count(self) -> int:
        """Возвращает количество выданных книг."""
        return sum(1 for b in self._books.values() if not b['available'])

    def get_book_info(self, title: str):
        """
        Возвращает информацию о книге (словарь) или None, если книги нет.
        """
        if title not in self._books:
            return None
        return self._books[title]