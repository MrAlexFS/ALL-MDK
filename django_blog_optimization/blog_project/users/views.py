from django.shortcuts import render
from django.contrib.auth.decorators import login_required

from django.contrib.auth import authenticate, login
from django.shortcuts import render, redirect

@login_required
def profile(request):
    user = request.user
    # Оптимизация для постов: категория (ForeignKey) + комментарии (обратная связь)
    posts = user.posts.select_related('category').prefetch_related('comments')
    # Оптимизация для комментариев: пост и автор поста (цепочка ForeignKey)
    comments = user.comments.select_related('post__author')
    return render(request, 'users/profile.html', {
        'posts': posts,
        'comments': comments,
    })

def login_view(request):
    if request.method == 'POST':
        username = request.POST.get('username')
        password = request.POST.get('password')
        user = authenticate(request, username=username, password=password)
        if user:
            login(request, user)
            return redirect('profile')
        else:
            return render(request, 'users/login.html', {'error': 'Неверные данные'})
    return render(request, 'users/login.html')