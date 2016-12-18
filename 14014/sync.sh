#!/bin/sh
mv project_hub/index.php index.php.saved
rm -rf project_hub/*
cp -a project_hub-src/public/* www
cp project_hub-src/public/.* www
rm -rf project_hub/index.php
mv index.php.saved www/index.php