# youtube_downloader
Парсит страницу, находит youtube видео, скачивает их и загужает на dailymotion.com.

# system requirements
Для работы скрита необходимо, чтобы в системе был установлен youtube-dl - https://github.com/ytdl-org/youtube-dl.
python3 должен быть в $PATH и доступен как python. PHP не ниже 7.1, расширнеие php-curl.

# settings
После загрузки проекта, нужно обновить зависимости composer - composer update. 
Создать файл config.php по подобию config.php.example и заполнить своими данными.
Запуск скрипта - php heandler.php http://test.site/youadr.html
