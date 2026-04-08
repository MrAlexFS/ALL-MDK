class Library:
    def __init__(self):
        self._books = {
            "1984": {"author": "George Orwell", "available": True},
            "Brave New World": {"author": "Aldous Huxley", "available": True},
            "Fahrenheit 451": {"author": "Ray Bradbury", "available": True},
        }

    def add_book(self, title, author):
        if not title or not author:
            raise ValueError("Title and author cannot be empty")
        if title in self._books:
            raise ValueError(f"Book '{title}' already exists")
        self._books[title] = {"author": author, "available": True}

    def issue_book(self, title):
        if title not in self._books:
            raise ValueError(f"Book '{title}' not found")
        if not self._books[title]["available"]:
            raise ValueError(f"Book '{title}' is already issued")
        self._books[title]["available"] = False

    def return_book(self, title):
        if title not in self._books:
            raise ValueError(f"Book '{title}' not found")
        if self._books[title]["available"]:
            raise ValueError(f"Book '{title}' is not issued")
        self._books[title]["available"] = True

    def get_available_count(self):
        return sum(1 for book in self._books.values() if book["available"])

    def get_issued_count(self):
        return len(self._books) - self.get_available_count()

    def get_book_info(self, title):
        if title not in self._books:
            return None
        book = self._books[title]
        return {
            "title": title,
            "author": book["author"],
            "available": book["available"]
        }