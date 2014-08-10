<ifmodule mod_rewrite.c="">
  RewriteEngine On
  RewriteBase /
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond $1 !^(index\.php|images|robots\.txt)
  RewriteRule ^(.*)$ index.php?$1 [L]
</ifmodule>
