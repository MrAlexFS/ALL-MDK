from django.shortcuts import render
from .models import Post

def post_list(request):
    # Оптимизированный запрос: select_related для ForeignKey, prefetch_related для ManyToMany и обратных связей
    posts = Post.objects.select_related('author', 'category') \
                        .prefetch_related('tags', 'comments__author') \
                        .order_by('-created_at')
    return render(request, 'blog/post_list.html', {'posts': posts})