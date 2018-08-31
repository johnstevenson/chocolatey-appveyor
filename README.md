# chocolatey-appveyor
Testing using Chocolatey to set up PHP and Composer on Appveyor CI.

## Original Method
```yml
build: false
shallow_clone: true
platform:
  - x64

environment:
    PHP_CACHE_DIR: C:\tools\php
    PHP_DOWNLOAD_URL: http://windows.php.net/downloads/releases/archives
    PHP_ZIP: php-7.1.11-nts-Win32-VC14-x64.zip

cache:
  - '%PHP_CACHE_DIR% -> appveyor.yml'

init:
  - SET PATH=%PHP_CACHE_DIR%;%PATH%
  - SET COMPOSER_NO_INTERACTION=1
  - SET PHP=0

install:
  - IF EXIST %PHP_CACHE_DIR% (SET PHP=1)
  - IF %PHP%==0 mkdir %PHP_CACHE_DIR% && cd %PHP_CACHE_DIR%
  - IF %PHP%==0 appveyor DownloadFile %PHP_DOWNLOAD_URL%/%PHP_ZIP%
  - IF %PHP%==0 7z x %PHP_ZIP% -y >nul && del /Q *.zip
  - IF %PHP%==0 cinst -y composer -i --ia /DEV=%PHP_CACHE_DIR%
  - php -v
  - IF %PHP%==1 (composer self-update) ELSE (composer --version)
  - cd %APPVEYOR_BUILD_FOLDER%
  - composer install --prefer-dist --no-progress

test_script:
  - cd %APPVEYOR_BUILD_FOLDER%
  - php test.php
```
