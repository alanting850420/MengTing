dev: .docker-up

.docker-up:
	@docker-compose up -d

del: .docker-down

.docker-down:
	docker-compose down
