# Makefile

# Variables
SERVICE=app
APP_ENV?=local

# Start Docker containers
start:
	APP_ENV=$(APP_ENV) docker-compose up --build -d

# Stop Docker containers
stop:
	docker-compose down

# Restart Docker containers
restart-all:
	docker-compose down
	APP_ENV=$(APP_ENV) docker-compose up --build -d

# Apply migration
deploy-migrations:
	docker-compose exec $(SERVICE) php artisan migrate

# Apply seed
deploy-seed:
	docker-compose exec $(SERVICE) php artisan db:seed