<h1>Reporte de Artículos con Bajo Stock</h1>

<p>Estos son los artículos que tienen stock menor a 10 unidades:</p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Precio Unitario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->name }}</td>
                <td>{{ $article->stock }}</td>
                <td>{{ $article->category->name ?? 'Sin categoría' }}</td>
                <td>${{ $article->price_unit }}</td>
            </tr>
        @endforeach
    </tbody>
</table>