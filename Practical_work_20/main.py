from src.library import Library

def main():
    lib = Library()

    print("=== Начальное состояние библиотеки ===")
    print(f"Доступно книг: {lib.get_available_count()}")
    print(f"Выдано книг: {lib.get_issued_count()}")

    print("\n=== Добавление новой книги ===")
    lib.add_book("The Catcher in the Rye", "J.D. Salinger")
    print(f"Доступно книг после добавления: {lib.get_available_count()}")

    print("\n=== Выдача книги '1984' ===")
    lib.issue_book("1984")
    print(f"Доступно книг: {lib.get_available_count()}")
    print(f"Выдано книг: {lib.get_issued_count()}")

    print("\n=== Возврат книги '1984' ===")
    lib.return_book("1984")
    print(f"Доступно книг: {lib.get_available_count()}")

    print("\n=== Информация о книге 'Brave New World' ===")
    info = lib.get_book_info("Brave New World")
    print(info)

if __name__ == "__main__":
    main()