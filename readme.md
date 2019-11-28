## Note

Setup database and create backup directory 

- Setup database on .env file.
- Add your MySQL database name by comma separate to env file with `BACKUP_DATABASES` and this will stored into `storage/backups/` for example
`BACKUP_DATABASES = "db1, db2, db3, db4, db5"`
- Create `backups` directory to `storage` folder.
- Run serve command `php artisan serve` by default it serve to http://127.0.0.1:8000
