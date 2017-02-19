#!/bin/bash
php yii migrate --migrationPath=@app/migrations
php yii migrate/up --migrationPath=@yii/rbac/migrations
php yii migrate/up --migrationPath=@vendor/yii2mod/yii2-user/migrations
php yii migrate/up --migrationPath=@yii/rbac/migrations