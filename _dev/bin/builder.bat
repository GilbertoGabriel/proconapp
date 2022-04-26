@ECHO OFF
SET BIN_TARGET=%~dp0/map/cards.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/categorias.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/cores.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/estabelecimento_produtos.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/estabelecimento_produtos_preco.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/estabelecimentos.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/marcas.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/menus.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/perfil_tela.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/perfis.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/permissoes.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/produtos.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/situacoes_registros.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/telas.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/map/usuarios.php
php "%BIN_TARGET%" %*
SET BIN_TARGET=%~dp0/builder.bat
del "%BIN_TARGET%" %*