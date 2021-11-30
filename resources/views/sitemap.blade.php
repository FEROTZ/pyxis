<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  {{-- @foreach ($menus as $menu)
    <url>
        <loc>{{$menu->slug}}</loc>
        <lastmod>{{gmdate('Y-m-dTH:i:sZ',strtotime($menu->updated_at))}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
  @endforeach --}}
  
    @foreach($menus as $menu)
      @if($menu->padre_id == 1)

        @foreach($menu->menus as $producto)
          <url>
            <loc>{{url($producto->padre->slug.'/'.$producto->slug)}}</loc>
            <lastmod>{{gmdate('Y-m-dTH:i:sZ', strtotime($producto->updated_at))}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
          </url>
            @foreach($producto->menus as $categoria)
              <url>
                <loc>{{url($producto->slug.'/'.$categoria->slug)}}</loc>
                <lastmod>{{gmdate('Y-m-dTH:i:sZ', strtotime($categoria->updated_at))}}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.4</priority>
              </url>
              @foreach($categoria->menus as $sub_categoria)
                <url>
                  <loc>{{url($producto->slug."/".$sub_categoria->slug)}}</loc>
                  <lastmod>{{gmdate('Y-m-dTH:i:sZ', strtotime($producto->updated_at))}}</lastmod>
                  <changefreq>daily</changefreq>
                  <priority>0.2</priority>
                </url>
              @endforeach

            @endforeach
        @endforeach

      @endif
    @endforeach
  
</urlset>