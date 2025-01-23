<h1>Notificación: Artículo sin stock</h1>
<p>El siguiente artículo se ha quedado sin stock:</p>
<ul>
    <li>Nombre del artículo: {{ $article->name }}</li>
    <li>Categoría: {{ $article->category->name ?? 'Sin categoría' }}</li>
    <li>Precio unitario: ${{ $article->price_unit }}</li>
</ul>