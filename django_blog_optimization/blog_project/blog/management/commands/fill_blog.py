import random
from django.core.management.base import BaseCommand
from django.contrib.auth.models import User
from blog.models import Category, Tag, Post, Comment


class Command(BaseCommand):
    help = 'Заполняет базу данных тестовыми данными для демонстрации N+1 проблемы'

    def add_arguments(self, parser):
        parser.add_argument(
            '--clear',
            action='store_true',
            help='Очистить существующие данные перед заполнением',
        )

    def handle(self, *args, **options):
        if options['clear']:
            self.stdout.write('Очистка существующих данных...')
            Post.objects.all().delete()
            Category.objects.all().delete()
            Tag.objects.all().delete()
            Comment.objects.all().delete()
            # Удаляем всех пользователей, кроме суперпользователя (если есть)
            User.objects.exclude(is_superuser=True).delete()

        # Создаём пользователей
        users = []
        for i in range(1, 6):
            username = f'user{i}'
            user, created = User.objects.get_or_create(
                username=username,
                defaults={'email': f'{username}@example.com'}
            )
            if created:
                user.set_password('pass123')
                user.save()
                self.stdout.write(f'Создан пользователь: {username}')
            users.append(user)

        # Категории
        categories = []
        for name in ['IT', 'Life', 'Sport']:
            cat, created = Category.objects.get_or_create(name=name)
            if created:
                self.stdout.write(f'Создана категория: {name}')
            categories.append(cat)

        # Теги
        tags = []
        for name in ['python', 'django', 'news', 'fun', 'tutorial']:
            tag, created = Tag.objects.get_or_create(name=name)
            if created:
                self.stdout.write(f'Создан тег: {name}')
            tags.append(tag)

        # Посты
        posts = []
        for i in range(1, 10):
            author = random.choice(users)
            category = random.choice(categories)
            title = f'Пост {i}: {random.choice(["Новости", "Обзор", "Туториал", "Мысли"])}'
            post = Post.objects.create(
                title=title,
                content='Lorem ipsum ' * 20,
                author=author,
                category=category,
            )
            # Добавляем от 1 до 3 случайных тегов
            for _ in range(random.randint(1, 3)):
                post.tags.add(random.choice(tags))
            posts.append(post)
            self.stdout.write(f'Создан пост: {title}')

        # Комментарии
        comment_count = 0
        for post in posts:
            # Каждому посту от 2 до 5 комментариев
            for _ in range(random.randint(2, 5)):
                author = random.choice(users)
                text = f'Комментарий от {author.username}: ' + random.choice([
                    'Отлично!', 'Спасибо!', 'Интересно', '👍', 'Полезно', 'Согласен'
                ])
                Comment.objects.create(
                    text=text,
                    author=author,
                    post=post,
                )
                comment_count += 1

        self.stdout.write(self.style.SUCCESS(
            f'Готово! Создано: {len(users)} пользователей, '
            f'{len(categories)} категорий, {len(tags)} тегов, '
            f'{len(posts)} постов, {comment_count} комментариев.'
        ))