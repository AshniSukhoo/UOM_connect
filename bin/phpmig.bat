@ECHO OFF
SET BIN_TARGET=%~dp0/../vendor/davedevelopment/phpmig/bin/phpmig
php "%BIN_TARGET%" %*
