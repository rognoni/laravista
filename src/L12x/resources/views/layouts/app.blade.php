<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>🔍Pages</title>
    @yield('head')
  </head>
  <body>
    <main class="container">
      <nav>
        <ul>
          <li><a href="{{ route('pages') }}"><strong>🔍Pages</strong></a></li>
        </ul>
        <ul>
          <li><a href="https://monastic.neocities.org/?c=docs/index.md">docs</a></li>
          <li><a href="https://neocities.org/site/monastic">Neocities</a></li>
        </ul>
      </nav>
      @yield('content')
      <small>
        <nav>
          <ul>
            <li><a href="https://www.linkedin.com/in/laravista/">LinkedIn</a></li>
            <li><a href="https://techhub.social/@laravista">Mastodon</a></li>
            <li>💬<a href="https://github.com/rognoni/VanillaStaticCMS/discussions">Discussions</a></li>
          </ul>
          <ul>
            <li><a href="https://monastic.neocities.org/site.yaml">site.yaml</a></li>
          </ul>
        </nav>
      </small>
    </main>
  </body>
</html>