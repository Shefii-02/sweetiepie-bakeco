<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>
    
    {{-- Loop through dynamic URLs --}}
    @foreach ($dynamic_urls as $url)
        <url>
            <loc>{{ $url }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
    
    {{-- Loop through static URLs --}}
    @foreach ($static_urls as $url)
        <url>
            <loc>{{ $url }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
</urlset>
